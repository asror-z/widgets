<?php

/**
 *
 * Class ZHtml5sortableWidget
 * http://demos.krajee.com/widget-details/select2
 *
 * Created By: ElnurController Suyunov
 * Refactored: Asror Zakirov
 */

namespace zetsoft\widgets\actions;


use zetsoft\system\kernels\ZWidget;


class ZHtml5sortableWidget extends ZWidget
{


  public $config = [];
  public $_config = [
      'title' => ZHtml5sortableWidget::title['title'],
  ];


  public const title = [
      'title' => 'Project Name1'
  ];

  public $layout = [];
  public $_layout = [

      'html' => <<<HTML
        <header>
                 <h1>HTML5 Sortable jQuery Plugin</h1>
         </header>

    <h2>Sortable List</h2>
    <ul class="sortable list">
        <li>Item 1</li>
        <li>Item 2</li>
        <li>Item 3</li>
        <li>Item 4</li>
        <li>Item 5</li>
        <li>Item 6</li>
    </ul>
<section>
    <h2>Sortable Grid</h2>
    <ul class="sortable grid">
        <li>Item 1</li>
        <li>Item 2</li>
        <li>Item 3</li>
        <li>Item 4</li>
        <li>Item 5</li>
        <li>Item 6</li>
    </ul>
</section>
<section>
    <h2>Exclude Items</h2>
    <ul class="exclude list">
        <li>Item 1</li>
        <li>Item 2</li>
        <li>Item 3</li>
        <li class="disabled">Item 4</li>
        <li class="disabled">Item 5</li>
        <li class="disabled">Item 6</li>
    </ul>
</section>
<section>
    <h2>Sortable List With Handles</h2>
    <ul class="handles list">
        <li><span>::</span> Item 1</li>
        <li><span>::</span> Item 2</li>
        <li><span>::</span> Item 3</li>
        <li><span>::</span> Item 4</li>
        <li><span>::</span> Item 5</li>
        <li><span>::</span> Item 6</li>
    </ul>
</section>
<section id="connected">
    <h2>Connected Sortable Lists</h2>
    <ul class="connected list">
        <li>Item 1</li>
        <li>Item 2</li>
        <li>Item 3</li>
        <li>Item 4</li>
        <li>Item 5</li>
        <li>Item 6</li>
    </ul>
    <ul class="connected list no2">
        <li class="highlight">Item 1</li>
        <li class="highlight">Item 2</li>
        <li class="highlight">Item 3</li>
        <li class="highlight">Item 4</li>
        <li class="highlight">Item 5</li>
        <li class="highlight">Item 6</li>
    </ul>
</section>
HTML,
      'js' => <<<JS
    $(function() {
        $('.sortable').sortable();
        $('.handles').sortable({
            handle: 'span'
        });
        $('.connected').sortable({
            connectWith: '.connected'
        });
        $('.exclude').sortable({
            items: ':not(.disabled)'
        });
    });
JS,
      'css' => <<<CSS
    header, section {
        display: block;
    }
    
    h1, h2 {
        text-align: center;
        font-weight: normal;
    }
    #features {
        margin: auto;
        width: 460px;
        font-size: 0.9em;
    }
    .connected, .sortable, .exclude, .handles {
        margin: auto;
        padding: 0;
        width: 310px;
        -webkit-touch-callout: none;
        -webkit-user-select: none;
        -khtml-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
    }
    .sortable.grid {
        overflow: hidden;
    }
    .connected li, .sortable li, .exclude li, .handles li {
        list-style: none;
        border: 1px solid #CCC;
        background: #F6F6F6;
        font-family: "Tahoma";
        color: #1C94C4;
        margin: 5px;
        padding: 5px;
        padding-bottom: 30px;
        height: 22px;
    }
    .handles span {
        cursor: move;
    }
    li.disabled {
        opacity: 0.5;
    }
    .sortable.grid li {
        line-height: 80px;
        float: left;
        width: 80px;
        height: 80px;
        text-align: center;
    }
    li.highlight {
        background: #FEE25F;
    }
    #connected {
        width: 440px;
        overflow: hidden;
        margin: auto;
    }
    .connected {
        float: left;
        width: 200px;
    }
    .connected.no2 {
        float: right;
    }
    li.sortable-placeholder {
        border: 1px dashed #CCC;
        background: none;
    }
 CSS,
  ];


  public function asset()
  {
    //$this->fileJs('https://cdn.jsdelivr.net/npm/jquery@3.4.1/dist/jquery.min.js');
   // $this->fileJs('/render/actions/ZHtml5sortableWidget/assets/jquery.sortable.js');
    $this->fileJs('https://cdn.jsdelivr.net/npm/jquery-sortablejs@1.0.1/jquery-sortable.js');
  }


  public function codes()
  {

    if ($this->_config['visible'])


      $this->htm = strtr($this->_layout['html'], []);
    $this->js = strtr($this->_layout['js'], []);
    $this->css = strtr($this->_layout['css'], []);


  }


}
