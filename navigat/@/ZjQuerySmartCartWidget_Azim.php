<?php

/**
 *
 *
 * Author:  Asror Zakirov
 * https://www.linkedin.com/in/asror-zakirov
 * https://github.com/asror-z
 *
 */

namespace zetsoft\widgets\navigat;

use rmrevin\yii\fontawesome\FA;
use zetsoft\system\kernels\ZWidget;

class ZjQuerySmartCartWidget extends ZWidget
{
    public $config = [];
    public $_config = [
        // 'bgColor' => ZAccLayWidget::bgColor['bg-primary-dark'],
        // 'theme_default' => ZjQuerySmartTabWidget::themeSelector['Default'],
        //'animationNone' => ZjQuerySmartTabWidget::Animations['None'],
        // 'class' => 'accordion',
    ];
    public static $grapes = [
        'enable' => true,
        'icon' => '',
        'image' => '/render/navigat/ZAccLayWidget/image/icon.png',
        'name' => Azl . 'AccLay',
        'title' => Azl . '<b>safasfsa</b><img src="/render/navigat/ZAccLayWidget/image/icon.png"/>',

    ];

    public const themeSelector = [
        'Default' => 'Default',
        'Classic' => 'Classic',
        'Dark' => 'Dark',
        'Brick' => 'Brick',
        'Bootstrap Tabs' => 'Bootstrap Tabs',
        'Bootstrap Pills' => 'Bootstrap Pills',
        'No Theme' => 'No Theme',
    ];

    public const Animations = [
        'None' => 'None',
        'Fade' => 'Fade',
        'Slide Horizontal' => 'Slide Horizontal',
        'Slide Vertical' => 'Slide Vertical',
        'Slide Swing' => 'Slide Swing',
    ];

    public $theme = [
        'Default',
        'Classic',
        'Dark',
        'Brick',
        'Bootstrap Tabs',
        'Bootstrap Pills',
        'No Theme',
    ];

    public $animation = [
        'None',
        'Fade',
        'Slide Horizontal',
        'Slide Vertical',
        'Slide Horizontal',
        'Slide Swing',
    ];
    public $layout = [];
    public $_layout = [

        'item' => <<<HTML
            
  <br />
    <section class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Products
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <!-- BEGIN PRODUCTS -->
                            <div class="col-md-4 col-sm-6">
                                <div class="sc-product-item thumbnail">
                                    <img data-name="product_image" src="http://placehold.it/250x150/2aabd2/ffffff?text=Product+1" alt="...">
                                    <div class="caption">
                                        <h4 data-name="product_name">Product 1</h4>
                                        <p data-name="product_desc">Product details</p>
                                        <hr class="line">
                                        
                                        <div>
                                            <div class="form-group">
                                                <label>Size: </label>
                                                <select name="product_size" class="form-control input-sm">
                                                    <option>S</option>
                                                    <option>M</option>
                                                    <option>L</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Color: </label><br />
                                                <label class="radio-inline">
                                                    <input type="radio" name="product_color" value="red"> red
                                                </label>
                                                <label class="radio-inline">
                                                    <input type="radio" name="product_color" value="blue"> blue
                                                </label>
                                                <label class="radio-inline">
                                                    <input type="radio" name="product_color" value="green"> green
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
                            <div class="col-md-4 col-sm-6">
                                <span class="sc-product-item thumbnail">
                                    <img data-name="product_image" src="http://placehold.it/250x150/2aabd2/ffffff?text=Product+2" alt="...">
                                    <div class="caption">
                                        <h4 data-name="product_name">Product 2 </h4>
                                        <p data-name="product_desc">Product details</p>
                                    
                                        <hr class="line">
                                        <div>
                                            <div class="form-group">
                                                <label>Size: </label>
                                                <select name="product_size" class="form-control input-sm">
                                                    <option>S</option>
                                                    <option>M</option>
                                                    <option>L</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Color: </label><br />
                                                <label class="radio-inline">
                                                    <input type="radio" name="product_color" value="red"> red
                                                </label>
                                                <label class="radio-inline">
                                                    <input type="radio" name="product_color" value="blue"> blue
                                                </label>
                                                <label class="radio-inline">
                                                    <input type="radio" name="product_color" value="green"> green
                                                </label>
                                            </div>
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" name="gift_wrap" value="1"> Gift wrap
                                                </label>
                                            </div>
                                            <strong class="price pull-left">$5,435.50</strong>
                                            
                                            <input name="product_price" value="5435.50" type="hidden" />
                                            <input name="product_id" value="145" type="hidden" />
                                            <button class="sc-add-to-cart btn btn-success btn-sm pull-right">Add to cart</button>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                </span>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <div class="sc-product-item thumbnail">
                                    <img data-name="product_image" src="http://placehold.it/250x150/2aabd2/ffffff?text=Product+3" alt="...">
                                    <div class="caption">
                                        <h4 data-name="product_name">Product 3</h4>
                                        <p data-name="product_desc">Product details</p>
                                    
                                        <hr class="line">
                                        
                                        <div>
                                            <div class="form-group">
                                                <label>Size: </label>
                                                <select name="product_size" class="form-control input-sm">
                                                    <option>S</option>
                                                    <option>M</option>
                                                    <option>L</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Color: </label><br />
                                                <label class="radio-inline">
                                                    <input type="radio" name="product_color" value="red"> red
                                                </label>
                                                <label class="radio-inline">
                                                    <input type="radio" name="product_color" value="blue"> blue
                                                </label>
                                                <label class="radio-inline">
                                                    <input type="radio" name="product_color" value="green"> green
                                                </label>
                                            </div>
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" name="gift_wrap" value="1"> Gift wrap
                                                </label>
                                            </div>
                                            <strong class="price pull-left">$5,435.50</strong>
                                            
                                            <input name="product_price" value="5435.50" type="hidden" />
                                            <input name="product_id" value="145" type="hidden" />
                                            <button class="sc-add-to-cart btn btn-success btn-sm pull-right">Add to cart</button>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-4 col-sm-6">
                                <span class="sc-product-item thumbnail">
                                    <img data-name="product_image" src="http://placehold.it/250x150/2aabd2/ffffff?text=Product+4" alt="...">
                                    <div class="caption">
                                        <h4 data-name="product_name">Product 4 </h4>
                                        <p data-name="product_desc">Lorem Ipsum is simply dummy text of the printing and typesetting industry. </p>
                                    
                                        <hr class="line">
                                        <div>
                                            <div class="form-group">
                                                <label>Size: </label>
                                                <select name="product_size" class="form-control input-sm">
                                                    <option>S</option>
                                                    <option>M</option>
                                                    <option>L</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Color: </label><br />
                                                <label class="radio-inline">
                                                    <input type="radio" name="product_color" value="red"> red
                                                </label>
                                                <label class="radio-inline">
                                                    <input type="radio" name="product_color" value="blue"> blue
                                                </label>
                                                <label class="radio-inline">
                                                    <input type="radio" name="product_color" value="green"> green
                                                </label>
                                            </div>
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" name="gift_wrap" value="1"> Gift wrap
                                                </label>
                                            </div>
                                            <strong class="price pull-left">$435.50</strong>
                                            
                                            <input name="product_price" value="435.50" type="hidden" />
                                            <input name="product_id" value="154" type="hidden" />
                                            <button class="sc-add-to-cart btn btn-success btn-sm pull-right">Add to cart</button>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                </span>
                            </div>
                            
                            <div class="col-md-4 col-sm-6">
                                <span class="sc-product-item thumbnail">
                                    <img data-name="product_image" src="http://placehold.it/250x150/2aabd2/ffffff?text=Product+5" alt="...">
                                    <div class="caption">
                                        <h4 data-name="product_name">Product 5 </h4>
                                        <p data-name="product_desc">Lorem Ipsum is simply dummy text of the printing and typesetting industry. </p>
                                    
                                        <hr class="line">
                                        <div>
                                            <div class="form-group">
                                                <label>Size: </label>
                                                <select name="product_size" class="form-control input-sm">
                                                    <option>S</option>
                                                    <option>M</option>
                                                    <option>L</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Color: </label><br />
                                                <label class="radio-inline">
                                                    <input type="radio" name="product_color" value="red"> red
                                                </label>
                                                <label class="radio-inline">
                                                    <input type="radio" name="product_color" value="blue"> blue
                                                </label>
                                                <label class="radio-inline">
                                                    <input type="radio" name="product_color" value="green"> green
                                                </label>
                                            </div>
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" name="gift_wrap" value="1"> Gift wrap
                                                </label>
                                            </div>
                                            <strong class="price pull-left">$3,410.00</strong>
                                            
                                            <input name="product_price" value="3410.00" type="hidden" />
                                            <input name="product_id" value="155" type="hidden" />
                                            <button class="sc-add-to-cart btn btn-success btn-sm pull-right">Add to cart</button>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                </span>
                            </div>
                            
                            <div class="col-md-4 col-sm-6">
                                <span class="sc-product-item thumbnail">
                                    <img data-name="product_image" src="http://placehold.it/250x150/2aabd2/ffffff?text=Product+6" alt="...">
                                    <div class="caption">
                                        <h4 data-name="product_name">Product 6 </h4>
                                        <p data-name="product_desc">Lorem Ipsum is simply dummy text of the printing and typesetting industry. </p>
                                    
                                        <hr class="line">
                                        <div>
                                            <div class="form-group">
                                                <label>Size: </label>
                                                <select name="product_size" class="form-control input-sm">
                                                    <option>S</option>
                                                    <option>M</option>
                                                    <option>L</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Color: </label><br />
                                                <label class="radio-inline">
                                                    <input type="radio" name="product_color" value="red"> red
                                                </label>
                                                <label class="radio-inline">
                                                    <input type="radio" name="product_color" value="blue"> blue
                                                </label>
                                                <label class="radio-inline">
                                                    <input type="radio" name="product_color" value="green"> green
                                                </label>
                                            </div>
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" name="gift_wrap" value="1"> Gift wrap
                                                </label>
                                            </div>
                                            <strong class="price pull-left">$5,435.50</strong>
                                            
                                            <input name="product_price" value="5435.50" type="hidden" />
                                            <input name="product_id" value="145" type="hidden" />
                                            <button class="sc-add-to-cart btn btn-success btn-sm pull-right">Add to cart</button>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                </span>
                            </div>
                            <!-- END PRODUCTS -->
                        </div>
                    </div>
                </div>
                
            </div>
            
            <aside class="col-md-4">
                
                <!-- Cart submit form -->
                <form action="results.php" method="POST"> 
                    <!-- SmartCart element -->
                    <div id="smartcart"></div>
                </form>
                
            </aside>
        </div>
    </section>
HTML,


        'css' => <<<CSS
            body {
            padding-right: 5%;
            padding-left: 5%;
        }
         

CSS,

        'js' => <<<JS
                    
              $(document).ready(function(){
            // Initialize Smart Cart    	
            $('#smartcart').smartCart();
		});
               
JS,
    ];

    public function asset()
    {
        //$this->fileCss('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css');
        $this->fileCss('https://cdn.jsdelivr.net/npm/jquery-smartcart@3.0.1/dist/css/smart_cart.min.css');

       // $this->fileJs('https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js');
        $this->fileJs('https://cdn.jsdelivr.net/npm/jquery-smartcart@3.0.1/dist/js/jquery.smartCart.min.js');
    }

    public function codes()
    {
        $this->htm = strtr(
            $this->_layout['item'], [
            // '{class}' => $this->_config['class'],
            // '{animationNone}' => $this->_config['animationNone'],
            //   '{theme_default}' => $this->_config['theme_default'],


            // '{readonly}' => $this->_config['readonly'] ? 'readonly' : '',
        ]);
      //  $this->css = strtr($this->_layout['css'], [

       // ]);
        $this->js = strtr($this->_layout['js'], [
            //'{class}' => $this->jscode($this->_config['class']),
        ]);


    }
}
