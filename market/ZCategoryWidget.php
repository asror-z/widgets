<?php

/**
 *
 *
 * Author:  Khojiakbar Kodirov
 *
 * Refactored by: Madaminov Shaykhnazar  Backend section add
 */

namespace zetsoft\widgets\market;


use zetsoft\models\App\eyuf\Category;
use zetsoft\models\shop\ShopCategory;
use zetsoft\system\kernels\ZWidget;

class ZCategoryWidget extends ZWidget
{
    public $config = [];
    public $_config = [
        'class'  => '',
        '{link}' => '',
    ];

    public $layout = [];
    public $_layout = [
        'main' => <<<HTML
           <section class="category">
                
                    <div class="row">
                        <div class="col-lg-12 col-md-6 col-sm-3 col-xs-2">
                            <div class="category-box">
                                <div class="sec-title">
                                    <h6>Categories</h6>
                                </div>
                                <div id="accordion">
                                {content}
                                </div>
                            </div>
                        </div>    
                    </div>
               
            </section>

HTML,
        'css' => <<<CSS
       .category.fa-angle-down:before {
       position: absolute;
       right: 5px;
       top: 13px;
       }
       
       .category.card-header{
       border-radius: 20px;
       height: 40px;
       }
       .category span{
       position: absolute;
       left: 5px;
       }
      
  

        
CSS,

    ];
    public function asset()
    {
        $this->fileCss('\render\asrorz\theme\light.css');
    }

    public function codes()
    {
        $content = '';
        $id = '';
        $childs = '';
        $categories = ShopCategory::find()->all();
            

        foreach ($categories as $category) {
            $title = $category['name'];
            $id = 'collapse'.$category['id'];
            $childs =[];// $category['child'];

            $content .= "
                 <div class='card'>
                     <div class='card-header'>
                         <a href='' data-toggle='collapse' data-target='#$id'>
                             <span>$title</span>
                             <i class='fa fa-angle-down'></i>
                         </a>
                     </div>
                     <div id='$id' class='collapse'>
                         <div class='card-body'>
                             <ul class='list-unstyled'>
                     ";
                            foreach ($childs as $child) {
                                $child = $child['name'];
                                if(empty($child)){
                                    continue;
                                }else{
                                    $content .= "
                                         <li><a href='{link}'><i class='fa fa-angle-right'></i>$child</a></li>
                                    ";
                                }
                            }
                $content.= '
                             </ul> 
                         </div>
                     </div>
                 </div>';
        }
        $this->htm .= strtr($this->_layout['main'], [
            '{class}' => $this->_config['class'],
            '{content}' => $content,
        ]);

        $this->css = ($this->_layout['css']);


    }
}
