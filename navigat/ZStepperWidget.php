<?php

/**
 *
 *
 * Author:  Asror Zakirov
 * https://www.linkedin.com/in/asror-zakirov
 * https://github.com/asror-z
 *   Edited: Khusan Juraev
 */

namespace zetsoft\widgets\navigat;


use phpDocumentor\Reflection\Types\Self_;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\themes\ZTabWidget;
use function Sodium\crypto_box_keypair_from_secretkey_and_publickey;

class ZStepperWidget extends ZWidget
{
    public $config = [];
    public $_config = [
        'title' => 'step',
        'step' => ZStepperWidget::type['step'],
    ];

    public function asset() {
        $this->fileCss('/render/asrorz/mdb/css/addons-pro/steppers.css');

        $this->fileJs('/render/asrorz/mdb/js/addons-pro/steppers.js');
    }

    public const type = [
        'stepper' => 'stepper',
        'step' => 'step',
    ];

    public $layout = [];
    public $_layout = [

        'stepper' => <<<HTML
      <ul class="stepper horizontal horizontal-fix" id="horizontal-stepper-fix">
        {step}
      </ul>
HTML,

        'step' => <<<HTML
      <li class="step">
       <div class="step-title waves-effect waves-dark">{title}</div>
       <div class="step-new-content mt-3">
         <div class="row">
         {contents}
         </div>
       </div>
     </li>
HTML,

        'content' => <<<HTML
<div class="content">
{content}
</div>
HTML,

        'css' => <<<CSS
      ul.horizontal-fix li a {
          padding: .84rem 2.14rem;
      }
      .step-new-content::-webkit-scrollbar{
          display: none;
      }
CSS,

        'js' => <<<JS
    $(document).ready(function () {
        $('.stepper').mdbStepper();
    })

    function someFunction22() {
            $('#horizontal-stepper-fix').nextStep();
    }
    
    $('li.step:first-child').addClass('active');
    
JS,

    ];

    public function codes()
    {
        $steps = '';
        foreach ($this->data as $key => $value) {
            $steps .= strtr($this->_layout['step'],[
                '{title}' => $value,
                '{contents}' => strtr($this->_layout['content'], [
                    '{content}' => $value,
                ]),
            ]);
        }

        $this->htm = strtr( $this->_layout['stepper'], [
            '{step}' => $steps,
        ] );

        $this->css = strtr( $this->_layout['css'], [] );
        $this->js = strtr( $this->_layout['js'], [] );
    }
}


