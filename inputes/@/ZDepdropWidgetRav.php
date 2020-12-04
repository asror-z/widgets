<?php

namespace zetsoft\widgets\inputes;

use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\helpers\ZFormatter;
use zetsoft\system\helpers\ZHTML;
use zetsoft\system\kernels\ZWidget;


class ZDepdropWidgetRav extends ZWidget
{

    public $config = [];
    public $_config = [
        'depend' => null,
        'url' => '/api/core/rest/service.aspx',
        'namespace' => 'inputs',
        'service' => 'depend',
        'method' => 'sample',
        'args' => '',
        'type' => 'GET',
        'isFilter' => false,
        'params' => [],
        'isDepend' => false,
        'isClearDup' => false,
        'isHide' => 0,
        'isMulti' => false,
        'dependAttr' => null,
        'dataValue' => '',
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
        $this->fileCss('https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css');
        //Theme
        $this->fileCss('https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-theme/0.1.0-beta.10/select2-bootstrap.min.css');
        //JsFile
        $this->fileJs('https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.full.min.js');
    }

    public $layout = [];
    public $_layout = [

        'main' => <<<HTML

<div class="{id}-select2-container">

	<select id="{id}" value='{value}' depend="{depend}" parent-value="{parent-value}" class="{class}" attribute="{attribute}" name="{name}" {readonly} {multiple}>
		<option value="">Select...</option>
        {options}     
	</select>
	
</div>

HTML,

        'option' => <<<HTML
     <option value="{key}" {selected}>{value}</option>    
HTML,

        'js' => <<<JS

        $("#{id}").select2({
              width: '100%',
              theme: 'bootstrap',
              placeholder: '{placeholder}',
              allowClear: true,
              
        }).on('change', {changeEvent})
          .on('select', {selectEvent});
        
        
        {depdrop}
        {duplicate}
	
JS,

        'duplicate' => <<<JS

       var data = {data}; 
    
       function setSelect2(select2) {
    
            var option = '';
            option += '<option value=""><\/option>'
            for (const value in data) {
                option += '<option value="' + value + '">' + data[value] + '<\/option>';
            }
    
            select2.html(option);
    
       }
    
       $(document).on('select2:opening', '#{id}', function () {
    
           var val = $(this).val();
           setSelect2($(this));
           $(this).val(val);
    
       }); 
       
       $(document).on('select2:open', '#{id}', function() {
        
            let selects = $('[attribute="{attribute}"]');
            
            let values = [];
            selects.each(function(key, selectTag) {
                if ($(selectTag).val() !== $('#{id}').val())
                    values.push($(selectTag).val());
            });
            
            $(this).find('option').each(function(key, optionTag) {
              
                 values.forEach(function(selectVal) {
                    if ($(optionTag).attr('value') === selectVal) {
                        $(optionTag).remove();
                    }
                 });
              
            });  
              
       });    

JS,

        'isAjax' => <<<JS

             var dependId = $('#{depend-id}').val();
             var parentDepend = $('#{depend-id}').attr('parent-value');
	        
			 var defaultData = {
				 depend: dependId,
				 parentDepend: parentDepend,
                 args: dependId,                       				 
			 };
		
			 var configData = {configData};
			 
			 var data = {
				...defaultData,
			 };
		
			 $("#{id}").attr('disabled', 'disabled');  
		
			 $.ajax({
			    type: '{type}',
			    url: '{url}',
			    data: data,
			    success: function(data) {
					   
				   var select2 = $("#{id}");
				   
				   select2.empty();
				   
				   let sibling = $('.{id}-select2-container');
				   
				   if ({isHide}) {
					   if (!$.isEmptyObject(data))
						  sibling.show();
					   else
						  sibling.hide();
				   } 
					 
				   var options = '';
				   var value = '{value}';
				   
				   options = document.createElement('option');
				   select2.append(options)
				   
				   if ($.type(data) === 'object') {
				   
						for (const prop in data) {
						
						   options = document.createElement('option');
						   options.value = prop;
						   options.text = data[prop];
			
						   select2.append(options);
						   
						   if (prop == value)
							  options.selected = 'selected';
						   
						}
						
				   }
				   
                   select2.removeAttr('disabled');   
				   select2.attr('value', select2.val());
				   select2.trigger('change');
				   
			    }
			   
			 });

JS,

        'depdrop' => <<<JS
		
         {isAjax}
    
         
         $('#{depend-id}').on('change', function() {
             
             var depends = {depends}
             var bool = false
             for (var item in depends) {
                 var value = $('#' + depends[item]).val()
                 if ((value === '' || value === undefined))
                    bool = true
             }
             
             if (bool === true) 
                return
             
             var data = {
                ...{
                   depend: $(this).val(),
                   parentDepend: $(this).attr('parent-value'),
                }, 
                ...{configData}
             };
                        
             $('#{id}').attr('disabled', 'disabled');  
        
             $.ajax({
               type: '{type}',
               url: '{url}',
               data: data,
               success: function(data) {
                              
                   var select2 = $("#{id}");
                   select2.empty();
                   
                   if ($.type(data) === 'object') {
                   
                       options = document.createElement('option');
				       select2.append(options)
                    
                       for (const prop in data) {
                       
                          var options = document.createElement('option');
                          options.value = prop;
                          options.text = data[prop];
                          
                          select2.append(options);
                       }
                   }
                   
                   select2.removeAttr('disabled');  
                   select2.attr('value', select2.val());
                   select2.attr('parent-value', $('#{depend-id}').val());
                   select2.trigger('change');
                   
               }
               
             });
    
         });

JS,

    ];


    private function processArgs($args)
    {

        $return = [];
        foreach ($args as $arg) {
            if (!empty($arg))
                $return[] = $arg;
        }

        return $return;

    }


    public function codes()
    {

        $this->data = $this->getDatas();

        $params = [
            'namespace' => $this->_config['namespace'],
            'service' => $this->_config['service'],
            'method' => $this->_config['method'],
            'args' => $this->_config['args'],
            'App' => $this->_config['App'],
        ];

        $params = ZArrayHelper::merge($params, $this->_config['params']);

        $depends = '{}';
        if (is_array($this->_config['depend']))
            $depends = $this->getDepends($this->_config['depend']);

        if (is_array($depends))
            $depend = end($depends);
        else
            $depend = $this->checkDepend($this->_config['depend']);

        $ajax = '';
        if ($this->_config['isMulti'])
            $ajax = strtr($this->_layout['isAjax'], [
                '{id}' => $this->id,
                '{depend-id}' => $depend,
                '{url}' => $this->_config['url'],
                '{isHide}' => $this->jscode($this->_config['isHide']),
                '{dataValue}' => $this->jscode($this->_config['dataValue']),
                '{type}' => $this->_config['type'],
                '{configData}' => json_encode($params),
            ]);


        /*
        * Replace for JS structure of DEPDROP
        */


        $depdropJs = '';
        if (!empty($this->_config['depend']))
            $depdropJs = strtr($this->_layout['depdrop'], [
                '{id}' => $this->id,
                '{isAjax}' => $ajax,
                '{depends}' => $this->jscode($depends),
                '{depend-id}' => $this->jscode($depend),
                '{url}' => $this->_config['url'],
                '{isHide}' => $this->jscode($this->_config['isHide']),
                '{dataValue}' => $this->jscode($this->_config['dataValue']),
                '{type}' => $this->_config['type'],
                '{configData}' => json_encode($params),
            ]);


        $duplicateJs = '';
        if ($this->_config['isClearDup'])
            $duplicateJs = strtr($this->_layout['duplicate'], [
                '{id}' => $this->id,
                '{data}' => json_encode($this->data),
                '{attribute}' => $this->getAttributeAll(),
            ]);


        $this->js = strtr($this->_layout['js'], [
            '{id}' => $this->id,
            '{attribute}' => $this->getAttributeAll(),
            '{depdrop}' => $depdropJs,
            '{duplicate}' => $duplicateJs,
            '{data}' => json_encode($this->data),
            '{depend-id}' => $depend,
            '{type}' => $this->_config['type'],
            '{placeholder}' => $this->_config['placeholder'],
            //Events
            '{changeEvent}' => $this->eventCode('change'),
            '{selectEvent}' => $this->eventCode('select'),
        ]);


        /*
         * Add options to SELECT tag of DEPDROP
         */


        $options = '';
        foreach ($this->data as $key => $value) {

            $selected = $this->getSelected($key);
            $options .= strtr($this->_layout['option'], [
                '{key}' => $key,
                '{value}' => $value,
                '{selected}' => $selected,
                '{id}' => $this->id,
                '{readonly}' => $this->_config['readonly'],
            ]);

        }


        /*
         * Replace for HTML structure of DEPDROP
         */


        $b1 = $this->model;
        $b2 = !is_array($this->_config['depend']);
        $b3 = !empty($this->_config['depend']);

        $parentValue = null;
        if ($b1 && $b2 && $b3) {
            $depend = $this->_config['depend'];
            $parentValue = $this->model->$depend;
        }

        $name = $this->name;
        if ($this->_config['multiple'])
            $name = $this->name . '[]';

        $this->htm = strtr($this->_layout['main'], [
            '{options}' => $options,
            '{id}' => $this->id,
            '{parent-value}' => $parentValue,
            '{name}' => $name,
            '{depend}' => $depend,
            '{attribute}' => $this->getAttributeAll(),
            '{class}' => $this->_config['class'],
            '{readonly}' => $this->_config['readonly'] ? 'disabled' : '',
            '{multiple}' => $this->_config['multiple'] ? 'multiple' : '',
        ]);

    }


    private function getDatas()
    {

        $namespace = $this->_config['namespace'];
        $service = $this->_config['service'];
        $method = $this->_config['method'];
        $dependAttr = $this->_config['depend'];

        if (!$this->model || !$this->_config['depend'])
            return $this->data;

        $args = [];
        if (is_array($dependAttr)) {
            foreach ($dependAttr as $depend) {
                $args[] = $this->model->$depend;
            }
        } else {
            $args[] = $this->model->$dependAttr;
        }

        if (!empty($this->_config['args']))
            $args = ZArrayHelper::merge($args, explode('|', $this->_config['args']));

        $args = $this->processArgs($args);

        if (!empty($this->_config['depend'])) {

            if ($this->_config['App'])
                $this->data = Az::$app->App->$namespace->$service->$method(...$args);
            else
                $this->data = Az::$app->$namespace->$service->$method(...$args);
                
        }

        return $this->data;
    }


    private function getSelected($key)
    {

        $this->value = ZFormatter::filterValue($this->value);

        $selected = '';
        if ($this->value === $key) {
            $selected = 'selected';
        }

        if (is_array($this->value)) {
            foreach ($this->value as $val)
                if ($val === $key)
                    $selected = 'selected';
        }

        return $selected;

    }


    private function normalize($name)
    {
        return str_replace(['[]', '][', '[', ']', ' ', '.'], ['', '-', '-', '', '-', '-'], strtolower($name));
    }


    private function getAttributeAll()
    {
        preg_match('/[\[\w\]].*\[(.*)\]/', $this->name, $match);

        return ZArrayHelper::getValue($match, 1);
    }


    private function getDepends($depends)
    {
        $return = [];
        foreach ($depends as $depend) {
            $return[] = $this->checkDepend($depend);
        }

        return $return;
    }


    private function checkDepend($depend)
    {
        $attrName = $this->getAttributeAll();

        switch (true) {

            case $this->_config['isMulti']:
                $name = $this->normalize($this->name);
                $return = str_replace($attrName, $depend, $name) . $this->_config['dependAttr'];
                break;

            case $this->_config['isDepend']:
                $modelBase = $this->modelClassName;
                $return = $modelBase . '-' . $depend . $this->_config['dependAttr'];
                break;

            case !empty($attrName):
                $name = $this->normalize($this->name);
                $return = str_replace($attrName, $depend, $name);
                break;

            case $this->model && !empty($depend):
                $return = ZHTML::getInputId($this->model, $depend);
                break;

            default:
                $return = $depend;
                break;

        }

        return $return;
    }

}


