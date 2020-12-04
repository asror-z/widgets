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
class ZSelect2FlagWidget extends ZWidget
{

    public $config = [];
    public $_config = [
        'flagHeight' => '15px',
        'flagWidth' => '18px',
        'margin' => '',
        'padding' => '',
    ];
    

    public $layout = [];
    public $_layout = [

        'js' => <<<JS

   function formatState (state) {
  if (!state.id) {
    return state.text;
  }
  var baseUrl = "/render/asrorz/flags";
  var state = $(
    '<span><img src="' + baseUrl + '/' + state.element.value.toLowerCase() + '.png" class="img-flag" /> ' + state.text + '</span>'
  );
  
  return state;
}
      function ZSelect2Widget(){
        $('#{id}').select2({
           templateResult: formatState,
         templateSelection: formatState,    
})
}
        
        $(document).ready(function() {
         ZSelect2Widget();  
        });
        
        $(document).on('pjax:end', function () {
        $('#{id}').select2('destroy');
       ZSelect2Widget()
    });
JS,

        'css' => <<<CSS


        .img-flag{
       height: {flagHeight};
       width: {flagWidth};
       margin: {margin};
       padding: {padding};
       background-repeat: no-repeat;
        }

       .select2-container--bootstrap .select2-results__option[aria-selected=true]{
       background-color: {selectedColor};
       }
       .select2-container--bootstrap .select2-results__option--highlighted[aria-selected]{
       color: {Fontcolor};
       background-color: {selectColor};
       }
        
CSS,

    ];

    public function codes()
    {


        $this->js .= strtr($this->_layout['js'], [
            '{id}' => $this->id,
        ]);

        $this->css = strtr($this->_layout['css'], [
            '{flagHeight}' => $this->_config['flagHeight'],
            '{flagWidth}' => $this->_config['flagWidth'],
            '{margin}' => $this->_config['margin'],
            '{padding}' => $this->_config['padding'],
        ]);
    }
}


