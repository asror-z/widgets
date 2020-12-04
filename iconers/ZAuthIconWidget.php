<?php

namespace zetsoft\widgets\iconers;

use zetsoft\models\user\UserOauth;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZWidget;

/**
 *
 * https://github.com/akveo/eva-icons
 * https://akveo.github.io/eva-icons/#/
 *
 * Created By: Abdurakhmonov Umid
 *
 */
class ZAuthIconWidget extends ZWidget
{
    public static $grapes = [
        'enable' => true,
        'icon' => '',
        'height' => '600px',
        'width' => '840px',
        'image' => '',
        'name' => Azl . 'authicon',
        'title' => Azl . '<b>authicon</b>',
    ];

    /**
     * Configuration
     */
    public $config = [];
    public $_config = [
        'grapes' => true,
        'iframe' => true
    ];
    public $icons = [
        'github' => ['git' => 'github'],
        'facebook' => ['fb' => 'facebook-f'],
        'twitter' => ['tw' => 'twitter'],
        'google' => ['gplus' => 'google'],
        'linked-in' => ['li' => 'linkedin-in'],
        'yandex' => ['li' => 'yandex'],
        'instagram' => ['li' => 'instagram'],
    ];
    public $oauthLink = '/core/core/oauth.aspx?service=';
    public $data = [
        '/core/core/oauth.aspx?service=github' => ['git' => 'github'],
        '/core/core/oauth.aspx?service=facebook' => ['fb' => 'facebook-f'],
        '/core/core/oauth.aspx?service=twitter' => ['tw' => 'twitter'],
        '/core/core/oauth.aspx?service=google' => ['gplus' => 'google'],
        '/core/core/oauth.aspx?service=linked-in' => ['li' => 'linkedin-in'],
        '/core/core/oauth.aspx?service=yandex' => ['li' => 'yandex'],
        '/core/core/oauth.aspx?service=instagram' => ['li' => 'instagram'],
    ];
    public $branch = [];
    public $_branch = [
        'widget' => [
            'iframe'
        ],
    ];
    public $layout = [];
    public $_layout = [
        'main' => <<<HTML
            <div class="col-md-12">
                <ul class="d-flex flex-wrap justify-content-center mb-0 p-0" >   
                    {content}  
                </ul>
            </div>
HTML,

        'item' => <<<HTML
        <a href="{href}" class="btn-floating shadow-none btn-{key} openAuth" type="button" role="button">
            <i class="fab fa-{val}"></i>
        </a>
HTML,

    ];

    public function collectData()
    {
        $this->data = [];
        $userOauth = UserOauth::findAll(['active' => true]);
        foreach ($userOauth as $item) {
            $this->data["{$this->oauthLink}{$item->type}"] =  $this->icons[$item->type];
        }
    }

    public function codes()
    {
        $this->collectData();

        $href = '';
        $content = '';
        foreach ($this->data as $url => $icons) {
            if ($url)
                $href = $url;
            else
                $href = '#';
            foreach ($icons as $btnIcon => $icon) {
                $content .= strtr($this->_layout['item'], [
                    '{key}' => $btnIcon,
                    '{val}' => $icon,
                    '{href}' => $href,
                ]);
            }
        }

        $this->htm = strtr($this->_layout['main'], [
            '{content}' => $content,
        ]);
        if ($this->_config['iframe'])
            $this->js = <<<JS
            $(window).ready(function() {
                $('.openAuth').on('click', function (event) {
                e.preventDefault()
                      window.open($(this).attr('href'), 
                      "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,top=100,left=700,width=600,height=600");
                })
            });
JS;


    }
}
