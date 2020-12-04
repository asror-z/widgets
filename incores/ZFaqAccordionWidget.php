<?php

namespace zetsoft\widgets\incores;

use zetsoft\system\kernels\ZWidget;

/**
 *
 * Class ZKSelect2Widget
 * http://demos.krajee.com/widget-details/select2
 *
 * Created By: Sunnat Ermatov
 * Refactored:
 */
class ZFaqAccordionWidget extends ZWidget
{

    /**
     * Configuration
     */
    public $config = [];
    public $_config = [

    ];


    /**
     *
     * Plugin Events
     * https://select2.org/programmatic-control/events
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

    public const size = [
        'lg' => 'lg',
        'md' => 'md',
        'sm' => 'sm'
    ];

    public $layout = [];
    public $_layout = [

        'main' => <<<HTML
        <div id="website">
    <div id="website-body" role="main">
        <div class="ep_gridrow ep-o_product">
            <div class="ep_gridrow-content">
                <div class="ep_gridcolumn" data-view1200="2" data-view1020="2" data-view750="1" data-view640="0"
                     data-view480="0" data-view320="0">
                    <div class="ep_gridcolumn-content">&nbsp;</div>
                </div>
                <div class="ep_gridcolumn ep-layout_tableofcontent" data-view1200="8" data-view1020="8" data-view750="10"
                     data-view640="8" data-view480="8" data-view320="4" role="menubar">

                    <div class="ep_gridcolumn-content">
                        <nav class="ep_tableofcontent-menu" aria-label="Frequently Asked Questions - Contents" role="tablist" multiselectable="true">
                            <ol>

                                <li id="tableofcontent_parliament" class="ep_content"  data-selected="false" >
                                    <div class="ep_title" id="tableofcontent_parliament-title">
                                        <span><span class="ep_name">Parliament</span><span class="ep_icon"></span></span>
                                    </div>
                                    <div class="ep_menu-access ep_openaccess" id="tableofcontent_parliament-access" aria-controlss="tableofcontent_parliament-content" role="tab">
                                        <a href="#" title="View menu"><span class="ep_hidden">View list:</span><span class="ep_name">Parliament</span><span class="ep_icon">&plus;</span></a>
                                    </div>
                                    <div class="ep_list" id="tableofcontent_parliament-content">
                                        <ul aria-labelledby="tableofcontent_parliament-title">
                                            <li class="ep_item">
                                                <a href="#"
                                                   title="#" aria-selected="false">
                                                    <span class="ep_name">What is the European Parliament?</span><span class="ep_icon">&nbsp;</span>
                                                </a>
                                            </li>
                                            <li class="ep_item">
                                                <a href="#"
                                                   title="#" aria-selected="false">
                                                    <span class="ep_name">What are the European Parliament’s powers and legislative procedures?</span><span class="ep_icon" >&nbsp;</span>
                                                </a>
                                            </li>
                                            <li class="ep_item">
                                                <a href="#" aria-selected="false">
                                                    <span class="ep_name">What role does the EP play in the EU budget?</span><span class="ep_icon">&nbsp;</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="ep_menu-access ep_closeaccess">
                                        <a href="#" title="Hide menu"><span class="ep_hidden">Hide list:</span><span class="ep_name">Parliament</span><span class="ep_icon">&nbsp;</span></a>
                                    </div>
                                </li>

                                <li id="tableofcontent_elections" class="ep_content"  data-selected="false" >
                                    <div class="ep_title" id="tableofcontent_elections-title">
                                        <span><span class="ep_name">Elections</span><span class="ep_icon">&nbsp;</span></span>
                                    </div>
                                    <div class="ep_menu-access ep_openaccess" id="tableofcontent_elections-access" aria-controlss="tableofcontent_elections-content" role="tab">
                                        <a href="#" title="View menu"><span class="ep_hidden">View list:</span><span class="ep_name">Elections</span><span class="ep_icon">&nbsp;</span></a>
                                    </div>
                                    <div class="ep_list" id="tableofcontent_elections-content">
                                        <ul aria-labelledby="tableofcontent_elections-title">
                                            <li class="ep_item">
                                                <a href="#"
                                                   title="#" aria-selected="false">
                                                    <span class="ep_name">How are members of the European Parliament elected?</span><span class="ep_icon">&nbsp;</span>
                                                </a>
                                            </li>
                                            <li class="ep_item">
                                                <a href="#"
                                                   title="#">
                                                    <span class="ep_name">What are political groups and how are they formed?</span><span class="ep_icon">&nbsp;</span>
                                                </a>
                                            </li>
                                            <li class="ep_item">
                                                <a href="#"
                                                   title="#" aria-selected="false">
                                                    <span class="ep_name">Seating in the Chamber</span><span class="ep_icon">&nbsp;</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="ep_menu-access ep_closeaccess">
                                        <a href="#"><span class="ep_hidden">Hide list:</span><span class="ep_name">Elections</span><span class="ep_icon">&nbsp;</span></a>
                                    </div>
                                </li>

                                <li id="tableofcontent_meps" class="ep_content"  data-selected="false" >
                                    <div class="ep_title" id="tableofcontent_meps-title">
                                        <span><span class="ep_name">MEPs</span><span class="ep_icon">&nbsp;</span></span>
                                    </div>
                                    <div class="ep_menu-access ep_openaccess" id="tableofcontent_meps-access" aria-controlss="tableofcontent_meps-content" role="tab">
                                        <a href="#" title="View menu"><span class="ep_hidden">View list:</span><span class="ep_name">MEPs</span><span class="ep_icon">&nbsp;</span></a>
                                        <a href="#" title="View menu"><span class="ep_hidden">View list:</span><span class="ep_name">MEPs</span><span class="ep_icon">&nbsp;</span></a>
                                    </div>
                                    <div class="ep_list" id="tableofcontent_meps-content">
                                        <ul aria-labelledby="tableofcontent_meps-title">
                                            <li class="ep_item">
                                                <a href="#"
                                                   title="#" aria-selected="false">
                                                    <span class="ep_name">The work of MEPs</span><span class="ep_icon">&nbsp;</span>
                                                </a>
                                            </li>
                                            <li class="ep_item">
                                                <a href="#"
                                                   title="#" aria-selected="false">
                                                    <span class="ep_name">How many MEPs?</span><span class="ep_icon">&nbsp;</span>
                                                </a>
                                            </li>
                                            <li class="ep_item">
                                                <a href="#"
                                                   title="#" aria-selected="false">
                                                    <span class="ep_name">Salaries and pensions</span><span class="ep_icon">&nbsp;</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="ep_menu-access ep_closeaccess">
                                        <a href="#" title="Hide menu"><span class="ep_hidden">Hide list:</span><span class="ep_name">MEPs</span><span class="ep_icon">&nbsp;</span></a>
                                    </div>
                                </li>

                                <li id="tableofcontent_parliament_organisational" class="ep_content"  data-selected="false" >
                                    <div class="ep_title" id="tableofcontent_parliament_organisational-title">
                                        <span><span class="ep_name">Parliament (organisational aspects)</span><span class="ep_icon">&nbsp;</span></span>
                                    </div>
                                    <div class="ep_menu-access ep_openaccess" id="tableofcontent_parliament_organisational-access" aria-controls="tableofcontent_parliament_organisational-content" role="tab">
                                        <a href="#" title="View menu"><span class="ep_hidden">View list:</span><span class="ep_name">Parliament (organisational aspects)</span><span class="ep_icon">&nbsp;</span></a>
                                    </div>
                                    <div class="ep_list" id="tableofcontent_parliament_organisational-content">
                                        <ul aria-labelledby="tableofcontent_parliament_organisational-title">

                                            <li class="ep_item">
                                                <a href="#"
                                                   title="Go to the page : Why was Strasbourg designated the official seat of the European Parliament?" aria-selected="false">
                                                    <span class="ep_name">Why was Strasbourg designated the official seat of the European Parliament?</span><span class="ep_icon">&nbsp;</span>
                                                </a>
                                            </li>
                                            <li class="ep_item">
                                                <a href="#"
                                                   title="Go to the page : Which languages are in use in the Parliament?" aria-selected="false">
                                                    <span class="ep_name">Which languages are in use in the Parliament?</span><span class="ep_icon">&nbsp;</span>
                                                </a>
                                            </li>
                                            <li class="ep_item">
                                                <a href="#"
                                                   title="Go to the page : How many people work in the Parliament?" aria-selected="false">
                                                    <span class="ep_name">How many people work in the Parliament?</span><span class="ep_icon">&nbsp;</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="ep_menu-access ep_closeaccess">
                                        <a href="#" title="Hide menu"><span class="ep_hidden">Hide list:</span><span class="ep_name">Parliament (organisational aspects)</span><span class="ep_icon">&nbsp;</span></a>
                                    </div>
                                </li>

                                <li id="tableofcontent_visitors" class="ep_content"  data-selected="false" >
                                    <div class="ep_title" id="tableofcontent_visitors-title">
                                        <span><span class="ep_name">Visitors</span><span class="ep_icon">&nbsp;</span></span>
                                    </div>
                                    <div class="ep_menu-access ep_openaccess" id="tableofcontent_visitors-access" aria-controlss="tableofcontent_visitors-content" role="tab">
                                        <a href="#" title="View menu"><span class="ep_hidden">View list:</span><span class="ep_name">Visitors</span><span class="ep_icon">&nbsp;</span></a>
                                    </div>
                                    <div class="ep_list" id="tableofcontent_visitors-content">
                                        <ul aria-labelledby="tableofcontent_visitors-title">
                                            <li class="ep_item">
                                                <a href="#"
                                                   title="Go to the page : Group and individual visits to the EP" aria-selected="false">
                                                    <span class="ep_name">Group and individual visits to the EP</span><span class="ep_icon">&nbsp;</span>
                                                </a>
                                            </li>
                                            <li class="ep_item">
                                                <a href="#"
                                                   title="Go to the page : Parlamentarium" aria-selected="false">
                                                    <span class="ep_name">Parlamentarium</span><span class="ep_icon">&nbsp;</span>
                                                </a>
                                            </li>
                                            <li class="ep_item">
                                                <a href="#"
                                                   title="Go to the page : House of European History" aria-selected="false">
                                                    <span class="ep_name">House of European History</span><span class="ep_icon">&nbsp;</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="ep_menu-access ep_closeaccess">
                                        <a href="#" title="Hide menu"><span class="ep_hidden">Hide list:</span><span class="ep_name">Visitors</span><span class="ep_icon">&nbsp;</span></a>
                                    </div>
                                </li>

                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
HTML,

      /*  'js' => <<<JS
           
           $(document).ready(function() {
          (function() {
        if (window.history && history.replaceState) {
            var hash = window.location.hash
            var linkUrl = document.getElementById('dev_product_url').value
            if (hash && document.getElementById(hash.replace('#',''))) {
                linkUrl += hash
            }
            if (window.location.href !== linkUrl) {
                history.replaceState(null, null, linkUrl)
            }
        }
    })()
});
           
    
    
JS, */

        'css' => <<<CSS
    body {
        background-color: white;
        }
        .ep_icon::after{
            background-image: none!important;
        }
        
CSS,

    ];

    public function asset()
    {

        $this->fileCss('/render/incores/ZFaqAccordionWidget/assets/structure.css');
        $this->fileCss('/render/incores/ZFaqAccordionWidget/assets/atomicdesign.css');
        $this->fileJs('/render/incores/ZFaqAccordionWidget/assets/behaviour.js');
        $this->fileJs('https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.0/jquery.min.js');
    }


    public function codes()
    {
        //  $this->htm = \kartik\select2\Select2::widget($this->options);

        $this->htm = $this->_layout['main'];

//        $this->js = $this->_layout['js'];

        $this->css = $this->_layout['css'];


    }

}
