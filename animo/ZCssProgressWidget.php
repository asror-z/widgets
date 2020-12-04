<?php

namespace zetsoft\widgets\animo;

use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use function GuzzleHttp\Psr7\str;
use zetsoft\system\kernels\ZWidget;
use kartik\widgets\Select2;
use yii\web\JsExpression;

/**
 *
 * https://github.com/codrops/CSSProgress
 * https://tympanus.net/Tutorials/CSSProgress/
 *
 *
 * Created By: AzimjonToirov
 * Refactored: AzimjonToirov
 * no CDN
 */
class ZCssProgressWidget extends ZWidget
{

    /**
     * Configuration
     */
    public $config = [];
    public $_config = [
        'type' => ZCssProgressWidget::type['move'],
        'color' => ZCssProgressWidget::color['navy'],
        'TooltipColor' => ZCssProgressWidget::color['heat-gradient'],
        'ValueNow' => 40,
        'ValueAfter' => 100,
        'MaxValue' => 100,
        'MinValue' => 0,
        'Tittle' => 'Some text here',
    ];


    /**
     *
     * Constants
     */
    public const type = [
        'ruler' => 'ruler',
        'move' => 'move',
        'heat-gradient' => 'heat-gradient',
        'dots-pattern' => 'dots-pattern',
    ];

    public const color = [
        'heat-gradient' => 'heat-gradient',
        'navy' => 'navy',
        'white' => 'white',
        'dark' => 'dark'
    ];

     public $layout=[];
     public $_layout=[


         'main' => <<<HTML
        <article class="flexy-grid col-7">
            <input type="checkbox" id="{id}">
            <label>{Tittle}</label>
            
            <div class="flexy-column">
                <div class="progress-factor flexy-item">
                    <div class="progress-bar ProgressBarStyle">
                        <div class="bar has-rotation has-colors {color} {type}" role="progressbar" aria-valuenow="{ValueNow}"
                             aria-valuemin="{MinValue}" aria-valuemax="{MaxValue}">
                            <div class="tooltip ProgressTooltip {TooltipColor}"></div>
                            <div class="bar-face face-position roof percentage"></div>
                            <div class="bar-face face-position back percentage"></div>
                            <div class="bar-face face-position floor percentage volume-lights"></div>
                            <div class="bar-face face-position left"></div>
                            <div class="bar-face face-position right"></div>
                            <div class="bar-face face-position front percentage volume-lights shine"></div>
                        </div>
                    </div>
                </div>
            </div>

            <label class="value-label" for="{id}">Jump to {ValueAfter}%</label>
        </article>
HTML,
         'css' => <<<CSS
            .flexy-column{
                width: 100%;
            }
            
            .ProgressBarStyle{
                width: auto;
            }
    
                /* line 86, ../scss/custom-bars.scss */
            input[type='checkbox']:checked ~ .flexy-column .bar[aria-valuenow] .percentage:before {
              width: {ValueAfter}%;
            }
            /* line 102, ../scss/custom-bars.scss */
            input[type='checkbox']:checked ~ .flexy-column .bar[aria-valuenow] .tooltip {
              left: {ValueAfter}%;
            }
            /* line 104, ../scss/custom-bars.scss */
            input[type='checkbox']:checked ~ .flexy-column .bar[aria-valuenow] .tooltip:before {
              content: '{ValueAfter}%';
            }
            .ProgressBarStyle{
                overflow: visible !important;
                background-color: unset !important;
            }
            .ProgressTooltip{
                opacity: 1 !important;
            }
    CSS,




     ];
    public function asset()

    {
        $this->fileCss('/render/animo/ZCssProgressWidget/assets/custom-bars.css');
        $this->fileCss('/render/animo/ZCssProgressWidget/assets/component.css');
    }

    public function codes()
    {



        $this->htm = strtr($this->_layout['main'], [
            '{id}' => $this->id,
            '{type}' => $this->_config['type'],
            '{color}' => $this->_config['color'],
            '{ValueNow}' => $this->_config['ValueNow'],
            '{MinValue}' => $this->_config['MinValue'],
            '{MaxValue}' => $this->_config['MaxValue'],
            '{TooltipColor}' => $this->_config['TooltipColor'],
            '{ValueAfter}' => $this->_config['ValueAfter'],
            '{Tittle}' => $this->_config['Tittle'],
        ]);

        $this->css = strtr($this->_layout['css'], [
            '{ValueAfter}' => $this->_config['ValueAfter']
        ]);


    }

}
