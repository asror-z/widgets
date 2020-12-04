<?php

namespace zetsoft\widgets\actions;

use zetsoft\dbitem\App\eyuf\CheckboxItem;
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
 * @author MurodovMirbosit
 */
class ZSortSelectableWidget extends ZWidget
{

    /**
     * Configuration
     */
    public $config = [];
    public $_config = [
        'container' => 'parent-div',
        'ContainerClass' => '',
        'sorting' => false,
        'cols' => self::cols['5'],
        'width' => '',
        'height' => '',
        'itemClass' => 'display-inherit',
        'margin' => '', //top right bottom left ставите марджины по часавой стрелке
    ];

    public const cols = [
        '2' => '4',
        '3' => '3',
        '5' => '2',
        '11' => '1',
    ];


    /**
     *
     * Plugin Events
     */
    public $event = [];
    public $_event = [

        'checked' => "console.log('CHECKED');",
        'unchecked' => "console.log('UNCHECKED');"
    ];

    public $layout = [];
    public $_layout = [

        'main' => <<<HTML
<div id="container-{id}" class="{container}-div {ContainerClass}">
    <ul id="myItems" class="my-ul d-flex row">
        {content}
    </ul>
     <input id="{id}-hidden" type="hidden" name="{name}" >
</div>
HTML,

        'myItems' => <<<HTML
            <li class="item {selected}  col-{cols}" data-value="{value}">
               {item}
               {sort}
            </li>
           
HTML,

        'sort' => <<<HTML
<div class="handle mdi mdi-menu"></div>
HTML,

        'css' => <<<CSS
.ui-selectable{
/*width: {width};
height: {height};
margin: {margin};*/
}

.my-ul{
    
}
CSS,

        'js' => <<<JS
      function SortSelectable() {
     var selecteds = $('.{container}-div').find('.item');
    
     $(document).on('mouseleave', '.item', function() {
         var values = [];       
         selecteds.each(function(key, value) {
             if ($(value).hasClass('ui-selected')) {
                 values.push($(value).attr('data-value'));
             }
         });
     
         $('#{id}-hidden').attr('value', JSON.stringify(values));
                
         console.log($('#{id}-hidden').val());
         
     })
     
const myItems = document.getElementById('myItems');
const SELECTABLE = new Selectable({
	filter: ".item",
	appendTo: myItems,
	ignore: ".handle", // ignore the handle used for sorting
});

const SORTABLE = Sortable.create(myItems, {
	animation: 200,
	handle: ".handle",
	onUpdate: function (evt) {
	    
    // Selecting will still work, but shift + select will be broken due to the order difference.
    // So update the Selctable instance to reflect the new order.
	SELECTABLE.update();
	}
});
      }
      
      SortSelectable();
      
      jQuery(document).on('pjax:end', function () {
           SortSelectable();
      });
                     
JS,

    ];

    public function asset()
    {
        //CSS
        $this->fileCss('//cdn.materialdesignicons.com/3.0.39/css/materialdesignicons.min.css');
        $this->fileCss('/render/actions/ZSortSelectableWidget/demo/style.css');

        //JS
        $this->fileJs('https://cdn.jsdelivr.net/npm/selectable.js@latest/selectable.min.js');
        $this->fileJs('https://cdn.jsdelivr.net/npm/sortablejs@1.10.2/Sortable.min.js');
        /*$this->fileJs("https://mobius1.github.io/Selectable/assets/js/demos/sortable.js");*/
    }

    public function codes()
    {

        $content = '';
        $sort = '';

        foreach ($this->data as $key => $value) {

            $selected = '';
            if (!is_array($this->value))
                $dbValue = json_decode($this->value, true);
            else
                $dbValue = $this->value;

            if (!empty($dbValue)) {
                foreach ($dbValue as $val) {
                    if ($key == $val) {
                        $selected = 'ui-selected';
                    }
                }
            }

            if ($this->_config['sorting']) {
                $sort .= strtr($this->_layout['sort'], []);
            }

            $content .= strtr($this->_layout['MyItem'], [
                '{id}' => $this->id++,
                '{name}' => $this->name,
                '{value}' => $key,
                '{selected}' => $selected,
                '{item}' => $value,
                '{sort}' => $sort,
                '{cols}' => $this->_config['cols'],
            ]);
        }

        $this->htm .= strtr($this->_layout['main'], [
            '{content}' => $content,
            '{id}' => $this->id,
            '{name}' => $this->name,
            '{container}' => $this->_config['container'],
            '{ContainerClass}' => $this->_config['ContainerClass']
        ]);

        $this->js .= strtr($this->_layout['js'], [
            '{container}' => $this->_config['container'],
            '{id}' => $this->id,
            '{change}' => $this->eventCode('change'),
            '{unchecked}' => $this->eventCode('unchecked'),
            '{checked}' => $this->eventCode('checked'),
        ]);

        $this->css = strtr($this->_layout['css'], [
            '{width}' => $this->_config['width'],
            '{height}' => $this->_config['height'],
            '{margin}' => $this->_config['margin'],
        ]);
    }
}

