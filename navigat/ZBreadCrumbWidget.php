<?php

/**
 *
 *
 * Created By: Shakxzod Namazbaev
 * Created_at: 02.12.2019
 *
 */

namespace zetsoft\widgets\navigat;

use rmrevin\yii\fontawesome\FA;
use zetsoft\dbitem\wdg\MenuItem;
use zetsoft\system\helpers\ZInflector;
use zetsoft\system\kernels\ZWidget;
use zetsoft\system\Az;
use yii\helpers\Url;

class ZBreadCrumbWidget extends ZWidget
{

    /**
     *
     * Configuration
     */
    public $config = [];
    public $_config = [
        'color' => ZBreadCrumbWidget::color['indigo'],
        'icon' => FA::_ANGLE_DOUBLE_RIGHT,
        'textStyle' => ZBreadCrumbWidget::textStyle['text-Lowercase'],
        'textColor' => ZBreadCrumbWidget::textColor['text-black'],
        'isActive' => false,
        'hasIcon' => false,
        'hasBreadcrumb' => true,
        'font-up-bold' => false,
        'text' => 'ZetSoft',
        'items' => [],

    ];
    public static $grapes = [
        'enable' => true,
        'icon' => '',
        'image' => '/render/navigat/ZBreadCrumbWidget/image/icon.png',
        'name' => Azl . 'BreadCrumb',
        'title' => Azl . '<b>safasfsa</b><img src="/render/navigat/ZBreadCrumbWidget/image/icon.png"/>',

    ];

    public const textStyle = [
        'text-Uppercase' => 'uppercase',
        'text-Lowercase' => 'lowercase'
    ];
    public const textColor = [
        'text-black' => 'black-text',
        'text-white' => 'white-text',
        'text-success' => 'success-text',
        'text-warning' => 'warning-text',
        'text-danger' => 'danger-text',
    ];

    public function codes()
    {


        /** @var MenuItem $menuItem */
        foreach ($this->data as $menuItem) {
            
        }

        //$this->_config['text'] = ZInflector::titleize(Az::$app->controller->view->title);

        if (!empty($this->moduleId))
            $this->data[] = [
                'name' => $this->moduleId,
                'url' => ['/' . $this->moduleId]
            ];
        if (!empty($this->controlId))
            $this->data[] = [
                'name' => $this->controlId,
                'url' => ['/' . $this->moduleId . '/' . $this->controlId],
            ];

        if (!empty($this->actionId))
            $this->data[] = [
                'name' => $this->actionId,
                //'url' => ['/' . $this->moduleId . '/' . $this->controlId . '/' . $this->actionId],
            ];

        $all = '';

        $k = 0;
        foreach ($this->data as $item) {
            $url = isset($item['url']) ? Url::to($item['url']) : "#";
            $k++;
            if ($url === Az::$app->request->url) {
                $url = <<<HTML
 {$item['name'] }
HTML;
            } else {

                if ($k === 4) {
                    $url = $this->actionId;
                } else {
                    $url = <<<HTML
                <a class="{$this->_config['textColor']} breadcrumb_text " style="color: white!important; margin-right: 5px" href="{$url}">{$item['name']}</a>
HTML;
                }

            }
            if ($k === 4) {
                $all .= <<<HTML
                    <li class="breadcrumb-item breadcrumb_text align-items-center " style="color: white!important;" >
                    {$url}
                    </li>
HTML;
            } else {
                $all .= <<<HTML
                    <li class="breadcrumb-item breadcrumb_text ">
                    {$url}
                     <i class="fas fa-chevron-circle-right align-items-center" aria-hidden="true" style="color: white"></i>
                    </li>
HTML;
            }
        }

        $this->htm .= <<<HTML

        <div class="{$this->_config['font-up-bold' ]} align-items-center" '  style="border-bottom: 1px solid #23709e; background-color: #4c8bf5!important;>
            <nav aria-label="breadcrumb">
            <div style="display: flex;">
<!--                <p class="m-0 p-1" style="font-weight: bold">{$this->_config['text']}</p>-->
                <ul class="breadcrumb lighten-1 mr-auto text-{$this->_config['textStyle']} align-items-center">
                    &nbsp;{$all}
                </ul>
                </div>
            </nav>
        </div>
HTML;
        $this->css = <<<HTML
            
            <style>
                      
             .brea{
             font-size: 17px;
             }
           
        .breadcrumb-item+.breadcrumb-item::before {
            padding-right: .01rem!important;
            content: ''!important;
          
}
</style>       
HTML;
    }
}
