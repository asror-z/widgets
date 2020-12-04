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


/**
 * Class    ZNestable2Widget
 * @package zetsoft\widgets\navigat
 *
 * https://github.com/RamonSmit/Nestable2
 * https://ramonsmit.github.io/Nestable2/
 */
class ZNestable2Widget extends ZWidget
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
    public $json = [];
    public $class_name;
    #region const
    public const ajaxUrl = [
        'url' => '/core/tester/nestableTerrabayt/test.aspx'
    ];
    public const modelClass = [
        'class_name' => ShopCategory::class,
    ];
    public const ajaxMethod = [
        'GET' => 'GET',
        'POST' => 'POST',
        'PUT' => 'PUT'
    ];
    public const attrId = [
        'id' => 'id',
    ];
    public const attrName = [
        'name' => 'name',
    ];
    public const attrParent = [
        'parent_id' => 'parent_id',
    ];
    public const attrSort = [
        'sort' => 'sort',
        'false' => false,
    ];
    public const actionReplace_item = ['true' => true, 'false' => false];
    public const actionAdd_item = ['true' => true, 'false' => false];
    public const actionCollapse_item = ['true' => true, 'false' => false];
    public const actionExpand_item = ['true' => true, 'false' => false];
    public const htmlLi = [
        'html' => '<li class="dd-item" data-id="1">
            <div class="dd-handle">Item 1</div>
        </li>
        <li class="dd-item" data-id="2">
            <div class="dd-handle">Item 2</div>
        </li>
        <li class="dd-item" data-id="3">
            <div class="dd-handle">Item 3</div>
            <ol class="dd-list">
                <li class="dd-item" data-id="4">
                    <div class="dd-handle">Item 4</div>
                </li>
                <li class="dd-item" data-id="5" data-foo="bar">
                    <div class="dd-nodrag">Item 5</div>
                </li>
            </ol>
        </li>'
    ];
    public const ff = ['json' => '[{id:35,children:[{id:36}]}]'];
    public const jsonArray = [
        'json' => '[
            {
                "id": 1,
                "content": "First item",
                "classes": ["dd-nochildren"]
            },
            {
                "id": 2,
                "content": "Second item",
                "children": [
                    {
                        "id": 3,
                        "content": "Item 3"
                    },
                    {
                        "id": 4,
                        "content": "Item 4"
                    },
                    {
                        "id": 5,
                        "content": "Item 5",
                        "value": "Item 5 value",
                        "foo": "Bar",
                        "children": [
                            {
                                "id": 6,
                                "content": "Item 6"
                            },
                            {
                                "id": 7,
                                "content": "Item 7"
                            },
                            {
                                "id": 8,
                                "content": "Item 8"
                            }
                        ]
                    }
                ]
            },
            {
                "id": 9,
                "content": "Item 9"
            },
            {
                "id": 10,
                "content": "Item 10",
                "children": [
                    {
                        "id": 11,
                        "content": "Item 11",
                        "children": [
                            {
                                "id": 12,
                                "content": "Item 12"
                            }
                        ]
                    }
                ]
            }
        ]; '
    ];
    /*  public const maxDepth = [
          'default' => 5,
      ];
      public const group = [
          'default' => 0,
      ];
      public const callback = [
          'default' => null,
      ];
      public const scroll = [
          'default' => false,
      ];
      public const scrollSensitivity = [
          'default' => 1,
      ];
      public const scrollSpeed = [
          'default' => 5,
      ];
      public const scrollTriggers = [
          'default' => ['top' => 40, 'left' => 40, 'right' => -40, 'bottom' => -40],
      ];
      public const effect = [
          'default' => ['animation' => 'none', 'time' => 'slow'],
      ];

      public const listNodeName = [
          'default' => 'ol',
      ];
      public const itemNodeName = [
          'default' => 'li',
      ];
      public const rootClass = [
          'default' => 'dd',
      ];
      public const listClass = [
          'default' => 'dd-list',
      ];
      public const itemClass = [
          'default' => 'dd-item',
      ];
      public const dragClass = [
          'default' => 'dd-dragel',
      ];
      public const noDragClass = [
          'default' => 'dd-nodrag',
      ];
      public const handleClass = ['default' => 'dd-handle',];
      public const collapsedClass = ['default' => 'dd-collapsed',];
      public const noChildrenClass = ['default' => 'dd-nochildren',];
      public const placeClass = ['default' => 'dd-placeholder',];
      public const emptyClass = ['default' => 'dd-empty',];
      public const expandBtnHTML = ['default' => '<button data-action="expand">Expand></button>',];
      public const collapseBtnHTML = ['default' => '<button data-action="collapse">Collapse</button>',];
      public const includeContent = ['default' => false,];
          */

    #endregion
    public $event = [];
    public $_event = [
        'expand_all_click' => 'jQuery(function(){
   jQuery(\'#collapse_all\').click();
});    ',
        'collapse_all_click' => 'jQuery(function(){
   jQuery(\'#collapse_all\').click();
});    ',
        'add_item_click' => 'jQuery(function(){
   jQuery(\'#collapse_all\').click();
});    ',
        'replace_item_click' => 'jQuery(function(){
   jQuery(\'#collapse_all\').click();
});    ',

    ];

    public $layout = [];
    public $_layout = [
        'item' => <<<HTML
            <!--<div class="container">   -->
            
            <div class="cf nestable-lists">
                    <menu id="nestable-menu">
    <input type="hidden" data-action="expand-all" id="expand_all">
    <input type="hidden" data-action="collapse-all" id="collapse_all" >
    <input type="hidden" data-action="add-item" id="add_item">
    <input type="hidden" data-action="replace-item" id="replace_item">  
</menu>

    <div class="dd" id="nestable">         
        <ol class="dd-list">
        {html_li}
    </ol>
    </div>

</div>
<!--<p><strong>Serialised Output (per list)</strong></p>
<textarea id="nestable-output" onchange = 'check2(this.value)'></textarea>    -->
<input type="hidden" id="nestable-output" onchange = 'check2(this.value)'>
<!--</div> -->
HTML,

        'css' => <<<CSS
        
       
CSS,
        'js' => <<<JS
        $(document).ready(function () {
                    {replace-item}
                    {expand-all}
                    {collapse-all}
                    {add-item}
                    
                    var someGlobalVar;
                   // var parent_id="{parent_id}",sort='{isSort}';
                 // var model="{modelClass}";
                    
        var updateOutput = function (e) {
            var list = e.length ? e : $(e.target),
                output = list.data('output');
            if (window.JSON) {
                output.val(window.JSON.stringify(list.nestable('toArray')));//, null, 2));
         someGlobalVar = list.nestable('toArray');
         console.log('someMes',someGlobalVar);
              
         $(function() {
                         $.ajax({
                       //  type:'POST',
                         method: 'POST',
                         url: '/core/tester/nestable/nestable.aspx',
                         data: someGlobalVar, 
                         dataType: 'json',
                          beforeSend: function(x) {
                            if (x && x.overrideMimeType) {
                              x.overrideMimeType("application/j-son;charset=UTF-8");
                            }
                          },
                         success:function(data) {
                             console.log('succes')
                         } ,
                         error:function( jqXHR,  textStatus,  errorThrown) { 
                            // if error occured
                             console.log(' error');
                         }
                         
                         }) ; 
              }); 
            }
            else {
                output.val('JSON browser support required for this demo.');
            }
        };         
             
       var json = {json_array}  
        var lastId = 12;

        // activate Nestable for list 1
        $('#nestable').nestable({
            group: 1,
            json: json,
            contentCallback: function (item) {
                var content = item.content || '' ? item.content : item.id;
                content += ' <i>(id = ' + item.id + ')</i>';

                return content;
            }
        }).on('change', updateOutput);
        

        // output initial serialised data
        updateOutput($('#nestable').data('output', $('#nestable-output')));
       // updateOutput($('#nestable').data('output', ));
       // updateOutput($('#nestable2').data('output', $('#nestable2-output')));

        $('#nestable-menu').on('click', function (e) {
            var target = $(e.target),
                action = target.data(paramAction);
            if (action === 'expand-all') {
                $('.dd').nestable('expandAll');
            }
            if (action === 'collapse-all') {
                $('.dd').nestable('collapseAll');
            }
            if (action === 'add-item') {
                var newItem = {
                    "id": ++lastId,
                    "content": "Item " + lastId,
                    "children": [
                        {
                            "id": ++lastId,
                            "content": "Item " + lastId,
                            "children": [
                                {
                                    "id": ++lastId,
                                    "content": "Item " + lastId
                                }
                            ]
                        }
                    ]
                };
                $('#nestable').nestable('add', newItem);
            }
            if (action === 'replace-item') {
                var replacedItem = {
                    "id": 10,
                    "content": "New item 10",
                    "children": [
                        {
                            "id": ++lastId,
                            "content": "Item " + lastId,
                            "children": [
                                {
                                    "id": ++lastId,
                                    "content": "Item " + lastId
                                }
                            ]
                        }
                    ]
                };
                $('#nestable').nestable('replace', replacedItem);
            }
        });

       // $('#nestable3').nestable();
          /*function check(value){
                document.getElementById('nestable-output').value = value
            };
                */
                
            //Is not changable according to OP
            function check2(value){  //alert(value);
            var obj = (value);
           
            };

            window.onload = function(){
                var tE = document.querySelector('#nestable-output'); //The readonly textarea

                //Redefine the value property for the textarea
                tE._value = tE.value;
                Object.defineProperty(tE, 'value', {
                    get: function(){return this._value},
                    set: function(v){
                        // console.log(this.id, ' - the value changed to: ' + v)
                        this._value = v;
                        this.setAttribute('value', v) //Setting the attribute (browser stuff);
                        check2(v)
                    }
                })
            }
    });
JS,


    ];

    /*  public function jscode($value)
      {
      }*/

    public function asset()
    {
        parent::asset();
        $this->fileCss('https://cdn.jsdelivr.net/npm/nestable2@1.6.0/jquery.nestable.min.css');
        $this->fileJs('https://cdn.jsdelivr.net/npm/nestable2@1.6.0/jquery.nestable.min.js');
    }

    public function codes()
    {
        $this->htm = strtr(
            $this->_layout['item'], [
            // '{class}' => $this->_config['class'],
            //'{firstTab}' => $item0,
            '{html_li}' => $this->_config['html'],
            // ' {saveForm}' => $saveForm,
            // '{readonly}' => $this->_config['readonly'] ? 'readonly' : '',
        ]);

        $this->css = strtr($this->_layout['css'], [

        ]);

        $this->js = strtr($this->_layout['js'], [
            '{replace-item}' => ($this->_config['actionReplace_item'] == 'true') ? $this->_event['replace_item_click'] : '',
            '{json_array}' => $this->_config['json'],
            //'{json_array}' =>Az::$app->tests->nestable->getVal(),
            '{expand-all}' => ($this->_config['actionExpand_item'] == 'true') ? $this->_event['expand_all_click'] : '',
            '{collapse-all}' => ($this->_config['actionCollapse_item'] == 'true') ? $this->_event['collapse_all_click'] : '',
            '{add-item}' => ($this->_config['actionAdd_item']) ? $this->_event['add_item_click'] : '',
            '{url}' => $this->jscode($this->_config['url']),
            '{GET}' => $this->jscode($this->_config['method']),
            
            // '{isSort}' => $this->jscode($this->_config['sortAttribute']),
            // '{modelClass}' => $this->jscode($this->_config['modelClass']),
            // '{parent_id}' => $this->jscode($this->_config['parentAttribute']),

        ]);

    }

}
