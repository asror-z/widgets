<?php

namespace zetsoft\widgets\inputes;

use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\helpers\ZHTML;
use zetsoft\system\kernels\ZWidget;


class ZDepdropWidgetNorm extends ZWidget
{

    public $config = [];
    public $_config = [
        'depend' => null,
        'url' => '/core/grapes/getFilter.aspx',
        'resetUrl' => '/core/grapes/reset.aspx',
        'type' => 'POST',
        'params' => [],
        'isDepend' => false,
        'isClearDup' => false,
        'dependAttr' => null,
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

    public function asset()
    {
        //CssFile
        $this->fileCss('https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css');
        //Theme
        $this->fileCss('https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-theme/0.1.0-beta.10/select2-bootstrap.css');
        //JsFile
        $this->fileJs('https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.full.min.js');
    }

    public $layout = [];
    public $_layout = [

        'main' => <<<HTML

<div class="{id}-select2-container">
    <select id="{id}" value="{value}" class="{class}" attribute="{attribute}" name="{name}" {readonly} {multiple}>
        <option value="">Select...</option>
           {options}     
    </select>
</div>

HTML,

        'option' => <<<HTML
         <option value="{key}" {selected} >{value}</option>    
HTML,
        'label' => <<<HTML
            
HTML,

        'js' => <<<JS


    $("#{id}").select2({
          width: '100%',
          theme: 'bootstrap',
          placeholder: '{placeholder}',
          allowClear: true,
    });

    {depdrop}

    {duplicate}

    
JS,

        'duplicate' => <<<JS

   $('#{id}').on('select2:open', function() {
    
        let selects = $('[attribute="{attribute}"]');
        
        let values = [];
        selects.each(function(key, selectTag) {
            if ($(selectTag).val() !== $('#{id}').val())
                values.push($(selectTag).val());
        });
        
        $(this).find('option').each(function(key, optionTag) {
          
             values.forEach(function(selectVal) {
                         
                if (selectVal.includes($(optionTag).attr('value'))) {
                    $(optionTag).remove();
                }
                       
             });
          
        });  
          
    });    

JS,



        'depdrop' => <<<JS
    
    
     var defaultData = {
         depend: $('#{depend-id}').val(),
     };

     var configData = {configData};
     
     var data = {
        ...defaultData,
        ...configData
     };

     $("#{id}").attr('disabled', 'disabled');  

     $.ajax({
       type: '{type}',
       url: '{url}',
       data: data,
       success: function(data) {
           
           var select2 = $("#{id}");
           select2.removeAttr('disabled');  
           select2.html(null);
           
           var opts = JSON.parse(data);
           
           let sibling = $('.{id}-select2-container');
           if (!$.isEmptyObject(opts))
               sibling.show();
           else
               sibling.hide(); 
                    
           var options = '';
           var value = {value};
           for (const prop in opts) {
            
               options = document.createElement('option');
               options.value = prop;
               options.text = opts[prop];

               select2.append(options);
                
               if (prop == value)
                  $(options).attr('selected', 'selected');
               
           }
           
           select2.trigger('change');
           
       }
       
     });
    

    $('.{id}-select2-container').hide();

    $('#{depend-id}').on('change', function() {

     var defaultData = {
         depend: $(this).val(),
     };
     
     var configData = {configData};
     
     var data = {
        ...defaultData,
        ...configData
     };

     $("#{id}").attr('disabled', 'disabled');  

     $.ajax({
       type: '{type}',
       url: '{url}',
       data: data,
       success: function(data) {
           
           var select2 = $("#{id}");
           select2.removeAttr('disabled');  
           select2.html(null);
           
           var opts = JSON.parse(data);
           
           let sibling = $('.{id}-select2-container');
           if (!$.isEmptyObject(opts))
               sibling.show();
           else
               sibling.hide(); 
                    
           var options = '';
           var value = {value};
           for (const prop in opts) {
            
               options = document.createElement('option');
               options.value = prop;
               options.text = opts[prop];
                           
               select2.append(options);
               
               if (prop == value)
                  $(options).attr('selected', 'selected');
                
           }
           
           select2.trigger('change');
           
       }
     });

    });
JS,

    ];


    public function codes()
    {

        $depdropJs = '';
        if (!empty($this->_config['depend']))
            $depdropJs = strtr($this->_layout['depdrop'], [
                '{id}' => $this->id,
                '{depend-id}' => $this->checkDepend(),
                '{url}' => $this->_config['url'],
                '{value}' => $this->value,
                '{type}' => $this->_config['type'],
                '{configData}' => json_encode($this->_config['params']),
            ]);

        $duplicateJs = '';
        if ($this->_config['isClearDup'])
            $duplicateJs = strtr($this->_layout['duplicate'], [
                '{id}' => $this->id,
                '{attribute}' => $this->getAttributeAll(),
            ]);


        $this->js = strtr($this->_layout['js'], [
            '{id}' => $this->id,
            '{attribute}' => $this->getAttributeAll(),
            '{depdrop}' => $depdropJs,
            '{duplicate}' => $duplicateJs,
            '{data}' => json_encode($this->data),
            '{depend-id}' => $this->checkDepend(),
            '{resetUrl}' => $this->_config['resetUrl'],
            '{type}' => $this->_config['type'],
            '{placeholder}' => $this->_config['placeholder'],
        ]);


        $option = '';

        if (intval($this->value) !== 0)
            $this->value = intval($this->value);


        $name = $this->name;
        if ($this->_config['multiple'])
            $name = $this->name . '[]';



        foreach ($this->data as $key => $value) {

            $selected = '';
            if ($this->value === $key)
                $selected = 'selected';

            if (is_array($this->value))
                foreach ($this->value as $val) {
                    if ($val === $key)
                        $selected = 'selected';
                }

            $option .= strtr($this->_layout['option'], [
                '{value}' => $value,
                '{id}' => $this->id,
                '{key}' => $key,
                '{selected}' => $selected,
                '{readonly}' => $this->_config['readonly'],
            ]);
        }


        $this->htm = strtr($this->_layout['main'], [

            '{options}' => $option,
            '{id}' => $this->id,
            '{name}' => $name,
            '{value}' => $this->value,
            '{attribute}' => $this->getAttributeAll(),
            '{class}' => $this->_config['class'],
            '{readonly}' => $this->_config['readonly'] ? 'disabled' : '',
            '{multiple}' => $this->_config['multiple'] ? 'multiple' : '',

        ]);

        $this->css = <<<CSS
         
       .hide-select2 {
         display:none;
       } 
CSS;


    }

    private function normalize($name)
    {
        return str_replace(['[]', '][', '[', ']', ' ', '.'], ['', '-', '-', '', '-', '-'], strtolower($name));
    }


    private function getAttributeAll() {

        preg_match('/[\[\w\]].*\[(.*)\]/', $this->name, $match);

        return ZArrayHelper::getValue($match, 1);
    }

    private function checkDepend()
    {

        $attrName = $this->getAttributeAll();

        switch (true) {

            case $this->_config['isDepend']:
                $modelBase = strtolower($this->modelClassName);
                $depend = $modelBase . '-' . $this->_config['depend'] . $this->_config['dependAttr'];
                break;

            case !empty($attrName):
                $name = $this->normalize($this->name);
                $depend = str_replace($attrName, $this->_config['depend'], $name);
                break;

            case $this->model && !empty($this->_config['depend']):
                $depend = ZHTML::getInputId($this->model, $this->_config['depend']);
                break;

            default:
                $depend = $this->_config['depend'];
                break;

        }

        return $depend;
    }



}


