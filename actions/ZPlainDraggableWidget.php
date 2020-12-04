<?php

namespace zetsoft\widgets\actions;

use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use function GuzzleHttp\Psr7\str;
use zetsoft\system\kernels\ZWidget;
use kartik\widgets\Select2;
use yii\web\JsExpression;

/**
 *
 * Class ZKSelect2Widget
 *
 *
 * Created By: Dilmurod Axmadov
 * Refactored: Asror Zakirov
 */
//plaindraggable/ex.css CDN da topilmadi
class ZPlainDraggableWidget extends ZWidget
{

  /**
   * Configuration
   */
  public $config = [];
  public $_config = [
      'type' => ZPlainDraggableWidget::type['main'],
      'grapes' => true,
  ];

  public const type = [
      'main' => 'main'

  ];

  public $layout = [];
  public $_layout = [


      'main' => <<<HTML
        <div class="cols2"  '>
  <div class="col">
    <p>SVG elements are positioned correctly even if those are zoomed-in/out.</p>
  </div>

  <div class="col" style="white-space: nowrap;">

    <div id="ex-020-slider">
      <div id="ex-020-pointer" class="cat" style="will-change: transform; -webkit-tap-highlight-color: transparent; box-shadow: transparent 0px 0px 1px; cursor: grab; user-select: none; transform: translate(0px, 24px);"></div>
    </div>

    <svg id="ex-020-stage" version="1.1" viewBox="0 0 360 216"><!-- content: 800 x 480 -->
      <rect id="ex-020-rect" x="10" y="10" width="780" height="460"></rect>
      <line id="ex-020-line-1" y2="63" y1="160" x2="147" x1="36"></line>
      <line id="ex-020-line-2" y2="220" y1="103" x2="240" x1="360"></line>
      <path id="ex-020-path" d="M36,160C147,63 240,220 360,103"></path>
      <circle id="ex-020-p0" cx="36" cy="160" r="16" style="-webkit-tap-highlight-color: transparent; box-shadow: transparent 0px 0px 1px; cursor: grab; user-select: none;" transform="translate(0 0)" class="cat"></circle>
      <circle id="ex-020-p1" cx="80" cy="40" r="16" style="-webkit-tap-highlight-color: transparent; box-shadow: transparent 0px 0px 1px; cursor: grab; user-select: none;" transform="translate(67.0005 22.9997)" class="cat"></circle>
      <circle id="ex-020-p2" cx="240" cy="220" r="16" style="-webkit-tap-highlight-color: transparent; box-shadow: transparent 0px 0px 1px; cursor: grab; user-select: none;" transform="translate(0 0)" class="cat"></circle>
      <circle id="ex-020-p3" cx="380" cy="120" r="16" style="-webkit-tap-highlight-color: transparent; box-shadow: transparent 0px 0px 1px; cursor: grab; user-select: none;" transform="translate(-20.0002 -16.9999)" class="cat"></circle>
    </svg>

  </div>
</div>
        
HTML,
      'js' => <<<JS
        
  window.addEventListener('load', function() {
    'use strict';

    var svg = document.getElementById('ex-020-stage'),
            field = document.getElementById('ex-020-rect'),
            p0 = document.getElementById('ex-020-p0'),
            p1 = document.getElementById('ex-020-p1'),
            p2 = document.getElementById('ex-020-p2'),
            p3 = document.getElementById('ex-020-p3'),
            path = document.getElementById('ex-020-path'),
            line1 = document.getElementById('ex-020-line-1'),
            line2 = document.getElementById('ex-020-line-2'),
            point = svg.createSVGPoint(),
            viewBox = svg.viewBox.baseVal,
            xy = {
              p0: {x: p0.cx.baseVal.value, y: p0.cy.baseVal.value},
              p1: {x: p1.cx.baseVal.value, y: p1.cy.baseVal.value},
              p2: {x: p2.cx.baseVal.value, y: p2.cy.baseVal.value},
              p3: {x: p3.cx.baseVal.value, y: p3.cy.baseVal.value}
            },
            OFFSET = {x: 16, y: 16}, // between draggable element and path seg
            SLIDER_RANGE = 240-24, //
            SLIDER_OFFSET,
            VIEW_WIDTH = 400,
            VIEW_HEIGHT = 240;

    function update(rect, xySeg) {
      if (rect) {
        point.x = rect.left-window.pageXOffset;
        point.y = rect.top-window.pageYOffset;
        point = point.matrixTransform(svg.getScreenCTM().inverse());
        xySeg.x = point.x + OFFSET.x;
        xySeg.y = point.y + OFFSET.y;
      }
      path.setAttribute('d', 'M' + xy.p0.x + ',' + xy.p0.y +
              'C' + xy.p1.x + ',' + xy.p1.y + ' ' +
              xy.p2.x + ',' + xy.p2.y + ' ' +
              xy.p3.x + ',' + xy.p3.y + '');
      line1.x1.baseVal.value = xy.p0.x;
      line1.y1.baseVal.value = xy.p0.y;
      line1.x2.baseVal.value = xy.p1.x;
      line1.y2.baseVal.value = xy.p1.y;
      line2.x1.baseVal.value = xy.p3.x;
      line2.y1.baseVal.value = xy.p3.y;
      line2.x2.baseVal.value = xy.p2.x;
      line2.y2.baseVal.value = xy.p2.y;
    }

    var drgP0 = new PlainDraggable(p0, {containment: field, onMove: function() { update(this.rect, xy.p0); }}),
            drgP1 = new PlainDraggable(p1, {containment: field, onMove: function() { update(this.rect, xy.p1); }}),
            drgP2 = new PlainDraggable(p2, {containment: field, onMove: function() { update(this.rect, xy.p2); }}),
            drgP3 = new PlainDraggable(p3, {containment: field, onMove: function() { update(this.rect, xy.p3); }}),
            pointer = new PlainDraggable(document.getElementById('ex-020-pointer'), {
              onMove: function() {
                var ratio = (this.rect.top + SLIDER_OFFSET) / SLIDER_RANGE + 0.5;
                viewBox.width = VIEW_WIDTH / ratio;
                viewBox.height = VIEW_HEIGHT / ratio;
                drgP0.position();
                drgP1.position();
                drgP2.position();
                drgP3.position();
              }
            });

    SLIDER_OFFSET = SLIDER_RANGE / 2-pointer.rect.top;
    update();
  });

           
JS,
  ];
  /**
   *
   * Plugin Events
   * https://select2.org/programmatic-control/events
   */
  public $event = [];
  public $_event = [

  ];


  /**
   *
   * Constants
   */


  public function asset()
  {
    $this->fileCss('/render/actions/ZPlainDraggableWidget/assets/ex.css');
    /* $this->fileJs('/publish/yarner/plain-draggable/plain-draggable.min.js');*/
    $this->fileJs('https://cdn.jsdelivr.net/npm/plain-draggable@2.5.12/plain-draggable.min.js');
  }


  public function codes()
  {
    //  $this->htm = \kartik\select2\Select2::widget($this->options);


    if ($this->_config['visible'])
      $this->htm = $this->_layout[$this->_config['type']];

      $this->htm = strtr($this->_layout['main'], [
          
          '{readonly}' => $this->_config['readonly'] ? 'readonly' : ''
      ]);

    $this->js = strtr($this->_layout['js'], []);


  }

}
