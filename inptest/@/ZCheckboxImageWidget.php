<?php

namespace zetsoft\widgets\inptest;

use zetsoft\system\kernels\ZWidget;

/**
 * author: MurodovMirbosit
 * refactored: Toirov Azimjon
 * modifyedBy:  Javohir Abdufattokhov
 *
 * https://github.com/jcuenod/imgCheckbox/
 * http://jcuenod.github.io/imgCheckbox/
 */
class ZCheckboxImageWidget extends Zwidget

{



    public $config = [];
    public $_config = [
        'photo' => ZCheckboxImageWidget::photos['img2'],
        'title'=> ZCheckboxImageWidget::titles['title'],
    ];

    public const photos =[
      'img1'=> 'https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcQYh-gwkaik2hwrBRWcjqm-LHucQGKcqVGdE6B5pMuAjzz_zLGb',
      'img2'=> 'https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcQYh-gwkaik2hwrBRWcjqm-LHucQGKcqVGdE6B5pMuAjzz_zLGb',
      'img3'=> 'https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcQYh-gwkaik2hwrBRWcjqm-LHucQGKcqVGdE6B5pMuAjzz_zLGb',
      'img4'=> 'https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcQYh-gwkaik2hwrBRWcjqm-LHucQGKcqVGdE6B5pMuAjzz_zLGb',

    ];
    public const titles =[
        'title'=> 'Leon',
        /*'title2'=> 'Italita',
        'title3'=> 'Ispaniya' ,
        'title4'=> 'Belgiya'*/
    ];

    public $layout = [];
    public $_layout = [

        'main' => <<<HTML

                <img class="checkable" src="{img}" name="{img}"/>
               <input value="{img}" checked="checked"/> <!--checked="checked"-->
               
                <!--<label class="image-checkbox" title="{title}">
                <img src="{img}"/>
                <input type="checkbox" checked="checked" name="{name}" value="{img}"/>
            </label>-->

HTML,

        'jsCode' => <<<JS
$(document ).ready(function() {
   
   $("img.checkable").imgCheckbox({
            graySelected: true,
            scaleSelected: true,
            fixedImageSize: false,
            checkMarkSize: "30px",
            checkMarkPosition: 'top-left',
            scaleCheckMark: true,
            fadeCheckMark: false,
            addToForm: true,
            preselect: [], // { preselect: [0,1,2] }, { preselect: true }
            radio: false,
            canDeselect: false,
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
        .image-checkbox-checked
        {
            border-color: #f58723;
        }
CSS,

    ];

    public function asset()
    {
        $this->fileJs('https://cdn.jsdelivr.net/npm/imgcheckbox@0.5.3/jquery.imgcheckbox.js');

    }

    public function codes()
    {
        $this->htm = strtr($this->_layout['main'], [
            '{img}'=>$this->_config['photo'],
            '{title}'=>$this->_config['title'],
            '{name}' => $this->name,
            '{value}' => $this->value,
            '{id}' => $this->id



        ]);
        $this->js = strtr($this->_layout['jsCode'], [
          
        ]);
        $this->css = strtr($this->_layout['cssCode'], [
        ]);

    }

}
