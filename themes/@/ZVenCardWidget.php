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

namespace zetsoft\widgets\themes;


use rmrevin\yii\fontawesome\FA;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\navigat\ZButtonWidget;

class ZVenCardWidget extends ZWidget
{
    public $config = [];
    public $_config = [

        'title' => 'ZFrameWork',
    ];
    public $layout =[];
    public $_layout = [
        'vencard' => <<<HTML
       <div class="card">
          <div class="view overlay">   
                    <div class="d-flex mb-3 card-header light-blue lighten-1 py-0 p-xl-1">
                        <div class="mr-auto p-2">
                      {gpsButton}&nbsp;&nbsp; {title}
                        </div>  
                <div class="pr-2 py-2 p-xr-1">
                     <li class="list-inline-item white-text pr-2">
                      {minusButton}</li>
                      
                      <li class="list-inline-item pr-2">
                      {buttonSave}</li>
                      
                      <li class="list-inline-item pr-2">
                      {settingButton}</li>
                      
                      <li class="list-inline-item pr-2">
                          {closeButton}
                      </li>
                      </div>
          </div>  
</div>
      <div class="card-body">   
        {content}
      </div>
</div>
HTML
    ];

    public function asset()
    {

    }

    public function init()
    {
        parent::init();
        ob_start();

    }



    public function codes()
    {
        $content = ob_get_clean();
        $this->htm = strtr($this->_layout['vencard'], [
            '{gpsButton}' => ZButtonWidget::widget([
                'config' => [
                    'style' => ZButtonWidget::btnStyle['btn-secondary'],

                    'icon' => FA::_CHART_BAR,
                    'iconSize' => ZButtonWidget::iconSize['0'],

                ]
            ]),
            '{minusButton}' => ZButtonWidget::widget([
                'config' => [

                    'icon' => FA::_MINUS,
                    'iconSize' => ZButtonWidget::iconSize['0'],
                    'url' => 'javascript:collapse()',
                    'isCollapse' => true
                ]
            ]),
            '{buttonSave}' => ZButtonWidget::widget([
                'config' => [


                    'iconSize' => ZButtonWidget::iconSize['1x'],
                    'icon' => FA::_SYNC,
                    'url' => 'javascript:collapse()',
                    'isCollapse' => true,
                ]
            ]),
            '{settingButton}' => ZButtonWidget::widget([
                'config' => [

                    'icon' => FA::_COGS,
                    'iconSize' => ZButtonWidget::iconSize['0'],
                    'url' => 'javascript:collapse()',
                    'isCollapse' => true,
                ]
            ]),
            '{closeButton}' => ZButtonWidget::widget([
                'config' => [

                    'icon' => FA::_TIMES,
                    'iconSize' => ZButtonWidget::iconSize['0'],
                    'url' => 'javascript:collapse()',
                    'isCollapse' => true,
                ]
            ]),

            '{title}' => $this->_config['title'],
            '{content}' => $content,

        ]);

    }

}


