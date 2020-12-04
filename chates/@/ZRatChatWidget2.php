<?php

/**
 *
 *
 * Author:  Asror Zakirov
 * https://www.linkedin.com/in/asror-zakirov
 * https://www.facebook.com/asror.zakirov
 * https://github.com/asror-z
 *
 */

namespace zetsoft\widgets\chates;


use zetsoft\system\kernels\ZWidget;

class ZRatChatWidget2 extends ZWidget
{
    public $config = [];
    public $_config = [

    ];

    public $layout = [];
    public $_layout = [
        'main' => <<<HTML


    <div id="loginHolder">
        <div class="form-group">
            <label for="text-name">Enter Name</label>
            <div class="input-group d-block">
                <input type="text" onkeyup="loginOnEnter(event)" id="text-name" class="form-control">
                <span class="input-group-addon login-btn float-right btn btn-primary" onclick="login()"> Login </span>
            </div>
        </div>
    </div>
     
        <div id="chatHolder">
            <h3>Hello I'm <span id="me"></span> (<span id="mekey"></span>)</h3>
        </div>
        
            <div class="nav flex-column nav-pills col-md-2" id="onlineUsers">
            
            </div>

        <div class="tab-content col-md-10" id="userChat">
    
        </div>
        
HTML,

        'socket' => <<<JS
     var conn = new WebSocket('ws://' + window.location.hostname + ':1997');
        var name;
        conn.onopen = function (e) {
            var id = {userId};
            var userName = '{userName}';
            console.log("Connection established!");
            var info = {};
            info['userId'] = id,
            info['userName'] = userName
            conn.send(JSON.stringify(info));
        };

        function getTime() {
            var date = new Date();

            return date.toLocaleDateString()
        };

        function sendMessage(e, msgFor) {
            
            var code = (e.keyCode ? e.keyCode : e.which);

            if (code !== 13) {
                return null;
            }

            var message = document.getElementById('message').value;

            if (message.length === 0) {
                return null;
            }

            var msg = {};
         
            msg["type"] = "message";
            msg["name"] = name;
            msg["message"] = message;
            msg["msgFor"] = msgFor;
            msg["from"] = $('#mekey').text();
            conn.send(JSON.stringify(msg));

            var content = document.getElementById('tab_messages_' + msgFor).innerHTML;
            scrollBottom('tab_messages_' + msgFor);

            document.getElementById('tab_messages_' + msgFor).innerHTML = content + '<div class="sent-message">' + message + '</div>';
            document.getElementById('message').value = '';
        };

        function receiveMessage(e) {
            var jsonMessage = JSON.parse(e.data);

            console.log(jsonMessage);
            if (jsonMessage.type === "message") {
                var content = document.getElementById('tab_messages_' + jsonMessage.from).innerHTML;
                document.getElementById('tab_messages_' + jsonMessage.from).innerHTML = content + '<div class="received-message">' + jsonMessage.message + '</div>';
                scrollBottom('tab_messages_' + jsonMessage.from);
            } else if (jsonMessage.type === "onlineUsers") {
                var count = 0;
                var onlineUsers = "";
                var userChat = "";
                $.each(jsonMessage.onlineUsers, function (key, val) {
                    var me = $('#me').text();
                    if (me === val) {
                        $('#mekey').text(key);
                    }
                    if (me != val) {
                        if (count === 0) {
                            onlineUsers = '<a href="#tab_' + key + '" class="nav-link active" data-toggle="pill">' + val + '</a>';

                            userChat = '<div class="tab-pane fade show active" id="tab_' + key + '"><h5>' + val + ' is online</h5><div class="msg-container" id="tab_messages_' + key + '"></div><textarea id="message" class="form-control" onkeyup="sendMessage(event,' + key + ')" placeholder="Type your message here..."></textarea>';
                        } else {
                            onlineUsers = onlineUsers + '<a href="#tab_' + key + '" class="nav-link" data-toggle="pill">' + val + '</a>';
                            userChat = userChat + '<div class="tab-pane fade" id="tab_' + key + '"><h5>' + val + '  is online</h5><div class="msg-container" id="tab_messages_' + key + '"></div><textarea id="message" class="form-control" onkeyup="sendMessage(event,' + key + ')" placeholder="Type your message here..."></textarea>';
                        }
                        count++;
                    }
                });
                //console.log(onlineUsers);
                document.getElementById('onlineUsers').innerHTML = onlineUsers;
                document.getElementById('userChat').innerHTML = userChat;
            }
        };

        conn.onmessage = function (e) {
            console.log(e);

            receiveMessage(e);
        };

        function hideChat() {
            var element = document.getElementById("chatHolder");
            element.style.display = "none";
        }
        
        function loginOnEnter(e) {
            var code = (e.keyCode ? e.keyCode : e.which);

            if (code === 13) {
                login();
            }
        }

        function login() {
            var chatHolder = document.getElementById("chatHolder");
            chatHolder.style.display = "block";
            var loginHolder = document.getElementById("loginHolder");
            loginHolder.style.display = "none";

            name = document.getElementById("text-name").value;
            $('#me').text(name);
            conn.send("{\"type\":\"login\",\"name\":\"" + name + "\"}")
        }
        
        $(document).ready(function () {
            hideChat();
        });

        function scrollBottom(divName) {
            var objDiv = document.getElementById(divName);
            objDiv.scrollTop = objDiv.scrollHeight;
        }
JS,

        'css' => <<<CSS
        .received-message, .sent-message {
            padding: 10px;
            margin: 1px 0 0 0;
            text-align: left;
        }

        .sent-message {
            background: #efefef;
            text-align: right;
        }

        .received-message {
            background: #efefef;

        }

        #chat {
            background: #EAEAEA;
            border: #CCC;
            padding: 20px;
        }

        .login-btn {
            cursor: pointer;
            font-weight: bold;
        }

        .msg-container {
            min-height: 300px;
            max-height: 600px;
            overflow-y: scroll;
        }
CSS,


    ];

    public function codes()
    {

        $this->htm = strtr($this->_layout['main'],[
        
        ]);
        $this->js = strtr($this->_layout['socket'], [
           '{userId}' => $this->userIdentity()->id,
           '{userName}' => $this->userIdentity()->name,
        ]);

        $this->css = $this->_layout['css'];

    }

}
