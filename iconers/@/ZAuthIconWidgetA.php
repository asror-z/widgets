<?php

namespace zetsoft\widgets\iconers;

use zetsoft\system\kernels\ZWidget;

/**
 *
 * https://github.com/akveo/eva-icons
 * https://akveo.github.io/eva-icons/#/
 *
 * Created By: Abdurakhmonov Umid
 *
 */
class ZAuthIconWidgetA extends ZWidget
{

    /**
     * Configuration
     */
    public $config = [];
    public $_config = [
    ];

    public $data = [
        'fb' => 'facebook-f',
        'tw' => 'twitter',
        'gplus' => 'google-plus-g',
        'li' => 'linkedin-in',
        'ins' => 'instagram',
        'pin' => 'pinterest',
        'vk' => 'vk',
        'so' => 'stack-overflow',
        'yt' => 'youtube',
        'git' => 'github',
        'comm' => 'comments',
        'email' => 'envelope',
        'dribbble' => 'dribbble',
        'reddit' => 'reddit-alien',
        'whatsapp bg-success' => 'whatsapp',
    ];


    public $layout = [];
    public $_layout = [
        'main' => <<<HTML
            
            <div class="row">
            
                <div class="col-md-6 offset-3 d-inline-block">
                
                <ul>   
                         {content}  
                </ul>
            </div>
            
           </div>
          

HTML,

        'item' => <<<HTML

<div class="row">
            
                <div class="col-md-6 offset-3 d-inline-block">
            <a class="btn-floating btn-{key}" type="button" role="button">
                <i class="fa fa-{val}"></i>
            </a>
            </div>
            </div>
HTML,





    ];


    public function asset()
    {

    }


    public function codes()
    {
        $content = '';
        foreach ($this->data as $key => $val) {
            $content .= strtr($this->_layout['item'], [
                '{key}' => $key,
                '{val}' => $val
            ]);
        }




        $this->htm = strtr($this->_layout['main'], [
            '{content}' => $content,
        ]);


    }

}
