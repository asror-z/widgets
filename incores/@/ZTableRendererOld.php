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
use unclead\multipleinput\TabularInput;
use yii\base\BaseObject;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\web\View;
use zetsoft\system\Az;
use zetsoft\system\control\ZCoreTrait;
use zetsoft\system\helpers\ZJsonHelper;


class ZTableRendererOld extends BaseObject implements RendererInterface
{



    use ZCoreTrait;

    /**
     * @var string the ID of the widget
     */
    public $id;

    /**
     * @var ActiveRecordInterface[]|Model[]|array input data
     */
    public $data = null;

    /**
     * @var BaseColumn[] array of columns
     */
    public $columns = [];

    /**
     * @var int maximum number of rows
     */
    public $max;

    /**
     * @var int minimum number of rows.
     * @since 1.2.6 Use this option with value 0 instead of `allowEmptyList` with `true` value
     */
    public $min;

    /**
     * @var array client-side attribute options, e.g. enableAjaxValidation. You may use this property in case when
     * you use widget without a model, since in this case widget is not able to detect client-side options
     * automatically.
     */
    public $attributeOptions = [];

    /**
     * @var array the HTML options for the `remove` button
     */
    public $removeButtonOptions = [];

    /**
     * @var array the HTML options for the `add` button
     */
    public $addButtonOptions = [];

    /**
     * @var array the HTML options for the `clone` button
     */
    public $cloneButtonOptions = [];

    /**
     * @var bool whether to allow the empty list
     */
    public $allowEmptyList = false;

    /**
     * @var array|\Closure the HTML attributes for the table body rows. This can be either an array
     * specifying the common HTML attributes for all body rows, or an anonymous function that
     * returns an array of the HTML attributes. It should have the following signature:
     *
     * ```php
     * function ($model, $index, $context)
     * ```
     *
     * - `$model`: the current data model being rendered
     * - `$index`: the zero-based index of the data model in the model array
     * - `$context`: the widget object
     *
     */
    public $rowOptions = [];

    /**
     * @var string
     */
    public $columnClass;

    /**
     * @var array|string position of add button. By default button is rendered in the row.
     */
    public $addButtonPosition = self::POS_ROW;

    /**
     * @var TabularInput|MultipleInput
     */
    protected $context;

    /**
     * @var string
     */
    private $indexPlaceholder;

    /**
     * @var ActiveForm the instance of `ActiveForm` class.
     */
    public $form;

    /**
     * @var bool allow sorting.
     * @internal this property is used when need to allow sorting rows.
     */
    public $sortable = false;

    /**
     * @var bool whether to render inline error for all input. Default to `false`. Can be override in `columns`
     * @since 2.10
     */
    public $enableError = false;

    /**
     * @var bool whether to render clone button. Default to `false`.
     */
    public $cloneButton = false;

    /**
     * @var string|\Closure the HTML content that will be rendered after the buttons.
     *
     * ```php
     * function ($model, $index, $context)
     * ```
     *
     * - `$model`: the current data model being rendered
     * - `$index`: the zero-based index of the data model in the model array
     * - `$context`: the MultipleInput widget object
     *
     */
    public $extraButtons;

    /**
     * @var array CSS grid classes for horizontal layout. This must be an array with these keys:
     *  - 'offsetClass' the offset grid class to append to the wrapper if no label is rendered
     *  - 'labelClass' the label grid class
     *  - 'wrapperClass' the wrapper grid class
     *  - 'errorClass' the error grid class
     */
    public $layoutConfig = [];

    /**
     * @var array
     */
    public $iconMap = [];

    /**
     * @var string
     *
     * @todo Use bootstrap theme for BC. We can switch to default theme in major release
     */
    public $theme = self::THEME_BS;

    /**
     * @var array
     */
    public $jsExtraSettings = [];

    /**
     * @var array List of the locations of registered JavaScript code block or files in right order.
     */
    public $jsPositions = [View::POS_HEAD, View::POS_BEGIN, View::POS_END, View::POS_READY, View::POS_LOAD];

    /**
     * @var bool add a new line to the beginning of the list, not to the end
     */
    public $prepend = false;

    /**
     * @inheritdoc
     */
    public function setContext($context)
    {
        $this->context = $context;
    }

    public function init()
    {
        parent::init();
        $this->trait();
        
        $this->prepareMinOption();
        $this->prepareMaxOption();
        $this->prepareColumnClass();
        $this->prepareButtons();
        $this->prepareIndexPlaceholder();
        



    }

    private function prepareColumnClass()
    {
        if (!$this->columnClass) {
            throw new InvalidConfigException('You must specify "columnClass"');
        }

        if (!class_exists($this->columnClass)) {
            throw new InvalidConfigException('Column class "' . $this->columnClass . '" does not exist');
        }
    }

    private function prepareMinOption()
    {
        // Set value of min option based on value of allowEmptyList for BC
        if ($this->min === null) {
            $this->min = $this->allowEmptyList ? 0 : 1;
        } else {
            if ($this->min < 0) {
                throw new InvalidConfigException('Option "min" cannot be less 0');
            }

            // Allow empty list in case when minimum number of rows equal 0.
            if ($this->min === 0 && !$this->allowEmptyList) {
                $this->allowEmptyList = true;
            }

            // Deny empty list in case when min number of rows greater then 0
            if ($this->min > 0 && $this->allowEmptyList) {
                $this->allowEmptyList = false;
            }
        }
    }

    private function prepareMaxOption()
    {
        if ($this->max === null) {
            $this->max = PHP_INT_MAX;
        }

        if ($this->max < 1) {
            $this->max = 1;
        }

        // Maximum number of rows cannot be less then minimum number.
        if ($this->max < $this->min) {
            $this->max = $this->min;
        }
    }

    /**
     * @throws InvalidConfigException
     */
    private function prepareButtons()
    {
        if ($this->addButtonPosition === null || $this->addButtonPosition === []) {
            $this->addButtonPosition = $this->min === 0 ? self::POS_HEADER : self::POS_ROW;
        }

        if (!is_array($this->addButtonPosition)) {
            $this->addButtonPosition = (array)$this->addButtonPosition;
        }

        if (!array_key_exists('class', $this->removeButtonOptions)) {
            $this->removeButtonOptions['class'] = $this->isBootstrapTheme() ? 'btn btn-danger' : '';
        }

        if (!array_key_exists('label', $this->removeButtonOptions)) {
            $this->removeButtonOptions['label'] = Html::tag('i', null, ['class' => $this->getIconClass('remove')]);
        }

        if (!array_key_exists('class', $this->addButtonOptions)) {
            $this->addButtonOptions['class'] = $this->isBootstrapTheme() ? 'btn btn-default' : '';
        }

        if (!array_key_exists('label', $this->addButtonOptions)) {
            $this->addButtonOptions['label'] = Html::tag('i', null, ['class' => $this->getIconClass('add')]);
        }

        if (!array_key_exists('class', $this->cloneButtonOptions)) {
            $this->cloneButtonOptions['class'] = $this->isBootstrapTheme() ? 'btn btn-info' : '';
        }

        if (!array_key_exists('label', $this->cloneButtonOptions)) {
            $this->cloneButtonOptions['label'] = Html::tag('i', null, ['class' => $this->getIconClass('clone')]);
        }
    }


    /**
     * Creates column objects and initializes them.
     *
     * @throws \yii\base\InvalidConfigException
     */
    protected function initColumns()
    {
        foreach ($this->columns as $i => $column) {
            $definition = array_merge([
                'class' => $this->columnClass,
                'renderer' => $this,
                'context' => $this->context,
            ], $column);

            $this->addButtonOptions = (array)$this->addButtonOptions;

            if (!isset($definition['attributeOptions'])) {
                $definition['attributeOptions'] = $this->attributeOptions;
            }

            if (!isset($definition['enableError'])) {
                $definition['enableError'] = $this->enableError;
            }

            $this->columns[$i] = Az::createObject($definition);
        }
    }

    /**
     * Render extra content in action column.
     *
     * @param $index
     * @param $item
     *
     * @return string
     */
    protected function getExtraButtons($index, $item)
    {
        if (!$this->extraButtons) {
            return '';
        }

        if (is_callable($this->extraButtons)) {
            $content = call_user_func($this->extraButtons, $item, $index, $this->context);
        } else {
            $content = $this->extraButtons;
        }

        if (!is_string($content)) {
            throw new InvalidParamException('Property "extraButtons" must return string.');
        }

        return $content;
    }

    public function render()
    {
        $this->initColumns();

        $view = $this->context->getView();
        MultipleInputAsset::register($view);

        // Collect all js scripts which were added before rendering of our widget
        $jsBefore = [];
        if (is_array($view->js)) {
            foreach ($view->js as $position => $scripts) {
                foreach ((array)$scripts as $key => $js) {
                    if (!isset($jsBefore[$position])) {
                        $jsBefore[$position] = [];
                    }
                    $jsBefore[$position][$key] = $js;
                }
            }
        }

        $content = $this->internalRender();

        // Collect all js scripts which has to be appended to page before initialization widget
        $jsInit = [];
        if (is_array($view->js)) {
            foreach ($this->jsPositions as $position) {
                foreach (ArrayHelper::getValue($view->js, $position, []) as $key => $js) {
                    if (isset($jsBefore[$position][$key])) {
                        continue;
                    }
                    $jsInit[$key] = $js;
                    $jsBefore[$position][$key] = $js;
                    unset($view->js[$position][$key]);
                }
            }
        }

        $template = $this->prepareTemplate();

        $jsTemplates = [];
        if (is_array($view->js)) {
            foreach ($this->jsPositions as $position) {
                foreach (ArrayHelper::getValue($view->js, $position, []) as $key => $js) {
                    if (isset($jsBefore[$position][$key])) {
                        continue;
                    }
                    $jsTemplates[$key] = $js;
                    unset($view->js[$position][$key]);
                }
            }
        }

        $options = ZJsonHelper::encode(array_merge([
            'id' => $this->id,
            'inputId' => $this->context->options['id'],
            'template' => $template,
            'jsInit' => $jsInit,
            'jsTemplates' => $jsTemplates,
            'max' => $this->max,
            'min' => $this->min,
            'attributes' => $this->prepareJsAttributes(),
            'indexPlaceholder' => $this->getIndexPlaceholder(),
            'prepend' => $this->prepend
        ], $this->jsExtraSettings));

        $js = "jQuery('#{$this->id}').multipleInput($options);";
        $view->registerJs($js);

        if ($this->sortable) {
            $this->registerJsSortable();
        }

        return $content;
    }

    private function registerJsSortable()
    {
        $view = $this->context->getView();
        MultipleInputSortableAsset::register($view);

        // todo override when ListRenderer will use div markup
        $options = ZJsonHelper::encode($this->getJsSortableOptions());
        $js = "$('#{$this->id} .multiple-input-list').sorting($options);";
        $view->registerJs($js);
    }

    /**
     * Returns an array of JQuery sortable plugin options.
     * You can override this method extend plugin behaviour.
     *
     * @return array
     */
    protected function getJsSortableOptions()
    {
        return [
            'containerSelector' => 'table',
            'itemPath' => '> tbody',
            'itemSelector' => 'tr',
            'placeholder' => '<tr class="placeholder">',
            'handle' => '.drag-handle',
            'onDrop' => new \yii\web\JsExpression("
                function(item, container, _super, event) {
                    _super(item, container, _super, event);

                    var wrapper = item.closest('.multiple-input').first();
                    event = $.Event('afterDropRow');
                    wrapper.trigger(event, [item]);
                }
            ")
        ];
    }


    /**
     * @return mixed
     */
    public function getIndexPlaceholder()
    {
        return $this->indexPlaceholder;
    }

    /**
     * @return bool
     */
    protected function isAddButtonPositionHeader()
    {
        return in_array(self::POS_HEADER, $this->addButtonPosition);
    }

    /**
     * @return bool
     */
    protected function isAddButtonPositionFooter()
    {
        return in_array(self::POS_FOOTER, $this->addButtonPosition);
    }

    /**
     * @return bool
     */
    protected function isAddButtonPositionRow()
    {
        return in_array(self::POS_ROW, $this->addButtonPosition);
    }

    /**
     * @return bool
     */
    protected function isAddButtonPositionRowBegin()
    {
        return in_array(self::POS_ROW_BEGIN, $this->addButtonPosition);
    }

    private function prepareIndexPlaceholder()
    {
        $this->indexPlaceholder = 'multiple_index_' . $this->id;
    }

    /**
     * Prepares attributes options for client side.
     *
     * @return array
     */
    protected function prepareJsAttributes()
    {
        $attributes = [];
        foreach ($this->columns as $column) {
            $model = $column->getModel();
            $inputID = str_replace(['-0', '-0-'], '', $column->getElementId(0));
            if ($this->form instanceof ActiveForm && $model instanceof Model) {
                
              

                $field = $this->form->field($model, $column->name);
                foreach ($column->attributeOptions as $name => $value) {
                    if ($field->hasProperty($name)) {
                        $field->$name = $value;
                    }
                }
                $field->render('');
                $attributeOptions = array_pop($this->form->attributes);
                if (isset($attributeOptions['name']) && $attributeOptions['name'] === $column->name) {
                    $attributes[$inputID] = ArrayHelper::merge($attributeOptions, $column->attributeOptions);
                } else {
                    $this->form->attributes[] = $attributeOptions;
                }
            } else {
                $attributes[$inputID] = $column->attributeOptions;
            }
        }

        return $attributes;
    }

    /**
     * @param $action - the control parameter, used as key into allowed types
     * @return string - the relevant icon class
     *
     * @throws InvalidConfigException
     */
    protected function getIconClass($action)
    {
        if (in_array($action, ['add', 'remove', 'clone', 'drag-handle'])) {
            return $this->iconMap[$action];
        }

        if (YII_DEBUG) {
            throw new InvalidConfigException('Out of bounds, "' . $action . '" not found in your iconMap');
        }
        return '';
    }

    public function isDefaultTheme()
    {
        return $this->theme === self::THEME_DEFAULT;
    }

    public function isBootstrapTheme()
    {
        return $this->theme === self::THEME_BS;
    }

    /**
     * @return mixed
     */
    protected function internalRender()
    {
        $content = [];

        if ($this->hasHeader()) {
            $content[] = $this->renderHeader();
        }

        $content[] = $this->renderBody();
        $content[] = $this->renderFooter();

        $options = [];
        Html::addCssClass($options, 'multiple-input-list');

        if ($this->isBootstrapTheme()) {
            Html::addCssClass($options, 'table table-condensed table-renderer');
        }

        $content = Html::tag('table', implode("\n", $content), $options);

        return Html::tag('div', $content, [
            'id' => $this->id,
            'class' => 'multiple-input'
        ]);
    }

    /**
     * Renders the header.
     *
     * @return string
     */
    public function renderHeader()
    {
        $cells = [];
        foreach ($this->columns as $column) {
            /* @var $column BaseColumn */
            $cells[] = $this->renderHeaderCell($column);
        }

        if ($this->max === null || ($this->max >= 1 && $this->max !== $this->min)) {
            $button = $this->isAddButtonPositionHeader() ? $this->renderAddButton() : '';

            if ($this->cloneButton) {
                $cells[] = $this->renderButtonHeaderCell();
            }

            $cells[] = $this->renderButtonHeaderCell($button);
        }

        return Html::tag('thead', Html::tag('tr', implode("\n", $cells)));
    }

    /**
     * Renders the footer.
     *
     * @return string
     */
    public function renderFooter()
    {
        if (!$this->isAddButtonPositionFooter()) {
            return '';
        }

        $columnsCount = 0;
        foreach ($this->columns as $column) {
            if (!$column->isHiddenInput()) {
                $columnsCount++;
            }
        }

        if ($this->cloneButton) {
            $columnsCount++;
        }

        $cells = [];
        $cells[] = Html::tag('td', '&nbsp;', ['colspan' => $columnsCount]);
        $cells[] = Html::tag('td', $this->renderAddButton(), [
            'class' => 'list-cell__button'
        ]);

        return Html::tag('tfoot', Html::tag('tr', implode("\n", $cells)));
    }


    /**
     * Check that at least one column has a header.
     *
     * @return bool
     */
    private function hasHeader()
    {
        if ($this->min === 0 || $this->isAddButtonPositionHeader()) {
            return true;
        }

        foreach ($this->columns as $column) {
            /* @var $column BaseColumn */
            if ($column->title) {
                return true;
            }
        }

        return false;
    }

    /**
     * Renders the header cell.
     * @param BaseColumn $column
     * @return null|string
     */
    private function renderHeaderCell($column)
    {
        if ($column->isHiddenInput()) {
            return null;
        }

        $options = $column->headerOptions;
        Html::addCssClass($options, 'list-cell__' . $column->name);

        return Html::tag('th', $column->title, $options);
    }

    /**
     * Renders the button header cell.
     * @param string
     * @return string
     */
    private function renderButtonHeaderCell($button = '')
    {
        return Html::tag('th', $button, [
            'class' => 'list-cell__button'
        ]);
    }

    /**
     * Renders the body.
     *
     * @return string
     *
     * @throws \yii\base\InvalidConfigException
     * @throws \yii\base\InvalidParamException
     */
    protected function renderBody()
    {
        $rows = [];

        if ($this->data) {
            $j = 0;
            foreach ($this->data as $index => $item) {
                if ($j++ <= $this->max) {
                    $rows[] = $this->renderRowContent($index, $item);
                } else {
                    break;
                }
            }
            for ($i = $j; $i < $this->min; $i++) {
                $rows[] = $this->renderRowContent($i);
            }
        } elseif ($this->min > 0) {
            for ($i = 0; $i < $this->min; $i++) {
                $rows[] = $this->renderRowContent($i);
            }
        }

        return Html::tag('tbody', implode("\n", $rows));
    }

    /**
     * Renders the row content.
     *
     * @param int $index
     * @param ActiveRecordInterface|array $item
     * @return mixed
     * @throws InvalidConfigException
     */
    private function renderRowContent($index = null, $item = null)
    {
        $cells = [];
        $hiddenInputs = [];
        $isLastRow = $this->max === $this->min;
        if (!$isLastRow && $this->isAddButtonPositionRowBegin()) {
            $cells[] = $this->renderActionColumn($index, $item, true);
        }

        $columnIndex = 0;
        foreach ($this->columns as $column) {
            /* @var $column BaseColumn */
            $column->setModel($item);
            if ($column->isHiddenInput()) {
                $hiddenInputs[] = $this->renderCellContent($column, $index, $columnIndex++);
            } else {
                $cells[] = $this->renderCellContent($column, $index, $columnIndex++);
            }
        }
        if ($this->cloneButton) {
            $cells[] = $this->renderCloneColumn();
        }

        if (!$isLastRow) {
            $cells[] = $this->renderActionColumn($index, $item);
        }

        if ($hiddenInputs) {
            $hiddenInputs = implode("\n", $hiddenInputs);
            $cells[0] = preg_replace('/^(<td[^>]+>)(.*)(<\/td>)$/s', '${1}' . $hiddenInputs . '$2$3', $cells[0]);
        }

        $content = Html::tag('tr', implode("\n", $cells), $this->prepareRowOptions($index, $item));

        if ($index !== null) {
            $content = str_replace('{' . $this->getIndexPlaceholder() . '}', $index, $content);
        }

        return $content;
    }

    /**
     * Prepares the row options.
     *
     * @param int $index
     * @param ActiveRecordInterface|array $item
     * @return array
     */
    protected function prepareRowOptions($index, $item)
    {
        if (is_callable($this->rowOptions)) {
            $options = call_user_func($this->rowOptions, $item, $index, $this->context);
        } else {
            $options = $this->rowOptions;
        }

        Html::addCssClass($options, 'multiple-input-list__item');

        return $options;
    }


    /**
     * Renders the action column.
     *
     * @param null|int $index
     * @param null|ActiveRecordInterface|array $item
     * @param bool $isFirstColumn
     * @return string
     */
    private function renderActionColumn($index = null, $item = null, $isFirstColumn = false)
    {
        $content = $this->getActionButton($index, $isFirstColumn) . $this->getExtraButtons($index, $item);

        return Html::tag('td', $content, [
            'class' => 'list-cell__button',
        ]);
    }

    /**
     * Renders the clone column.
     *
     * @return string
     */
    private function renderCloneColumn()
    {
        return Html::tag('td', $this->renderCloneButton(), [
            'class' => 'list-cell__button',
        ]);
    }

    private function getActionButton($index, $isFirstColumn)
    {
        if ($index === null || $this->min === 0) {
            if ($isFirstColumn) {
                return $this->isAddButtonPositionRowBegin() ? $this->renderRemoveButton() : '';
            }

            return $this->isAddButtonPositionRowBegin() ? '' : $this->renderRemoveButton();
        }

        $index++;
        if ($index < $this->min) {
            return '';
        }

        if ($index === $this->min) {
            if ($isFirstColumn) {
                return $this->isAddButtonPositionRowBegin() ? $this->renderAddButton() : '';
            }

            return $this->isAddButtonPositionRow() ? $this->renderAddButton() : '';
        }

        if ($isFirstColumn) {
            return $this->isAddButtonPositionRowBegin() ? $this->renderRemoveButton() : '';
        }

        return $this->isAddButtonPositionRowBegin() ? '' : $this->renderRemoveButton();
    }

    private function renderAddButton()
    {
        $options = [
            'class' => 'multiple-input-list__btn js-input-plus',
        ];

        Html::addCssClass($options, $this->addButtonOptions['class']);

        return Html::tag('div', $this->addButtonOptions['label'], $options);
    }

    /**
     * Renders remove button.
     *
     * @return string
     */
    private function renderRemoveButton()
    {
        $options = [
            'class' => 'multiple-input-list__btn js-input-remove',
        ];

        Html::addCssClass($options, $this->removeButtonOptions['class']);

        return Html::tag('div', $this->removeButtonOptions['label'], $options);
    }

    /**
     * Renders clone button.
     *
     * @return string
     */
    private function renderCloneButton()
    {
        $options = [
            'class' => 'multiple-input-list__btn js-input-clone',
        ];

        Html::addCssClass($options, $this->cloneButtonOptions['class']);

        return Html::tag('div', $this->cloneButtonOptions['label'], $options);
    }

    /**
     * Returns template for using in js.
     *
     * @return string
     *
     * @throws \yii\base\InvalidConfigException
     */
    protected function prepareTemplate()
    {
        return $this->renderRowContent();
    }

    public $elementName;

    /**
     *
     * Function  renderCellContent
     * @param ZMultipleInputColumn $column
     * @param int|null $index
     * @param null $columnIndex
     * @return  string
     * @throws \yii\base\InvalidConfigException
     */
    public function renderCellContent($column, $index, $columnIndex = null)
    {

        //  vd($column, $index, $columnIndex);

        $id = $column->getElementId($columnIndex);

        $name = $column->getElementName($index);
//        vd($columnIndex, $id, $name);

        // vd($id );
        /**
         * This class inherits iconMap from BaseRenderer
         * If the input to be rendered is a drag column, we give it the appropriate icon class
         * via the $options array
         */
        $options = [
            'id' => $id,
            'attribute' => $column->name
        ];

        if (substr($id, -4) === 'drag') {
            $options = ArrayHelper::merge($options, ['class' => $this->iconMap['drag-handle']]);
        }


        // vdd($name, $options);

        $input = $column->renderInput($name, $options, [
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

        $hasError = false;
        $error = '';

        if ($index !== null) {
            $error = $column->getFirstError($index);
            $hasError = !empty($error);
        }

        if ($column->enableError) {
            $input .= "\n" . $column->renderError($error);
        }

        $wrapperOptions = ['class' => 'field-' . $id];
        if ($this->isBootstrapTheme()) {
            Html::addCssClass($wrapperOptions, 'form-group');
        }

        if ($hasError) {
            Html::addCssClass($wrapperOptions, 'has-error');
        }

        if (is_callable($column->columnOptions)) {
            $columnOptions = call_user_func($column->columnOptions, $column->getModel(), $index, $this->context);
        } else {
            $columnOptions = $column->columnOptions;
        }

        Html::addCssClass($columnOptions, 'list-cell__' . $column->name);

        $input = Html::tag('div', $input, $wrapperOptions);

        return Html::tag('td', $input, $columnOptions);
    }
}
