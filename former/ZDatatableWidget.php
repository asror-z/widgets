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

namespace zetsoft\widgets\former;


use zetsoft\system\assets\ZColor;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\themes\ZCardWidget;


class ZDatatableWidget extends ZWidget
{

    public $config = [];
    public $_config = [

        'tableColor' => ZColor::color['rgba-white-slight'],
        'theadColor' => ZColor::color['stylish-color'],

    ];
    public static $grapes = [
        'enable' => true,
        'icon' => '',
        'image' => '/render/former/ZViewWidget/image/icon.png',
        'name' => Azl . 'View',
        'title' => Azl . '<b>safasfsa</b><img src="/render/former/ZViewWidget/image/icon.png"/>',

    ];

    public $layout = [];
    public $_layout = [

        'main' => <<<HTML
             <table class="table table-striped table-hover table-borderless {tableColor}">
                <tbody>
                    {forItems}
                </tbody>
             </table>
         
HTML,

    ];


    public function codes()
    {

        if ($this->model === null)
            return false;

        $columns = $this->model->columns;
        $forItem = '';
        foreach ($columns as $key => $formDB):

            Az::$app->forms->wiData->clean();
            Az::$app->forms->wiData->model = $this->model;
            Az::$app->forms->wiData->attribute = $key;
            $value = Az::$app->forms->wiData->value();

            if (!isset($formDB->title))
                $val = $key;
            else
                $val = $formDB->title;

            $forItem .= <<<HTML
             <tr>  
               <td>$val</td>
               <td>$value</td>
            </tr>
HTML;
        endforeach;
        $this->htm = strtr($this->_layout['main'], [
            '{forItems}' => $forItem,
            '{tableColor}' => $this->_config['tableColor'],
            
        ]);

        $cont = ZCardWidget::widget([
            'config' => [
                'type' => ZCardWidget::type['dynCard'],
                'title' => Az::l('Общая информация'),
                'content' => $this->htm,
            ]
        ]);

        $this->htm = $cont;


    }
}


