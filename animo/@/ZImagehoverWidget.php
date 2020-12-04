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
 * Class ZKSelect2Widget
 * http://demos.krajee.com/widget-details/select2
 *
 * Created By:Zoxidjon Ergashev
 * Refactored: Zoxidjon Ergashev
 */

    class ZImagehoverWidget extends ZWidget
{
    /**
     * Configuration
     */
    public $config = [];
    public $_config = [
        'type' => ZImagehoverWidget::type['imghvr-shutter-out-diag-2'],
        'title'=>ZImagehoverWidget::title['Hello World'],
        'text'=>ZImagehoverWidget::text['text1'],
        'image'=>ZImagehoverWidget::image['img1'],
        'alt'=>ZImagehoverWidget::alt['alt1']
    ];
    /**
     *
     * Constants
     */
    public const title=[
         'Hello World'=>'Hello World',
         'Hello friends'=>'Hello friends'
     ];
     public const text=[
        'text1'=>'Life is too important to be taken seriously!',
        'text2'=>'Lorem important to be taken seriously!'
     ];
     public const image=[
        'img1'=>'/image/200x200/2.jpg',
        'img2'=>'/image/200x200/1.jpg',
        'img3'=>'/image/200x200/3.jpg'
     ];
     public const alt=[
        'alt1'=>'example-image',
        'alt2'=>'example-image2'
     ];

    public const type=[
        'imghvr-fade' => 'imghvr-fade',
        'imghvr-push-up'=>'imghvr-push-up',
        'imghvr-push-down'=> 'imghvr-push-down',
        'imghvr-push-left'=>'imghvr-push-left',
        'imghvr-push-right'=>'imghvr-push-right',
        'imghvr-slide-up'=>'imghvr-slide-up',
        'imghvr-slide-down'=>'imghvr-slide-down',
        'imghvr-slide-left'=>'imghvr-slide-left',
        'imghvr-slide-right'=>'imghvr-slide-right',
        'imghvr-reveal-up'=>'imghvr-reveal-up',
        'imghvr-reveal-down'=>'imghvr-reveal-down',
        'imghvr-reveal-left'=>'imghvr-reveal-left',
        'imghvr-reveal-right'=>'imghvr-reveal-right',
        'imghvr-hinge-up'=>'imghvr-hinge-up',
        'imghvr-hinge-down'=>'imghvr-hinge-down',
        'imghvr-hinge-left'=>'imghvr-hinge-left',
        'imghvr-hinge-right'=>'imghvr-hinge-right',
        'imghvr-flip-horiz'=>'imghvr-flip-horiz',
        'imghvr-flip-vert'=>'imghvr-flip-vert',
        'imghvr-flip-diag-1'=>'imghvr-flip-diag-1',
        'imghvr-flip-diag-2'=> 'imghvr-flip-diag-2',
        'imghvr-shutter-out-horiz'=>'imghvr-shutter-out-horiz',
        'imghvr-shutter-out-vert'=>'imghvr-shutter-out-vert',
        'imghvr-shutter-out-diag-1'=>'imghvr-shutter-out-diag-1',
        'imghvr-shutter-out-diag-2'=>'imghvr-shutter-out-diag-2',
        'imghvr-shutter-in-horiz'=>'imghvr-shutter-in-horiz',
        'imghvr-shutter-in-vert'=> 'imghvr-shutter-in-vert',
        'imghvr-shutter-in-out-horiz'=> 'imghvr-shutter-in-out-horiz',
        'imghvr-shutter-in-out-vert'=>'imghvr-shutter-in-out-vert',
        'imghvr-shutter-in-out-diag-1'=>'imghvr-shutter-in-out-diag-1',
        'imghvr-shutter-in-out-diag-2'=>'imghvr-shutter-in-out-diag-2',
        'imghvr-fold-up'=>'imghvr-fold-up',
        'imghvr-fold-down'=> 'imghvr-fold-down',
        'imghvr-fold-left'=>  'imghvr-fold-left',
        'imghvr-fold-right'=>'imghvr-fold-right',
        'imghvr-zoom-in'=>'imghvr-zoom-in',
        'imghvr-zoom-out'=> 'imghvr-zoom-out',
        'imghvr-zoom-out-up'=>'imghvr-zoom-out-up',
        'imghvr-zoom-out-down'=>'imghvr-zoom-out-down',
        'imghvr-zoom-out-left'=>'imghvr-zoom-out-left',
        'imghvr-zoom-out-right'=>'imghvr-zoom-out-right',
        'imghvr-zoom-out-flip-horiz'=>'imghvr-zoom-out-flip-horiz',
        'imghvr-zoom-out-flip-vert'=>'imghvr-zoom-out-flip-vert',
        'imghvr-blur'=>'imghvr-blur'

    ];

        public $layout=[];
        public $_layout=[
             'main'=><<<HTML
            <div class="asset pure-u-1 pure-u-sm-1-2 pure-u-md-1-3 pure-u-lg-1-4">
                <figure class="{type}"><img src="{image}" alt="{alt}">
                <figcaption>
                    <h3>{title}</h3>
                    <p>{text}</p>
                </figcaption><a href="#"></a>
                </figure>
            </div>        
HTML,
              'css'=><<<CSS
                .asset  {
                    display:inline-block;
                }
CSS


        ];
    public function asset()
    {
        $this->fileCss('https://cdn.jsdelivr.net/npm/imagehover.css@2.0.0/css/imagehover.css');
    
    }

    public function codes()
    {
        $this->options = [
            // 'language' => Az::$app->language,
            // 'theme' => $this->_config['theme'],
            // 'changeOnReset' => true,
            // 'hideSearch' => $this->_config['isHideSearch'],
            // 'maintainOrder' => $this->_config['isMaintainOrder'],
            // 'showToggleAll' => true,
            // 'toggleAllSettings' => [
            //     'selectLabel' => '<i class="fas fa-ok-circle"></i> Tag All',
            //     'unselectLabel' => '<i class="far fa-check-square"></i> Unselect all',
            //     'selectOptions' => [],
            //     'unselectOptions' => [],
            //     'options' => ['class' => 's2-togall-button']
            // ],


        ];


        $this->htm= strtr($this->_layout["main"],[
            '{type}'=> $this->_config['type'] ,
            '{image}'=> $this->_config['image'],
            '{alt}'=> $this->_config['alt'],
            '{title}'=> $this->_config['title'],
            '{text}'=> $this->_config['text'],
        ]);
        $this->css= strtr($this->_layout["css"],[]);

    }

}
