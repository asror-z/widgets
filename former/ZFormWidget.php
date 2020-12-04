<?php

namespace zetsoft\widgets\former;

use kartik\builder\Form;
use kartik\builder\FormGrid;
use rmrevin\yii\fontawesome\FA;
use Symfony\Component\CssSelector\Exception\ExpressionErrorException;
use zetsoft\dbitem\data\ALLApp;
use zetsoft\dbitem\data\ALLData;
use zetsoft\dbitem\data\Config;
use zetsoft\dbitem\data\ConfigDB;
use zetsoft\former\core\CoreServiceForm;
use zetsoft\service\menu\Json;
use zetsoft\system\actives\ZActiveRecord;
use zetsoft\system\actives\ZDynamicModel;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\kernels\ZWidget;
use zetsoft\system\module\Forms;
use zetsoft\system\module\Models;
use zetsoft\widgets\incores\ZFormGrid;
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\widgets\themes\ZCardWidget;

/**
 * Class ZFormWidget
 * http://demos.krajee.com/builder-details/form-grid
 */
class ZFormWidget extends ZWidget
{

    public $rows;

    public static $grapes = [
        'modalWidth' => '550px',
        'modalHeight' => '500px',
    ];


    public $_active = [
        'click' => false
    ];

    /* @var ALLApp $allapp */
    public $allapp;

    /**
     * Configuration
     */
    public $config = [];
    public $_config = [

        'type' => ZFormWidget::type['all'],
        'ident' => 0,
        'model' => null,

        'isCnt' => false,
        'count' => 1,
        'bottomBtnClass' => '',
        'botId' => '',

        'before' => null,
        'topBtn' => true,
        'botBtn' => true,

        'topBtnType' => ZButtonWidget::btnType['submit'],
        'botBtnType' => ZButtonWidget::btnType['submit'],

        'topBtnEvent' => [],
        'botBtnEvent' => [],

        'grapes' => false,

        'readonly' => false,

        'title' => '',
        'btnName' => 'Сохранить',
        'btnTitle' => 'Сохранить',

        'formSession' => null,
        'formClass' => null,
        'formAttr' => null,
        'formModel' => null,

        'columnsCount' => 2,
        'columnSize' => ZFormWidget::columnSize['sm'],
        'typeCard' => ZFormWidget::typeCard['card'],
        'titleClass' => 'bg-success',

        'isCard' => false,
    ];

    public const typeCard = [
        'card' => 'card',
        'collapse' => 'collapse',
    ];


    public $event = [];
    public $_event = [];
    public $layout = [];
    public $_layout = [

        'main' => <<<HTML
        {submitTop}
        {formGrid}
        {submitBottom}
HTML,

        'js' => <<<JS
 $('#{formId}').on('afterValidateAttribute', function (e, attribute, messages, deferreds) {
        console.log(e);
        console.log(attribute);
        var id = attribute.id;
        $('#'+id).trigger('changezet');
    });
JS,


        'submitTop' => <<<HTML
    <div class="d-flex justify-content-end topBtn mt-0 mb-3">{topBtn}</div>
HTML,

        'submitBottom' => <<<HTML
     <div class="d-flex justify-content-end bottomBtn">{bottomBtn}</div>
HTML,

        'css' => <<<CSS
            .btnCursor {
                    cursor: default;
             }

CSS,


    ];

    public const type = [
        'all' => 'all',
        'allbl' => 'allbl',
        'steps' => 'steps',
        'block' => 'block',
        'card' => 'card',
    ];

    public const columnSize = [
        'xs' => 'xs',
        'sm' => 'sm',
        'md' => 'md',
        'lg' => 'lg',
        'xl' => 'xl',
    ];


    public function init()
    {
        parent::init();
        if ($this->form !== null)
            $this->id = $this->form->id;
    }


    public function codes()
    {

        $model = $this->formApp();
        $model = $this->formParent($model);

//vd(ZArrayHelper::getValue($this->_config, 'values'));

        /*
        if ($model instanceof ZDynamicModel)
              vdd($model->name);
        */


        if ($model === null)
            return null;

        if (!$model->isModel())
            $this->form->enableAjaxValidation = false;


        $innerForm = false;

        if (empty($this->form))
            $innerForm = true;

        if ($innerForm)
            $this->form = $this->activeBegin();


        /**
         *
         * AfterValidate usage
         */

        /*
        $this->js = strtr($this->_layout['js'], [
                '{formId}' => $this->id
            ]);
                 */


        Az::$app->forms->former->model = $this->model;
        Az::$app->forms->former->form = $this->form;

        Az::$app->forms->former->event();

        $this->form->fieldConfig['enableLabel'] = $this->model->configs->hasLabel;
        $this->form->fieldConfig['labelSpan'] = $this->model->configs->labelSpan;
        $this->form->type = $this->model->configs->labelType;

        $former = Az::$app->forms->former;

        if (empty($this->rows)) {

            $former->clean();
            $former->model = $model;
            $former->form = $this->form;
            $former->ident = $this->_config['ident'];
            $former->isCnt = $this->_config['isCnt'];
            $former->count = $this->_config['count'];
            $former->type = $this->_config['type'];

            $this->rows = $former->run();
        }

        if (empty($this->rows)) {
            return null;
        }

        /**
         *
         * Buttons
         */

        $topBtn = ZButtonWidget::widget([
            'id' => 'secondary' . $this->modelClassName,
            'config' => [
                'btnType' => $this->_config['topBtnType'],
                'text' => Az::l('Сохранить'),
                'pjax' => 0,
                'icon' => 'fa fa-' . FA::_SAVE,
                'btnStyle' => ZButtonWidget::btnStyle['btn-outline-success'],
                'btnRounded' => false,
                'name' => 'submitBtn',
                'class' => 'rounded text-muted',
            ],
            'event' => $this->_config['topBtnEvent']

        ]);

        $botId = $this->modelClassName;

        if (!empty($this->_config['botId']))
            $botId = $this->_config['botId'];


        $bottomBtn = ZButtonWidget::widget([
            'id' => $botId,
            'config' => [
                'btnType' => $this->_config['botBtnType'],
                'text' => $this->_config['btnTitle'],
                'pjax' => 0,
                'icon' => 'fa fa-' . FA::_SAVE,
                'btnStyle' => ZButtonWidget::btnStyle['btn-outline-success'],
                'btnRounded' => false,
                'name' => 'submitBtn',
                'class' => $this->_config['bottomBtnClass']
            ],
            'event' => $this->_config['botBtnEvent']
        ]);


        /**
         *
         * Options
         */
        $this->options = [
            'form' => $this->form,
            'formName' => $this->formName,
            'model' => $model,
            'attributeDefaults' => [
                'type' => Form::INPUT_TEXT,
                'labelOptions' => [],
                'inputContainer' => [],
                'container' => []
            ],
            'rows' => $this->rows,
            'columns' => $this->_config['columnsCount'],
            'autoGenerateColumns' => true,
            'columnSize' => $this->_config['columnSize'],
            'columnOptions' => [
                'class' => ''
            ],
            'rowOptions' => [
                // 'class' => 'btn-warning'
            ],
            'options' => [
                'tag' => 'fieldset',
                'title' => $this->_config['title'],
            ],
        ];


        /**
         *
         * Blocks
         */


        $formGrid = ZFormGrid::widget($this->options);

        $top = '';
        if ($this->_config['topBtn'])
            $top = strtr($this->_layout['submitTop'], [
                '{topBtn}' => $topBtn
            ]);

        $bottom = '';
        if ($this->_config['botBtn'])
            $bottom = strtr($this->_layout['submitBottom'], [
                '{bottomBtn}' => $bottomBtn
            ]);

        if (!empty($this->options['rows']))
            $this->htm = strtr($this->_layout['main'], [
                '{submitTop}' => $top,
                '{formGrid}' => $formGrid,
                '{submitBottom}' => $bottom,
            ]);

        if ($this->formALL) {

            $obj = ZArrayHelper::getValue($this->modelColumns, $this->attributeAll);

            $this->htm = ZCardWidget::widget([
                'config' => [
                    'type' => ZCardWidget::type['dynCard'],
                    'title' => $obj->title === null ? $this->_config['title'] : $obj->title,
                    'hasTitle' => false,
                    'content' => $this->htm,
                    'padding' => '10px',
                ]
            ]);
        }

        if ($innerForm)
            $this->activeEnd();

        //  vd(  $this->id);
        $this->css = $this->_layout['css'];


    }

}
