<?php

namespace zetsoft\widgets\actions;

use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
//use zetsoft\widgets\inputes\ZSampleWidget;
use function GuzzleHttp\Psr7\str;
use zetsoft\system\kernels\ZWidget;
use kartik\widgets\Select2;
use yii\web\JsExpression;

/**
 *
 * https://github.com/mee4dy/easySelectable
 * https://www.jqueryscript.net/demo/DOM-Selection-jQuery-easySelectable/
 *
 * Created By: AzimjonToirov
 * Refactored: AzimjonToirov
 */
class ZEasySelectable extends ZWidget
{

    /**
     * Configuration
     */
    public $config = [];
    public $_config = [
        'selects' => [],
        'disabled' => false,
        'contentBefore' => '',
        'isHideSearch' => false,
        'isMaintainOrder' => false,
        'contentAfter' => 'Test',
        'readonly' => false,
        'multiple' => false,
        'theme' => ZeasySelectable::theme['classic'],
        'size' => ZeasySelectable::size['lg'],
        'selectableColor' => '#333'
    ];


    /**
     *
     * Plugin Events
     * https://select2.org/programmatic-control/events
     */
    public $event = [];
    public $_event = [
        'change' => ' console.log("ZKSelect2Widget | $eventChange") ',

    ];


    /**
     *
     * Constants
     */
    public const theme = [
        'default' => 'default',
        'classic' => 'classic',
        'bootstrap' => 'bootstrap',
        'krajee' => 'krajee',
        'krajee-bs4' => 'krajee-bs4',
    ];

    public const size = [
        'lg' => 'lg',
        'md' => 'md',
        'sm' => 'sm'
    ];




    /**
     *
     * Function  option
     * https://demos.krajee.com/widget-details/select2#settings
     */



    public function codes()
    {
        $this->options = [
            'model' => $this->model,
            'attribute' => $this->attribute,
            'name' => $this->name,
            'bsVersion' => $this->bsVersion,
            'data' => $this->data,
            'value' => $this->value,
            'language' => Az::$app->language,


            'theme' => $this->_config['theme'],
            'changeOnReset' => true,
            'hideSearch' => $this->_config['isHideSearch'],
            'maintainOrder' => $this->_config['isMaintainOrder'],
            'showToggleAll' => true,
            'toggleAllSettings' => [
                'selectLabel' => '<i class="fas fa-ok-circle"></i> Tag All',
                'unselectLabel' => '<i class="far fa-check-square"></i> Unselect all',
                'selectOptions' => [],
                'unselectOptions' => [],
                'options' => ['class' => 's2-togall-button']
            ],
            'initValueText' => '',
            'addon' => [
                'groupOptions' => [],
                'contentBefore' => $this->_config['contentBefore'],
                'contentAfter' => $this->_config['contentAfter']

            ],
            'size' => $this->_config['size'],
            'disabled' => $this->_config['disabled'],
            'readonly' => $this->_config['readonly'],
            'options' => [
                'multiple' => $this->_config['multiple'],
                'placeholder' => $this->_config['placeholder']
            ],
            'pluginLoading' => true,
            /**
             * Plugin Options
             * https://select2.org/options
             */
            /**
             * Plugin Events
             * https://select2.org/programmatic-control/events
             */
            'pluginEvents' => [
                'select2:change' => $this->eventCode('change'),
                'select2:open' => $this->eventCode('open'),
            ],

        ];


        $this->htm = <<<HTML
  <ul id="easySelectable">
HTML;
        foreach ($this->_config['selects'] as $select) {
            $this->htm .= <<<HTML
            <li class="es-selectable">{$select}</li>
HTML;
        }

        $this->htm .= <<<HTML
           </ul>       
HTML;

        $this->js = <<<JS
          
(function($){
	//selectable html elements
	$.fn.easySelectable = function(options){
		var el = $(this);
		var options = $.extend({
			'item': 'li',
			'state': true,
			onSelecting: function (event){

			},
			onSelected: function (event){

			},
			onUnSelected: function (event){

			}
		}, options);
		el.on('dragstart', function(event) { event.preventDefault(); });
		el.off('mouseover');
		el.addClass('easySelectable');
		if(options.state){
			el.find(options.item).addClass('es-selectable');
	  		el.on('mousedown', options.item, function (event){
	  			$(this).trigger('start_select');
				var offset = $(this).offset();
				var hasClass = $(this).hasClass('es-selected');
				var prev_el = false;
				el.on('mouseover', options.item, function (event){
					if(prev_el==$(this).index()) return true;
					prev_el = $(this).index();
					var hasClass2 = $(this).hasClass('es-selected');
					if(!hasClass2){
						$(this).addClass('es-selected').trigger('selected');
						el.trigger('selected');
						options.onSelecting($(this));
						options.onSelected($(this));
					}
					else{
						$(this).removeClass('es-selected').trigger('unselected');
						el.trigger('unselected');
						options.onSelecting($(this));
						options.onUnSelected($(this));
					}
				});
				if(!hasClass){
					$(this).addClass('es-selected').trigger('selected');
					el.trigger('selected');
					options.onSelecting($(this));
					options.onSelected($(this));
				}
				else{
					$(this).removeClass('es-selected').trigger('unselected');
					el.trigger('unselected');
					options.onSelecting($(this));
					options.onUnSelected($(this));
				}
				var relativeX = (e.pageX-offset.left);
				var relativeY = (e.pageY-offset.top);
			});
			$(document).on('mouseup', function(){
				el.off('mouseover');
		    });
		}
		else{
			el.off('mousedown');
		}
	};
})(jQuery);

           $(function(){
            $('#easySelectable').easySelectable();
        });
JS;

        $this->css = <<<CSS
* {
    margin: 0;
    padding: 0;
}

body {
    background: #f7f7f7;
}

#wrap {
    width: 960px;
    margin: 80px auto;
}

#wrap section {
    margin-top: 30px;
}

#wrap .wrap__title {
    margin-bottom: 15px;
    color: #444;
}

#wrap .wrap__title .small {
    font-size: 11px;
    color: #666;
    margin-left: 20px;
}

#wrap .wrap__table {
    border-collapse: collapse;
    table-layout: fixed;
    width: 100%;
}

#wrap .wrap__table th {
    color: #222;
    border: 1px solid #ccc;
    padding: 10px;
    text-align: left;
}

#wrap .wrap__table th:nth-child(1) {
    width: 80px;
}

#wrap .wrap__table th:nth-child(2) {
    width: 80px;
}

#wrap .wrap__table th:nth-child(3) {
    width: 150px;
}

#wrap .wrap__table td {
    border: 1px solid #ccc;
    padding: 10px;
}

#easySelectable {
    display: flex;
    flex-wrap: wrap;
}

#easySelectable li {
    margin: 0 10px 10px 0;
    background: #fff;
    transition: background 0.2s;
    width: 100px;
    height: 100px;
    color: #222;
    font-weight: bold;
    text-align: center;
    display: flex;
    justify-content: center;
    align-items: center;
    cursor: pointer;
    box-shadow: 0px 1px 1px #ccc;
}

#easySelectable li.es-selected {
    background: {$this->_config['selectableColor']};
    color: #fff;
}
CSS;

    }
}

