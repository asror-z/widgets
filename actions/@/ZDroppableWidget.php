<?php

/**
 *
 *
 * Author:  Asror Zakirov
 * https://www.linkedin.com/in/asror-zakirov
 * https://www.facebook.com/asror.zakirov
 * https://github.com/asror-z
 *
 */

namespace zetsoft\widgets\actions;

use zetsoft\system\Az;
use zetsoft\system\helpers\ZFileHelper;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;

class ZDroppableWidget extends ZWidget
{

  /**
   * Configuration
   */
  public $config = [];
  public $_config = [
      'disabled' => false,
      'tag' => ZDroppableWidget::tag['div'],
      'image' => ZDroppableWidget::image['image2'],
  ];


  public const image = [
      'image1' => '/image/200x200/1.jpg',
      'image2' => '/image/200x200/2.jpg',
      'image3' => '/image/200x200/3.jpg',
  ];

  public const tag = [
      'div' => 'div',
      'p' => 'p'
  ];

  public $layout = [];
  public $_layout = [

      'main' => <<<HTML
    <{tag} class="ui-widget ui-helper-clearfix">

    <ul id="gallery" class="gallery ui-helper-reset ui-helper-clearfix">
        <li class="ui-widget-content ui-corner-tr">
            <h5 class="ui-widget-header">High Tatras</h5>
            <img src="{image}" width="96" height="72">
            <a href="{image}" title="View larger image" class="ui-icon ui-icon-zoomin">View larger</a>
            <a href="link/to/trash/script/when/we/have/js/off" title="Delete this image" class="ui-icon ui-icon-trash">Delete image</a>
        </li>
        
    </ul>

   <!-- <div id="trash" class="ui-widget-content ui-state-default">
        <h4 class="ui-widget-header"><span class="ui-icon ui-icon-trash">Trash</span> Trash</h4>
    </div>-->
</{tag}>
HTML,


      'css' => <<<CSS
             #gallery { float: left; width: 65%; min-height: 12em; }
            .gallery.custom-state-active { background: #eee; }
            .gallery li { float: left; width: 96px; padding: 0.4em; margin: 0 0.4em 0.4em 0; text-align: center; }
            .gallery li h5 { margin: 0 0 0.4em; cursor: move; }
            .gallery li a { float: right; }
            .gallery li a.ui-icon-zoomin { float: left; }
            .gallery li img { width: 100%; cursor: move; }
    
            #trash { float: right; width: 32%; min-height: 18em; padding: 1%; }
            #trash h4 { line-height: 16px; margin: 0 0 0.4em; }
            #trash h4 .ui-icon { float: left; }
            #trash .gallery h5 { display: none; }
        
CSS,

  ];

  public function asset()
  {
    $this->fileCss('https://cdn.jsdelivr.net/npm/jqueryui@1.11.1/jquery-ui.css');
    $this->fileCss('/render/actions/ZDroppableWidget/assets/css/material.css');
    $this->fileJs('https://cdn.jsdelivr.net/npm/jquery@3.4.1/dist/jquery.js');
    $this->fileJs('https://cdn.jsdelivr.net/npm/jqueryui@1.11.1/jquery-ui.js');
    $this->fileJs('/render/actions/ZDroppableWidget/assets/js/script.js');

  }

  public function codes()
  {


    $this->htm = strtr($this->_layout['main'], [

        '{image}' => $this->_config['image'],
        '{tag}' => $this->_config['tag'],


    ]);
    $this->css = strtr($this->_layout['css'], []);

  }


}


