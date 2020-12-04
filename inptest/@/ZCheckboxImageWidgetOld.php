<?php

namespace zetsoft\widgets\inptest;

use zetsoft\system\kernels\ZWidget;

/**
 * author: MurodovMirbosit
 * refactored: Toirov Azimjon
 * modifyedBy:  Javohir Abdufattokhov
 * Class    ZHDropDownListWidget
 * @package widgets\inputes
 *
 * https://github.com/jcuenod/imgCheckbox/
 * http://jcuenod.github.io/imgCheckbox/
 */
class ZCheckboxImageWidgetOld extends Zwidget
{

    public $config = [];
    public $_config = [
        'photo' => ZCheckboxImageWidget::photos['img1'],
        'title'=> ZCheckboxImageWidget::titles['title1'],
    ];

    public const photos =[
      'img1'=> 'https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcQYh-gwkaik2hwrBRWcjqm-LHucQGKcqVGdE6B5pMuAjzz_zLGb',
      'img2'=> 'https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcQYh-gwkaik2hwrBRWcjqm-LHucQGKcqVGdE6B5pMuAjzz_zLGb',
      'img3'=> 'https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcQYh-gwkaik2hwrBRWcjqm-LHucQGKcqVGdE6B5pMuAjzz_zLGb',
      'img4'=> 'https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcQYh-gwkaik2hwrBRWcjqm-LHucQGKcqVGdE6B5pMuAjzz_zLGb',

    ];
    public const titles =[
        'title1'=> 'Angliya',
        'title2'=> 'Italita',
        'title3'=> 'Ispaniya' ,
        'title4'=> 'Belgiya'
    ];

    public $layout = [];
    public $_layout = [

        'main' => <<<HTML
        <div class="container">
            <div class="col-md-3 text-xs-center">
            <label class="image-checkbox" title="{title}">
                <img src="{img}"/>
                <input type="checkbox" checked="checked" name="{name}" value="{img}"/>
            </label>
        </div>      
        </div>

    
HTML,

        'jsCode' => <<<JS
   jQuery(function ($) {
            // init the state from the input
            $(".image-checkbox").each(function () {
                if ($(this).find('input[type="checkbox"]').first().attr("checked")) {
                    $(this).addClass('image-checkbox-checked');
                }
                else {
                    $(this).removeClass('image-checkbox-checked');
                }
            });

            // sync the state to the input
            $(".image-checkbox").on("click", function (e) {
                if ($(this).hasClass('image-checkbox-checked')) {
                    $(this).removeClass('image-checkbox-checked');
                   $(this).find('input[type="checkbox"]').first().removeAttr("checked");
                }
                else {
                    $(this).addClass('image-checkbox-checked');
                    $(this).find('input[type="checkbox"]').first().attr("checked", "checked");
                }

                e.preventDefault();
            });
        });                
JS,
        'cssCode' => <<<CSS
         .image-checkbox
        {
            cursor: pointer;
            box-sizing: border-box;
            -moz-box-sizing: border-box;
            -webkit-box-sizing: border-box;
            border: 4px solid transparent;
            outline: 0;
        }
         img{
            width: 300px;
            height: 300px;
         }
        .image-checkbox input[type="checkbox"]
        {
            display: none;
        }

        .image-checkbox-checked
        {
            border-color: #f58723;
        }
CSS,

    ];

    public function asset()
    {
        $this->fileJS('https://cdn.jsdelivr.net/npm/imgcheckbox@0.5.3/jquery.imgcheckbox.min.js');
        $this->fileCss('https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css');
        
    }

    public function codes()
    {
        $this->htm = strtr($this->_layout['main'], [
            '{img}'=>$this->_config['photo'],
            '{title}'=>$this->_config['title'],
            '{name}' => $this->name,
            '{value}' => $this->value
        ]);
        $this->js = strtr($this->_layout['jsCode'], [
          
        ]);
        $this->css = strtr($this->_layout['cssCode'], [
        ]);

    }

}
