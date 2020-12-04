<?php

namespace zetsoft\widgets\animo;

use zetsoft\system\kernels\ZWidget;


/**
 *
 *
 * https://github.com/ariona/hover3d
 *
 * Created By: Umarov Sunnat
 * Refactored: Umarov Sunnat
 * no cdn
 */
class ZAHover3dWidget extends ZWidget
{

    /**
     * Configuration
     */
    public $config = [];
    public $_config = [
        'type'  => ZAHover3dWidget::type['default'],
        'title'  => "Image name",
        'category' => "Photography1",
        'image'    => ZAHover3dWidget::image['img1'],
        'perspectiv1' => 1000,
        'invert1' => false,
        'shin1' => true,
        //'hoverin'=>'hover-in',
        //'hoverout'=>'hover-out',
        //'hover3d'=>'hover-3d',

    ]; //

    public const shins = [
       'n'=> true,
       'f'=> false,

    ];
    
    public const categorie = [
        'categories1' => 'Photography1',
        'categories2' => 'Photography2'
    ]; //

    public const image = [
        'img1' => 'http://unsplash.it/600/400?image=287',
        'img2' => '/image/200x200/2.jpg',
        'img3' => '/image/200x200/1.jpg',
        'img4' => '/image/200x200/3.jpg'
    ]; //

    public const type = [
        'default' => 'default',
    ];

    public $layout = [];
    public $_layout = [


        'default' => <<<HTML
            <div class="container">   
             
                
                {imageContent}
                
            </div>
HTML,
        'imagesContent' => <<<HTML
                <div class="project" >
                    <div class="project__card" >
                        <a href="" class="project__image">
                            <img src=" {img_src} " alt="" ></a>
                        <div class="project__detail">
                            <h2 class="project__title"><a href=""> {title} </a></h2>
                            <small class="project__category"><a href=""> {category} </a></small>
                        </div>
                    </div>
                </div>
HTML



    ];

    public function asset()
    {
        $this->fileCss('https://ghcdn.rawgit.org/ariona/hover3d/master/material.css');
        //$this->fileJs('/publish/bower/hover3d/dist/js/vendor/jquery-1.12.1.min.js');
        $this->fileJs('https://ghcdn.rawgit.org/ariona/hover3d/master/dist/js/jquery.hover3d.js');   //no cdn link for this library
    } //
 
    public function codes()
    {
        $content = "";
        foreach ($this->data as $item) {
            $content .= strtr($this->_layout['imagesContent'], [
                '{title}'    => $item['title'],
                '{img_src}'  => $item['image'],
                '{category}' => $item['category'],
            ]);
        }
        if($this->_config['visible'])
        $this->htm = strtr($this->_layout['default'], [
            '{imageContent}' =>  $content,
        ]);

        $this->js = <<<JS
        $(document).ready(function(){
            $(".project").hover3d({
                selector: ".project__card",
                perspective: {perspectiv1},     
                invert:{invert1},
                shine:{shin1},
                //hoverInClass:{hoverin},
               // hoverOutClass:{hoverout},
               // hoverClass:{hover3d},
                
            });
        });
JS;
        $this->css = <<<CSS
            
CSS;
        $this->js = strtr($this->js, [
            '{perspectiv1}' => $this->jscode($this->_config['perspectiv1']),
            '{invert1}'  => $this->jscode($this->_config['invert1']),
            '{shin1}' => $this->jscode($this->_config['shin1']),
            //'{hoverin}' => $this->jscode( $this->_config['hoverin']),
            //'{hoverout}' => $this->jscode( $this->_config['hoverout']),
            //'{hover3d}' => $this->jscode( $this->_config['hover3d']),

        ]);
    } //

}
