<?php

namespace zetsoft\widgets\navigat;

use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use function GuzzleHttp\Psr7\str;
use zetsoft\system\kernels\ZWidget;
use kartik\widgets\Select2;
use yii\web\JsExpression;

/**
 *
 *
 * https://mdbootstrap.com/docs/jquery/components/stepper/
 *
 * Created By: Jahongir Qudratov
 *
 */
class ZStepperWidget extends ZWidget
{

    /**
     * Configuration
     */
    public $config = [];
    public $_config = [
        'layout' => ZStepperWidget::layout['parallel'],
        'data-label' => '',
        'btnColor' => ZStepperWidget::btnStyle['btn-danger'],
        'btnSize' => ZStepperWidget::btnSize['btn-md'],
        'content' => '',
        'active' => '',
        'items' => [],


    ];


    /**
     *
     * Plugin Events
     * https://select2.org/programmatic-control/events
     */
    public $event = [];
    public $_event = [
        'change' => ' console.log("ZKSelect2Widget | $eventChange") ',

    ];


    /**
     *
     * Constants
     */


    public const layout = [
        'horizontal' => 'horizontal',
        'parallel' => 'parallel',
        'linear' => 'linear',
        'non-linear' => 'non-linear'
    ];

    public const btnSize = [
        'btn-lg' => 'btn-lg',
        'btn-md' => 'btn-md',
        'btn-sm' => 'btn-sm',
    ];

    private $li_config = [
        'name' => 'Step 1',
        'content' => '',
        'active' => '',

    ];

    public function asset()
    {
        $this->fileCss('/render/ALL/vendroid/assets/theme/mdbpro/css/addons-pro/steppers.css');

        $this->fileJs('/render/ALL/vendroid/assets/theme/mdbpro/js/addons-pro/steppers.js');
    }

public $layout =[];
public $_layout=[

    'linear' => <<<HTML
     <ul class="stepper linear">
            {array}
</ul>
HTML,
    'non-linear' => <<<HTML
     <ul class="stepper">
                {array}
</ul>

HTML,

    'parallel' => <<<HTML
     <ul class="stepper parallel">
                        {array}
</ul>
HTML,
    'horizontal' => <<<HTML
     <ul class="stepper horizontal" id="horizontal-stepper">
                                {array}
</ul>
HTML,

];


    public function codes()
    {
        //  $this->htm = \kartik\select2\Select2::widget($this->options);


        $array = '';

        foreach ($this->_config['items'] as $key => $item) {

            $item = ZArrayHelper::merge($this->li_config, $item);


            $array .= <<<HTML
                    <li class="step {$item['active']}">
        <div class="step-title waves-effect waves-dark">{$item['name']}</div>
        <div class="step-new-content" style="left: 0%; display: none;">
            <div class="row">
                   {$item['content']}
            </div>
            <div class="step-actions">
                <button class="waves-effect waves-dark btn {$this->_config['btnSize']} {$this->_config['btnColor']} next-step">CONTINUE</button>
                <button class="waves-effect waves-dark btn {$this->_config['btnSize']} {$this->_config['btnColor']} previous-step">BACK</button>
            </div>
        </div>
    </li>
HTML;

        }




        /*$this->htm = $this->_layout[$this->_config['layout']];*/

        $this->js = <<<JS
            $(document).ready(function () {
                $('.stepper').mdbStepper();
                
                $('.stepper li:first-child').children().children('.step-actions').find('.previous-step').hide();
                
                $('.stepper li:last-child').children().children('.step-actions').find('.next-step').text('Submit');
                 
                $('.stepper li:last-child').children().children('.step-actions').find('.next-step').removeClass('next-step');
          });
          
JS;

        $this->htm = strtr($this->htm, [

            '{data-label}' => $this->jscode($this->_config['data-label']),
            '{active}' => $this->jscode($this->_config['active']),
            '{btnColor}' => $this->jscode($this->_config['btnColor']),
            '{btnSize}' => $this->jscode($this->_config['btnSize']),
            '{items}' => $this->jscode($this->_config['items']),
            '{content}' => $this->jscode($this->_config['content']),

        ]);

         $this->htm = strtr($this->_layout['horizontal'],[
         '{array}'=> $array
         ]);



    }
}
