<?php

/**
 *
 *
 * Author:  Asror Zakirov
 * https://www.linkedin.com/in/asror-zakirov
 * https://www.facebook.com/asror.zakirov
 * https://github.com/asror-z
 *
 */

namespace zetsoft\widgets\inputes;


use kartik\select2\Select2;
use kartik\widgets\DepDrop;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use zetsoft\models\place\PlaceCountry;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZInflector;
use zetsoft\system\kernels\ZWidget;

class ZKDepDropDbWidgetOLD extends ZWidget
{
    public $depend;
    public $parent;
    public $options;
    public $target;

    public $config = [];
    public $_config = [
        'id' => 'id',
        'parent' => null,
        'depend' => null,
        'target' => null,
        'db_config' => 'true',
        'initDepends' => '',
        'type'   => ZKDepDropWidget::types['select2'],


    ];

    public const types = [
        'default' => 1,
        'select2' => 2,
    ];


    public function codes()
    {
        $this->options = [
            'model' => $this->model,
            'attribute' => $this->attribute,
            'type' => $this->_config['type'],
            'select2Options' => [
                'pluginOptions' => [
                    'placeholder' => Az::l('Select...'),
                    'allowClear' => true
                ]
            ],
            'pluginOptions' => [
                'url' => Url::to([$this->controlId . '/depdrop-db',
                    'target' => bname($this->_config['target']),
                    'parent' => bname($this->_config['parent']),
                    'db_config' => bname($this->_config['db_config'])
                    ]
                )
            ],
            'options' => [
                'widget' => $this->dataWidget,
                'id' => $this->_config['id'],
            ],
        ];

        /*Az::$app->params[$this->attribute] = $this->_config['target'];

        $className = bname($this->model->modelClassName);

        $id = ZInflector::underscore($className) . '-' . $this->model->id . '-' . $this->attribute;*/

        if ($this->_config['parent'] == null) {

            $modelName = $this->_config['target'];
            $items = ArrayHelper::map($modelName::find()->all(), 'id', 'name');

            $select2opts = [
                'model' => $this->model,
                'attribute' => $this->attribute,
                'data' => $items,
            ];

            $this->htm = Select2::widget($select2opts);


        } else {
            $this->options['pluginOptions']['depends'] = [$this->_config['depend']];
            $this->options['pluginOptions']['initialize'] = true;
            $this->options['pluginOptions']['initDepends'] = [$this->_config['initDepends']];

            $this->htm = DepDrop::widget($this->options);
        }

    }

}
