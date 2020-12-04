<?php

namespace zetsoft\widgets\inputes;

use zetsoft\system\Az;
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
class ZSelect2LangWidgetAbl extends ZWidget
{

    public $config = [];
    public $_config = [
        'width' => '',
        'class' => '',
        'theme' => ZSelect2LangWidget::theme['bootstrap'],
        'multiple' => false,
        'icon' => '',
        'hasPlace' => true,
        'placeholder' => '',
        'flagHeight' => '15px',
        'flagWidth' => '18px',
        'margin' => '',
        'padding' => '',
        //true only in view page
        'ajax' => false,
        'url' => '/core/tester/restjson/api4.aspx',
        'dataType' => 'jsonb',
        //true for select country with his flag
        'imagePath' => false,
        'clear' => true,
        'label' => false,
        'selectedColor' => '#cccccc',
        'selectColor' => '#337ab7',
        'Fontcolor' => '#000000',
        'readonly' => false,
    ];

    public static $grapes = [
        'enable' => true,
        'icon' => 'fa-down',
        'src' => '/render/inputes/ZSelect2Widget/image/icon.png',
        'name' => Azl . 'Select2',
        'title' => Azl . '<h4>Select2</h4>',
        'content' => Azl . '<b>this widget for selcted element</b>',
    ];

    public $branch = [];
    public $_branch = [
        'widget' => [
            'theme',
            'size',
            'url',
            'multiple',
            'allowClear',
            'isHideSearch',
        ],
    ];

    public $branchLabel = [];
    public $_branchLabel = [
        'widget' => Azl . 'Основные опции ZSelect2Widget',
        'tooltip' => Azl . 'Примечание',
    ];

    public const size = [
        'lg' => 'lg',
        'md' => 'md',
        'sm' => 'sm'
    ];

    public const theme = [
        'bootstrap' => 'bootstrap',
        'classic' => 'classic',
        'material' => 'material',
    ];

    public $event = [];
    public $_event = [
        'opening' => "function() { console.log('select2:opening'); }",
        'open' => "function() { console.log('open'); }",
        'closing' => "function() { console.log('close'); }",
        'close' => "function() { console.log('close'); }",
        'selecting' => "function() { console.log('selecting'); }",
        'select' => "function() { console.log('select'); }",
        'unselecting' => "function() { console.log('unselecting'); }",
        'unselect' => "function() { console.log('unselect'); }",
        'clear' => "function() { console.log('select2:clear'); }",
        'clearing' => "function() { console.log('select2:clearing'); }",
    ];



    public $layout = [];
    public $_layout = [




        'imagePath' => <<<JS

    templateResult: formatState,
    templateSelection: formatState,

JS,

        'js' => <<<JS

   function formatState (state) {
  if (!state.id) {
    return state.text;
  }
  var baseUrl = "/render/asrorz/flags";
  var state = $(
    '<a href="/'+state.element.value.toLowerCase()+'/{href}"><span><img src="' + baseUrl + '/' + state.element.value.toLowerCase() + '.png" class="img-flag" /> ' + state.text + '</span></a>'
  );
  
  return state;
}

JS,

        'flagSelect2' => <<<JS
         function formatState (state) {
            if (!state.id) {
                return state.text;
            }
         /*agar flaglani olomasela shu urlni qarisla flagla bormi bosa kyn datadan kevotgan keyni qarisla flaglani otiga datani key to`ri kelish kere shunda to`ri cqaradi example: key=uz => value=uz.png */
         var baseUrl = "/render/asrorz/flags";
            var state = $(
         '<span><img src="' + baseUrl + '/' + state.element.value.toLowerCase() + '.png" class="img-flag" /> ' + state.text + '</span>'
  );
  return state;
}
        $("#{id}").select2({
    templateResult: formatState,
    /*templateSelection: formatState,*/ 
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

        'icon' => <<<HTML
    <i class="{icon} fa-2x"></i>
HTML,

    ];

    public function codes()
    {
        $option = '';

        $pathInfo = Az::$app->request->pathInfo;
        $queryString = Az::$app->request->queryString;


        if (!empty($this->data))
            foreach ($this->data as $key => $value) {

                $selected = '';
                if ($this->value === $key)
                    $selected = 'selected="selected"';

                if (is_array($this->value))
                    foreach ($this->value as $val) {
                        if ($key === $value) {
                            $selected = 'selected="selected"';
                        }
                    }
                $option .= strtr($this->_layout['option'], [
                    '{value}' => $value,
                    '{key}' => $key,
                    '{selected}' => $selected,
                    '{readonly}' => $this->_config['readonly'],
                ]);
            }

        $iconCode = strtr($this->_layout['icon'], [
            '{icon}' => $this->_config['icon'],
        ]);

        $name = $this->name;
        if ($this->_config['multiple'])
            $name = $this->name . '[]';

        $label = '';
        if ($this->_config['label']) {
            $label .= strtr($this->_layout['label'], [
                '{labels}' => $this->_config['placeholder'],
                '{id}' => $this->id,
            ]);
        }


        $this->htm = ZSelect2Widget::widget([
            
        ]);

    }
}


