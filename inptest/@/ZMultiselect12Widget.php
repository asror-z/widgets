<?php

namespace zetsoft\widgets\inptest;

use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use function GuzzleHttp\Psr7\str;
use zetsoft\system\kernels\ZWidget;
use kartik\widgets\Select2;
use yii\web\JsExpression;

/**
 *

    http://loudev.com/#demos
 *  https://github.com/lou/multi-select
 *
 *  Created By: 
 */



class ZMultiselect12Widget extends ZWidget
{

    /**
     * Configuration
     */
    public $config = [];
    public $_config = [

    ];


    /**
     *
     * Plugin Events
     * https://select2.org/programmatic-control/events
     */
    public $event = [];
    public $_event = [

    ];





    public function codes()
    {
        //  $this->htm = \kartik\select2\Select2::widget($this->options);

        $this->htm = <<<HTML
       
  <h1>Searchable</h1>
  <select multiple class="searchable" name="searchable[]">
    <option value='elem_1'>elem 1</option>
    <option value='elem_2'>elem 2</option>
    <option value='elem_3'>elem 3</option>
    <option value='elem_4'>elem 4</option>
    <option value='elem_5'>elem 5</option>
    <option value='elem_6'>elem 6</option>
    <option value='elem_7'>elem 7</option>
    <option value='elem_8'>elem 8</option>
    <option value='elem_9'>elem 9</option>
    <option value='elem_10'>elem 10</option>
    <option value='elem_11'>elem 11</option>
    <option value='elem_12'>elem 12</option>
    <option value='elem_13'>elem 13</option>
    <option value='elem_14'>elem 14</option>
    <option value='elem_15'>elem 15</option>
    <option value='elem_16'>elem 16</option>
    <option value='elem_17'>elem 17</option>
    <option value='elem_18'>elem 18</option>
    <option value='elem_19'>elem 19</option>
    <option value='elem_20'>elem 20</option>

    <option value='elem_100'>elem 100</option>
  </select>

HTML;

        $this->js = <<<JS
           $('.searchable').multiSelect({
  selectableHeader: "<input type='text' class='search-input' autocomplete='off' placeholder='try \"12\"'>",
  selectionHeader: "<input type='text' class='search-input' autocomplete='off' placeholder='try \"4\"'>",
  afterInit: function(ms){
    var that = this,
        $selectableSearch = that.$selectableUl.prev(),
        $selectionSearch = that.$selectionUl.prev(),
        selectableSearchString = '#'+that.$container.attr('id')+' .ms-elem-selectable:not(.ms-selected)',
        selectionSearchString = '#'+that.$container.attr('id')+' .ms-elem-selection.ms-selected';

    that.qs1 = $selectableSearch.quicksearch(selectableSearchString)
    .on('keydown', function (event){
      if (e.which === 40){
        that.$selectableUl.focus();
        return false;
      }
    });

    that.qs2 = $selectionSearch.quicksearch(selectionSearchString)
    .on('keydown', function (event){
      if (e.which == 40){
        that.$selectionUl.focus();
        return false;
      }
    });
  },
  afterSelect: function(){
    this.qs1.cache();
    this.qs2.cache();
  },
  afterDeselect: function(){
    this.qs1.cache();
    this.qs2.cache();
  }
});
JS;


        $this->css = <<<CSS

         input{
        width: 167px;
      }
CSS;


    }

}
