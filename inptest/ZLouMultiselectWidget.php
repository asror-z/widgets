<?php

namespace zetsoft\widgets\inptest;


use zetsoft\system\kernels\ZWidget;


/**
 *
 *
 * http://loudev.com/#demos
 * https://github.com/lou/multi-select
 *
 * Created By:
 */
class ZLouMultiselectWidget extends ZWidget
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

    public function asset()
    {

        $this->fileCss('https://cdnjs.cloudflare.com/ajax/libs/multi-select/0.9.12/css/multi-select.min.css');

        
        $this->fileJs('https://cdnjs.cloudflare.com/ajax/libs/multi-select/0.9.12/js/jquery.multi-select.min.js');
        $this->fileJs('https://cdn.jsdelivr.net/npm/jquery.quicksearch@2.4.0/dist/jquery.quicksearch.js');

    }


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
  <button class="btn btn-primary">Save</button>

HTML;

        $this->js = <<<JS
           $('.searchable').multiSelect({
                selectableHeader: "<input type='text' class='search-input' autocomplete='off' placeholder='try \"12\"'>",
                selectionHeader: "<input type='text'  class='search-input' autocomplete='off' placeholder='try \"4\"'>",  
               
                
});
           $('.search-input').quicksearch('ul.ms-list li');
JS;


        $this->css = <<<CSS
CSS;


    }

}
