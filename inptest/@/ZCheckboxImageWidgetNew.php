<?php

namespace zetsoft\widgets\inptest;

use zetsoft\system\kernels\ZWidget;

/**
 
 * Class    ZHDropDownListWidget
 * @package widgets\inputes
 *
 * https://github.com/jcuenod/imgCheckbox/
 * http://jcuenod.github.io/imgCheckbox/
 */
class ZCheckboxImageWidgetNew extends Zwidget
{


    public $config = [];
    public $_config = [
        'photo' => ZCheckboxImageWidgetNew::photos['img1'],
        'title' => ZCheckboxImageWidgetNew::titles['title1'],
        'checkMarkImage' => '',
        'graySelected' => true,
        'scaleSelected' => true,
        'fixedImageSize' => false,
        'checkMarkSize' => 30,
        'checkMarkPosition' => 'center',    //top, left, bottom, right, top-right, ...
        'scaleCheckMark' => true,
        'fadeCheckMark' => false,
        'addToForm' => true,
        'preselect' => [0,1,2],
        'radio' => false,
        'canDeselect' => false,
        
    ];

    public const photos = [
        'img1' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcQYh-gwkaik2hwrBRWcjqm-LHucQGKcqVGdE6B5pMuAjzz_zLGb',
        'img2' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcQYh-gwkaik2hwrBRWcjqm-LHucQGKcqVGdE6B5pMuAjzz_zLGb',
        'img3' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcQYh-gwkaik2hwrBRWcjqm-LHucQGKcqVGdE6B5pMuAjzz_zLGb',
        'img4' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcQYh-gwkaik2hwrBRWcjqm-LHucQGKcqVGdE6B5pMuAjzz_zLGb',

    ];
    public const titles = [
        'title1' => 'Angliya',
        'title2' => 'Italita',
        'title3' => 'Ispaniya',
        'title4' => 'Belgiya'
    ];


    public function asset()
    {
        $this->fileJS('https://cdn.jsdelivr.net/npm/imgcheckbox@0.5.3/jquery.imgcheckbox.min.js');
        $this->fileCss('https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css');
    }


    public function codes()
    {
        $this->layout = [
            'main' => <<<HTML
        <div class="container">
            <div class="col-md-3 text-xs-center">
                <label class="image-checkbox" title="{title}">
                <img src="{img}" />
                <input type="checkbox" name="team[]" value="{title}" checked="checked" />
                </label>
            </div>      
        </div>
HTML,

        ];


        $this->htm = strtr($this->layout['main'], [
            '{img}' => $this->_config['photo'],
            '{title}' => $this->_config['title']
        ]);


        $this->js = strtr($this->layout['main'], [
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

        ]);


        $this->css = strtr($this->layout['main'], [
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
        ]);

    }

}
