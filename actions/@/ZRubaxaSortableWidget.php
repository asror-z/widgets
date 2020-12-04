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
 * http://sortablejs.github.io/Sortable/
 *
 * Created By: Asror Zakirov
 * Refactored: Asror Zakirov
 */

class ZRubaxaSortableWidget extends ZWidget
{

    /**
     * Configuration
     */
    public $config = [];
    public $_config = [
        'data'=>[],
        'type' => ZRubaxaSortableWidget::type['main'],
    ];

    public const type = [
        'main' => 'main'

    ];

    public $layout = [];
    public $_layout = [

        'main' => <<<HTML
        <div id="simpleList" class="list-group">
    <div class="list-group-item">This is <a href="http://rubaxa.github.io/Sortable/">Sortable</a></div>
    <div class="list-group-item">It works with Bootstrap...</div>
    <div class="list-group-item">...out of the box.</div>
    <div class="list-group-item">It has support for touch devices.</div>
    <div class="list-group-item">Just drag some elements around.</div>
</div>


<!-- List with handle -->
<div id="listWithHandle" class="list-group">
    <div class="list-group-item">
        <span class="badge">14</span>
        <span class="glyphicon glyphicon-move" aria-hidden="true"></span>
        Drag me by the handle
    </div>
    <div class="list-group-item">
        <span class="badge">2</span>
        <span class="glyphicon glyphicon-move" aria-hidden="true"></span>
        You can also select text
    </div>
    <div class="list-group-item">
        <span class="badge">1</span>
        <span class="glyphicon glyphicon-move" aria-hidden="true"></span>
        Best of both worlds!
    </div>
</div>
           
HTML
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

        $this->fileJs('/render/actions/@/ZRubaxaSortableWidget/assets/Sortable.js');
        /*$this->fileJs('https://cdn.jsdelivr.net/npm/sortablejs@1.10.2/Sortable.js');*/
        

    }

    public function codes()
    {
        //  $this->htm = \kartik\select2\Select2::widget($this->options);



        $this->js = <<<JS
            // Simple list
    Sortable.create(simpleList, { /* options */ });

    // List with handle
    Sortable.create(listWithHandle, {
        handle: '.glyphicon-move',
        animation: 150
    });
JS;


        $this->css = <<<CSS

CSS;


    }

}
