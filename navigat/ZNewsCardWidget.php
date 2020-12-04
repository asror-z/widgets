<?php

namespace zetsoft\widgets\navigat;

use zetsoft\models\news\News;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use function GuzzleHttp\Psr7\str;
use zetsoft\system\kernels\ZWidget;
use kartik\widgets\Select2;
use yii\web\JsExpression;


/**
 *
 * Class ZNewsCardWidget
 * http://demos.krajee.com/widget-details/select2
 *
 * Created By: AzimjonToirov
 * 
 */
class ZNewsCardWidget extends ZWidget
{

    /**
     * Configuration
     */
    public $config = [];
    public $_config = [
        'type' => ZNewsCardWidget::type['one'],
        'news_type_id' => '',
        'title' => '',
        'imgUrl' => '/render/navigat/ZNewsCardWidget/image/icon.png',
        'subTitle' => '',
        'text' => '',
        'time' => '',
        'id' => '',
    ];

    public static $grapes = [
        'enable' => true,
        'icon' => '',
        'image' => '/render/navigat/ZNewsCardWidget/image/icon.png',
        'name' => Azl . 'NewsCard',
        'title' => Azl . '<b>safasfsa</b>',
    ];

    public const type = [
        'one' => 'one',
        'two' => 'two',
        'three' => 'three',
        'four' => 'four',
        'manual' => 'manual',
    ];

    public $layout = [];
    public $_layout = [
        'one' => <<<HTML
            <div class="gallery-item mb-4">
                 <a href="detail.aspx?id={id}">
                    <div class="gallery-item__img">
                        <div class="img lazy">
                            <img src="{imgUrl}"/>
                        </div>
                    </div>
                    <div class="news-meta text-dark">
                        <div>
                            <i class="far fa-address-card"></i>
                            <span class="text-left pl-2">{time} {news_type_id} </span>
                            </div>
                        
                        <p class="category text-info">{subTitle}</p>
                    </div>
                        <div class="gallery-item__title">{title}</div>
                        <div class="text-dark pt-2">{text}</div>
                 </a>
            </div>
HTML,

        'two' => <<<HTML
        <div class="col-12 pb-2" style="border-bottom: 1px solid darkgrey">
            <a href="detail.aspx?id={id}" class="text-dark">
                <div class="row mt-3">
                    <div class="col-md-5 gallery-item">
                        <img src="{imgUrl}" class="w-100 shadow">
                    </div>
                    <div class="col-md-7 text-muted">
                        <div class="meta-news mb-3">
                            <i class="fa fa-calendar"></i>
                           <span>{time}</span> 
                        </div>
                        <div class="font-weight-bold text-dark fp-18">{title}</div>
                        <div>{text}</div>
                    </div>
                </div>
            </a>
        </div>
HTML,

        'three' => <<<HTML
             <a href="detail.aspx?id={id}" class="text-muted row mb-4">
                    <div class="gallery-item col-md-6 p-0">
                        <img src="{imgUrl}" class="img-fluid">
                    </div>
                    <div class="cardText p-3 col-md-6">
                        <div class="meta-news mb-3">
                            <i class="fa fa-calendar"></i>
                           <span>{time}</span> 
                        </div>
                        <div class="pl-2 pr-2 pt-2"><p class="font-weight-bold text-dark">{subTitle}</p></div>
                        <div class="pl-2 pr-2 pt-2" style="200px">{title}</div>
                    </div>
             </a>
HTML,

        //detail
        'four' => <<<HTML
               <div class="gallery-item col-md-12">
                    
                    <div class="row mb-3">
                        <div class="col-md-4 gallery-item">
                            <img src="{imgUrl}" class="img-fluid shadow">
                        </div>
                        <div class="col-md-8">
                        <div class="row justify-content-start align-items-center">
                            &nbsp;&nbsp;<i class="fa fa-calendar"></i><span class="col-6 fontSizeTimeNews">{time}</span>
                        </div>
                            <h4>{subTitle}</h4>
                            <p class="mt-3 fp-18">{title}</p>
                        </div>
                        <div class="col-md-12 mt-3 mb-4" style="border-bottom: 1px solid darkgrey">
                            <p>{text}</p>
                        </div>
                    </div>

                </div>
HTML,

        'manual' => <<<HTML
        <div class="col-12 mb-2 gallery-item">
            <a href="view.aspx?id={id}" class="text-dark">
                <div class="meta-news mb-3">
                    <i class="fa fa-calendar"></i>
                    <span>{time}</span> 
                </div>
                <div style="font-weight: bold">{title}</div>
                <div>{text}</div>
            </a>
        </div>
HTML,

        'js' => <<<JS
          (function() {
        function logElementEvent(eventName, element) {
            console.log(
                Date.now(),
                eventName,
                element.getAttribute("src")
            );
        }
        });
JS,


    ];

    public function asset()
    {
        $this->fileCss('/render/navigat/ZNewsCardWidget/assets/NewsCardStyle/styleNewCard.css');
        $this->fileJs('https://cdn.jsdelivr.net/npm/vanilla-lazyload@12.4.0/dist/lazyload.js');

    }


    public function codes()
    {
    
        $this->js = strtr($this->_layout['js'],[]);

        $this->htm = strtr($this->_layout[$this->_config['type']], [
            '{id}' => $this->_config['id'],
            '{time}' => $this->_config['time'],
            '{text}' => $this->_config['text'],
            '{subTitle}' => $this->_config['subTitle'],
            '{imgUrl}' => $this->_config['imgUrl'],
            '{title}' => $this->_config['title'],
            '{news_type_id}' => $this->_config['news_type_id'],
            
            '{readonly}' => $this->_config['readonly'] ? 'readonly' : ''

        ]);


    }

}
