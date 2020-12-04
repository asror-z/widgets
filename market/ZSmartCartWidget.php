<?php

namespace zetsoft\widgets\market;


use zetsoft\system\kernels\ZWidget;


/**
 * http://techlaboratory.net/projects/demo/jquery-smart-cart/v3/basic
 * CreatedBy: Muhriddin Pardabayev
 */

class ZSmartCartWidget extends ZWidget
{

    /**
     * Configuration
     */
    public $config = [];

    public $_config = [
        'name' => "Product 1",
        'details' => "Product 1 Product details",
        'price' => 555,


    ];

    
    public $event = [];
    public $_event = [

    ];


    /**
     *
     * Constants */
    public function asset()
    {
        $this->fileCss('https://cdn.jsdelivr.net/npm/jquery-smartcart@3.0.1/dist/css/smart_cart.css');
        $this->fileCss('https://cdn.jsdelivr.net/npm/jquery-smartcart@3.0.1/dist/css/smart_cart.min.css');
        $this->fileJs('https://cdn.jsdelivr.net/npm/jquery-smartcart@3.0.1/dist/js/jquery.smartCart.js');
        $this->fileJs('https://cdn.jsdelivr.net/npm/jquery-smartcart@3.0.1/dist/js/jquery.smartCart.min.js');
    }


    public $layout = [];
    public $_layout = [
        'main' => <<<HTML
          
    <section class="container">
    <div class="row">
    <div class="col-md-8">
    
    <!-- BEGIN PRODUCTS -->
    <div class="col-md-4 col-sm-6">
    <div class="sc-product-item thumbnail">
        <img data-name="product_image" src="http://en.capfruit.com/data/medias/302/style/produit_accroche/FRUIT_COULIS.jpg" alt="...">
        <div class="caption">
            <h4 data-name="product_name">Product 1</h4>
            <p data-name="product_desc">Product details</p>
            <hr class="line">
            
            <div>
                <div class="form-group">
                    <label>Size: </label>
                    <select name="{name}" class="form-control input-sm">
                        <option>S</option>
                        <option>M</option>
                        <option>L</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Color: </label><br />
                    <label class="radio-inline">
                        <input type="radio" name="{name}" value="red"> red
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="{name}" value="blue"> blue
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="{name}" value="green"> green
                    </label>
                </div>
                <div class="form-group2">
                    <input class="sc-cart-item-qty" name="product_quantity" min="1" value="1" type="number">
                </div>
                <strong class="price pull-left">$2,990.50</strong>
                
                <input name="product_price" value="2990.50" type="hidden" />
                <input name="product_id" value="12" type="hidden" />
                <button class="sc-add-to-cart btn btn-success btn-sm pull-right">Add to cart</button>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
    </div>
    
    <!-- END PRODUCTS -->
    </div>
    </div>
    
    </section>
HTML,
        'shopcart' => <<<HTML
 <aside class="col-md-4">
                
                <!-- Cart submit form -->
                <form action="results.php" method="POST"> 
                    <!-- SmartCart element -->
                    <div id="smartcart"></div>
                </form>
                
            </aside>
HTML,
        'js' => <<<JS
   $(document).ready(function(){
            // Initialize Smart Cart    	
            $('#smartcart').smartCart();
		});
JS,



    ];


    public function codes()
    {

        $this->htm = strtr($this->_layout['main'], [
            '{name}' => $this->_config['name'],
            '{details}' => $this->_config['details'],
            '{price}' => $this->_config['price'],

        ]);

        $this->htm .= $this->_layout['shopcart'];
        $this->js = $this->_layout['js'];
    }

}
