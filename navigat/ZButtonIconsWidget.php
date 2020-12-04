<?php

/**
 *
 *
 * Created By: Shakxzod Namazbaev
 * Created_at: 03.12.2019
 * Refactored By: Xakimjon Ergashov
 * Refactored_at 05.05.2020
 *
 */

namespace zetsoft\widgets\navigat;

use zetsoft\system\kernels\ZWidget;


class ZButtonIconsWidget extends ZWidget
{

    /**
     * Configuration
     */
    public $config = [];
    public $_config = [
        'iconSize' => ZButtonIconsWidget::iconSize['2x'],
        'gridSize' => ZButtonIconsWidget::gridSize['50'],
        'gapSize' => ZButtonIconsWidget::gapSize['5'],
        'toggle' => ZButtonWidget::toggle['tooltip'],

    ];
    public const iconSize = [
        '1x' => '16',
        '2x' => '32',
        '3x' => '64',
        '4x' => '128',
        '5x' => '256',
    ];

    public const gridSize = [
        '25' => '25px',
        '50' => '50px',
        '75' => '75px',
        '100' => '100px',
        '125' => '125px',
        '175' => '175px',
        '200' => '200px',
        '225' => '225px',
    ];
    
    public const gapSize = [
        '3' => '3px',
        '5' => '5px',
        '8' => '8px',
        '10' => '10px',
        '12' => '12px',
        '15' => '15px',
        '20' => '20px',
    ];

    public const toggle = [
        'tooltip' => 'tooltip',
        'collapse' => 'collapse',
        'dropdown' => 'dropdown',
        'modal' => 'modal',
        'tab' => 'tab',
        'pill' => 'pill',
        'button' => 'button',
        'buttons' => 'buttons',
    ];

    public $layout = [];
    public $_layout = [
        

        'main' => <<<HTML
           <div class="icon-container">
           <div class="icon-item">
            <a>
            <img src="/render/navigat/ZButtonIconsWidget/images/iconfinder_Google_1298745.png" width="{iconSize}" height="{iconSize}">
</a>
</div>
      <div>
            <a>
            <img src="/render/navigat/ZButtonIconsWidget/images/iconfinder_facebook_1233013.png" width="{iconSize}" height="{iconSize}">
</a>
</div>
   <div>
            <a>
            <img src="/render/navigat/ZButtonIconsWidget/images/iconfinder_Twitter_381374.png" width="{iconSize}" height="{iconSize}">
</a>
</div>
   <div>
            <a>
            <img src="/render/navigat/ZButtonIconsWidget/images/iconfinder_pinterest_1279049.png" width="{iconSize}" height="{iconSize}">
</a>
</div>
   <div>
            <a>
            <img src="/render/navigat/ZButtonIconsWidget/images/1491580635-yumminkysocialmedia26_83102.png" width="{iconSize}" height="{iconSize}">
</a>
</div>
<div>
            <a>
            <img src="/render/navigat/ZButtonIconsWidget/images/iconfinder_vk_1279056.png" width="{iconSize}" height="{iconSize}">
</a>
</div>
<div>
            <a>
            <img src="/render/navigat/ZButtonIconsWidget/images/odno.png" width="{iconSize}" height="{iconSize}">
</a>
</div>
<div>
            <a>
            <img src="/render/navigat/ZButtonIconsWidget/images/34509a05557bf30853af477a83b7c7bb.png" width="{iconSize}" height="{iconSize}">
</a>
</div>     
</div>
            
HTML,
        'css' => <<<CSS
         .icon-container {
          display: grid;
          grid-column-gap: {gapSize};
          grid-row-gap: {gapSize};
          grid-template-columns: {gridSize}  {gridSize} {gridSize} {gridSize};
          grid-template-rows: {gridSize}  {gridSize};
  }       

CSS,

    ];


    public function asset()
    {
       
    }

    public function codes()
    {
        $this->htm .= strtr($this->_layout['main'], [
            '{iconSize}' => $this->_config['iconSize'],

        ]);
        $this->css .= strtr($this->_layout['css'], [
            '{gridSize}' => $this->_config['gridSize'],
            '{gapSize}' => $this->_config['gapSize'],
        ]);
    }
}
