<?php

namespace zetsoft\widgets\former;

use kartik\builder\Form;
use kartik\form\ActiveForm;
use zetsoft\dbitem\data\ALLTrait;
use zetsoft\dbitem\data\ConfigDB;
use zetsoft\dbitem\data\FormDb;
use zetsoft\former\ALL;
use zetsoft\former\card\ModelCardForm;
use zetsoft\service\forms\Active;
use zetsoft\service\forms\Ajaxer;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\helpers\ZUrl;
use zetsoft\system\kernels\ZWidget;
use zetsoft\system\module\Models;
use zetsoft\system\schema\ColumnSchema;
use zetsoft\widgets\inputes\ZHInputWidget;
use zetsoft\widgets\inputes\ZKSelect2Widget;
use zetsoft\widgets\inputes\ZKSwitchInputWidget;
use zetsoft\widgets\inputes\ZSelect2Widget;
use zetsoft\widgets\notifier\ZModalWidget;
use zetsoft\widgets\notifier\ZModalWidgetRavshan;
use zetsoft\widgets\notifier\ZPopoverXWidget;
use zetsoft\widgets\places\ZGoogleWidget;

/**
 * Class ZKEditableWidget
 * @package widgets\blocks
 * http://demos.krajee.com/editable
 */
class ZEditActiveWidget extends ZWidget
{

    /**
     * Configuration
     */

    public $changeUrl;

    public $config = [];
    public $_config = [
        'formId' => '',
        'index' => '',
        'options' => [],
        'isSession' => false,
        'modelId' => '',
        'successEdit' => '',
        'changeUrl' => '',
        'successChange' => '',
        'editableUrl' => '',
        'getParams' => [],
        'depends' => [],
    ];


    public const editableType = [
        'modal' => ZModalWidget::class,
        'popoverX' => ZPopoverXWidget::class,
    ];



    /**
     *
     * Plugin Events
     * https://select2.org/programmatic-control/events
     */
    public $event = [];
    public $_event = [

        'editableChange' => 'function(event, val) { console.log("ZKEditableWidget | Changed Value") }',
        'editableSubmit' => 'function(event, val, form) { console.log("ZKEditableWidget | Submitted Value ") }',
        'successChange' => '',
        'editableBeforeSubmit' => 'function(event, val, form, jqXHR) { console.log("ZKEditableWidget | Before submit triggered") }',
        'editableReset' => 'function(event) { console.log("ZKEditableWidget | Reset editable form"); }',
        'editableSuccess' => 'function(event, val, form, data) { console.log(); }',
        'editableError' => 'function(event, val, form) { console.log("ZKEditableWidget | Submitted Value" ) }',

        'editableAjaxError' => 'function(event, jqXHR, status, message) { console.log("ZKEditableWidget | message"); }'
    ];


    public $layout = [];
    public $_layout = [

        'main' => <<<HTML
   <div class="rv-editable-link {class}"><!--d-flex justify-content-center w-100-->
      {displayValue}
   </div>
   
HTML,

        'displayValueLink' => <<<HTML
<a id="modal-{id}-modal" class="{readonly} displayValue-editable modal-trigger-button">
  {value}
</a>
HTML,

        'displayValueReadonly' => <<<HTML
<span style="width:100%" id="readonly-{id}" class="modal-trigger-button">
  {value}
</span>
HTML,


        'js' => <<<JS

    var parentWindow = window.parent.document;
    
    var dynaSubmit = parentWindow.getElementById('{dynaSubmit}')
    var dynaReset = parentWindow.getElementById('{dynaReset}')
    var form = $('#edit-form')
    
    var isValid = true;
    form.on('afterValidate', function(event, e, errors) {
    
        if (errors.length > 0) 
           isValid = false
        else 
           isValid = true
            
    })
    
    $(dynaReset).on('click', event => window.parent.closeSweet())
    
    $(dynaSubmit).on('click', function(event) {
            
        if (isValid === true) {
        
            $.ajax({
                method: 'POST',
                url: '{url}',
                dataType: 'json',
                data: form.serialize(),
                success: function(response) {
                    var editable = parentWindow.getElementById(getId('{attribute}'))
                    
                    $(editable).html(response.output)
                 
                    var dependAttr = '';
                    var depends = {depends};
                           
                    for (var key in depends) {
                        var value = depends[key];
                        dependAttr = parentWindow.getElementById(getId(value))
                        $(dependAttr).html(response.depends[value])
                    }
                    
                    window.parent.ajaxFor();
                    window.parent.closeSweet();
                    window.parent.location.reload();
                    $('#dyna-editable-js-panel').hide()
                    
                },
                
            }).then(function() {
                window.location.reload();
            })  

        }
      
    })

    function getId(attribute) {
        return 'editable-{modelName}-' + attribute + '-{modelId}';
    }
    
    form.on('submit', function(event) {
        return;
    })
    
    $(document).on('keyup', event => {
        
        if (event.keyCode === 13) {
            $(dynaSubmit).click()
            return;
        }
        
        if (event.keyCode === 27) {
            window.parent.closeSweet();
            $('.jsPanel').hide()
            return;
        }
        
    })
        
    
JS,

        'css' => <<<CSS
        
        .displayValue-editable {
            color: royalblue!important;
            width: 100%;
        }
        
        .rv-editable-link {
            top: 30%;
        }
        
        .rv-editable-link:last-child {
            text-align: center !important;
        }
        
CSS,


    ];


    public function codes()
    {

        $column = $this->model->columns[$this->attribute];
        $column->options = $this->_config['options'];

        $active = new Active();
        $active->id = $this->_config['formId'];
        $active->validationUrl = '/api/core/apps/validate.aspx?modelClassName=' . $this->modelClassName;

        $form = $this->activeBegin($active);

        $model = $this->model;
        $model->configs->nameOn = [$this->attribute];

        $depends = $model->columnsList();

        $model->columns();

        echo ZFormWidget::widget([
            'form' => $form,
            'model' => $model,
            'config' => [
                'topBtn' => false,
                'botBtn' => false,
                'botId' => 'dynaSubmit',
                'bottomBtnClass' => 'btn-outline-success bottom-min'
            ],
        ]);

        $this->activeEnd();

        switch ($this->model->configs->editClass) {

            case ConfigDB::editClass['panel']:
                $submitBtnId = 'dynaSubmitPanel';
                $resetBtnId = 'dynaResetPanel';
                break;

            default:
                $submitBtnId = 'dynaSubmit';
                $resetBtnId = 'dynaReset';
                break;
        }

        $this->js = strtr($this->_layout['js'], [
            '{modelId}' => $this->jscode($this->model->id),
            '{index}' => $this->jscode($this->_config['index']),
            '{id}' => $this->jscode($this->id),
            '{attribute}' => $this->jscode($this->attribute),
            '{depends}' => $this->jscode($depends),
            '{formId}' => $this->jscode($this->_config['formId']),
            '{dynaSubmit}' => $submitBtnId,
            '{dynaReset}' => $resetBtnId,
            '{url}' => ZUrl::to([
                '/api/core/rest/get-value',
                'hasEdit' => true,
                'editableKey' => $this->model->id,
                'editableIndex' => $this->_config['index'],
                'session' => $this->_config['isSession'],
                'editableAttribute' => $this->attribute,
                'modelName' => $this->modelClassName,
                'depends' => $column->depends,
            ]),
            '{changeUrl}' => $this->_config['editableUrl'],
            '{successChange}' => $this->eventCode('successChange'),
            '{modelName}' => $this->jscode($this->modelClassName),
            '{session}' => $this->jscode($this->_config['isSession']),
        ]);


    }
}
