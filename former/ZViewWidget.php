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


class ZViewWidget extends ZWidget
{

    public $config = [];
    public $_config = [
        'tableColor' => ZColor::color['rgba-white-slight'],
        'theadColor' => ZColor::color['primary-color'],
        'isCard' => true,
        'title' => null,
        'headerRight' => null

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
        foreach ($columns as $key => $formDB) {

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
               <td class="font-weight-bold">$val</td>
               <td class="font-weight-bold">$value</td>
            </tr>
HTML;
        }
        
        $this->htm = strtr($this->_layout['main'], [
            '{forItems}' => $forItem,
            '{tableColor}' => $this->_config['tableColor'],

        ]);
        
        $this->htm = ZCardWidget::widget([
            'config' => [
                'type' => ZCardWidget::type['dynCard'],
                'title' => $this->_config['title']? $this->_config['title'] : Az::l('Общая информация'),
                'classHeadColor' => $this->_config['theadColor'],
                'content' => $this->htm,
                'headerRight' => $this->_config['headerRight'],
            ]
        ]);



    }
}


