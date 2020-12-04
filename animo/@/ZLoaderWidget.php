<?php

/**
 *
 * 
 *
 */

namespace zetsoft\widgets\animo;

use zetsoft\system\kernels\ZWidget;
//use zetsoft\widgets\animo\ZLoaderWidget;


class ZLoaderWidget extends ZWidget
{
    public $config = [];
    public $_config = [
        'timeToHide' => 4000,
        'zIndex' => 999,
        'spinner' => ZLoaderWidget::spinner['spinner6'],
        'imagePath' => false,
        'bgColor' => '#2ecc71'
    ];
    public const spinner = [
        'spinner1' => 'spinner1',
        'spinner2' => 'spinner2',
        'spinner3' => 'spinner3',
        'spinner4' => 'spinner4',
        'spinner5' => 'spinner5',
        'spinner6' => 'spinner6',
        'spinner7' => 'spinner7',
    ];
     public $layout=[];
     public $_layout=[
         'main'=> <<<HTML
    <div id="fakeLoader"></div>
    
      
HTML,
          'js'=> <<<JS
        $("#fakeLoader").fakeLoader({

            timeToHide:{timeToHide}, //Time in milliseconds for fakeLoader disappear
            zIndex:{zIndex}, // Default zIndex
            spinner:'{spinner}',//Options: 'spinner1', 'spinner2', 'spinner3', 'spinner4', 'spinner5', 'spinner6', 'spinner7'
            bgColor: '{bgColor}', //Hex, RGB or RGBA colors
            imagePath:'{imagePath}' //If you want can you const your custom image

        });
JS


     ];
 public function asset()
{
    $this->fileCss('https://cdn.jsdelivr.net/npm/fakeloader@1.0.0/fakeLoader.css');
    $this->fileJs('https://cdn.jsdelivr.net/npm/fakeloader@1.0.0/fakeLoader.min.js');
}
  public function codes()
{
    $this->htm= strtr($this->_layout["main"],[]);
    $this->js= strtr($this->_layout["js"],[
        '{timeToHide}'=>  $this->_config['timeToHide'] ,
        '{zIndex}'=>  $this->_config['zIndex']  ,
        '{spinner}'=>  $this->_config['spinner']  ,
        '{bgColor}'=>  $this->_config['bgColor']  ,
        '{imagePath}'=>  $this->_config['imagePath']  ,

    ]);


}


}?>

