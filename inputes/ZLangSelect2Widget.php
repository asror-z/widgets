<?php

namespace zetsoft\widgets\inputes;

use zetsoft\system\kernels\ZWidget;

/**
 * Author: Asror Zakirov
 * https://www.linkedin.com/in/asror-zakirov
 * https://github.com/asror-z
 * https://www.linkedin.com/in/asror-zakirov
 * https://www.facebook.com/asror.zakirov
 *
 * Created By: MurodovMirbosit
 * Refactored: AzimjonToirov
 *
 * Class ZSelect2Widget
 * https://github.com/asror-z
 * https://github.com/select2/select2
 * https://select2.org/
 * https://select2.github.io/select2/
 *
 */
class ZLangSelect2Widget extends ZWidget
{

    public $config = [];
    public $_config = [
       
    ];
    
    public $event = [];
    public $_event = [
    
    ];

    public function asset()
    {
     
    }

    public $layout = [];
    public $_layout = [

        'main' => <<<HTML
        
HTML,
        
    ];

    public function codes()
    {

      $this->htm = ZSelect2MaterialWidget::widget([
         'name' => 'asd',
         'data' => $this->data,
         'config' => [
             'enableEvent' => true,
             'multiple' => false,
             'placeholder' => '123',
             'imagePath' => true,
             'pjax'=> false
         ]
      ]);
       
    }
}
