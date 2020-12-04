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

class ZKDepDropOLDWidget extends ZWidget
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
        'type'   => ZKDepDropWidget::types['select2'],
        'grapes' => false,

        
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
                'pluginOptions' => ['allowClear' => true]
            ],
            'pluginOptions' => [
                'placeholder' => 'Select...',
                'url' => Url::to([$this->controlId . '/depdrop-new',
                    'target' => bname($this->_config['target']),
                    'parent' => bname($this->_config['parent'])]),
            ],
            'options' => [
                'id' => $this->_config['id'],
            ],
        ];

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
            $this->htm = DepDrop::widget($this->options);
        }

    }

}
