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
 * https://demos.jquerymobile.com/1.4.5/checkboxradio-radio/
 *
 * Created By: Omadbek Rahmonov
 *
 */
class ZHRadioWidgetRef extends ZWidget
{

    /**
     * Configuration
     */
    public $config = [];
    public $_config = [
        'type' => ZHRadioWidgetRef::types['horizontal'],
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
    public const theme = [
        'default' => 'default',
        'classic' => 'classic',
        'bootstrap' => 'bootstrap',
        'krajee' => 'krajee',
        'krajee-bs4' => 'krajee-bs4',
    ];

    public const size = [
        'lg' => 'lg',
        'md' => 'md',
        'sm' => 'sm'
    ];

    public const types = [
      'horizontal' => 'horizontal',
      'vertical' => 'vertical'
    ];


    public function asset()
    {
        $this->fileCss('http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css');
        $this->fileCss('https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css');


        $this->fileJs('http://code.jquery.com/jquery-1.11.1.min.js');
        $this->fileJs('http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js');
    }


    public function codes()
    {
        $this->layout = [
            'horizontal' => <<<HTML
                  <form>    
                      <fieldset data-role="controlgroup" data-type="horizontal">
                          <input type="radio" name="radio-choice-h-2" id="radio-choice-h-2a" value="on" checked="checked">
                    <label for="radio-choice-h-2a">One</label>
                    <input type="radio" name="radio-choice-h-2" id="radio-choice-h-2b" value="off">
                    <label for="radio-choice-h-2b">Two</label>
                    <input type="radio" name="radio-choice-h-2" id="radio-choice-h-2c" value="other">
                    <label for="radio-choice-h-2c">Three</label>
                
                      </fieldset>
                  </form>
HTML,
            'vertical' => <<<HTML
                  <form>           
                     <fieldset data-role="controlgroup">
                        <input type="radio" name="radio-choice-v-2" id="radio-choice-v-2a" value="on" checked="checked">
                        <label for="radio-choice-v-2a">One</label>
                        <input type="radio" name="radio-choice-v-2" id="radio-choice-v-2b" value="off">
                        <label for="radio-choice-v-2b">Two</label>
                        <input type="radio" name="radio-choice-v-2" id="radio-choice-v-2c" value="other">
                        <label for="radio-choice-v-2c">Three</label>
                     </fieldset>
                  </form>
HTML,
        ];

        $this->htm = <<<HTML
        
HTML;

        $this->js = <<<JS
            
JS;


        $this->css = <<<CSS

CSS;


    }

}
