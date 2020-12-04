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
class ZFormViewShahzodWidget extends ZWidget
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
        <table class="">
            {content}
        </table>

              
HTML,
        'value' => <<<HTML
        <tr>
            <td class="border-0 fe-09 p-0 mt-1 m-0 text-dark text-back-50 text-muted text-left fw-400">{key}</td>
            <td class="border-0 p-0 ml-1 text-dark font-weight-normal m-0 text-right fe-10">{value}</td>
        </tr>
HTML,


    ];


    public function codes()
    {


        $values = '';

        $form = Az::$app->forms->modelz->formObject($this->_config, $this->model);

        if (!$form)
            return null;

        /** @var Form[] $columns */
        $columns = $form->columns;
        $titles = $form->attributeLabels();


        

        if (!empty($this->value))
            if (is_array($this->value)) {

                foreach ($this->value as $key => $item) {

                    if (!ZArrayHelper::keyExists($key, $columns))
                        continue;

                    Az::$app->forms->wiData->clean();
                    Az::$app->forms->wiData->model = $this->model;
                    Az::$app->forms->wiData->attribute = $key;
                    $data = Az::$app->forms->wiData->data();

                    if (!empty($data))
                        $item = ZArrayHelper::getValue($data, $item);

                    $title = ZArrayHelper::getValue($titles, $key);

                    $item = ZVarDumper::beauty($item);

                    $values .= strtr($this->_layout['value'], [
                        '{key}' => $title,
                        '{value}' => $item,
                    ]);
                }
            }

        if (empty($values)) return null;

        $this->htm = strtr($this->_layout['main'], [
            '{content}' => $values
        ]);

        $this->css = <<<CSS


            
CSS;


    }

}
