<?php

/**
 *
 *
 * Author:  Asror Zakirov
 *
 * https://www.linkedin.com/in/asror-zakirov
 * https://www.facebook.com/asror.zakirov
 * https://github.com/asror-z
 *
 */

namespace zetsoft\widgets\former;


use kartik\helpers\Html;
use unclead\multipleinput\MultipleInput;
use unclead\multipleinput\renderers\BaseRenderer;
use unclead\multipleinput\renderers\DivRenderer;
use unclead\multipleinput\renderers\ListRenderer;
use unclead\multipleinput\renderers\RendererInterface;
use unclead\multipleinput\renderers\TableRenderer;
use zetsoft\dbitem\data\ALLApp;
use zetsoft\former\deps\DepsDataForm;
use zetsoft\former\eyuf\TestForm2;
use zetsoft\models\core\CoreInput;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\kernels\ZWidget;
use zetsoft\system\module\Forms;
use zetsoft\system\module\Models;
use zetsoft\widgets\incores\ZListRenderer;
use zetsoft\widgets\incores\ZDivRenderer;
use zetsoft\widgets\incores\ZTableRenderer;
use zetsoft\widgets\incores\ZMultipleInput;
use zetsoft\widgets\incores\ZMultipleInputColumn;
use zetsoft\widgets\themes\ZCardWidget;
use function False\true;

/**
 * Class ZMultiWidget
 * @package widgets\inputes
 * https://github.com/unclead/yii2-multiple-input/wiki/Configuration
 */
class ZMultiWidget_1 extends ZWidget
{

    /*
     * Configuration
     */
    public $dbType = dbTypeJsonb;
    public $config = [];
    public $_config = [
        'min' => 1,
        'max' => 500,
        'title' => 'Title MultipleWidget',
        'isPrepend' => false,
        'isCloneButton' => true,
        'isSortable' => true,
        'isAllowEmptyList' => false,
        'isEnableGuestitle' => false,
        'isShowGeneralError' => true,
        'isEmbedded' => false,
        'extraButtons' => '',
        'grapes' => false,
        'formObject' => null,
        'columnClass' => ZMultipleInputColumn::class,
        'addButtonType' => ZMultiWidget::button['textInput'],
        'addButtonPosition' => ZMultiWidget::po['posRow'],
        'theme' => ZMultiWidget::theme['bootstrap'],
        'iconSource' => ZMultiWidget::icon['fontawesome'],
        'renderer' => ZMultiWidget::renderer['table'],
        'btnType' => self::btnType['btn-mic'],
        'formClass' => null,
        'customId' => '',
        'dependAttr' => ''

    ];


    public static $grapes = [
        'enable' => false,
        'icon' => '',
        'width' => '1200px',
        'height' => '600px',
        'image' => '/render/former/ZMultiWidget/image/icon.png',
        'name' => Azl . 'Multi',
        'title' => Azl . '<b>Titile</b><img src="/render/former/ZMultiWidget/image/icon.png"/>',

    ];

    public $_active = [
        'afterInit' => true,
        'beforeAddRow' => true,
        'afterAddRow' => true,
        'beforeDeleteRow' => true,
        'afterDeleteRow' => true,
        'afterDropRow' => true,
    ];

    public $event = [];
    public $_event = [
        'afterInit' => self::event['main'],
        'beforeAddRow' => self::event['multi'],
        'afterAddRow' => self::event['multi'],
        'beforeDeleteRow' => self::event['multi'],
        'afterDeleteRow' => self::event['multi'],
        'afterDropRow' => self::event['multiItem'],
    ];


    /**
     *
     * Constants
     */

    public const po = [
        'posHeader' => RendererInterface::POS_HEADER,
        'posRow' => RendererInterface::POS_ROW,
        'posRowBegin' => RendererInterface::POS_ROW_BEGIN,
        'posFooter' => RendererInterface::POS_FOOTER,
    ];

    public const button = [
        'textInput' => 'textInput',
        'hiddenInput' => 'hiddenInput',
        'dropDownList' => 'dropDownList',
        'listbox' => 'listBox',
        'checkboxList' => 'checkboxList',
        'radioList' => 'radioList',
        'static' => 'static',
        'checkbox' => 'checkbox',
        'radio' => 'radio',
        'dragColumn' => 'dragColumn',

    ];

    public const btnType = [
        'btn-mic' => 'btn-mic',
        'btn-min' => 'btn-min',
        'btn-max' => 'btn-max',
        'default' => '',
    ];

    public const renderer = [
        'list' => ZListRenderer::class,
        'table' => ZTableRenderer::class,
        'div' => ZDivRenderer::class
    ];

    public const theme = [
        'default' => MultipleInput::THEME_DEFAULT,
        'bootstrap' => MultipleInput::THEME_BS,
    ];

    public const icon = [
        'glyph' => MultipleInput::ICONS_SOURCE_GLYPHICONS,
        'fontawesome' => MultipleInput::ICONS_SOURCE_FONTAWESOME,
    ];

    public $columns;


    public function codes()
    {


        /** @var Models $model */
        $model = $this->formApp();
        $model = $this->formParent($model);

        if ($model === null)
            return Az::warning('Form Is Empty');

        /** @var ALLApp $allApp */

        if (empty($this->columns))
            foreach ($model->columns as $key => $column) {

                Az::$app->forms->wiData->clean();
                Az::$app->forms->wiData->model = $model;
                Az::$app->forms->wiData->attribute = $key;
                $column->data = Az::$app->forms->wiData->data();
                $widget = $column->widget;

                $item = [];

                $item['name'] = $key;
                $item['type'] = $widget;
                $item['title'] = $column->title;

                $item['value'] = $column->value;
                $item['defaultValue'] = $column->value;
                $item['items'] = $column->data;

                $item['options'] = $column->options;
                $item['options']['model'] = $model;
         //       $item['options']['attribute'] = $this->attribute;
                $item['options']['data'] = $column->data;

                $item['enableError'] = false;
                $item['errorOptions'] = [
                    'class' => 'help-block help-block-error'
                ];

                //  $item['context'] = $this;
                $item['attributeOptions'] = [];
                $item['columnOptions'] = [];
                $item['inputTemplate'] = '{input}';

                $this->columns[] = $item;
            }

        if ($this->model)
            $this->paramSet('modelId', $this->model->id);

        if (!empty($this->_config['formObject']))
            $this->model = $this->_config['formObject'];

        $this->options = [
            'model' => $this->model,
            'attribute' => $this->attribute,
            'name' => $this->name,
            'theme' => $this->_config['theme'],
            'max' => $this->_config['max'],
            'min' => $this->_config['min'],
            'prepend' => $this->_config['isPrepend'],
            'attributeOptions' => [

            ],    // unclear
            'addButtonPosition' => $this->_config['addButtonPosition'],
            'addButtonOptions' => [
                'class' => 'btn ' . $this->_config['btnType'] . ' btn-success'
            ],

            'removeButtonOptions' => [
                'class' => 'btn ' . $this->_config['btnType'] . ' btn-danger'
            ],
            'cloneButtonOptions' => [
                'class' => 'btn ' . $this->_config['btnType'] . ' btn-primary'
            ],
            'columns' => $this->columns,
            'data' => $this->value,
            'allowEmptyList' => $this->_config['isAllowEmptyList'],
            'columnClass' => $this->_config['columnClass'],
            'rendererClass' => $this->_config['renderer'],
            'rowOptions' => [
                'placeholder' => '',
            ],
            'options' => [
                'class' => $this->_config['class'],
                // todo check core-test edit page
            ],
            'sortable' => $this->_config['isSortable'],
            'cloneButton' => $this->_config['isCloneButton'],
            'extraButtons' => $this->_config['extraButtons'],
            'layoutConfig' => [
                'offsetClass' => '',
                'labelClass' => '',
                'wrapperClass' => '',
                'errorClass' => '',
            ],
            'iconSource' => $this->_config['iconSource'],
            'showGeneralError' => $this->_config['isShowGeneralError'],

        ];

        if ($this->_config['isEmbedded'] === true && $this->modelCheck())
            $this->htm .= Html::hiddenInput(Html::getInputName($this->model, $this->attribute), null);

        $this->htm .= ZMultipleInput::widget($this->options);

        if (!empty($this->modelColumn->title))
            $title = $this->modelColumn->title;
        else
            $title = $model->configs->title;

        $this->htm = ZCardWidget::widget([
            'config' => [
                'title' => $title,
                'type' => ZCardWidget::type['dynCard'],
                'content' => $this->htm
            ]
        ]);

        $this->css = <<<CSS
        .basic {
            font-size: 15px !important;
            font-weight: bold !important;
            text-align: center !important;
            position: relative;
            padding: 5px;
        }
        
        .btn-max{
            margin-right: -0.5rem;
            padding-left: 1.6rem;
            padding-right: 1.6rem;
            padding-top: 0.9rem;
            padding-bottom: 0.9rem;
        }
        
        .btn-min{
            margin-right: -0.5rem;
            padding-left: 1.2rem;
            padding-right: 1.2rem;
            padding-top: 0.6rem;
            padding-bottom: 0.6rem;
        }
        
        .btn-mic{ 
            padding-left: 0.8rem;
            padding-right: 0.8rem;
            padding-top: 0.3rem;
            padding-bottom: 0.3rem; 
            margin-left: -17px!important;  
        }
        
        
CSS;
    }
}
