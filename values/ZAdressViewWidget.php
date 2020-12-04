<?php

namespace zetsoft\widgets\values;

use Symfony\Component\CssSelector\Exception\ExpressionErrorException;
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
class ZAdressViewWidget extends ZWidget
{

    /**
     * Configuration
     */
    public $config = [];
    public $_config = [
        'formClass' => null,
        'formModel' => null,
        'formAttr' => null,
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
        <table class="w-100 bordertopnone">
            {content}
        </table>

              
HTML,
        'value' => <<<HTML
        <tr class=" d-flex border-top-0 p-0 m-0">
            <!--<td class="border-0 p-0 m-0 text-dark mt-1 text-left font-weight-normal fw-700">{key}</td>-->
            <td class="p-0 justify-content-between ml-1 text-dark border-top-0 text-center font-weight-normal m-0 fe-10">{value}</td>
        </tr>
HTML,


    ];


    public function codes()
    {


        $values = '';
        $fullValue = '';

        $form = Az::$app->forms->modelz->formObject($this->_config, $this->model);

        if (!$form)
            return null;

        /** @var Form[] $columns */
        $columns = $form->columns;
        $titles = $form->attributeLabels();


        if (!empty($this->value))
            if (is_array($this->value)) {
                //vdd($this->value);
                foreach ($this->value as $key => $item) {

                    if (!ZArrayHelper::keyExists($key, $columns))
                        continue;
                    Az::$app->forms->wiData->clean();
                    Az::$app->forms->wiData->model = $this->model;
                    Az::$app->forms->wiData->attribute = $key;
                    $data = Az::$app->forms->wiData->data();
                    if (!empty($data))
                        $item = ZArrayHelper::getValue($data, $item);
                    //$title = ZArrayHelper::getValue($titles, $key);
                    $val = null;
                    if (is_array($item)) {
                        $val = ZArrayHelper::getValue($item, 'user_entered_address');
                    }
                    if ($val !== null) $item = $val;
                    $item = ZVarDumper::beauty($item);
                    if (is_array($item)) {
                        //vdd($item);
                        $item = $item[0]['address'];
                    }

                    $values .= strtr($this->_layout['value'], [
                        //'{key}' => $title,
                        '{value}' => $item,
                    ]);

                    $fullValue .= $item;
                }
            }


        if (empty($fullValue))
            $values = 'Не задано';

        $this->htm = strtr($this->_layout['main'], [
            '{content}' => $values
        ]);

        $this->css = <<<CSS
                      
CSS;


    }

}
