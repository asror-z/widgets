<?php

namespace zetsoft\widgets\ajaxify;


use zetsoft\system\kernels\ZWidget;


class ZStatusWidget extends ZWidget
{

    /**
     * Configuration
     */
    public $config = [];
    public $_config = [
        'awayTime' => 20000    //Make status of user away after 20 second
    ];


    /**
     *
     * Plugin Events
     *
     */
    public $event = [];
    public $_event = [
    ];

    public $layout = [];
    public $_layout = [

        'js' => <<<JS
          
           
JS,


    ];


    public function asset()
    {
//        $this->fileJs('https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.3.0/socket.io.js');
//        $this->fileJs('/render/ajaxify/ZStatusWidget/assets/js/StatusViaSocket.js');
    }


    public function codes()
    {
        //$file = file_get_contents(Root.'/render/ajaxify/ZStatusWidget/assets/js/StatusViaSocket.js');
       /* $this->js = strtr($this->_layout['js'], []);
        $js = strtr($file, [
            '{user_id}' => $this->userIdentity()->id,
            '{away_time}' => $this->_config['awayTime'],
            '{user_status}'=>$this->userIdentity()->status
        ]);*/
       // file_put_contents(Root.'/render/ajaxify/ZStatusWidget/assets/js/StatusViaSocket.js',$js);
    }



}

