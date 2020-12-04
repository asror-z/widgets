<?php

namespace zetsoft\widgets\yandex;


use zetsoft\system\Az;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\inputes\ZSelect2Widget;
use function PHPUnit\Framework\returnArgument;

class ZCompareWidget4 extends ZWidget
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
    <form action="#" method="get">
        <table class="  compare_tbl table table-striped shadow" border="0" cellspacing="0" cellpadding="0">
            <thead>
                <tr class="floatCNav">
                    <td>
                        <div class="row">
                            <div class="col-md-5">
                                <label for="criteria">
                                    <h6>
                                        {title}
                                    </h6>
                                </label>
                                <select onchange="function () {
                                     console.log("asdf")
                                }" name="criteria" class="form-control" id="criteria">
                                    {options}
                                </select>
                                <div>
                                    <input id="differences" type="checkbox">{show_differences_string}
                                </div>
                            </div>
                        </div>
                    </td>
                            {compared_els}
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
    </form>
HTML,

        'compared_el' => <<<HTML
            <td data-ce="c{index}" data-el="{product_name}" class="">
                <div class="selected_item">
                    <a href="{product_url}" class="text-dark px-2">
                        <div class="row  py-2 mx-0">
                            <div class="col-md-3">
                                <img class="h-50" src="{product_img}">
                            </div>
                            <div class="col-md-4">
                                <h6>
                                    {product_name}
                                </h6>
                            </div>
                        </div>
                    </a>
                    <div class="row">
                        <div class="col-md-3 offset-md-1 ">
                            <button class="btn btn-warning w-100 text-light" data-el="{product_name}">
                                unselect
                            </button>
                        </div>
                    </div>
                </div>
            </td>
HTML,

        'compared_els_variants' => <<<HTML
        <td class="val col-md-4">
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
        $current_category_id =  $productItems[0]->categoryId;
        //$proporties = Az::$app->market->product->propertsByCategory($current_category_id);
        
        $trs_code = '';
        $options = [];
        $props = '';
        $name = [];
        $tds_ = '';
        $compared_els_variants_code = '';

        $productItems = array_filter($productItems, function ($productItem) use($current_category_id){
            if($productItem->categoryId == $current_category_id)
                return true;
            else
                return false;
        });
        foreach ($productItems as $key => $proItem) {
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
        foreach ($productItems as $items) {
            $name = [];
             foreach ($items->items as $key => $value) {
                $name[] = $value->name;
             }
        $compared_els_variants_code .= strtr($this->_layout['compared_els_variants'], [
            '{compared_els_variants}' => ZSelect2Widget::widget([
                'data' => $name,
                'config' => [

                    ]
            ]),
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
            }else {
                $compared_els .= strtr($this->_layout['compared_el'], [
                    '{product_img}' => '',
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
