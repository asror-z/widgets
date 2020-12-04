<?php

/**
 *
 *
 * Author:  Asror Zakirov
 * https://www.linkedin.com/in/asror-zakirov
 * https://www.facebook.com/asror.zakirov
 * https://github.com/asror-z
 *
 */
namespace zetsoft\widgets\animo;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZFileHelper;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
class ZIHoverWidget extends ZWidget
{
    /**
     *
     * @var string http://gudh.github.io/ihover/dist/index.html#circle
     * https://github.com/gudh/ihover
     *
     * Shahnoza Karimova
     */

    public $config = [];
    public $_config = [
        'type' => ZIHoverWidget::type['circle'], //circle, square
        'image' => ''  ,
        'circleAction' => ZIHoverWidget::circleAction['left_to_right'],
        'squareAction' => ZIHoverWidget::squareAction['scale_up'],
        'circleEffect' => ZIHoverWidget::circleEffect['effect4'],
        'squareEffect' => ZIHoverWidget::squareEffect['effect15'],
        'color' => ZIHoverWidget::color['uncolored'],
    ];
    public const circleAction =
        [
            'left_to_right' =>'left_to_right',
            'right_to_left' =>'right_to_left',
            'bottom_to_top' =>'bottom_to_top',
            'top_to_bottom' => 'top_to_bottom'
        ];

    public const squareAction =
        [
            'left_and_right' =>'left_and_right',
            'left_to_right' =>'left_to_right',
            'right_to_left' =>'right_to_left',
            'bottom_to_top' =>'bottom_to_top',
            'top_to_bottom' => 'top_to_bottom',
            'from_top_and_bottom' => 'from_top_and_bottom',
            'from_left_and_right' => 'from_left_and_right',
            'scale_up' => 'scale_up',
            'scale_down' => 'scale_down',

        ];


        public const color =
        [
            'colored' =>'colored',
            'uncolored' =>''
        ];

      

    public const circleEffect =
        [
            'effect3' =>'effect3',
            'effect4' =>'effect4',
            'effect5' =>'effect5',
            'effect6' => 'effect6',
            'effect7' => 'effect7',
            'effect8' => 'effect8',
            'effect9' => 'effect9',
            'effect10' => 'effect10',
            'effect11' => 'effect11',
            'effect12' => 'effect12',
            'effect13' => 'effect13',
            'effect14' => 'effect14',
            'effect15' => 'effect15',
            'effect16' => 'effect16',
            'effect17' => 'effect17',
            'effect18' => 'effect18',
            'effect19' => 'effect19',
            'effect20' => 'effect20',
        ];

    public const squareEffect =
        [
            'effect3' =>'effect3',
            'effect4' =>'effect4',
            'effect5' =>'effect5',
            'effect6' => 'effect6',
            'effect7' => 'effect7',
            'effect8' => 'effect8',
            'effect9' => 'effect9',
            'effect10' => 'effect10',
            'effect11' => 'effect11',
            'effect12' => 'effect12',
            'effect13' => 'effect13',
            'effect14' => 'effect14',
            'effect15' => 'effect15'
        ];







    public const type = [
         'circle' => 'circle',
         'square' => 'square'
    ];

        public $layout=[];
        public $_layout=[

            'circle' => <<<HTML
                            <div class="ih-item circle {color} {circleEffect} {circleAction}">
                                <a href="http://gudh.github.io/ihover/dist/index.html#">
                                    <div class="spinner"></div>
                                    <div class="img"><img src="{image}" alt="img"></div>
                                    <div class="info">
                                        <div class="info-back">
                                            <h3>Heading here</h3>
                                            <p>Description goes here</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
HTML,
            'square' =>  <<<HTML
                            <div class="ih-item square {color} {squareEffect} {squareAction}">
                                <a href="http://gudh.github.io/ihover/dist/index.html#">
                                    <div class="spinner"></div>
                                    <div class="img"><img src="{image}" alt="img"></div>
                                    <div class="info">
                                        <div class="info-back">
                                            <h3>Heading here</h3>
                                            <p>Description goes here</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
HTML,





        ];

    public function asset()
    {
        $this->fileCss('testing/animo/All/assets/hovers/cssjs/gudh ihover/css/css.css');
        $this->fileCss('render/animo/All/assets/hovers/cssjs/gudh ihover/css/main.css');

    }

    public function codes()
    {





        $this->htm = strtr($this->_layout[$this->_config['type']],[
            '{color}'=>$this->_config['color'],
            '{circleEffect}'=>  $this->_config['circleEffect'] ,
            '{circleAction}' =>$this->_config['circleAction'],
            '{image}'=>$this->_config['image'],
            '{squareEffect}'=>$this->_config['squareEffect'],
            '{squareAction}'=>$this->_config['squareAction']


        ]);


    }

}
