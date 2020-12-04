<?php

/**
 *
 *
 * Author:  Asror Zakirov
 * Date:    21.05.2019
 * https://www.linkedin.com/in/asror-zakirov
 * https://www.facebook.com/asror.zakirov
 * https://github.com/asror-z
 *
 */

namespace zetsoft\widgets\inptest;

use zetsoft\system\helpers\ZHTML;
use zetsoft\system\kernels\ZWidget;

/**
 * Class ZHRadioWidget
 * @package widgets\inputes
 * https://www.yiiframework.com/doc/api/2.0/yii-helpers-basehtml#radio()-detail
 *
 * Refactored: Zoxidjon001
 */
class ZHRadioWidget extends ZWidget
{

    public $config = [];
    public $_config = [
        'type' => ZHRadioWidget::type['Horizontal'],

    ];

  public const type = [
      'BasicMarkup' => 'BasicMarkup',
      'Horizontal' => 'Horizontal',
      'Vertical' => 'Vertical',
      'iconRight' => 'iconRight',
      'Disabled' => 'Disabled',
      'Enhanced' => 'Enhanced'
  ];

    public $layout = [];
    public $_layout = [
        'BasicMarkup' => <<<HTML
             <form>
        <legend>Basic markup:</legend>
        <fieldset data-role="controlgroup">
            <label>
                <input type="radio" name="radio-choice-0" id="radio-choice-0a">One
            </label>
            <label for="radio-choice-0b">Two</label>
                <input type="radio" name="radio-choice-0" id="radio-choice-0b" class="custom">
        </fieldset>
    </form>


HTML,
        'Horizontal' => <<<HTML
   <form>    
        <fieldset data-role="controlgroup" data-type="horizontal">
                    
            <legend>Horizontal:</legend>
                    <input type="radio" name="radio-choice-h-2" id="radio-choice-h-2a" value="on" checked="checked">
                    <label for="radio-choice-h-2a">One</label>
                    <input type="radio" name="radio-choice-h-2" id="radio-choice-h-2b" value="off">
                    <label for="radio-choice-h-2b">Two</label>
                    <input type="radio" name="radio-choice-h-2" id="radio-choice-h-2c" value="other">
                    <label for="radio-choice-h-2c">Three</label>
                
        </fieldset>
    </form>
    <form>
                
HTML,
        'Vertical' => <<<HTML
                    <form>           
    <fieldset data-role="controlgroup">
                
        <legend>Vertical:</legend>
                <input type="radio" name="radio-choice-v-2" id="radio-choice-v-2a" value="on" checked="checked">
                <label for="radio-choice-v-2a">One</label>
                <input type="radio" name="radio-choice-v-2" id="radio-choice-v-2b" value="off">
                <label for="radio-choice-v-2b">Two</label>
                <input type="radio" name="radio-choice-v-2" id="radio-choice-v-2c" value="other">
                <label for="radio-choice-v-2c">Three</label>
            
    </fieldset>
</form>
HTML,
        'iconRight' => <<<HTML
      <form>
        <fieldset data-role="controlgroup" data-iconpos="right">
                    
            <legend>Vertical, icon right:</legend>
                    <input type="radio" name="radio-choice-w-6" id="radio-choice-w-6a" value="on" checked="checked">
                    <label for="radio-choice-w-6a">One</label>
                    <input type="radio" name="radio-choice-w-6" id="radio-choice-w-6b" value="off">
                    <label for="radio-choice-w-6b">Two</label>
                    <input type="radio" name="radio-choice-w-6" id="radio-choice-w-6c" value="other">
                    <label for="radio-choice-w-6c">Three</label>
                
        </fieldset>
    </form>
HTML,
        'Disabled' => <<<HTML
    <form>
        <fieldset data-role="controlgroup" data-theme="b">
            <legend>Disabled:</legend>
            <label>
                <input type="radio" name="radio-choice-7" id="radio-choice-7a" disabled="disabled">One
            </label>
            <label for="radio-choice-7b">Two</label>
                <input type="radio" name="radio-choice-7" id="radio-choice-7b" disabled="disabled">
        </fieldset>
    </form>
HTML,
        'Enhanced' => <<<HTML
 <legend>Enhanced:</legend>
            <div class="ui-radio">
                    <label for="radio-enhanced" class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-off">I
                agree</label>
                    <input type="radio" name="radio-enhanced" id="radio-enhanced" data-enhanced="true">
            </div>
HTML,




    ];






    public function asset()
    {
        $this->fileCss('http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css');
       // $this->fileCss('https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css');
        //$this->fileJs('https://cdn.jsdelivr.net/npm/jquery@3.4.1/dist/jquery.min.js');
        $this->fileJs('http://code.jquery.com/jquery-1.11.1.min.js');
        $this->fileJs('http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js');
    }









    public function codes()
    {
        //vdd($this->options);



        /*$this->options = [
            'type' => 'radio',
            'class' => 'custom-control-input',
            'Horizontal' => $this->_config['Horizontal'],
            'id' => $this->id,
            'value' => $this->value,
        ];*/



        if (empty($this->model)) {
            $radio = ZHTML::radio(
                $this->name,
                false,
                $this->options
            );
        } else {
            $radio = ZHTML::activeRadio(
                $this->model,
                $this->attribute,
                $this->options
            );
        }

        $this->htm = strtr($this->_layout['BasicMarkup'],[

        ]);
        

   /*     $this->htm = <<<HTML
       <!-- Material unchecked -->
        <div class="custom-control custom-radio">
           
                <!-- Default unchecked -->
        <div class="custom-control custom-radio">
          <input type="radio" class="custom-control-input" id="defaultUnchecked" name="defaultExampleRadios">
          <label class="custom-control-label" for="defaultUnchecked">Default unchecked</label>
        </div>

               <!-- Default checked -->
        <div class="custom-control custom-radio">
          <input type="radio" class="custom-control-input" id="defaultChecked" name="defaultExampleRadios" checked>
          <label class="custom-control-label" for="defaultChecked">Default checked</label>
        </div>
        </div>
        
        
HTML;*/




    }


}

#!/usr/bin/env node

/* min.css binary
 * Usage: min.css [input-file1] [input-file2] [inputfileN] > [output-file]
 */

