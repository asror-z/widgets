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
class ZMCheckboxImageWidget extends Zwidget

{



    public $config = [];
    public $_config = [
        'photo' => ZMCheckboxImageWidget::photos['img2'],
        'label'=> 'ZMCheckboxImageWidget',
    ];

    public const photos =[
      'img1'=> 'https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcQYh-gwkaik2hwrBRWcjqm-LHucQGKcqVGdE6B5pMuAjzz_zLGb',
      'img2'=> 'https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcQYh-gwkaik2hwrBRWcjqm-LHucQGKcqVGdE6B5pMuAjzz_zLGb',
      'img3'=> 'https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcQYh-gwkaik2hwrBRWcjqm-LHucQGKcqVGdE6B5pMuAjzz_zLGb',
      'img4'=> 'https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcQYh-gwkaik2hwrBRWcjqm-LHucQGKcqVGdE6B5pMuAjzz_zLGb',

    ];

    public $layout = [];
    public $_layout = [

        'main' => <<<HTML
<ul class="imagescheckbox">
  <li class="childimage">
    <input type="checkbox" id="ImgCheckbox-{id}" class="checkboximage" name="{name}" value="{value}" />
    <label for="ImgCheckbox-{id}" class="labelimage"><img src="{img}" class="labelsimage" />{label}</label>
  </li>
  <li>

HTML,

        'jsCode' => <<<JS
$(document ).ready(function() {
   
   $("img.checkboximage").imgCheckbox({
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
                          
        /*$("img").imgCheckbox({
        
            /!*onload: function(){
                // Do something fantastic!
            },*!/
            /!*onclick: function (event){
                var isChecked = el.hasClass("imgChked"),
                    imgEl = el.children()[0];  // the img element
                    
                    console.log(el)

                console.log(imgEl.name + " is now " + (isChecked? "checked": "not-checked") + "!");
            }*!/
        });*/
        
});

 
   /*jQuery(function ($) {
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
        });   */             
JS,
        'cssCode' => <<<CSS
.imagescheckbox {
  list-style-type: none;
    }

.childimage {
  display: inline-block;
}

input[type="checkbox"][class^="checkboximage"] {
  display: none;
}

.labelimage {
  border: 1px solid #fff;
  padding: 10px;
  display: block;
  position: relative;
  margin: 10px;
  cursor: pointer;
}

.labelimage:before {
  background-color: white;
  color: white;
  content: " ";
  display: block;
  border-radius: 50%;
  border: 1px solid grey;
  position: absolute;
  top: -5px;
  left: -5px;
  width: 25px;
  height: 25px;
  text-align: center;
  line-height: 28px;
  transition-duration: 0.4s;
  transform: scale(0);
}

.labelimage .labelsimage {
  height: 100px;
  width: 100px;
  transition-duration: 0.2s;
  transform-origin: 50% 50%;
}

:checked + .labelimage {
  border-color: #ddd;
}

:checked + .labelimage:before {
  content: "✓";
  background-color: grey;
  transform: scale(1);
}

:checked + .labelimage .labelsimage {
  transform: scale(0.9);
  /* box-shadow: 0 0 5px #333; */
  z-index: -1;
}
CSS,

    ];

    public function asset()
    {
        $this->fileJs('https://cdn.jsdelivr.net/npm/imgcheckbox@0.5.3/jquery.imgcheckbox.js');

    }

    public function codes()
    {
        $content = '';
        foreach($this->data as $key => $value)
        {
            $content .= strtr($this->_layout['main'], [
                '{img}'=>$value,
                '{label}'=>$this->_config['label'],
                '{name}' => $this->name,
                '{value}' => $key,
                '{id}' => $this->id,
            ]);
        }

        $this->htm = $content;

        $this->js = strtr($this->_layout['jsCode'], [
        ]);

        $this->css = strtr($this->_layout['cssCode'], [
        ]);

    }
}
