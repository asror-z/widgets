<?php

namespace zetsoft\widgets\values;

use Symfony\Component\CssSelector\Exception\ExpressionErrorException;
use yii\helpers\Json;
use zetsoft\dbitem\data\Form;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\helpers\ZVarDumper;
use zetsoft\system\kernels\ZWidget;

/**
 *
 * Class ZKSelect2Widget
 * http://demos.krajee.com/widget-details/select2
 *
 * Created By: Jahongir Qudratov
 */
class ZFormViewWidget extends ZWidget
{

    /**
     * Configuration
     */
    public $config = [];
    public $_config = [
        'formClass' => null,
        'formModel' => null,
        'formAttr' => null,
        'formSession' => null,
        'formObject' => null,
    ];


    /**
     *
     * Plugin Events
     * https://select2.org/programmatic-control/events
     */
    public $event = [];
    public $_event = [

    ];


    /**
     *
     * Constants
     */

    public $layout = [];
    public $_layout = [

        'main' => <<<HTML
        <table class="table-download">
            {content}
        </table>

              
HTML,
        'value' => <<<HTML
        <tr class="tkvalue ">
            <td class="font-weight-bold tkey text-left">{key}</td>
            <td class="font-weight-bold tvalue text-right">{value}</td>
        </tr>
HTML,


    ];


    public function codes()
    {
        $values = '';
        $fullValue = '';

        $column = $this->model->columns[$this->attribute];

        $form = Az::$app->forms->modelz->formObject($this->_config, $this->model, $this->modelAttrs);

        if (!$form)
            return null;

        /** @var Form[] $columns */
        $columns = $form->columns;
        $titles = $form->attributeLabels();

        $this->value = ZArrayHelper::getValue($this->modelAttrs, $this->attribute);

        //todo:start Daho
        if (is_string($this->value))
            $this->value = Json::decode($this->value, true);
        //todo:end

        if (!empty($this->value))
            if (is_array($this->value)) {
                foreach ($this->value as $key => $item) {

                    if (ZArrayHelper::keyExists($key, $columns)) {
                        Az::$app->forms->wiData->clean();
                        Az::$app->forms->wiData->model = $form;
                        Az::$app->forms->wiData->attribute = $key;
                        $data = Az::$app->forms->wiData->data();

                        if (!empty($data))
                            $item = ZArrayHelper::getValue($data, $item);

                    }

                    $title = $key;
                    if (ZArrayHelper::keyExists($key, $titles))
                        $title = ZArrayHelper::getValue($titles, $key);

                    $item = ZVarDumper::beauty($item);

                    $values .= strtr($this->_layout['value'], [
                        '{key}' => $title,
                        '{value}' => $item,
                    ]);

                    $fullValue .= $item;
                }
            }

        if (empty($values))
            return null;

        $this->htm = strtr($this->_layout['main'], [
            '{content}' => $values
        ]);

    }

}


