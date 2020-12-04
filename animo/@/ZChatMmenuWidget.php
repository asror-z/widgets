<?php

namespace zetsoft\widgets\animo;

use zetsoft\system\kernels\ZWidget;



/**
 *
 * Class ZKSelect2Widget
 * http://demos.krajee.com/widget-details/select2
 *
 * Created By: Asror Zakirov
 * Refactored: Asror Zakirov
 */

class ZChatMmenuWidget extends ZWidget
{

    /**
     * Configuration
     */
    public $config = [];
    public $_config = [
       'type' => ZChatMmenuWidget::type['main'],
    ];

    public const type = [
        'main' => 'main'

    ];

    /**
     *
     * Plugin Events
     * https://select2.org/programmatic-control/events
     */
    public $event = [];
    public $_event = [
        'change' => ' console.log("ZKSelect2Widget | $eventChange") ',

    ];
      public $layout=[];
      public $_layout=[
          'main' => <<<HTML
        <nav id="{id}-chat">
    <div id="panel-menu">
        <ul>
            <li><a href="#/">Home</a></li>
            <li><span>About us</span>
                <ul>
                    <li><a href="#/">History</a></li>
                    <li><span>The team</span>
                        <ul>
                            <li><a href="#/">Management</a></li>
                            <li><a href="#/">Sales</a></li>
                            <li><a href="#/">Development</a></li>
                        </ul>
                    </li>
                    <li><a href="#/">Our address</a></li>
                </ul>
            </li>
            <li><a href="#/">Contact</a></li>

            <li class="Divider">Other demos</li>
            <li><a href="default.html">Default asset</a></li>
            <li><a href="onepage.html">One page asset</a></li>
        </ul>
    </div>

    <div id="panel-account">
        <ul>
            <li><a href="#/">My profile</a></li>
            <li><a href="#/">Privacy settings</a></li>
            <li><a href="#/">Activity</a></li>
            <li><a href="#/">Sign out</a></li>
        </ul>
    </div>

    <div id="panel-cart">
        <p style="text-align: center; padding-top: 30px;">Your shoppingcart is empty.<br/>
            <a href="#/">Continue shopping.</a></p>
    </div>
</nav>

HTML


      ];


    /**
     *
     * Constants
     */



    public function asset()
    {
        $this->fileCss('https://cdn.jsdelivr.net/npm/smartmenus@1.1.0/dist/css/sm-mint/sm-mint.css');
        $this->fileJs('https://cdn.jsdelivr.net/npm/smartmenus@1.1.0/dist/jquery.smartmenus.min.js');
        
    }


   


    public function codes()
    {
        //  $this->htm = \kartik\select2\Select2::widget($this->options);

       
        if($this->_config['visible'])
            $this->htm = $this->_layout[$this->_config['type']];

        $this->htm = strtr($this->_layout['main'], [
            '{id}' => $this->id,
        ]);
            
        $this->js = <<<JS

        $(function () {
            new Mmenu("#{$this->id}-chat", {
                extensions: {
                    all: ["theme-white", "pagedim-black"],
                    "(max-width: 767px)": ["fx-menu-slide"]
                },
                counters: !0,
                iconPanels: {
                    add: !0,
                    hideDivider: !0,
                    hideNavbar: !0,
                    visible: "first"
                },
                navbar: {
                    title: "mmenu"
                },
                navbars: [{
                    position: "top",
                    content: ["searchfield"]
                }, {
                    position: "top"
                }],
                setSelected: {
                    hover: !0,
                    parent: !0
                },
                sidebar: {
                    collapsed: {
                        use: 768,
                        hideNavbar: !0,
                        hideDivider: !0
                    },
                    expanded: {
                        use: 1440,
                        initial: "remember"
                    }
                }
            }, {
                offCanvas: {
                    page: {
                        selector: "#page"
                    }
                },
                searchfield: {
                    clear: !0
                }
            });


        });

    
JS;


        $this->css = <<<CSS
   
CSS;


    }

}
