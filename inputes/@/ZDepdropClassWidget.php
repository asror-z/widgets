<?php

namespace zetsoft\widgets\inputes;

use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\helpers\ZFormatter;
use zetsoft\system\helpers\ZHTML;
use zetsoft\system\kernels\ZWidget;


class ZDepdropClassWidget extends ZWidget
{

	public $config = [];
	public $_config = [
		'depend' => null,
		'url' => '/api/core/app/service.aspx',

		'namespace' => 'inputs',
		'service' => 'depend',
		'method' => 'sample',
		'args' => '',

		'type' => 'GET',
		'params' => [],
		'isDepend' => false,
		'isClearDup' => false,
		'isHide' => false,
		'isMulti' => false,
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
		$this->fileCss('/render/asrorz/css/select2.css');
		//Theme
		$this->fileCss('/render/asrorz/css/select2Bootstrap.css');
		//JsFile
		$this->fileJs('https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.full.min.js');
	}

	public $layout = [];
	public $_layout = [

		'main' => <<<HTML

<div class="{id}-select2-container">
	<select id="{id}" value='{value}' depend="{depend}" class="{class}" attribute="{attribute}" name="{name}" {readonly} {multiple}>
		<option value="">Select...</option>
		   {options}     
	</select>
</div>

HTML,

		'option' => <<<HTML
		 <option value="{key}" {selected}>{value}</option>    
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
				   select2.trigger('select2:select');
				   
			    }
			   
			 });
		
			 if ({isHide})
				$('.{id}-select2-container').hide();
		
			$('#{depend-id}').on('select2:select', function() {
		
				 var defaultData = {
					 depend: $(this).val(),
				 };
				 
				 var configData = {configData};
				 
				 var data = {...defaultData, ...configData};
			
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
					   var value = parseInt('{value}');
					   
					   options = document.createElement('option');
					   select2.append(options);
						
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
					   select2.trigger('select2:select');
					   
				   }
				 });
		
			});

JS,

	];


	public function codes()
	{

		switch (true) {

			case is_array($this->value):
				$filterValue = json_encode($this->value);
				break;

			case empty($this->value):
				$filterValue = 'null';
				break;

			default:
				$filterValue = $this->value;
				break;

		}

		$params = [
			'namespace' => $this->_config['namespace'],
			'service' => $this->_config['service'],
			'method' => $this->_config['method'],
			'args' => $this->_config['args'],
		];

		$params = ZArrayHelper::merge($params, $this->_config['params']);

		$depdropJs = '';
		if (!empty($this->_config['depend']))
			$depdropJs = strtr($this->_layout['depdrop'], [
				'{id}' => $this->id,
				'{depend-id}' => $this->checkDepend(),
				'{url}' => $this->_config['url'],
				'{isHide}' => $this->jscode($this->_config['isHide']),
				'{value}' => $this->jscode($filterValue),
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
			'{depend-id}' => $this->checkDepend(),
			'{type}' => $this->_config['type'],
			'{placeholder}' => $this->_config['placeholder'],
		]);

		$this->value = ZFormatter::filterValue($this->value);

		$name = $this->name;
		if ($this->_config['multiple']) {
			$name = $this->name . '[]';
		}

		$option = '';
		foreach ($this->data as $key => $value) {

			$selected = '';
			if (is_array($this->value)) {
				foreach ($this->value as $val) {
					if ($val === $key) {
						$selected = 'selected';
					}
				}

			} else
			if ($this->value === $key) {
				$selected = 'selected';
			}

			$option .= strtr($this->_layout['option'], [
				'{key}' => $key,
				'{value}' => $value,
				'{selected}' => $selected,
				'{id}' => $this->id,
				'{readonly}' => $this->_config['readonly'],
			]);

		}

		$this->htm = strtr($this->_layout['main'], [

			'{options}' => $option,
			'{id}' => $this->id,
			'{name}' => $name,
			'{value}' => $filterValue,
			'{depend}' => $this->checkDepend(),
			'{attribute}' => $this->getAttributeAll(),
			'{class}' => $this->_config['class'],
			'{readonly}' => $this->_config['readonly'] ? 'disabled' : '',
			'{multiple}' => $this->_config['multiple'] ? 'multiple' : '',

		]);


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

			case $this->_config['isMulti']:
                $name = $this->normalize($this->name);
                $depend = str_replace($attrName, $this->_config['depend'], $name) . $this->_config['dependAttr'];
				break;

			case $this->_config['isDepend']:
				$modelBase = $this->modelClassName;
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


