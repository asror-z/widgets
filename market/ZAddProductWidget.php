<?php

namespace zetsoft\widgets\market;


use zetsoft\system\kernels\ZWidget;


/**
 *
 *
 * CreatedBy: Zoirjon Sobirov
 */
class ZAddProductWidget extends ZWidget
{

    public $config = [];

    public $_config = [
        'currency'           =>'$',
        'products'  =>[
            [
                'productImg'         =>'https://lh3.googleusercontent.com/uO33Yo7ZkFEiP7lydwshGFKkJQiZP5rlPN86nDiDG1-CB07uwYBO1icZqujQw7KI25Y3HA=s85',
                'productName'        =>'Samsung',
                'productColorName'   =>'Red',
                'productSize'        =>'M',
                'productPrice'       =>180.00,
                'is_available'       =>'In Stock',
        ],

        ],

    ];


    public $event = [];
    public $_event = [

    ];



    public function asset()
    {
    }

    public $layout = [];
    public $_layout = [
        'main' => <<<HTML
           <!-- Wishlist -->
<section class="shopping-cart">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="cart-table wsh-list table-responsive">
                    <table class="table">

                        <tbody>
                        {content}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
</section>
HTML,


    ];


    public function codes()
    {
        $content = '';
        foreach ($this->_config['products'] as $product) {
            $imgSrc              = $product['productImg'];
            $productName         = $product['productName'];
            $productColorName    = $product['productColorName'];
            $productSize         = $product['productSize'];
            $productPrice        = $product['productPrice'];
            $is_available        = $product['is_available'];
            $currency            = $this->_config['currency'];

            $content .= "
                        <tr>
                            <td class='t-pro d-flex'>
                                <div class='t-img' style='margin-right: 2%'>
                                    <a href='#'><img src='$imgSrc' alt=''></a>
                                </div>
                                <div class='t-content'>
                                    <p class='t-heading'><a href=''>$productName</a></p>
                                    <ul class='list-unstyled list-inline rate'>
                                        <li class='list-inline-item'><i class='fa fa-star'></i></li>
                                        <li class='list-inline-item'><i class='fa fa-star'></i></li>
                                        <li class='list-inline-item'><i class='fa fa-star'></i></li>
                                        <li class='list-inline-item'><i class='fa fa-star'></i></li>
                                        <li class='list-inline-item'><i class='fa fa-star-o'></i></li>
                                    </ul>
                                    <ul class='list-unstyled col-sz'>
                                        <li><p>Color : <span>$productColorName</span></p></li>
                                        <li><p>Size : <span>$productSize</span></p></li>
                                    </ul>
                                </div>
                            </td>
                            <td class='t-price'>$currency$productPrice</td>
                            <td class='t-stk'>$is_available</td>
                            <td class='t-add'>
                                <button class='btn-success rounded' type='button' name='button'>Add to Cart</button>
                            </td>
                            <td class='t-rem'><a href=''><i class='fa fa-trash-o'></i></a></td>
                        </tr>
                
            ";

        }



        $this->htm .= strtr($this->_layout['main'], [
            '{content}' => $content,
        ]);
    }

}
