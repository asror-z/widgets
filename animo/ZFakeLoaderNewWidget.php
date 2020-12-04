<?php

namespace zetsoft\widgets\animo;

use zetsoft\system\kernels\ZWidget;
use function RingCentral\Psr7\str;

/**
 *
 *
 * Author:  Asror Zakirov
 * https://www.linkedin.com/in/asror-zakirov
 * https://github.com/asror-z
 *
 */

 class ZFakeLoaderNewWidget extends ZWidget{

 public $config = [] ;
 public $_config = [
    'spinner' => ZFakeLoaderNewWidget::snipper['spin1'],
    'bgColor' => '#2ad43f',
    'timeToHide' => false,

 ];



public const snipper = [
    'spin1' => 'spinner1',
    'spin2' => 'spinner2',
    'spin3' => 'spinner3',
    'spin4' => 'spinner4',
    'spin5' => 'spinner5',
    'spin6' => 'spinner6',
    'spin7' => 'spinner7',

];



public $layout=[];
public $_layout=[
    'main' => <<<HTML
          <div class="fakeLoader">
          </div>
HTML,
    'js' => <<<JS
           $(document).ready(function(){
                $.fakeLoader({
                    timeToHide: '{timeToHide}',
                    bgColor:    '{bgColor}',
                    spinner:  '{spinner}',
                    
                });
        });
JS,
];



public function asset()
{

    $this->fileJs('https://cdn.statically.io/gh/joaopereirawd/fakeLoader.js/master/js/fakeLoader.js');
    $this->fileCss('https://cdn.statically.io/gh/joaopereirawd/fakeLoader.js/master/css/fakeLoader.css');
}

     public function codes()
 {

    $this->htm = strtr($this->_layout['main'],[]);
    $this->js = strtr($this->_layout['js'],[
            '{spinner}' => $this->_config['spinner'],
            '{bgColor}' => $this->_config['bgColor'],
            '{timeToHide}' => $this->_config['timeToHide'],
    ]);

 }


 }
