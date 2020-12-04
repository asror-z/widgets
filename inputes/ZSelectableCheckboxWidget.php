<?php

namespace zetsoft\widgets\inputes;

use zetsoft\system\assets\ZColor;
use zetsoft\system\kernels\ZWidget;

/**
 *created By Xakimjon Ergashov
 * https://github.com/mee4dy/easySelectable
 * https://www.jqueryscript.net/demo/DOM-Selection-jQuery-easySelectable/
 *
 */
class ZSelectableCheckboxWidget extends ZWidget
{

    /**
     * Configuration
     */
    public $config = [];
    public $_config = [
        'container' => 'parent-div',
        'ContainerClass' => '',
        'sorting' => true,
        'width' => 'auto',
        'height' => 'auto',
        'itemClass' => 'display-inherit',
        'margin' => '', //top right bottom left ставите марджины по часавой стрелке
        'cols' => self::cols['1'],
        'boxColor' => ZColor::color['white'],
        'selectedColor' => ZColor::color['white'],
        'borderColor' => ZColor::color['main-green']
    ];

    public const cols = [
        '2' => '4',
        '3' => '3',
        '5' => '2',
        '11' => '1',
        '1' => '12',

    ];


    /**
     *
     * Plugin Events
     */
    public $event = [];
    public $_event = [
    ];

    public $layout = [];
    public $_layout = [

        'main' => <<<HTML
            <div id="container-{id}" class="{container}-div {ContainerClass}">
                <ul id="items" class="flex row">
                        {content}
                </ul>
                <input id="{id}-hidden" type="hidden" name="{name}" >
            </div>
    <script src="https://mobius1.github.io/Selectable/assets/js/demos/sortable.js"></script>
HTML,

        'items' => <<<HTML
            <li class="item {selected} col-lg-{cols}" data-value="{value}">
                        {item}
                        {sort}
            </li>
HTML,

        'sort' => <<<HTML
            <div class="handle mdi mdi-menu"></div>
HTML,

        'css' => <<<CSS
.ui-selectable{
width: {width};
height: {height};
margin: {margin};
}

#items{
flex-direction: row;
}
CSS,

        'js' => <<<JS
      var selecteds = $('.{container}-div').find('.item');
    
      $(document).on('mouseover', '.item', function() {
         var values = [];       
         selecteds.each(function(key, value) {
             if ($(value).hasClass('ui-selected')) {
                 values.push($(value).attr('data-value'));
             }
         });
     
         $('#{id}-hidden').attr('value', JSON.stringify(values));
                
         console.log($('#{id}-hidden').val());
         
     })
   
JS,

    ];

    public function asset()
    {
        //CSS
        $this->fileCss("//cdn.materialdesignicons.com/3.0.39/css/materialdesignicons.min.css");
        $this->fileCss("/render/actions/ZSortSelectableWidget/demo/style.css");

        //JS
        $this->fileJs("https://cdn.jsdelivr.net/npm/selectable.js@latest/selectable.min.js");
        $this->fileJs("https://cdn.jsdelivr.net/npm/sortablejs@1.10.2/Sortable.min.js");
        /*$this->fileJs("https://mobius1.github.io/Selectable/assets/js/demos/sortable.js");*/
    }

    public function codes()
    {

        $content = '';
        $sort = '';
        foreach ($this->data as $key => $value) {

            $selected = '';

            $dbValue = json_decode($this->value, true);

            if (!empty($dbValue))
                foreach ($dbValue as $val)
                    if ($key == $val)
                        $selected = 'ui-selected';

            if ($this->_config['sorting'])
            {
                $sort .= strtr($this->_layout['sort'],[]);
            }

            $content .= strtr($this->_layout['items'],[
                '{id}' => $this->id++,
                '{name}' => $this->name,
                '{value}' => $key,
                '{selected}' => $selected,
                '{item}' => $value,
                '{sort}' => $sort,
                '{cols}' => $this->_config['cols']
            ]);
        }

        $this->htm .= strtr($this->_layout['main'],[
            '{content}' => $content,
            '{id}' => $this->id,
            '{name}' => $this->name,
            '{container}' => $this->_config['container'],
            '{ContainerClass}' => $this->_config['ContainerClass']
        ]);

        $this->js .= strtr($this->_layout['js'],[
            '{container}' => $this->_config['container'],
            '{id}' => $this->id,
        ]);

        $this->css = strtr($this->_layout['css'],[
            '{width}' => $this->_config['width'],
            '{height}' => $this->_config['height'],
            '{margin}' => $this->_config['margin'],
        ]);
    }
}

