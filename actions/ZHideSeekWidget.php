<?php

namespace zetsoft\widgets\actions;

use zetsoft\system\kernels\ZWidget;

/**
 *
 * Class ZKSelect2Widget
 * http://demos.krajee.com/widget-details/select2
 *
 * Created By: Sherzod Mangliyev
 * Refactored: 
 */
class ZHideSeekWidget extends ZWidget
{

  /**
   * Configuration
   */
  public $config = [];
  public $_config = [
      'grapes' => true,
  ];

  public const type = [
      
  ];

  /**
   *
   * Plugin Events
   * https://select2.org/programmatic-control/events
   */
  public $event = [];
  public $_event = [

  ];

  public $layout = [];
  public $_layout = [

      'main' => <<<HTML

    <input id="{id}" class="search search-nodata search-highlight" name="search" placeholder="Start typing here" type="text" data-list=".list">
<ul class="list list-unstyled">
    <li>item 1</li>
    <li>item 2</li>
    <li>item 3</li>
    <li>item 4</li>
    <li>java</li>
    <li>item 6</li>
    <li>item 7</li>
    <li>item 8</li>
    <li>item 9</li>
 </ul>

HTML,
      'js' => <<<JS
        $(document).ready(function() {
        $('.search').hideseek({
      list:           '.hideseek-data',
      nodata:         '',
      attribute:      'text',
      matches:        false,
      highlight:      false,
      ignore:         '',
      navigation:     false,
      ignore_accents: false,
      hidden_mode:    false,
      min_chars:      1
});
    });
JS,
      'css' => <<<CSS
       
CSS,
  ];


  public function asset()
  {

    $this->fileJs('https://cdn.jsdelivr.net/npm/jquery@3.4.1/dist/jquery.min.js');
    $this->fileJs('https://cdn.jsdelivr.net/npm/hideseek@0.8.0/jquery.hideseek.min.js');


  }


  public function codes()
  {

    $this->htm .= strtr($this->_layout['main'], [
        '{id}' => $this->id,
        
        '{readonly}' => $this->_config['readonly'] ? 'readonly' : ''
    ]);

    $this->js = strtr($this->_layout['js'], []);
    $this->css = strtr($this->_layout['css'], []);


  }

}
