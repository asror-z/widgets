<?php

namespace zetsoft\widgets\chates;

use PhpOffice\PhpWord\Reader\HTML;
use zetsoft\system\kernels\ZWidget;

/**
 *
 * Author:  Asror Zakirov
 * https://www.linkedin.com/in/asror-zakirov
 * https://www.facebook.com/asror.zakirov
 * https://github.com/asror-z
 *
 */
class ZUserMessageWidget extends ZWidget
{

    public $config = [];
    public $_config = [
        'name' => 'Brad Pit',
        'picture' => 'https://st2.depositphotos.com/1104517/11965/v/950/depositphotos_119659092-stock-illustration-male-avatar-profile-picture-vector.jpg',
        'time' => '11:02',
        'text' => ' Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                  labore et dolore magna aliqua.'
        ,
        'mine' => false,
        'userId' => '',
        'railVisible' => true,
        'type' => ZUserMessageWidget::type['telegram'],
        'file' => ''


    ];

    public const  type = [
        'mdb' => 'mdb',
        'telegram' => 'telegram'
    ];

//    public $layout = [];
//    public $_layout = [
//
//    ];


    public function codes()
    {
        $this->layout = [
            'friend' => [
                'mdb' => <<<HTML
            <li class="d-flex mb-4">
            
                <img src="{picture}" alt="avatar" class="avatar rounded-circle mr-2 ml-lg-3 ml-0 z-depth-1">
                
                <div class="chat-body white chat-body-div p-3 ml-1 z-depth-1 ">
                    <div class="header">
                        <strong class="primary-font"> {name} </strong>                                   
                    </div>
                    <p class="mb-0 usertext">
                        {text}
                    </p>
                    <span class="d-block text-right"><small class="pull-right text-muted">{time} </small> </span>
                </div>
            </li> 
HTML,
                'telegram' => <<<HTML
           <li class="d-flex mb-4 mr-5">
                                <img src="{picture}" alt="avatar" class="avatar rounded-circle mr-5 ml-lg-3 ml-0 z-depth-1">
                                <div class="chat-body w-25 p-3 ml-2 z-depth-1">
                                    <div class="header">
                                        <strong class="primary-font">{name}</strong>
                                        
                                    </div>
                                
                                
                                    <p class="mb-0">
                                       {text}
                                    </p>
                                    <small class="pull-right text-muted"><i class="far fa-clock"></i> {time}</small>
                                </div>
                                {file}
                            </li>     
HTML,

            ],
            'user' => [
                'mdb' => <<<HTML
            <li class="d-flex justify-content-end mb-4 mr-1">
                <div class="chat-body chat-body-div textblog p-3 z-depth-1">
                    <div class="header text-right">
                        
                    </div>
                    <p class="mb-0 usertext ">
                        {text}
                    </p>
                    <span class="d-block text-left"><small class="pull-right text-muted"><i class="fas fa-check-double"></i> {time} </small></span>
                </div>
            </li>
HTML,
                'telegram' => <<<HTML
                            <li class="d-flex justify-content-between ml-auto mb-4 mt-5 mr-3">
                                <div class="chat-body w-25 white p-3 ml-auto z-depth-1">
                                    <div class="header">
                                      
                                        
                                    </div>
                                  
                                    <p class="mb-0">
                                       {text}
                                    </p>
                                    <small class="pull-right text-muted"><i class="far fa-clock"></i> {time}</small>
                                </div>
                                  {file}
                            </li>
HTML,

            ],

            'css' => [
                'mdb' => <<<CSS
   
    .card.chat-room .members-panel-1,
        .card.chat-room .chat-1 {
            position: relative;
            overflow-y: scroll; }

        .card.chat-room .members-panel-1 {
            height: auto; }

        .card.chat-room .chat-1 {
            height: 495px; }

        .card.chat-room .friend-list li {
            border-bottom: 1px solid #e0e0e0; }
        .card.chat-room .friend-list li:last-of-type {
            border-bottom: none; }
        .avatar {
            height: 3rem;
            width: 3rem;
        }
        .chat-body-div{
            max-width: 60%;
        }
        .textblog{
        background:rgba(239, 253, 222,1);
        min-height: 15px !important;
        
        }
        .usertext{
        font-weight: normal;
       
        }
        .slimScrollBar{
        width: 10px;
        }
        .fa-check-double:hover {
            color: inherit;
            cursor: default;
        }
      
CSS,
                'telegram' => <<<CSS
 .row{
    margin-right: 0 !important;
    }
        .list-unstyled{
         height: 700px;
         border: 1px solid lightgrey;
        
        }

       .header__chat{
        border-bottom: 2px solid lightgray;
        padding: 10px;
       }
       .avatar2{
        width: 60px;
       }
       .t_icon{
        font-size: 20px !important;
       }

       .avatar{
           width: 80px;
           height: 80px;
           margin-top: 10px;
       }
 
        a {
            font-size: 14px;
            text-decoration: none;
        }

        a:hover {
            text-decoration: none;
        }

        .height {
            width: 100%;
            height: 100%;
            margin-top: 20px;

        }

        .recent {
            margin-left: 10px;
            margin-right: 10px;
            font-weight: 700;
            color: black;
        }

        .light {
            font-weight: 300;
            color: grey;
        }

        .blue {
            margin-left: 10px;
            margin-right: 10px;
        }

        .lichka_box {
            width: 100%;
            height: 60px;
        }

        .img_box {
            width: 60px;
            height: 60px;
            overflow: hidden;
            background: grey;
            border-radius: 50%;
        }

        .who_box {
            margin-left: 10px;
        }

        .who_box .recent {
            margin: 0;
            margin-top: 5px;
            margin-bottom: 2px;
        }

        .light {
            font-size: 16px;
            margin: 0;
            margin-top: 5px;
            margin-bottom: 2px;
        }
CSS,


            ],

            /*'scroll' => <<<JS
             $('#ul_chat').slimScroll({
                railVisible: '{railVisible}',
                allowPageScroll: true,
                touchScrollStep: 1000,
                height:'auto',
             });
JS,*/


        ];


        if ($this->_config['mine'] === false) {

            $this->htm = strtr($this->layout['friend'][$this->_config['type']], [
                '{name}' => $this->_config['name'],
                '{text}' => $this->_config['text'],
                '{picture}' => $this->_config['picture'],
                '{time}' => $this->_config['time'],
                '{file}' => $this->_config['file']

            ]);
        } else {
            $this->htm = strtr($this->layout['user'][$this->_config['type']], [

                '{text}' => $this->_config['text'],
                '{time}' => $this->_config['time'],
                '{file}' => $this->_config['file']

            ]);
        }

        $this->css = strtr($this->layout['css'][$this->_config['type']], [

        ]);

        /*$this->js = strtr($this->layout['scroll'], [
            '{id}' => 'ul_chat',
            '{railVisible}' => $this->_config['railVisible']
        ]);*/


    }
}
