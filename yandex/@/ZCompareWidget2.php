<?php

namespace zetsoft\widgets\yandex;

/**
 *
 *
 * Author:  Asror Zakirov
 * https://www.linkedin.com/in/asror-zakirov
 * https://github.com/asror-z
 *
 */

use rmrevin\yii\fontawesome\FA;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\inputes\ZInputWidget;
use zetsoft\widgets\inputes\ZSelect2Widget;
use zetsoft\widgets\navigat\ZButtonWidget;

class ZCompareWidget extends ZWidget
{
    public $config = [];
    public $_config = [
        'categories'=>[],
        'title' => 'Select2',
        'placeholder' => 'Input',
        'productItems'=>[]
    ];

    public $event = [];
    public $_event = [

    ];

    public $layout = [];
    public $_layout = [

        'main' => <<<HTML
        <table class="compare_tbl table table-striped shadow" border="0" cellspacing="0" cellpadding="0">
                    <thead>
                        <tr class="floatCNav">
                            <td>
                     <div class="row">
                                <div class="col-md-12">
                                    <label for="criteria">
                                        <h6>
                                            {title}
                                        </h6>
                                    </label>
                                   {select2}
                                    <div>
                                        <input id="differences" type="checkbox">{show_differences_string}
                                    </div>
                                </div>
                            </div>
                 </td>
                            {compared_els}
                            <td data-ce="c4" data-el="" class="nothree">
                                <div class="empty_item">
                                    <div class="row py-2 mt-5 mx-0">
                                        <div class="col-md-12">
                                           {input}
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                        <td colspan="5" data-ha="Summary" data-a="Summary">
                            <div class="compare_hdn"><i class="fa fa-arrow-up"></i>
                                <strong>{summary_string}</strong>
                            </div>
                        </td>
                    </tr>
                        <tr data-nd="variant">
                            <td class="title">{variants_string}</td>
                                {compared_els_variants}
                        </tr>
                        {trs}
                    </tbody>
           </table>
HTML,

        'compared_el' => <<<HTML
            <td data-ce="c{index}" data-el="{product_name}" class="nothree">
                     <div class="selected_item">
                                <a href="{product_url}" class="text-dark px-2">
                                    <div class="row  py-2 mx-0">
                                        <div class="col-md-5">
                                            <img class="" src="{product_img}">
                                        </div>
                                        <div class="col-md-7">
                                            <h6>
                                                {product_name}
                                            </h6>
                                        </div>
                                    </div>
                                </a>
                                <div class="row">
                                    <div class="col-md-10 offset-md-1">
                                        {ZButtonWidget}
                                    </div>
                                </div>
                            </div>
                 </td>
HTML,

        'compared_els_variants' => <<<HTML
<td class="val">
            {select2}
</td>
HTML,

        'compared_els_var' => <<<HTML
            <option value="variant">{variant}</option>
HTML,

        'tr' => <<<HTML
            <tr data-nd="{property}">
                        <td class="title">{property}</td>
                          {tds}
                    </tr>
HTML,


        'criteria_option' => <<<HTML
            <option value="{category_name}">{category_name}</option>
HTML,
    ];

    public function asset()
    {

    }

    public function codes()
    {

        $productItems = $this->_config['productItems'];
        $trs_code = '';
        foreach ($productItems as $productItem) {
            $tds_code = '';
            $name = '';
            foreach ($productItem->allProperties as $pro) {

                $name =$pro->name;

                $value=implode(', ', $pro->items);

            }
            $trs_code .= strtr($this->_layout['tr'], [
                '{property}' => $name,
                '{tds}' => $tds_code
            ]);
        }

        $compared_els = '';
        foreach ($productItems as $item) {
            //vdd($item);
            $compared_els .= strtr($this->_layout['compared_el'], [
                '{product_img}' => $item->images[0],
                '{product_url}' => $item->url,
                '{product_name}' => $item->name,
                '{index}' => $item->id,
                '{ZButtonWidget}' => ZButtonWidget::widget([
                    'config' => [
                        'toggle'=>'',
                        'hasIcon' => true,
                        'title' => 'При мерное меню',
                        'icon' => 'ft fas fa-' . FA::_CODE,
                        'btnType' =>  ZButtonWidget::btnType['button'],
                        'btnStyle' => ZButtonWidget::btnStyle['btn-outline-primary'],
                        'btnRounded' => false
                    ]
                ]),
            ]);
        }

        $categories = $this->_config['categories'];
        $categories_code = '';
        foreach ($categories as $category) {
            $categories_code .= strtr($this->_layout['criteria_option'], [
                '{category_name}' => $category
            ]);
        }


        //vdd($productItems);
        $compare_els = $productItems[0]->properties;
        $compared_els_variants_code = '';
        foreach ($compare_els as $item) {

            $compare_els_var_code = '';
            foreach ($item->items as $child) {
                //vdd($child);
                $compare_els_var_code .= strtr($this->_layout['compared_els_variants'], [
                    '{variant}' => $child
                ]);
            }
            $compared_els_variants_code .= strtr($this->_layout['compared_els_variants'], [
                '{compare_els_var}' => $compare_els_var_code,
                '{select2}' => ZSelect2Widget::widget([]),
            ]);
        }

        $this->htm .= strtr($this->_layout['main'], [
            '{trs}' => $trs_code,
            '{compared_els_variants}' => $compared_els_variants_code,
            '{summary_string}' => 'Вся характеристика',
            '{variants_string}' => 'Варианты',
            '{compared_els}'=>$compared_els,
            '{show_differences_string}'=>'Показать сравнение',
            '{title}' => $this->_config['title'],
            '{select2}'=> ZSelect2Widget::widget([]),
            '{input}' => ZInputWidget::widget([
                'config' => [
                    'placeholder' => 'ZInputWidget',
                    'type' => 'text',
                ]
            ]),

        ]);
    }
}
