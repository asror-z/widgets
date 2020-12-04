<?php
namespace zetsoft\widgets\Actions;

use zetsoft\system\kernels\ZWidget;

//tekshirish kerak

class ZJqueryUISortableWidgetOld extends ZWidget
{
    public $items = [];
    public $itemtype;
    public $iAnimate = 500;
    public $type;

    


    public $config = [];
    public $_config = [
        'axe' => ZJqueryUISortableWidget::Axe['x'],
        'type' => ZJqueryUISortableWidget::type['row']
    ];


     public const Axe = [
         'x'=> 'x',
         'y'=> 'y',

     ];

     public const type = [
         'column'=> 'column',
         'row'=> 'row',

     ];

     public $layout = [];
     public $_layout = [



     ];




    public function asset()
    {
        parent::asset();

        /*$this->fileJs('https://cdn.jsdelivr.net/npm/jquery@3.4.1/dist/jquery.js');*/
       /* $this->fileJs('https://cdn.jsdelivr.net/npm/jqueryui@1.11.1/jquery-ui.min.js');*/
       $this->fileJs('https://cdn.jsdelivr.net/npm/jqueryui@1.11.1/jquery-ui.js') ;
        /*$this->fileJs('https://cdn.jsdelivr.net/npm/jquery-ui-sortable-animation@1.0.1/jquery.ui.sortable-animation.js');*/
        $this->fileJs('https://cdn.jsdelivr.net/npm/jquery-ui-sortable-animation@1.0.1/jquery.ui.sortable-animation.js') ;
    }

    public function codes(){

        $this->htm = <<<HTML

    <ul id="sortable" style="display: flex; flex-direction:{$this->_config['type']}"  class="jqui-s-a-container ui-sortable">
HTML;

      foreach ($this->items as $item){
        $this->htm .= <<<HTML
       <li class="jqui-s-a-container__item ui-sortable-handle" style=" padding: 10px 20px;
        border:solid 4px #000; margin: 0; list-style: none; border-radius: 10px">{$item['item']}</li><br>
HTML;
      }


        $this->htm = <<<HTML
      </ul>
HTML;

        $this->js = <<<JS
    $(function () {
        $('#sortable').sortable({
          axis: '{$this->_config['axe']}',
          animation: {iAnimate},
        })
      });
JS;

    $this->all = $this->htm;

    return $this->all;

    }


}


