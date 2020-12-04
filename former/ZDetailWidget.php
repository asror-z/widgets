<?php

namespace zetsoft\widgets\former;

use rmrevin\yii\fontawesome\FA;
use Yii;
use yii\helpers\Html;
use yii\helpers\Json;
use zetsoft\models\core\CoreInput;
use zetsoft\models\user\User;
use zetsoft\models\App\eyuf\EyufDocument;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\helpers\ZUrl;
use zetsoft\system\kernels\ZView;
use kartik\dialog\Dialog;
use kartik\form\ActiveForm;
use rmrevin\yii\fontawesome\FontAwesome;
use zetsoft\system\kernels\ZWidget;
use kartik\detail\DetailView;
use zetsoft\widgets\inputes\ZKSelect2Widget;
use zetsoft\widgets\navigat\ZButtonWidget;

/**
 * Class ZKDetailViewWidget
 * @package widgets\former
 *
 * http://demos.krajee.com/detail-view
 * https://demos.krajee.com/detail-view-demo
 */
class ZDetailWidget extends ZWidget
{
    public $config = [];
    public $_config = [
        'title' => 'Example',
        //style
        'mode' => self::mode['view'],
        'page' => 'detail',
        'bootstrap' => true,
        'bordered' => false,
        'striped' => true,
        'condensed' => true,
        'responsive' => true,
        'hideAlerts' => false,

        'model' => '',
        'viewLabel' => '',
        'updateLabel' => '',
        'saveLabel' => '',
        'resetLabel' => '',
        'deleteLabel' => '',
        'deleteUrl' => '',
        'editAction' => '',

        'formOption' => [],
        'hover' => true,
        'icon' => '',
        'panelFooter' => 'ZCore Platform v5',
        'panelCssPrefix' => '',
        'pialogTitle' => '',
        'deleteParams' => [],
        'panelType' => self::panelType['primary'],
        'vAlign' => self::vAlign['middle'],
        'hAlign' => self::hAlign['center'],


    ];

    public $columns = [];


    public const mode = [
        'view' => 'view',
        'edit' => 'edit',
    ];

    private const panelType = [
        'default' => 'default',
        'primary' => 'primary',
        'info' => 'info',
        'danger' => 'danger',
        'success' => 'success',
        'active' => 'active',
    ];


    private const vAlign = [
        'top' => 'top',
        'middle' => 'middle',
        'bottom' => 'bottom',
    ];

    private const hAlign = [
        'right' => 'right',
        'left' => 'left',
        'center' => 'center',
    ];


    public function codes()
    {


        if ($this->model)
            $this->_config['model'] = $this->modelClass;

        if (empty($this->modelClassName))
            return $this->alertDanger( [], 'no such model');


        Az::$app->forms->detail->clean();
        Az::$app->forms->detail->model = $this->model;

        Az::$app->forms->detail->run();
        $this->columns = Az::$app->forms->detail->columns;

        if (isset($this->columns['id'])){
            $this->columns['id']['displayOnly'] = true;
        }

        if ($this->model)
            $this->_config['title'] = $this->model->configs->title;

        $this->options = [
            'model' => $this->model,
            //'attributes' => $this->attributes(),
            'attributes' => $this->columns,

            'mode' => $this->_config['mode'],

            //columns option need written

            //style
            'bootstrap' => $this->_config['bootstrap'],
            'bordered' => $this->_config['bordered'],
            'striped' => $this->_config['striped'],
            'condensed' => $this->_config['condensed'],
            'responsive' => $this->_config['responsive'],
            'hover' => $this->_config['hover'],

            'enableEditMode' => true,
            'hideIfEmpty' => false,
            'tooltips' => true,

            //https://demos.krajee.com/dialog
            'krajeeDialogSettings' => [
                'bsVersion' => 4,
                'useNative' => false,
                'libName' => 'krajeeDialog',
                'showDraggable' => true,
                /*'options' => [

                ],*/
                'jsPosition' => ZView::POS_HEAD,
            ],
            'fadeDelay' => 2,

            'hAlign' => $this->_config['hAlign'],
            'vAlign' => $this->_config['vAlign'],

            'rowOptions' => [],
            'labelColOptions' => [
                'style' => 'width: 20%'
            ],
            'valueColOptions' => [],
            'hideAlerts' => $this->_config['hideAlerts'],
            'notSetIfEmpty' => false,
            'alertContainerOptions' => [],
            'alertWidgetOptions' => [],
            'alertMessageSettings' => [
                'kv-detail-error' => 'alert alert-danger',
                'kv-detail-success' => 'alert alert-success',
                'kv-detail-info' => 'alert alert-info',
                'kv-detail-warning' => 'alert alert-warning'
            ],
            'options' => [],
            /*'container' => [],*/
            'panelOptions' => [],
            //'panelCssPrefix' => $this->sPanelCssPrefix,
            //   'formOptions' => $this->formOptions(),
            /*   'form' => $this->sFormClass,*/

            'panel' => [
                'heading' => $this->_config['title'],
                'type' => $this->_config['panelType'],
                'headingOptions' => [
                    'class' => 'card-header text-white bg-primary panel-title',
                    'tag' => 'h3',
                    'template' => ''
                ],
                'footer' => $this->_config['panelFooter'],
                'footerOptions' => [
                    'class' => 'card-footer',
                    'tag' => 'h4',
                    'template' => ''
                ],
            ],

            'mainTemplate' => "{detail}",
            /*   'buttonContainer' => [],*/
            'buttons1' => "{update} {delete}",
            'buttons2' => "{view} {reset} {save}",
            'viewAttributeContainer' => [],
            'editAttributeContainer' => [],
            'viewButtonsContainer' => [],
            'editButtonsContainer' => [],
            'viewOptions' => [
                'label' => '<i class="fa fa-eye text-white"></i>'
            ],
            'updateOptions' => [
                'label' => '<i class="fas fa-pen text-white"></i>',
                'params' => ['model' => $this->model],
            ],
            'saveOptions' => [
                'label' => '<i class="fas fa-save text-white"></i>',
                'params' => ['id' => $this->model->id, 'kvdelete' => true],
                'method' => 'post',

            ],
            'resetOptions' => [
                'label' => '<i class="fas fa-ban text-white"></i>'
            ],
            'deleteOptions' => [
                'label' => '<i class="fas fa-trash-alt text-white"></i>',
                'url' => "/{$this->prelastUrl()}/detail-delete.aspx?modelClassName={$this->modelClassName}&id={$this->model->id}",

                'params' => ['model' => $this->model, 'kvdelete' => true,],


            ],
            'container' => [],
            'formOptions' => [

                'method' => 'post',
            // don't change paramAction url
                //'action' => ZUrl::to(['detail', 'id' => $this->model->id]),

            // don't change paramAction url
                //'action' => ZUrl::to(['/api/core/rest/edit-dyna.aspx?', 'id' => $this->model->id]),


               /* 'action' => ZUrl::to([
                    "/{$this->moduleId}/{$this->controlId}/detail-edit",
                    'modelClassName' => "{$this->modelClassName}",
                    'id' => "{$this->model->id}",
                    'page' => $this->_config['page']
                ]),*/
                /*'action' => ZUrl::to([
                    '/core/tester/detail-view/detail-view',
                ])*/
            ],

            'i18n' => [
                'class' => 'yii\i18n\PhpMessageSource',
                'basePath' => '@kvdetail/messages',
                'forceTranslation' => true
            ],
        ];

        $this->htm = ZDetailView::widget($this->options);

    }

}
