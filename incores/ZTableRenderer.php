<?php

/**
 *
 *
 * Author:  Asror Zakirov
 * https://www.linkedin.com/in/asror-zakirov
 * https://github.com/asror-z
 *
 */

namespace zetsoft\widgets\incores;


use unclead\multipleinput\assets\MultipleInputAsset;
use unclead\multipleinput\assets\MultipleInputSortableAsset;
use unclead\multipleinput\components\BaseColumn;
use unclead\multipleinput\MultipleInput;
use unclead\multipleinput\renderers\RendererInterface;
use unclead\multipleinput\renderers\TableRenderer;
use unclead\multipleinput\TabularInput;
use yii\base\BaseObject;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\web\View;
use zetsoft\system\Az;
use zetsoft\system\control\ZCoreTrait;
use zetsoft\system\helpers\ZJsonHelper;


class ZTableRenderer extends TableRenderer
{
    protected function prepareRowOptions($index, $item)
    {
        if (is_callable($this->rowOptions)) {
            $options = call_user_func($this->rowOptions, $item, $index, $this->context);
        } else {
            $options = $this->rowOptions;
        }

        Html::addCssClass($options, 'multiple-input-list__item ' . $index);
        $options['data-index'] = $index;
        return $options;
    }
}
