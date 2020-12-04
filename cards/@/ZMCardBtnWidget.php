<?php

namespace zetsoft\widgets\cards;


use rmrevin\yii\fontawesome\FA;
use zetsoft\dbitem\shop\ProductItem;
use zetsoft\system\assets\ZColor;
use zetsoft\widgets\former\ZDynaFormGridWidget;
use zetsoft\widgets\former\ZViewWidget;
use zetsoft\widgets\inputes\ZKTouchSpinWidget;
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\widgets\navigat\ZPillTabWidget;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\navigat\ZPillWidget;
use zetsoft\widgets\themes\ZTabWidget;


/**
 *
 * https://mdbootstrap.com/docs/jquery/components/cards/#!
 *
 *
 *
 */
class ZMCardBtnWidget extends ZWidget
{



    public $config = [];
    public $_config = [
        'products' => []


    ];

    public $layout = [];
    public $_layout = [
        'imgcont' => <<<HTML
<div class="tab-pane fade show {class} w-100" id="{id}" role="tabpanel">
    <img src="{url}" alt="" class="img-fluid">
</div>
HTML,
        'imgtabs' => <<<HTML
<a class="nav-item nav-link {class}" data-toggle="tab" href="#{id}"><img src="{url}" alt="" width="80px"></a>
HTML,
        'imgcard' => <<<HTML
<div class="sg-img">
                  <!-- Tab panes -->
                  <div class="tab-content">
                      {imgcont}
                  </div>
                  <div class="nav d-flex justify-content-between">
                      {imgtabs}
                  </div>
              </div>
HTML,
      'property' => <<<HTML
<div class="color">
    <ul class="list-unstyled list-inline">
        <li>{propertyName} :</li>
        {propertyItem}
    </ul>
</div>
HTML,
     'propertyItem' => <<<HTML
      <li class="list-inline-item">
          <input type="radio" id="{name}-{value}" name="{name}" value="{value}">
          <label for="{name}-{value}"><span>{label}</i></span></label>
      </li>
HTML,


        'top' => <<<HTML
<div class="row">
          <div class="col-md-5">
              {imgcard}
          </div>
          <div class="col-md-7 mt-5">
              <div class="sg-content">
                  <div class="pro-tag">
                      <ul class="list-unstyled list-inline">
                          <li class="list-inline-item"><a href="">{category}</a></li>
                      </ul>
                  </div>
                   <div class="pro-name">
                       <p>{name}</p>
                   </div>
                   
                   <div class="pro-price">
                       <ul class="list-unstyled list-inline">
                           <li class="list-inline-item">{price}</li>
                           <li class="list-inline-item">{oldprice}</li>
                       </ul>
                       
                   </div>
                   <div class="colo-siz">
                       {properties}
                       <div class="qty-box">
                            {quantity}
                           
                       </div>
                       <div class="pro-btns">
                            {addCart}{favourite}{compare}
                       </div>
                   </div>
              </div>
          </div>
          <div class="col-md-12">
          {tab}
          </div>
      </div>
HTML,
        

        'js' => <<<JS
       
JS,

    ];

    public function codes()
    {
        /** @var ProductItem $products */
        $products = $this->_config['products'];

        $imgcont = '';
        $imgtabs = '';
        //vdd($products);
        foreach ($products->images as $key => $image){
             $imgcont .= strtr($this->_layout['imgcont'], [
                '{url}' => $image,
                '{class}' => $key === 0?'active':'',
                '{id}' => "img-$key"
             ]);
             $imgtabs .= strtr($this->_layout['imgtabs'], [
                '{url}' => $image,
                '{class}' => $key === 0?'active':'',
                 '{id}' => "img-$key"
             ]);
        }
        $imgcard = strtr($this->_layout['imgcard'],[
            '{imgtabs}' => $imgtabs,
            '{imgcont}' => $imgcont,
        ]);
        $products_code = '';

       /* foreach ($products as $key => $product) {
            #$total = $product->amount*$product->price;
            $properties_code = '';
            foreach ($product->properties as $property) {
                $properties_code .= strtr($this->_layout['property'], [
                    '{property}' => $property->property,
                    '{value}' => $property->value[0]
                ]);
            }
            $products_code .= strtr($this->_layout['main'], [
                '{image}' => $product->image[0],
                '{url}' => $product->url,
                '{name}' => $product->name,
                '{price}' => $product->price,
                #'{amount}' => $product->amount,
                "{delete_url}" => 'asdfas.fasdfas',
                "{properties}" => $properties_code,
                #"{total}" => $total,
                '{currency}' => $product->currency,
                '{id}' => $key
            ]);
        }*/

        /*$this->htm = strtr($this->_layout['main'], [
            '{products}' => $products_code
        ]);*/
        $pcode = '';
        foreach ($products->properties as $property){
              $pItem = '';
                /*vdd($property);*/
              foreach ($property->value as $key => $item){
                  $pItem .= strtr($this->_layout['propertyItem'], [
                       '{name}' => $property->name,
                       '{value}' => $key,
                       '{label}' => $item
                  ]);
              }

              $pcode .= strtr($this->_layout['property'], [
                '{propertyItem}' => $pItem,
                '{propertyName}' => $property->property
              ]);

        }
        /*vdd($pcode);*/
        $quantity = ZKTouchSpinWidget::widget([
            'name' => 'name',
            'value' => 1,
            'config'=>[
                'class'=>'col-md-1 text-center',
                'buttonup_txt'=>'<i class="fas fa-plus"></i>',
                'buttondown_txt'=>'<i class="fas fa-minus"></i>',

            ]

            
        ]);

        $addCart = ZButtonWidget::widget([
            'config' => [
                'btnStyle' => ZColor::btnStyle['btn-danger'],
                'text' => 'Add to cart'
            ]
        ]);
        $favourite = ZButtonWidget::widget([
            'config' => [
                'hasIcon' => true,
                'icon' => 'fa fa-' . FA::_HEART,
                'btnSize' => ZColor::btnSize['default'],
                'btnPaddingLeft' => ZButtonWidget::btnScale['0'],
                'btnPaddingRight' => ZButtonWidget::btnScale['0'],
                'btnPaddingTop' => ZButtonWidget::btnScale['0'],
                'btnPaddingBottom' => ZButtonWidget::btnScale['0'],
                'iconSize' => ZButtonWidget::iconSize['1x'],
            ]
        ]);
        $compare = ZButtonWidget::widget([
            'config' => [
                'hasIcon' => true,
                'icon' => 'fa fa-' . FA::_RANDOM,
                'btnSize' => ZColor::btnSize['default'],
                'btnPaddingLeft' => ZButtonWidget::btnScale['0'],
                'btnPaddingRight' => ZButtonWidget::btnScale['0'],
                'btnPaddingTop' => ZButtonWidget::btnScale['0'],
                'btnPaddingBottom' => ZButtonWidget::btnScale['0'],
                'iconSize' => ZButtonWidget::iconSize['1x'],
            ]
        ]);

        $tab = ZTabWidget::widget([
            'data' => [
                'Product detail' => $products->title,
                'Reviews' => '<br>',
                'Properties' => '',
                '4' => '4',
                '5' => '5',
            ]
        ]);

        $this->htm = strtr($this->_layout['top'], [
            '{imgcard}' => $imgcard,
            '{category}' => $products->categoryName,
            '{name}' => $products->name,
            '{price}' => $products->price,
            '{oldprice}' => $products->price_old,
            '{properties}' => $pcode,
            '{quantity}' => $quantity,
            '{addCart}' => $addCart,
            '{favourite}' => $favourite,
            '{compare}' => $compare,
            '{tab}' => $tab
        ]);

        $this->js = strtr($this->_layout['js'], []);

     

    }
}
