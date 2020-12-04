<?php

/**
 *
 *
 * Author:  Asror Zakirov
 * https://www.linkedin.com/in/asror-zakirov
 * https://github.com/asror-z
 *
 */

namespace zetsoft\widgets\navigat;


use zetsoft\models\shop\ShopCategory;
use zetsoft\models\place\PlaceRegion;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZWidget;

class ZNestable2WidgetD extends ZWidget
{
    public $config = [];
    public $_config = [
        'actionReplace_item' => ZNestable2Widget::actionReplace_item['false'],
        'actionAdd_item' => ZNestable2Widget::actionAdd_item['false'],
        'actionCollapse_item' => ZNestable2Widget::actionCollapse_item['true'],
        'actionExpand_item' => ZNestable2Widget::actionExpand_item['false'],
        'html' => ZNestable2Widget::htmlLi['html'],
        'json' => ZNestable2Widget::jsonArray['json'],
        'url' => ZNestable2Widget::ajaxUrl['url'],
        'method' => ZNestable2Widget::ajaxMethod['POST'],
        //'attrName' => ZNestable2Widget::attrName['name'],
        //'save' => '',
        'modelClass' => ShopCategory::class,
        'parentAttribute' => 'parent_id',
        'sortAttribute' => 'sort',
    ];



    public $event = [];
    public $_event = [

    ];

    public $layout = [];
    public $_layout = [
          'main' => <<<HTML
<div class="dd" id="nestable-json"></div>
HTML,
    'js' => <<<JS
$('.dd').nestable({
    onDragStart: function (l, e) {
        // get type of dragged element
        var type = $(e).data('type');
        
        // based on type of dragged element add or remove no children class
        switch (type) {
            case 'type1':
                // element of type1 can be child of type2 and type3
                l.find("[data-type=type2]").removeClass('dd-nochildren');
                l.find("[data-type=type3]").removeClass('dd-nochildren');
                break;
            case 'type2':
                // element of type2 cannot be child of type2 or type3
                l.find("[data-type=type2]").addClass('dd-nochildren');
                l.find("[data-type=type3]").addClass('dd-nochildren');
                break;
            case 'type3':
                // element of type3 cannot be child of type2 but can be child of type3
                l.find("[data-type=type2]").addClass('dd-nochildren');
                l.find("[data-type=type3]").removeClass('dd-nochildren');
                break;
            default:
                console.error("Invalid type");
        }
    }
});
JS,
     'jscode' => <<<JS
var json = '[{"id":1, "value":"wqew"},{"id":2,"children":[{"id":3},{"id":4},{"id":5,"value":"Item 5 value","children":[{"id":6},{"id":7},{"id":8}]}]},{"id":9},{"id":10,"children":[{"id":11,"children":[{"id":12}]}]}]';
var options = {'json': json}
$('#nestable-json').nestable(options);
JS,

    ];



    public function asset()
    {
        parent::asset();
        $this->fileCss('https://cdn.jsdelivr.net/npm/nestable2@1.6.0/jquery.nestable.min.css');


        $this->fileJs('https://cdn.jsdelivr.net/npm/nestable2@1.6.0/jquery.nestable.min.js');
    }

    public function codes()
    {

         $this->htm = strtr($this->_layout['main'], [

         ]);

         $this->js = strtr($this->_layout['jscode'], [

         ]);

    }

}
