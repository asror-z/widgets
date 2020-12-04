<?php

namespace zetsoft\widgets\former;

use kartik\builder\Form;
use kartik\form\ActiveForm;
use zetsoft\dbitem\data\ConfigDB;
use zetsoft\dbitem\data\FormDb;
use zetsoft\former\card\CardModelForm;
use zetsoft\models\ware\WareEnter;
use zetsoft\models\ware\WareEnterItem;
use zetsoft\models\ware\WareReturn;
use zetsoft\service\forms\Active;
use zetsoft\service\forms\Ajaxer;
use zetsoft\system\Az;
use zetsoft\system\except\ZNotFoundException;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\helpers\ZUrl;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\system\module\Models;
use zetsoft\system\schema\ColumnSchema;
use zetsoft\widgets\inputes\ZHInputWidget;
use zetsoft\widgets\inputes\ZInputWidget;
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
class ZProcessWidget extends ZWidget
{

    /**
     * Configuration
     */

    public $changeUrl;

    public $config = [];
    public $_config = [
        'relatedClass' => '',
        'relatedAttr' => '',
        'dynaConfig' => [],
        'formConfig' => [],
        'modelNames' => [],
        'modelNamesEx' => [],
        'relatedModelNamesEx' => [],
        'relatedModelNames' => [],
        'modelReadOnlyWidget' => [],
        'card' => []

     ];


    public function init()
    {
        parent::init();
    }

    /**
     *
     * Plugin Events
     * https://select2.org/programmatic-control/events
     */


    public $layout = [];
    public $_layout = [

    ];


    public function codes()
    {
        $relatedClass = $this->bootFull($this->_config['relatedClass']);

        $id = (int)$this->httpGet('id');
        if ($this->model === null)
            throw new ZNotFoundException('Model Not Found', 404);

        /*if ($this->modelSave($this->model)) {
            $this->urlRedirect([
                'index',
            ]);
        }*/

        $active = new Active();
        $active->type = Active::type['vertical'];
        $active->childClass = 'my-3';

        $form = $this->activeBegin($active);

        //$this->model->responsible = $this->userIdentity()->id;

        $this->model->configs->hasLabel = true;

        $this->model->configs->nameOn = $this->_config['modelNames'];
        $this->model->configs->nameOff = $this->_config['modelNamesEx'];
        $this->model->configs->readonlyWidget = $this->_config['modelReadOnlyWidget'];
        if (!empty($this->_config['card']))
            $this->model->configs->card = $this->_config['card'];

        $this->model->columns();

        echo ZFormBuildWidget::widget([
            'model' => $this->model,
            'form' => $form,
            'config' => $this->_config['formConfig']
        ]);
        $this->activeEnd();

        $relatedModel = new $relatedClass;
        $relatedmodel->configs->query = $relatedClass::find()
            ->where([
                $this->_config['relatedAttr'] => $id
            ]);


        $relatedModel->configs->dynaButtons = [
            'update' => [
                'content' => '{update}',
                'options' => ['class' => 'btn-group p-1 mr-0 {btnSize} {iconSize}']
            ],
            'add-tabular-clone-delete' => [
                'content' => '{add}{clone}{delete}',
                'options' => ['class' => 'btn-group p-1 mr-0 {btnSize} {iconSize}']
            ],

        ];
        $relatedModel->configs->nameOn = $this->_config['relatedModelNames'];
        $relatedModel->configs->nameOff = $this->_config['relatedModelNamesEx'];
        $relatedModel->columns();

        /** @var ZView $this */
        echo ZDynaWidget::widget([
            'model' => $relatedModel,
            'config' => $this->_config['dynaConfig']
        ]);


    }
}
