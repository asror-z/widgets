<?php
/**
 *
 *
 * Author:  Jasur Sh.
 *
 */

namespace zetsoft\widgets\ajaxify;


use phpDocumentor\Reflection\Type;
use PhpOffice\PhpSpreadsheet\Shared\OLE\PPS\Root;
use zetsoft\actions\crud\ZIndexAjaxAction;
use zetsoft\system\Az;
use zetsoft\system\helpers\Zicon;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\inputes\ZKStarRatingOnlyWidget;
use zetsoft\widgets\inputes\ZKStarRatingWidget;
use zetsoft\widgets\market\ZIconCardWidget;
use zetsoft\widgets\market\ZSingleProductWidget;
use zetsoft\widgets\navigat\ZButtonWidget;


class ZCardSwitcherWidget extends ZWidget
{

    /**
     * Configuration
     */
    public $config = [];
    public $_config = [
        'btn_no_active' => 'text-success',
        'btn_active' => 'btn-success',
        'btn_style' => 'rounded',
        'tab_position' => ZCardSwitcherWidget::position['right'],

        'icon_first' => 'fa-book',
        'icon_second' => 'fa-cogs',

        'local_storage_key' => 'grid',

        'first_el' => 'switch_to_col',
        'second_el' => 'switch_to_list',

        'first_data' => [],
        'second_data' => [],

        'first_widget' => '/render/cards/ZVMarketWidget/ready/main.php',
        'second_widget' => '/render/cards/ZHCommonSaleWidget/ready/main.php',

    ];

    public const position = [
        'left' => 'justify-content-start',
        'right' => 'justify-content-end',
        'center' => 'justify-content-center',
    ];

    public $layout = [];
    public $_layout = [

        'main' => <<<HTML
        <div class="d-block col-md-12 switch-parent d-flex {tab_position} mr-4 mb-2">
    <a class="btn {btn_no_active} {btn_style} {btn_active} mt-0" id="{first_el}">
        <i class="fas {icon_first}"></i>
    </a>
    <a class="btn  {btn_no_active} {btn_style} mr-2 mt-0" id="{second_el}">
        <i class="fas {icon_second}"></i>
    </a>
</div>
        {content}
HTML,
    ];

    public function codes()
    {
        $js = file_get_contents(Root . '/render/ajaxify/ZCardSwitcherWidget/assets/main.js');

        $data_first = $this->_config['first_data'];
        $data_second = $this->_config['second_data'];

        $content = '';
        foreach ($data_first as $first) {

            $content .= $this->require( $this->_config['first_widget'], [
                'item' => $first,
                'class' => $this->_config['first_el']
            ]);

        }

        foreach ($data_second as $second) {

            $content .= $this->require( $this->_config['second_widget'], [
                'item' => $second,
                'class' => $this->_config['second_el']
            ]);

        }


        $this->htm = strtr($this->_layout['main'], [
            '{btn_no_active}' => $this->_config['btn_no_active'],
            '{btn_active}' => $this->_config['btn_active'],
            '{btn_style}' => $this->_config['btn_style'],
            '{content}' => $content,
            '{first_el}' => $this->_config['first_el'],
            '{second_el}' => $this->_config['second_el'],
            '{icon_first}' => $this->_config['icon_first'],
            '{icon_second}' => $this->_config['icon_second'],
            '{tab_position}' => $this->_config['tab_position']

        ]);

        $this->js = strtr($js, [
            '{btn_no_active}' => $this->_config['btn_no_active'],
            '{btn_active}' => $this->_config['btn_active'],
            '{btn_style}' => $this->_config['btn_style'],
            '{local_storage_key}' => $this->_config['local_storage_key'],
            '{first_el}' => $this->_config['first_el'],
            '{second_el}' => $this->_config['second_el'],
        ]);
    }
}

