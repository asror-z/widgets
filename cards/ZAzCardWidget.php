<?php

/**
 *
 *
 * Author:  Asror Zakirov
 * https://www.linkedin.com/in/asror-zakirov
 * https://github.com/asror-z
 *
 */

/**
 *
 *
 * CreatedBy: Mirshod Ibodov
 */

namespace zetsoft\widgets\cards;


use zetsoft\system\kernels\ZWidget;

class ZAzCardWidget extends ZWidget
{
    public static $grapes = [
        'enable' => true,
        'icon' => '',
        'height' => '600px',
        'width' => '840px',
        'image' => 'https://av.ru/lp/b2b/pic/b2b/pleasure/pleasure1.png',
        'name' => Azl . 'AzCard',
        'title' => Azl . '<b>Title</b>',
    ];
    
    public $config = [];

    public $_config = [
        'grapes' => true,
        'url' => 'https://av.ru/lp/b2b/pic/b2b/pleasure/pleasure1.png',
        'title' => 'Индивидуальный сервис',
        'content' => 'Заключим договор, выберем способ оплаты, согласуем персональные цены: они отобразятся на сайте после авторизации',
        'class' => ''
    ];


    public $event = [];
    public $_event = [

    ];
    public $branch = [];
    public $_branch = [
        'widget' => [
            'url',
            'title',
            'content'
        ],
    ];


    public $layout = [];
    public $_layout = [
        'main' => <<<HTML
        <div class="toggle-card m-3 pt-2 pr-2 pb-18 text-center  hoverable">
            <div class="col-md-12 text-center p-3">
                <img src="{url}" class="">
            </div>
            <h3>{title}</h3>
            <div class="col-md-12 py-4">{content}</div>

        </div>

HTML,

        'js' => <<<JS
             
             var cards = $('.toggle-card');
             var textClass = $('.active-text');
JS,

        'clickJS' => <<<JS
             
            cards.on('click', function () {
            $(this).toggleClass('is_open');
            $(this).find('.cont').toggleClass('d-none');
            icon = $(this).find("i");
            icon.toggleClass("fa-ellipsis-h fa-times")
            });
JS,

        'css' => <<<CSS
        .toggle-card {
            width: 80%;
            height: 350px;
            padding: 10px;
        }
CSS,


    ];


    public function codes()

    {
        $this->htm .= strtr($this->_layout['main'], [
            '{content}' => $this->_config['content'],
            '{title}' => $this->_config['title'],
            '{url}' => $this->_config['url']

        ]);

        $this->js = strtr($this->_layout['js'], [

        ]);

        $this->css = strtr($this->_layout['css'], [

        ]);
    }


}
