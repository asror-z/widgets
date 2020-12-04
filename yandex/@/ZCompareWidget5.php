<?php

namespace zetsoft\widgets\yandex;


use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\inputes\ZSelect2Widget;

class ZCompareWidget5 extends ZWidget
{
    public $config = [];
    public $_config = [
        'categories' => [],
        'productItems' => [],
        'title' => 'Критерии сравнения',
        'placeholder' => 'Добавьте продукт',
        'unselectString' => 'отменить'

    ];

    public $event = [];
    public $_event = [

    ];

    public $layout = [];
    public $_layout = [

        'main' => <<<HTML
        <table class=" compare_tbl table table-striped shadow" border="0" cellspacing="0" cellpadding="0">
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
                                <select name="criteria" class="form-control" id="criteria">
                                    {options}
                                </select>
                                <div>
                                    <input id="differences" type="checkbox">{show_differences_string}
                                </div>
                            </div>
                        </div>
                    </td>
                            {compared_els}
                    <!--<td data-ce="c4" data-el="" class="nothree">
                        <div class="empty_item">
                            <div class="row py-2 mt-5 mx-0">
                                <div class="col-md-12">
                                    <input type="text" class="form-control" placeholder="{placeholder}" id="add_product">
                                </div>
                            </div>
                        </div>
                    </td>-->
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
                    <td class="val"></td>
                </tr>
                    {trs}
            </tbody>
        </table>
HTML,

        'compared_el' => <<<HTML
            <td data-ce="c{index}" data-el="{product_name}" class="">
                <div class="selected_item">
                    <a href="{product_url}" class="text-dark px-2">
                        <div class="row  py-2 mx-0">
                            <div class="col-md-5">
                                <img class="h-50" src="{product_img}">
                            </div>
                            <div class="col-md-7">
                                <h6>
                                    {product_name}
                                </h6>
                            </div>
                        </div>
                    </a>
                    <div class="row">
                        <div class="col-md-10 offset-md-1 ">
                            <button class="btn btn-warning w-100 text-light" data-el="{product_name}">
                                unselect
                            </button>
                        </div>
                    </div>
                </div>
            </td>
HTML,

        'compared_els_variants' => <<<HTML
        <td class="val">
            {compared_els_variants}
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

        'td' => <<<HTML
            <td class="val">{value}</td>
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
        foreach ($productItems[0]->allProperties as $key => $proItem) {
            $tds_code = '';
            foreach ($productItems as $productItem) {

                $options = implode('/', $productItem->allProperties[$key]->items);

                $tds_code .= strtr($this->_layout['td'], [
                    '{value}' => $options
                ]);
            }
            $trs_code .= strtr($this->_layout['tr'], [
                '{property}' => $productItem->allProperties[$key]->name,
                '{tds}' => $tds_code
            ]);
        }





        $compared_els = '';
        foreach ($productItems as $item) {

            if ($item->images) {
                $compared_els .= strtr($this->_layout['compared_el'], [
                    '{product_img}' => $item->images[0],
                    '{product_url}' => $item->url,
                    '{product_name}' => $item->name,
                    '{index}' => $item->id,
                    '{unselect_string}' => $item->text,
                ]);
            }

        }
        $categories = $this->_config['productItems'];
        $categories_code = '';
        foreach ($categories as $category) {
            $categories_code .= strtr($this->_layout['criteria_option'], [
                '{category_name}' => $category->categoryName
            ]);
        }


        $compare_els = $productItems['0']->properties;

        $compared_els_variants_code = '';
        foreach ($compare_els as $item) {

            $compare_els_var_code = '';
            foreach ($item->items as $child) {
                $compare_els_var_code .= strtr($this->_layout['compared_els_variants'], [
                    '{variant}' => $child
                ]);
            }

            $compared_els_variants_code .= strtr($this->_layout['compared_els_variants'], [
                '{compare_els_var}' => $compare_els_var_code,
                '{compared_els_variants}' => ZSelect2Widget::widget([
                    'data' => [
                        '2' => '1',
                        '3' => '1',
                        '4' => '1',
                    ],
                    'config' => [

                    ]
                ]),
            ]);
        }

        $this->htm .= strtr($this->_layout['main'], [
            '{trs}' => $trs_code,
            '{compared_els_variants}' => $compared_els_variants_code,
            '{summary_string}' => 'Вся характеристика',
            '{variants_string}' => 'Варианты',
            '{compared_els}' => $compared_els,
            '{show_differences_string}' => 'Показать сравнение',
            '{options}' => $categories_code,
            '{placeholder}' => $this->_config['placeholder'],
            '{title}' => $this->_config['title']
        ]);
    }

}
