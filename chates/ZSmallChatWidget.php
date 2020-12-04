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


use rmrevin\yii\fontawesome\FAB;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\kernels\ZWidget;

class ZSmallChatWidget extends ZWidget
{


    public $config = [];
    public $_config = [
        'text' => '',
        'data' => '',
        'fullName' => '',
        'src' => 'https://st2.depositphotos.com/1104517/11965/v/950/depositphotos_119659092-stock-illustration-male-avatar-profile-picture-vector.jpg',
        'status' => '',
        'telegram' => FAB::_TELEGRAM,
        'mine' => false,
        'grapes' => true

    ];
    private $message_item = [
        'text' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit voluptatem cum eum tempore',
        'time' => '11:11',


    ];

    public $layout = [];
    public $_layout = [


        'main' => <<<HTML
<div class="container-fluid"  {readonly}>

    <!-- Grid row -->
    <div class="row d-flex flex-row-reverse">

        <!-- Grid column -->
        <div class="col-md-5 mb-4 d-flex flex-row-reverse">

            <div class="card chat-room small-chat wide" id="myMessage">
                <div class="card-header white d-flex justify-content-between p-2" id="toggle">
                    <div class="heading d-flex justify-content-start">
                        <div class="profile-photo">
                            <img src="{src}" width="80" height="80" alt="avatar" class="avatar rounded-circle mr-2 ml-0">
                            <span class="state"></span>
                        </div>
                        <div class="data">
                            <p class="name mb-0"><strong>{fullName}</strong></p>
                            <p class="activity text-muted mb-0">{status}</p>
                        </div>
                    </div>
                    <div class="icons grey-text">
                        
                        <a class="feature"><i class="fas fa-cog mr-2"></i></a>
                        <a id="closeButton" id="closeBtn"><i class="fas fa-times mr-2"></i></a>
                    </div>
                </div>
                <div class="my-custom-scrollbar" id="message">
                    <div class="card-body p-3">
                           <div class="chat-message">
                           
                           
                                 {content}
                        
                        
                           </div>
                    </div>
                </div>
                
                
                <div class="card-footer text-muted white pt-1 pb-2 px-3">
               <div class="md-form input-group mb-3">
                  <input type="text" class="form-control" placeholder="Your message here"
                    aria-describedby="MaterialButton-addon2">
                  <div class="input-group-append">
                  <a class="btn-floating btn-primary" href="#"><i class="fa fa-{telegram}"></i></a>
                  </div>
                </div>
                </div>
            </div>

        </div>

    </div>


</div>
HTML,

        'mine' => <<<HTML
  <div class="card bg-primary rounded w-75 float-left z-depth-0 mb-1">
                    <div class="card-body p-2">
                        <p class="card-text text-white">{text}<span class="ml-0">{time}</span></p>
                    </div>
       </div>    
HTML,

        'friend' => <<<HTML
<div class="card bg-primary rounded w-75 float-right z-depth-0 mb-1">
                                <div class="card-body p-2">
                                    <p class="card-text text-white">{text}<span class="ml-0">{time}</span></p>
                                </div>
                   </div> 
HTML,


        <<<JS
 
  $('#closeButton').click(function() {
    $('#myMessage').hide();
});


JS,

        <<<CSS
.my-custom-scrollbar{
overflow-y: scroll;
max-height: 300px;
}
CSS,

    ];

    public function asset()
    {
        /*$this->fileJs('https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.0/jquery.min.js');*/
    }

    public function codes()
    {
        $content = '';
        foreach ($this->data as $key => $mes_item) {
            if ($this->_config['mine'] === false) {

                $content = $this->htm = strtr($this->_layout['friend'], [
                    '{text}' => $this->_config['text'],
                    '{time}' => $this->_config['time']

                ]);
            } else {
                $content = $this->htm = strtr($this->_layout['mine'], [
                    '{text}' => $this->_config['text'],
                    '{time}' => $this->_config['time'],
                ]);
            }
        }


        $this->htm = strtr($this->_layout['main'], [
            '{content}' => $content,
            '{src}' => $this->_config['src'],
            '{fullName}' => $this->_config['fullName'],
            '{status}' => $this->_config['status'],
            '{telegram}' => $this->_config['telegram'],
            
            '{readonly}' => $this->_config['readonly'] ? 'readonly' : '',
        ]);


    }


}
