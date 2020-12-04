<?php

/*
 * Author: AzimjonToirov
 *  
 * */

namespace zetsoft\widgets\cards;


use yii\bootstrap\Html;
use zetsoft\dbitem\shop\ProductItem;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\navigat\ZButtonWidget;

class ZCartViewWidget2 extends Zwidget
{
    public $config = [];
    public $_config = [
        'url' => '',
        'text' => 'Корзина',
        'icon' => 'fas fa-shopping-cart',
        'amount' => '',
        'hint'=>'Корзина'
    ];

    public $layout = [];
    public $_layout = [
        'main' => <<<HTML
        <div class="container main-section">
    <div class="row">
        <div class="col-lg-12 pl-3 pt-3">
            <table class="table table-hover border bg-white">
                <thead>
                <tr>
                    <th>Product</th>
                    <th>Price</th>
                    <th style="width:10%;">Quantity</th>
                    <th>Subtotal</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>
                        <div class="row">
                            <div class="col-lg-2 Product-img">
                                <img src="http://nicesnippets.com/demo/sc-images.jpg" alt="..." class="img-responsive"/>
                            </div>
                            <div class="col-lg-10">
                                <p>Lorem ipsum dolor sit amet</p>
                            </div>
                        </div>
                    </td>
                    <td> 12,000 </td>
                    <td data-th="Quantity">
                        <input type="number" class="form-control text-center" value="1">
                    </td>
                    <td>12,000</td>
                    <td class="actions" data-th="" style="width:10%;">
                        <button class="btn btn-info btn-sm"><i class="fa fa-refresh"></i>Обновить</button>
                        <button class="btn btn-danger btn-sm"><i class="fa fa-trash-o"></i>Очистить</button>
                    </td>
                </tr>
                </tbody>
                <tfoot>
                <tr>
                    <td><a href="#" class="btn btn-warning text-white"><i class="fa fa-angle-left"></i> Continue Shopping</a></td>
                    <td colspan="2" class="hidden-xs"></td>
                    <td class="hidden-xs text-center" style="width:10%;"><strong>Total : 12,000</strong></td>
                    <td><a href="#" class="btn btn-success btn-block">Checkout <i class="fa fa-angle-right"></i></a></td>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
HTML,
           css=><<<CSS
    .Product-img img{
            width: 100%;
        }
        .main-section{
            font-family: 'Roboto Condensed', sans-serif;
            margin-top: 5px;
            width: 10px;
            height: 10px;
        }
CSS,

    ];

    public function codes()
    {

        $this->htm .= strtr($this->_layout['main'], [
            '{url}' => $this->_config['url'],
            '{amount}' =>$this->_config['amount'],
            '{text}' => $this->_config['text'],
            '{icon}' => $this->_config['icon'],
            '{class}' => $this->_config['class'],
            '{hint}' => $this->_config['hint'],
        ]);

    }
}
