<?php

namespace zetsoft\widgets\chates;

use zetsoft\models\chat\ChatMessage;
use zetsoft\models\user\User;
use zetsoft\system\kernels\ZWidget;

class ZRatChatWidget extends ZWidget
{
    public $config = [];
    public $_config = [

    ];

    public $layout = [];
    public $_layout = [
        'main' => <<<HTML
<div class="chat container-fluid h-100 mh-100">
    <div class="row h-100 mh-100">
        <nav class="chat-nav col-lg-3 mh-100 d-flex flex-column overflow-hidden">
            <form class="px-4 pt-4 pb-3">
                <label class="sr-only" for="search-input">Search</label>
                <div class="field">
                    <span class="field__icon fas fa-search" aria-hidden="true"></span>
                    <input id="search-input" class="field__input form-control border-0" type="search" placeholder="Search" autocomplete="off">
                </div>
            </form>

            <ul class="users-list list-unstyled media-list flex-grow-1"></ul>
        </nav>
        
        <main class="chat-area chat-area--closed col-lg-9 mh-100 overflow-hidden d-flex flex-column">
            <p class="chat-closed-message m-0">Open any chat to see its messages</p>
            <div class="chat-body chat-body--empty">
                <header class="chat-header mb-5">
                    <span class="fellow-name"></span>
                </header>
                <p class="chat-empty-message m-0">No messages here. Don't wait, write first!</p>
                <ul class="chat-messages flex-grow-1 w-100 list-unstyled"></ul>
                <form class="message-form d-flex">
                    <input class="message-input form-control flex-grow-1 h-100 mr-2" type="text" placeholder="Type something to send...">
                    <button class="btn btn-primary m-0"><span class="far fa-paper-plane" aria-hidden="true"></span></button>
                </form>
            </div>
        </main>
    </div>
</div>
HTML,
        'socket' => <<<JS
                const CONFIG = {
                    myId: Number('{{myId}}')
                };
                
                const state = {
                    activeChat: null,
                };
                
                const cache = {
                    users: [],
                    
                    getIdentity(userId) {
                        return cache.users.find(({ id }) => id === userId);
                    }
                    
                };
                
                
                const WS_QUERY_RESULT_HANDLERS = {
                    'USERS': (users) => {
                        renderUserChats(users);
                        cache.users = users;
                    },
                    'CONVERSATION': ({ fellow, conversation }) => {
                        renderConversation(fellow, conversation);
                    }
                };
                
                const WS_MESSAGE_HANDLERS = {
                    'QUERY_RESULT': ({ target, result }) => {
                        WS_QUERY_RESULT_HANDLERS[target](result);
                    },                   'NEW_MESSAGE': ({ fellow, conversation }) => {
                        if (!isChatActive(fellow)) {
                            return;
                        }
                        
                        renderConversation(fellow, conversation);
                    }
                };
                
                const connection = new WebSocket('ws://94.158.52.244:2000');
                
                connection.addEventListener('open', () => {
                    wsAuthorize();
                    wsRequestUsers();
                });
                
                connection.addEventListener('message', ({data}) => {
                    const {type, payload} = JSON.parse(data);
                    handleWSMessage(type, payload);
                });
                
                $('#search-input').on('input', () => {
                    const searchQuery = $('#search-input').val();
                    renderUserChats(cache.users.filter(({ name }) => name.includes(searchQuery)));
                });
                
                $('.message-form').on('submit', (e) => {
                    e.preventDefault();
                    
                    const messageText = $('.message-input').val().trim();
                    if (messageText === '') {
                        return;
                    }
                    
                    sendMessage(messageText);
                    $('.message-input').val('');
                });
                
                function sendMessage(text) {
                    wsSend('SEND_MESSAGE', { to: state.activeChat, text });
                }
                
                function handleWSMessage(type, payload) {
                    const handler = WS_MESSAGE_HANDLERS[type];
                
                    if (!handler) {
                        throw new Error('Unknown WS message type: ' + type);
                    }
                
                    handler(payload);
                }
                
                function renderUserChats(users) {
                    $('.users-list').empty();
                    $('.users-list').append(...createUserChatsDOM(users));
                }
                
                function createUserChatsDOM(users) {
                    return users.map(createUserChatDOM);
                }
                
                function createUserChatDOM({id, photo, name}) {
                    return $('<li class="user media px-4" data-id="' + id + '">' +
                        '<img class="user__img rounded-circle" src="' + photo + '" alt="\'s photo">' +
                        '<div class="media-body align-self-center">' +
                            '<span class="user__name d-block font-weight-normal">' + name + '</span>' +
                        '</div>' +
                    '</li>').on('click', () => openChat(id));
                }
                
                function renderConversation(fellowId, conversation) {
                    $('.fellow-name').text(cache.getIdentity(fellowId).name);
                    
                    if (conversation.length === 0) {
                        $('.chat-body').addClass('chat-body--empty');
                        return;
                    }
                    
                    $('.chat-body').removeClass('chat-body--empty');
                    $('.chat-messages').empty();
                    $('.chat-messages').append(createConversationDom(conversation));
                    
                    scrollToBottom();
                }
                
                function createConversationDom(conversation) {
                    return conversation.map(createMessageDom);
                }
                
                function createMessageDom({ from, text, when }) {
                    const isMessageMine = from === CONFIG.myId;
                    
                    return $('<li class="d-flex justify-content-' + (isMessageMine ? 'end' : 'start') + ' mb-3">' +
                        '<div class="">' +
                            '<div class="d-block bg-primary rounded py-2 px-4 text-white">' + text + '</div>' +
                            '<span class="d-block">' + new Date(when).toDateString() + '</span>' +
                        '</div>' +
                    '</li>');
                }
                
                function scrollToBottom() {
                  $('.chat-messages').scrollTop($('.chat-messages')[0].scrollHeight);
                }
                
                function openChat(id) {
                    if (isChatActive(id)) {
                        return;
                    }
                    
                    state.activeChat = id;
                    
                    $('.chat-area').removeClass('chat-area--closed');
                    $('.user.user--open').removeClass('user--open');
                    $('.user[data-id=' + id + ']').addClass('user--open');
                    
                    wsRequestConversation(id);
                }
                
                function wsAuthorize() {
                    wsSend('AUTHORIZATION', { id: CONFIG.myId });
                }
                
                function wsRequestUsers() {
                  wsQuery('USERS');
                }
                
                function wsRequestConversation(userId) {
                    wsQuery('CONVERSATION', { userId });
                }
                
                function wsQuery(target, data = {}) {
                  wsSend('QUERY', { target, ...data });
                }
                
                function wsSend(type, payload) {
                  connection.send(JSON.stringify({ type, payload }));
                }
                
                function isChatActive(fellowId) {
                    return fellowId === state.activeChat;
                }
JS,
    ];

    public function asset()
    {
        $this->fileCss('/render/asrorz/css/chat.css');
    }

    public function codes()
    {
        if ($this->userIsGuest()) {
            $currentUrl = $this->urlParamStr . '.aspx';
            $this->urlRedirect('/core/user/user-auth/login-register.aspx?redirectUrl=' . $currentUrl);
        }


        $this->htm = $this->_layout['main'];

        $this->js = strtr($this->_layout['socket'], [
            '{{myId}}' => $this->userIdentity()->id
        ]);


    }
}
