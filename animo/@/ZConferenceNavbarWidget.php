<?php

/**
 *
 *
 * Author:  Asror Zakirov
 * Created BY :ElnurController Suyunov
 * no in CDN
 * https://www.linkedin.com/in/asror-zakirov
 * https://www.facebook.com/asror.zakirov
 * https://github.com/asror-z
 *
 */

namespace zetsoft\widgets\animo;


use zetsoft\system\kernels\ZWidget;
use function Matrix\trace;

class ZConferenceNavbarWidget extends ZWidget
{
    public $config = [];
    public $_config = [
        'type' => ZConferenceNavbarWidget::type['main'],
        'tlgTitle' => 'Telegram',
        'telTitle' => '+998 98 9988122',
        'smsTitle' => 'conference@eyuf.uz',
        'siteTitle' => 'www.eyuf.uz',
        'chatTitle' => 'Биз билан алоқа',
        'tlgLink' => 'https://t.me/joinchat/JNR4XVQ-Yf-2q0zoIF8dmw',
        'telLink' => 'https://eyuf.uz/',
        'smsLink' => 'https://eyuf.uz/',
        'siteLink' => 'https://eyuf.uz/',
        'chatLink' => 'https://eyuf.uz/',
        'confontsize' => '25px',
        'isSticky' => true,
        'view' => ZConferenceNavbarWidget::type['main'],


    ];

    public const type = [
        'main' => 'main'
    ];

    public $layout = [];
    public $_layout = [

        'main' => <<<HTML
        <ul class="kt-sticky-toolbar">
            <li class="kt-sticky-toolbar__item kt-sticky-toolbar__item--success" 
                title="{tlgTitle}">
                <a href="{tlgLink}" target="_blank"><i class="fa fa-paper-plane bb-c" 
                   aria-hidden="true" style="font-size: 18px;"></i></a>
            </li>
        <li class="kt-sticky-toolbar__item kt-sticky-toolbar__item--success" 
            title="{telTitle}">
            <a href="{telLink}" target="_blank"><i class="fa fa-phone bb-c" 
               aria-hidden="true" style="{confontsize}"></i></a>
        </li>
        <li class="kt-sticky-toolbar__item kt-sticky-toolbar__item--success" 
            title="{smsTitle}">
            <a href="{smsLink}" target="_blank"><i class="fa fa-envelope  bb-c" 
            aria-hidden="true" style="{confontsize}"></i></a>
        </li>
    
        <li class="kt-sticky-toolbar__item kt-sticky-toolbar__item--success" 
            title="{siteTitle}">
            <a href="{siteLink}" target="_blank"><i class="fa fa-globe bb-c" 
            aria-hidden="true" style="{confontsize}"></i></a>
        </li>
        <li class="kt-sticky-toolbar__item kt-sticky-toolbar__item--success" 
            title="{chatTitle}">
            <a href="{chatLink}"><i class="fa fa-comments bb-c" aria-hidden="true" style="{confontsize}"></i></a>
        </li>
    </ul>       
HTML


    ];

    public function asset()
    {

         $this->fileCss('/render/animo/All/assets/all/css/ConferenceNavbar/material.css');
         $this->fileCss('/render/animo/All/assets/all/css/ConferenceNavbar/toolbar.css');

        /* cdn.jsdelivr*/
        /*$this->fileCss('https://cdn.jsdelivr.net/npm/style.css@1.0.0/style.css');
        $this->fileCss('https://cdn.jsdelivr.net/npm/leaflet-toolbar@0.4.0-alpha.2/dist/leaflet.toolbar.min.css')*/;

    }


    public function codes()
    {


        $this->htm = strtr($this->_layout[$this->_config['view']],[
            '{tlgTitle}' => $this->_config['tlgTitle'],
            '{tlgLink}' => $this->_config['tlgLink'],
            '{telTitle}' =>$this->_config['telTitle'],
            '{telLink}'=>$this->_config['telLink'],
            '{confontsize}'=>$this->_config['confontsize'],
            '{smsTitle}'=> $this->_config['smsTitle'] ,
            '{smsLink}' =>$this->_config['smsLink'],
            '{siteTitle}' =>$this->_config['siteTitle'],
            '{siteLink}'=>$this->_config['siteLink'],
            '{chatTitle}'=> $this->_config['chatTitle'],
            '{chatLink}'=> $this->_config['chatLink']

        ]);

        $this->js = <<<JS
/*
        $('#tooltip').tooltip();
        $('#tooltip1').tooltip();
        $('#tooltip2').tooltip();
        $('#tooltip3').tooltip();
        $('#tooltip4').tooltip();*/

JS;

        if ($this->_config['isSticky']) {
            $this->css = <<<CSS
                .kt-sticky-toolbar{
                    background-color: #3d799c;
                    margin-top: 15px;
                    
                }
                .bb-c{
                    color: #3d799c !important;
                }
CSS;
        } else {
            $this->css = <<<CSS
                .kt-sticky-toolbar{
                    position: fixed;
                    background-color: #3d799c ;
                    right: -41px;
                    margin-top: 15px;   
                    transition: .3s linear;
                    -o-transition: .3s linear;
                    -moz-transition: .3s linear;
                    -webkit-transition: .3s linear;
                    z-index: 1000;
                }
                .kt-sticky-toolbar:hover{
                    right: 0;
                }
                 .bb-c{
                    color: #3d799c !important;
                }
CSS;
        }

        $this->css = <<<CSS
             .kt-sticky-toolbar{
                 position: fixed;
                 background-color: #777;
                 right: -41px;
                 transition: .3s linear;
                 -o-transition: .3s linear;
                 -moz-transition: .3s linear;
                 -webkit-transition: .3s linear;
                 z-index: 1000;
             }
             .kt-sticky-toolbar:hover{
                 right: 0;
             }
CSS;
    }
}
