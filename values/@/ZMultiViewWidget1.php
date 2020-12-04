<?php

namespace zetsoft\widgets\values;

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
class ZMultisadViewWidget extends ZWidget
{

    /**
     * Configuration
     */
    public $config = [];
    public $_config = [

    ];


    /**
     *
     * Plugin Events
     * https://select2.org/programmatic-control/events
     */
    public $event = [];
    public $_event = [

    ];

    public $layout = [];
    public $_layout = [
        'main' => <<<HTML
        <table class="table-download w-100 bg-white">
            {content}
        </table>

              
HTML,
        'option' => <<<HTML
        <tr>
            <td>{key}</td>
            <td>{value}</td>
        </tr>
HTML,
    ];


    /**
     *
     * Constants
     */


    public function asset()
    {

    }


    public function codes()
    {


        $form = Az::$app->forms->modelz->formObject($this->_config, $this->model);
        
        if (!$form)
            return null;

        /** @var Form[] $columns */
        $columns = $form->columns;
        $titles = $form->attributeLabels();


        if (!empty($this->value))

            foreach ($this->value as $oneValue) {

                if (is_array($oneValue))
                    foreach ($oneValue as $key => $item) {

                        if (empty($key) || empty($item))
                            continue;

                        /** @var Form $column */
                        $column = ZArrayHelper::getValue($columns, $key);

                        if ($column === null)
                            continue;

                        Az::$app->forms->wiData->clean();
                        Az::$app->forms->wiData->model = $form;
                        Az::$app->forms->wiData->attribute = $key;
                        $data = Az::$app->forms->wiData->data();

                        if (!empty($data))
                            $value = ZArrayHelper::getValue($data, $item);
                        else
                            $value = $item;

                        if ($value === null)
                            continue;

                        $title = ZArrayHelper::getValue($titles, $key);

                        $value = ZVarDumper::beauty($value);

                        $this->htm .= strtr($this->_layout['option'], [
                            '{key}' => $title,
                            '{value}' => $value,
                        ]);
                    }

            }


        $this->htm = strtr($this->_layout['main'], [
            '{content}' => $this->htm
        ]);

        $this->css = <<<CSS

            /*.table-download{
                width: 106%;
                margin-left: -6px;
                margin-top: -10px;
                margin-bottom: -10px;
                background-color: white !important;
            }*/

CSS;


    }

}
