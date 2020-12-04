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
class ZMultiViewWidget extends ZWidget
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

    public static $grapes = [
        'enable' => false,
        'icon' => '',
        'modalWidth' => '1000px',
        'image' => '/render/former/ZMultiWidget/image/icon.png',
        'name' => Azl . 'Multi',
        'title' => Azl . '<b>Titile</b><img src="/render/former/ZMultiWidget/image/icon.png"/>',

    ];

    public $layout = [];
    public $_layout = [
        'main' => <<<HTML
        <table class="table-download w-100">
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

        $values = '';
        $fullValues = '';
        if (!empty($this->value)) {
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

                        $values .= strtr($this->_layout['option'], [
                            '{key}' => $title,
                            '{value}' => $value,
                        ]);

                        $fullValues .= $value;
                        
                    }

            }
        }

        if (empty($fullValues))
            $values = Az::l('Не задано');




        $this->htm = strtr($this->_layout['main'], [
            '{content}' => $values
        ]);


        $this->css = <<<CSS

        .kv-align-center{
            padding: 0!important;        
        }
CSS;


    }

}
