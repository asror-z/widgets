<?php

namespace zetsoft\widgets\animo;

use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use function GuzzleHttp\Psr7\str;
use zetsoft\system\kernels\ZWidget;
use kartik\widgets\Select2;
use yii\web\JsExpression;

/**
 *
 * https://regulation.gov.uz/
 *
 * Created By: Asror Zakirov
 * Refactored: Asror Zakirov
 */

class ZRegulationNavbarWidget extends ZWidget
{

    /**
     * Configuration
     */
    public $config = [];
    public $_config = [
        'content' =>[],
        'title' => '',
        'link' => ''
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


    /**
     *
     * Constants
     */
    public const themes = [
        'default' => 'default',
        'classic' => 'classic',
        'bootstrap' => 'bootstrap',
        'krajee' => 'krajee',
        'krajee-bs4' => 'krajee-bs4',
    ];

    public const sizes = [
        'lg' => 'lg',
        'md' => 'md',
        'sm' => 'sm'
    ];


    public $layout=[];
    public $_layout=[

        'main' => <<<HTML
            <div class="head_menu">
                <div class="container">
                    <ul class="my_menu nav" id="w0">
                        <li><a href="{NavbarItemsHref}">{title}</a></li>
                    </ul>
                </div>
            </div>
    HTML



    ];

    public function codes()
    {


        $content = '';

      /*  foreach ($this->_config['content'] as $key => $value) {
           $content .= '<li><a href="$key['link']"> $key['title']</a></li>';
        }*/

        $this->htm = strtr($this->_layout['main'],[
            '{NavbarItemsHref}' => $this->_config['link'],
            '{title}' => $this->_config['title']
        ]);

        $this->js = <<<JS
           console.log("Test");
JS;


        $this->css = <<<CSS
      /* my_menu */
      .head_menu {
            padding: 10px 0 10px 0;
        }

        .my_menu li {
            list-style: none;
            display: inline-block;
        }

        .my_menu li.active a,
        .my_menu li a:focus,
        .my_menu li a:hover {
            background-color: #ffffff;
            text-decoration: none;
            border-bottom: 5px solid #2d9df6;
        }

        .my_menu li a {
            display: inline-block;
            margin-top: 1px;
            padding: 17px 24px;
            font-family: "SegoeUISemiBold";
            font-size: 19px;
            color: #2d9df6 !important;
            border-bottom: 5px solid transparent;
            margin-bottom: 0 !important;
            background-color: #ffffff;
        }

        .my_menu:after {
            width: 100%;
            content: '';
            display: block;
            clear: both;
            height: 1px;
        }

        .my_menu:before {
            width: 100%;
            height: 3px;
            background-color: #2d9df6;
            content: '';
            display: block;
            position: absolute;
            bottom: 0;
            left: 0;
            z-index: 1;
        }

        .my_menu {
            text-align: center;
            border: 0.5px solid #ffffff;
            /*border-bottom: 3px solid #2d9df6;;*/
            margin-bottom: 0 !important;
            /*padding: 0 30px;*/
            position: relative;
        }

CSS;


    }

}
