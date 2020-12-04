<?php

namespace zetsoft\widgets\values;

use zetsoft\dbitem\data\Form;
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
class ZFormViewWidgetOld extends ZWidget
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


    /**
     *
     * Constants
     */

    public $layout = [];


    public function asset()
    {

    }


    public function codes()
    {

        $this->layout = [
            'main' => <<<HTML
        <table class="table-download">
            {content}
        </table>

              
HTML,
            'value' => <<<HTML
        <tr>
            <td class="tdkey">{key}</td>
            <td class="tdvalue">{value}</td>
        </tr>
HTML,

        ];

        $values = '';

        $form = $this->formGet();
        if ($form === null) return null;


        /** @var Form[] $columns */
        $columns = $form->columns;
        $titles = $form->attributeLabels();

        if (!empty($this->value))
            if (is_array($this->value)) {

                foreach ($this->value as $key => $item) {

                    if (!ZArrayHelper::keyExists($key, $columns))
                        continue;

                    $data = $columns[$key]->data;
                    if (!empty($data))
                        $item = $data[$item];

                    $title = $titles[$key];

                    $item = ZVarDumper::beauty($item);

                    $values .= strtr($this->layout['value'], [
                        '{key}' => $title,
                        '{value}' => $item,
                    ]);
                }
            }


        $this->htm = strtr($this->layout['main'], [
            '{content}' => $values
        ]);

        $this->css = <<<CSS

            /*.table-download {
        width: 100%!important;
        !*margin-bottom: -10px!important;*!
        background-color: white;
}*/
            .tdkey{
            width: 80%!important;
            }
            .tdvalue{
             width: 20%!important;
            }
            .kv-align-center{
            padding-left: 0!important;
            padding-right: 0!important;
            }
            
          /*  #coresetting-2-value-cont .kv-editable-value, .kv-editable-link {
            width: 100%!important;
            !*margin-bottom: -10px!important;*!
               !* background-color: transparent !important;*!
            }
*/
CSS;


    }

}
