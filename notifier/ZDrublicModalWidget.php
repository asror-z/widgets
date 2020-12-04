<?php

namespace zetsoft\widgets\notifier;

use zetsoft\system\kernels\ZWidget;

/**
 *
 * https://github.com/drublic/css-modal
 * https://drublic.github.io/css-modal/
 *
 * Created By: Sunnat Ermatov
 * Refactored: Sunnat Ermatov
 */

class ZDrublicModalWidget extends ZWidget
{

    /**
     * Configuration
     */
    public $config = [];
    public $_config = [
        'type' => ZDrublicModalWidget::type['main'],
        
    ];
    public static $grapes = [
        'enable' => true,
        'icon' => '',
        'image' => '/render/notifier/ZDrublicModalWidget/image/icon.png',
        'name' => Azl . 'DrublicModal',
        'title' => Azl . '<b>safasfsa</b><img src="/render/notifier/ZDrublicModalWidget/image/icon.png"/>',

    ];

    /**
     *
     *
     */
    public $event = [];
    public $_event = [

    ];


    /**
     *
     * Constants
     */
    public const theme = [
        'default' => 'default',
        'classic' => 'classic',
        'bootstrap' => 'bootstrap',
        'krajee' => 'krajee',
        'krajee-bs4' => 'krajee-bs4',

    ];

    public const type = [
        'main' => 'main',

    ];


    public function asset()
    {
        $this->fileCss('https://cdn.jsdelivr.net/npm/css-modal@1.5.0/build/modal.css');
        $this->fileCss('render/notifier/ZDrublicModalWidget/asset/style.css');
        $this->fileJs('https://cdn.jsdelivr.net/npm/css-modal@1.5.0/modal.min.js');
    }
    public function init()
    {
        parent::init();
        ob_start();
    }



     public $layout = [];
     public $_layout = [
         'main' => <<<HTML
                <a href="#{id}" class="btn btn-success"   {readonly}>Modal new</a> 
    
    

    <!-- The Modal -->
    <section class="modal--show" id="{id}" tabindex="-1"
         role="dialog" aria-labelledby="modal-label" aria-hidden="true" data-stackable="false">

                <!-- Modal Header -->
                <div class="modal-inner">
        <header><!-- Header --><h2>This is a modal-header</h2></header>
        <div class="modal-content"><!-- The modals content -->
            {content}
        </div>
        <footer><!-- Footer -->

                <a href="#modal-embed" class="open-modal"
                   title="Open another modal"
                   role="button">Open a new modal</a>
                <a href="#!" class="close-action"
                   title="Close this modal"
                   data-dismiss="modal">Close</a>
            
        </footer>
    </div>

           
           <a href="#!" class="modal-close" title="Close this modal" data-close="Close"
       data-dismiss="modal">?</a>
</section> 
   

HTML,
        <<<CSS
    
    
CSS,
     ];

    public function codes()
    {
        //  $this->htm = \kartik\select2\Select2::widget($this->options);


        $content = ob_get_clean();

        $this->htm .= strtr($this->_layout[$this->_config['type']], [
            
            '{readonly}' => $this->_config['readonly'],
            '{content}' => $content,
            '{id}' => $this->id,

        ]);

    }

}
