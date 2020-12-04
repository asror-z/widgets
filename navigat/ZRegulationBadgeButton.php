<?php

namespace zetsoft\widgets\navigat;

use yii\bootstrap4\Button;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use function GuzzleHttp\Psr7\str;
use zetsoft\system\kernels\ZWidget;
use kartik\widgets\Select2;
use yii\web\JsExpression;

/**
 *
 * https://regulation.gov.uz/ru
 *
 * Created By: Azimon Toirov
 * Refactored: Azimon Toirov
 */
class ZRegulationBadgeButton extends ZWidget
{

    /**
     * Configuration
     */
    public $config = [];
    public $_config = [
        'main' => 'main',
        'iconSource' => 'https://regulation.gov.uz/img/housing.png',
        'badge' => 375,
        'text' => 'some text here',
        'url' => '',
    ];
    public static $grapes = [
        'enable' => true,
        'icon' => '',
        'image' => '/render/navigat/ZRegulationBadgeButton/image/icon.png',
        'name' => Azl . 'RegulationBadgeButton',
        'title' => Azl . '<b>safasfsa</b><img src="/render/navigat/ZRegulationBadgeButton/image/icon.png"/>',

    ];

    public $layout =[];
    public $_layout=[

        'main' => <<<HTML
                <div class="ways_list"  '>
                    <a href="{url}">
                        <div class="way_img">
                            <img src="{iconSource}" alt="">
                            <span class="way_badge">{badge}</span>
                        </div>
                        <span class="way_text">{text}</span>
                    </a>
                </div>
        HTML,

    ];

    public function codes()
    {
        //echo \Yii::$app->request->pathInfo;

       $iphone = [
           'apple',
           'ipad',
           'ipod',
       ];
       $samsung = [
           'galaxyA',
           'galaxyS',
           'galaxyE',
       ];
       $twoArrays =  ArrayHelper::merge($iphone, $samsung);
       //print_r($twoArrays);
       //echo $twoArrays;

        $alerDiv =  Html::tag('div', 'Save this value', [
            'class' => 'alert alert-info',
        ]);

        $this->htm = strtr($this->_layout['main'], [
            '{iconSource}' => $this->_config['iconSource'],
            '{badge}' => $this->_config['badge'],
            '{text}' => $this->_config['text'],
            '{url}' => $this->_config['url'],
            
        ]);

        $this->css = <<<CSS
    .ways_list{
        width: 275px;
    }
    .ways_list a:hover img {
        filter: brightness(0) invert(1);
    }

    .ways_list a:hover,
    .ways_list a:hover span {
        color: #ffffff;
        text-decoration: none;
    }

    .ways_list a {
        display: block;
        padding: 0 10px 0 15px;
        background-color: transparent;
        list-style: none;
    }

    .ways_list a:hover {
        color: #ffffff !important;
        background-color: #3c96df;
    }

    .ways_list .way_img .way_badge {
        background-color: #0a833d;
        color: #ffffff;
        font-size: 11px;
        border-radius: 10px;
        padding: 0 5px;
        position: absolute;
        z-index: 1;
        bottom: 15px;
        right: 15px;
    }

    .ways_list .way_img img {
        position: absolute;
        left: 0;
        top: 50%;
        margin: -32px 0 0 0;
    }

    .ways_list .way_img {
        position: relative;
        min-height: 90px;
        display: inline-block;
        width: 86px;
        float: left;
    }

    .ways_list .way_text {
        width: calc(100%-86px);
        max-width: calc(100%-86px);
        vertical-align: middle;
        height: 85px;
        display: table-cell;
        color: #0671a3;
        font-size: 16px;
    }
CSS;
    }
}
