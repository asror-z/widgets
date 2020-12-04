<?php

/**
 *
 *
 * Author:  jamshid Tojiboyev
 *
 */

namespace zetsoft\widgets\bozor;


use zetsoft\system\kernels\ZWidget;

class ZAdressWidget extends ZWidget
{
    public $config = [];
    public $_config = [
    'icon' => 'icon',
     'title' => 'title',
     'type' => ZAdressWidget::type['block']


    ];

    public const type = [
        'main' => 'main',
        'block' => 'block'
    ];

    public $event = [];
    public $_event = [
    ];

    public $layout = [];
    public $_layout = [
        'main' => <<<HTML
            
    <div class="no-gutters">
        <div class="box-address">
            <div class="location">
                <i class="{icon} fa-2x"></i>
                <h5 class="addres-text">{title}</h5>
            </div>
            <hr>
             <div class="info-addres">
                {content}
            </div>
                
        </div>
    </div>

HTML,


        'block' => <<<HTML
          <div class="my-box">
            <div class="box1">
            <p>Lorem ipsum dolor sit.</p>
            </div><div class="box2">
            <p>Lorem ipsum dolor sit.</p>
            </div><div class="box3">
            <p>Lorem ipsum dolor sit.</p>
            </div>
          </div>  
HTML,




        'css' => <<<CSS
    .box-address {
/*<<<<<<< HEAD*/
        border-radius: 3px;
        border: 1px solid lightgrey;
        box-shadow: 1px 1px 1px  lightgrey;
=======
        
        border: 2px solid darkgrey;
>>>>>>> parent of 7ac1fdfbb... 20-05-2020_17-50-19
    }
    
    
    
    
    


CSS

    ];

    public function init()
    {
        parent::init();
        ob_start();
    }


    public function codes()
    {
        $content = ob_get_clean();

        $this->htm = strtr($this->_layout[$this->_config['type']],[
               '{title}' => $this->_config['title'],
               '{content}' => $content,
        ]);

        $this->css = ($this->_layout['css']);

    }


}
