<?php

/**
 *
 *
 * Author:  Davlatov Ravshan
 * https://www.linkedin.com/in/asror-zakirov
 * https://github.com/ravshan014
 *
 */

namespace zetsoft\widgets\blocks;
use zetsoft\system\kernels\ZWidget;

class ZPanelWidget extends ZWidget
{
    /**
     * Configuration
     */
    public $config = [];
    public $_config = [
        'title' => 'Title',
        'subtitle' => 'subtitle',
        'width' => 75,  // 50   \  75   \   100
        'text' => 'Text content',
        'headerTitle' => 'Header title',
        'footerTitle' => 'Footer title',
        'titleTag' => 'h2',
        'links' => [],
        'navTabs' => [],
        'linkUrl' => '#',
        'textTag' => 'blockquote',  //  p  |  blockquote
        'textClass' => '', //    blockquote  |  card-text
        'listGroup' => [],
        'isHeader' => true,
        'isSubtitle' => false,
        'isListGroup' => false,
        'isFooter' => true,
        'isCentered' => false,
        'isNavTabs' => true,
        'isBordered' => true,
        'center' => '',  //   text-right    \   text-left
        'bgType' => ZPanelWidget::Theme['light'],
        'navType' => ZPanelWidget::Nav['tabs'],
        'btnStyle' => ZPanelWidget::Button['warning'],
        'borderType' => ZPanelWidget::Border['success'],
    ];
    /**
     *
     * Constants
     */

    public const Border = [
        'primary' => 'primary',
        'danger' => 'danger',
        'secondary' => 'secondary',
        'success' => 'success',
        'warning' => 'warning',
        'dark' => 'dark',
        'none' => 'none',
    ];

    public const Button = [
        'primary' => 'primary',
        'danger' => 'danger',
        'secondary' => 'secondary',
        'success' => 'success',
        'warning' => 'warning',
        'dark' => 'dark',
    ];

    public const Theme = [
        'primary' => 'primary',
        'secondary' => 'secondary',
        'success' => 'success',
        'danger' => 'danger',
        'warning' => 'warning',
        'info' => 'info',
        'light' => 'light',
        'dark' => 'dark',
    ];

    public const Nav = [
        'pills' => 'pills',
        'tabs' => 'tabs',
    ];
    public $layout=[];
    public $_layout=[
        'main'=><<<HTML
            <div class="card {center} border-{borderType} bg-{bgType} w-{width}">
                    <div class="card-header">
                        {headerTitle}
            <ul class="nav nav-{navType} card-header-{navType}">
HTML,
        'mainForeach'=><<<HTML
            <li class="nav-item">
                <a class="nav-link" href="#">nav</a>
            </li>
HTML,
        'main2'=><<<HTML
            </ul>
            </div>     
            <div class="card-body">        
                <{titleTag} class="card-title">
                {title}
                </{titleTag}>
                <{titleTag} 
                    class="card-subtitle mb-2 text-muted">
                {subtitle}
                </{titleTag}>
                <{textTag} 
                    class="{textClass}">
                {text}
                </textTag}>
            <ul class="list-group list-group-flush">
HTML,
        'mainForeach2'=><<<HTML
                <li class="list-group-item">{list}</li>
HTML,
        'main3'=><<<HTML
            </ul>                                
HTML,
        'mainForeach3'=><<<HTML
            <a href="{value}" class="card-link btn btn-{'btnStyle'}">
                key
            </a>            
HTML,
        'main4'=><<<HTML
        </div>
        <div class="card-footer text-muted">
           {footerTitle}
        </div>
        </div>    
HTML,
        'js'=><<<JS
        $(function() {
           $('.card-header').hide();
        });        
JS,
        'js2'=><<<JS
        $(function() {
           $('.nav').hide();
        });        
JS,
        'js3'=><<<JS
        $(function() {
           $('.card-footer').hide();
        });        
JS,
        'js4'=><<<JS
        $(function() {
           $('.card-subtitle').hide();
        });
JS,
         'js5'=> <<<JS
        $(function() {
           $('.list-group').hide();
        });
JS

    ];
    public function codes()
    {
        if ($this->_config['isCentered'] === true) {
            $this->_config['center'] = 'text-center';
        }
        if ($this->_config['isBordered'] === false) {
            $this->_config['borderType'] = ZPanelWidget::Border['none'];
        }

        $this->htm = $this->htm = strtr($this->_layout["main"],[
            '{center}'=> $this->_config['center'],
            '{borderType}'=> $this->_config['borderType'],
            '{bgType}'=> $this->_config['bgType'],
            '{width}'=> $this->_config['width'],
            '{headerTitle}'=> $this->_config['headerTitle'],
            '{navType}'=> $this->_config['navType'],


        ]);

        foreach ($this->_config['navTabs'] as $nav) {
            $this->htm .=strtr($this->_layout["mainForeach"],[
            '{nav}'=>$nav

            ]);
        }

        $this->htm .=strtr($this->_layout["main2"],[
            '{titleTag}'=> $this->_config['titleTag'],
            '{title}'=> $this->_config['title'],
            '{subtitle}'=> $this->_config['subtitle'],
            '{textTag}'=> $this->_config['textTag'],
            '{textClass}'=> $this->_config['textClass'],
            '{text}'=> $this->_config['text'],



        ]);

        foreach ($this->_config['listGroup'] as $list) {
                $this->htm .= strtr($this->_layout['mainForeach2'],[
                     '{list}'=>$list
                ]);
        }

        $this->htm .=strtr($this->_layout["main3"],[]);

        foreach ($this->_config['links'] as $key => $value) {
            $this->htm .=strtr($this->_layout["mainForeach3"],[
                '{value}'=>$value,
                '{$key}'=>$key,
                '{btnStyle}'=> $this->_config['btnStyle'],


            ]);
        }

        $this->htm .= strtr($this->_layout["main4"],[

            '{footerTitle}'=> $this->_config['footerTitle'],


        ]);
        if ($this->_config['isHeader'] === false) {

         $this->js =strtr($this->_layout["js"],[]);
        }
        if ($this->_config['isNavTabs'] === false) {

        $this->js .= strtr($this->_layout["js2"],[]);
        }

        if ($this->_config['isFooter'] === false) {
            $this->js .= strtr($this->_layout["js3"],[]);
        }

        if ($this->_config['isSubtitle'] === false) {
            $this->js .= strtr($this->_layout["js4"],[]);
        }
        if ($this->_config['isListGroup'] === false) {
            $this->js .= strtr($this->_layout["js5"],[]);
        }
    }
}
