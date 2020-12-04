<?php

/**
 * @link https://github.com/unclead/yii2-multiple-input
 * @copyright Copyright (c) 2014 unclead
 * @license https://github.com/unclead/yii2-multiple-input/blob/master/LICENSE.md
 */

namespace zetsoft\widgets\incores;


use unclead\multipleinput\renderers\BaseRenderer;
use unclead\multipleinput\renderers\ListRenderer;
use yii\base\InvalidConfigException;
use yii\db\ActiveRecordInterface;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

/**
 * Class ZListRenderer
 * @package unclead\multipleinput\renderers
 */
class ZListRenderer extends ListRenderer
{

    /**
    Renders the cell content.
     *
     * @param ZBaseColumn $column
     * @param int|null $index
     * @return string
     */
    public function renderCellContent($column, $index, $columnIndex = null)
    {
        $id    = $column->getElementId($index);
        $name  = $column->getElementName($index);

        /**
         * This class inherits iconMap from BaseRenderer
         * If the input to be rendered is a drag column, we give it the appropriate icon class
         * via the $options array
         */
        $options = ['id' => $id];
        if (substr($id, -4) === 'drag') {
            $options = ArrayHelper::merge($options, ['class' => $this->iconMap['drag-handle']]);
        }


        $input = $column->renderInput($name, $options,  [
            'id' => $id,
            'name' => $name,
            'indexPlaceholder' => $this->getIndexPlaceholder(),
            'index' => $index,
            'columnIndex' => $columnIndex,
            'context' => $this->context,
        ]);



        if ($column->isHiddenInput()) {
            return $input;
        }

        $layoutConfig = array_merge([
            'offsetClass'   => $this->isBootstrapTheme() ? 'col-sm-offset-3' : '',
            'labelClass'    => $this->isBootstrapTheme() ? 'col-sm-3' : '',
            'wrapperClass'  => $this->isBootstrapTheme() ? 'col-sm-6' : '',
            'errorClass'    => $this->isBootstrapTheme() ? 'col-sm-offset-3 col-sm-6' : '',
        ], $this->layoutConfig);

        Html::addCssClass($column->errorOptions, $layoutConfig['errorClass']);

        $hasError = false;
        $error = '';

        if ($index !== null) {
            $error = $column->getFirstError($index);
            $hasError = !empty($error);
        }


        $wrapperOptions = [];

        if ($hasError) {
            Html::addCssClass($wrapperOptions, 'has-error');
        }


        Html::addCssClass($wrapperOptions, $layoutConfig['wrapperClass']);

        $options = [
            'class' => "field-$id list-cell__$column->name" . ($hasError ? ' has-error' : ''),
        ];



        if ($this->isBootstrapTheme()) {
            Html::addCssClass($options, 'form-group');

        }

        if (is_callable($column->columnOptions)) {
            $columnOptions = call_user_func($column->columnOptions, $column->getModel(), $index, $this->context);
        } else {

            $columnOptions = $column->columnOptions;
        }


        $options = array_merge_recursive($options, $columnOptions);

        $content = Html::beginTag('div',  $options);

        if (empty($column->title)) {
            Html::addCssClass($wrapperOptions, $layoutConfig['offsetClass']);

        } else {
            $labelOptions = ['class' => $layoutConfig['labelClass']];

            if ($this->isBootstrapTheme()) {
                Html::addCssClass($labelOptions, 'control-label');
            }

        }

        $content .= Html::tag('div', $input, $wrapperOptions);

        /*$content[0] .= Html::label('sadsda');*/

        if ($column->enableError) {
            $content .= "\n" . $column->renderError($error);
        }

        $content .= Html::endTag('div');

        return $content;
    }



}
