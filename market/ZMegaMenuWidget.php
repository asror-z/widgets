<?php

/**
 *
 * CreatedBy: Jaxongir Maxamadjonov
 *
 */

namespace zetsoft\widgets\market;

use zetsoft\models\shop\ShopCategory;
use zetsoft\service\App\ALL\Bozor;
use zetsoft\service\menu\ALL;
use zetsoft\system\assets\ZColor;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\helpers\ZHTML;
use zetsoft\system\helpers\ZStringHelper;
use zetsoft\system\kernels\ZWidget;

class ZMegaMenuWidget extends ZWidget
{

    public $config = [];

    public $_config = [
        'name' => 'Mega Menu',
        'col_number' => 4,
        'items' => [],
        'nameOn' => ['user'],
        'contact' => 'contact.html',
        'track' => 'track.html',
        'pay' => '/',
        'offerta' => '/',

    ];

    public const theme = [
        'default' => 'default',
        'blueTheme' => 'blueTheme',
        'greenTheme' => 'greenTheme',
    ];

    /**
     *
     * Plugin Events
     * https://select2.org/programmatic-control/events
     */
    public $data = [];
    public $event = [];
    public $_event = [

    ];
    public $extra = '';

    /**
     *
     * Constants */
    public function asset()
    {
        $path = '/render/market/ZMegaMenuWidget/assets/';

    }


    public $layout = [];
    public $_layout = [
        'main' => <<<HTML
  <div class="menu-area container">
   <div class="row">
       <div class="col-md-12">
           <div class="main-menu">
               <ul class="list-unstyled list-inline ">
 {Menus}
 <li class="list-inline-item text-center borr">
  <img src="/uploaz/MenuPngs/5028.png"><a class="txt" href="{pay}">Оплата</a></li>
  <li class="list-inline-item text-center borr">
  <img src="/uploaz/MenuPngs/5027.png"><a class="txt" href="{track}">Доставка</a></li>
  <li class="list-inline-item text-center borr">
  <img src="/uploaz/MenuPngs/5029.png"><a class="txt" href="{offerta}">Оферта</a></li>
  <li class="list-inline-item text-center borr">
  <img src="/uploaz/MenuPngs/5030.png"><a class="txt" href="{contact}">Контакты</a></li>

                            </ul>
                        </div>
                    </div>
            <!-- <div class="col-md-3">        <li class="list-inline-item trac-btn"><a href="{Track}">Track Your Order</a></li></div> -->
                </div>
            </div>  
HTML,
        'Menu' => <<<HTML
<li class="list-inline-item text-center borr"><i class="fa fa-bars"></i><a class="txt">{label} <i class="fa fa-angle-down"></i></a>
 <ul class="dropdown list-unstyled">{items}</ul></li>
HTML,

        'lists' => <<<HTML
<li><a href="{url}">{label}</a></li>
HTML,
        'mega_menu' => <<<HTML
<!--<li class="list-inline-item mega-menu"><a>MEGA MENU <i class="fa fa-angle-down"></i></a> -->
 <div class="mega-box">
       <div class="row">{item_category}
                              {Carusel}
                              {mega_bnr}</div>
                       </div>
<!--</li>-->
HTML,

        'item_category' => <<<HTML
 <div class="col-md-3">
 <div class="clt-area">
          <h6>{category}</h6>
<div class="link-box">{sub_category}</div>
 </div></div>
HTML,
        'latest_news' => <<<HTML
<div class="col-lg-3 col-md-6">
 <div class="lt-news">
 <h6>{news}</h6>
    {sub_news}  </div>  </div>
HTML,
        'sub_news' => <<<HTML
<div class="news-box d-flex">
 <div class="news-img">
    <img src="{img}" alt="">   </div>
 <div class="news-con"> <p>{name}</p>
           <span>{date}</span>
 </div> </div>
HTML,
        'carusel' => <<<HTML
 <div class="col-md-3">
<div class="m-slider owl-carousel owl-loaded owl-drag">
 <div class="owl-stage-outer"><div class="owl-stage" style="transform: translate3d(-476px, 0px, 0px); transition: all 0.5s ease 0s; width: 1666px;">
                       <div class="owl-item cloned" style="width: 238px;"><div class="owl-nav disabled">
                       <div class="owl-prev">prev</div><div class="owl-next">next</div></div></div>
                       <div class="owl-item cloned" style="width: 238px;"><div class="owl-dots disabled"></div></div>
                       <div class="owl-item active" style="width: 238px;"><div class="owl-stage-outer">
                       <div class="owl-stage" style="transform: translate3d(-476px, 0px, 0px); transition: all 0.5s ease 0s; width: 1428px;">
                       <div class="owl-item cloned" style="width: 238px;">
                       <div class="slider-item">
                         <img src="{mega-1}" alt="" class="img-fluid">
                          <span>-{mega-1-p}</span>
                                      </div>
                                      </div>
                                      <div class="owl-item cloned" style="width: 238px;">
                                      <div class="slider-item">
                                          <img src="{mega-2}" alt="" class="img-fluid">
                                          <span>-{mega-2-p}</span>
                                        </div></div><div class="owl-item active" style="width: 238px;"><div class="slider-item">
                                                        <img src="{mega-1}" alt="" class="img-fluid">
                                                        <span>-{mega-1-p}</span>
                                                    </div></div><div class="owl-item" style="width: 238px;"><div class="slider-item">
                                          <img src="{mega-2}" alt="" class="img-fluid">
                                          <span>-{mega-2-p}</span>
                                                    </div></div><div class="owl-item cloned" style="width: 238px;"><div class="slider-item">
                                                        <img src="{mega-1}" alt="" class="img-fluid">
                                                        <span>-{mega-1-p}</span>
                                                    </div></div><div class="owl-item cloned" style="width: 238px;"><div class="slider-item">
                                                        <img src="{mega-2}" alt="" class="img-fluid">
                                                        <span>-{mega-3-p}</span>
                                                    </div></div></div></div></div><div class="owl-item" style="width: 238px;"><div class="owl-nav disabled"><div class="owl-prev">prev</div><div class="owl-next">next</div></div></div><div class="owl-item" style="width: 238px;"><div class="owl-dots disabled"></div></div><div class="owl-item cloned" style="width: 238px;"><div class="owl-stage-outer"><div class="owl-stage" style="transform: translate3d(-476px, 0px, 0px); transition: all 0.5s ease 0s; width: 1428px;"><div class="owl-item cloned" style="width: 238px;"><div class="slider-item">
                                                        <img src="{mega-1}" alt="" class="img-fluid">
                                                        <span>-{mega-1-p}</span>
                                                    </div></div><div class="owl-item cloned" style="width: 238px;"><div class="slider-item">
                                                        <img src="{mega-2}" alt="" class="img-fluid">
                                                        <span>-{mega-3-p}</span>
                                                    </div></div><div class="owl-item active" style="width: 238px;"><div class="slider-item">
                                                        <img src="{mega-1}" alt="" class="img-fluid">
                                                        <span>-{mega-1-p}</span>
                                                    </div></div><div class="owl-item" style="width: 238px;"><div class="slider-item">
                                                        <img src="{mega-2}" alt="" class="img-fluid">
                                                        <span>-{mega-3-p}</span>
                                                    </div></div><div class="owl-item cloned" style="width: 238px;"><div class="slider-item">
                                                        <img src="{mega-1}" alt="" class="img-fluid">
                                                        <span>-{mega-1-p}</span>
                                                    </div></div><div class="owl-item cloned" style="width: 238px;"><div class="slider-item">
                                                        <img src="{mega-2}" alt="" class="img-fluid">
                                                        <span>-{mega-3-p}</span>
                                                    </div></div></div></div></div><div class="owl-item cloned" style="width: 238px;"><div class="owl-nav disabled"><div class="owl-prev">prev</div><div class="owl-next">next</div></div></div></div></div><div class="owl-nav disabled"><div class="owl-prev">prev</div><div class="owl-next">next</div></div><div class="owl-dots disabled"></div></div>
 </div>
HTML,
        'mega_bnr' => <<<HTML
<div class="col-md-12">
   <div class="mega-bnr">
 <div class="row">
        {mega-bnr-extra}                                      
    </div>  </div> </div>
HTML,
        'mega_bnr_1' => <<<HTML
 <div class="col-md-3">
    <a href="#" class="bnr-box text-center">
        <img src="{img}" alt="">
        <span>{name}</span>
    </a>
</div>
HTML,
        'css' => <<<CSS
    .main-menu{
        background: #10b410;
        justify-content: space-between;
    }
    
    .list-unstyled.list-inline{
        height: 50px;
    }
    
    .menu-area .main-menu ul li.borr {
        border: none;
        position: relative;
        margin: 0;
        height: 50px;
        width: 18%;
        border-left: 0.2px solid white;
    }
    
    .menu-area .main-menu ul li.borr i.fa-bars{
        color: black!important;
        font-size: 20px;
    }

    .menu-area .main-menu ul li.borr:nth-child(1){
        border-left: none!important;
    }
    
    .menu-area .main-menu ul li.borr:last-child{
        border-right: 0.2px solid white;
    }

    .main-menu .txt{
        color: white!important;
    }

    .main-menu .txt:hover{
        color: white!important;
    }
    
    .main-menu i{
        width: 30px;
        height: 30px;
        color: white;
    }
    
    .menu-area .main-menu ul li ul.dropdown {
        position: absolute;
        left: 0;
        top: 100%;
        min-width: 170px;
        background: #fff;
        text-align: left;
        border: 1px solid #eeeeee;
        border-top: 0 solid #10b410!important; 
        padding: 0;
    }
CSS,

    ];

    public function exx($items)
    {
        $a = "";
        foreach ($items->extra as $mobile) {
            $a .= strtr($this->_layout['mega_bnr_1'], [
                "{name}" => $mobile->label,
                "{img}" => $mobile->image
            ]);
        }
        $this->extra = strtr($this->_layout['mega_bnr'], [
            "{mega-bnr-extra}" => $a,
        ]);
    }

    public function megamenu($items)
    {

        $list = "";
        foreach ($items->items as $item) {
            $sub_menu = "";

            if (!empty($item->items)) {


                foreach ($item->items as $sahifa) {

                    $sub_menu .= "<a href=\" " . $sahifa->url . '"> - ' . $sahifa->label . "</a>";

                    $sub_menu .= "\n";
                    //
                }
                $sub_menu = strtr($this->_layout['item_category'], [
                    "{category}" => $item->title,
                    '{sub_category}' => $sub_menu
                ]);
            }

            $sub_menu .= "\n";
            $list .= $sub_menu;

        }
        $menu = strtr($this->_layout['mega_menu'], [
            '{label}' => $item->title ?? "Default",
            '{item_category}' => $list,
            "{mega_bnr}" => $this->extra,
        ]);

        return $menu;
    }

    public function all($items)
    {

        $menu = "";
        foreach ($items as $item) {
            $sub_menu = "";
            /*if(!empty($item->param))
            {
                $mega = false;
                foreach ($item->items as $item1) {
                    if (!empty($item1->items))
                        $mega = true;
                }
                if ($mega) {
                $menu .= strtr($this->_layout['Menu'], [
                    '{label}'=> $item->title ?? "Default",
                    '{items}' =>  $this->megamenu($item)
                ]);
                    continue;
                }

            }   */
            if (!empty($item->items)) {

                foreach ($item->items as $sahifa) {
                    $sub_menu .= strtr($this->_layout['lists'], [
                        '{url}' => $sahifa->url ?? "#",
                        '{label}' => $sahifa->label ?? "Default"]);
                    $sub_menu .= "\n";
                }
                /*$menu .= strtr($this->_layout['Menu'], [
                    '{label}'=> $item->title ?? "Default",
                '{items}' =>  $sub_menu
            ]);  */

            } else {
            }
            $menu .= strtr($this->_layout['Menu'], [
                '{label}' => $item->title ?? "Default",
                '{items}' => $sub_menu
            ]);

            $menu .= "\n";

        }
        /*foreach ($items as $category) {
            if (!empty($category->child)) {$sub_menu .= strtr($this->_layout['lists'], [
                '{url}'=> $category->url ?? "#",
                '{label}' =>$category->name ?? "Default"]);
                $sub_menu.="\n";
            }
        }
        $menu = strtr($this->_layout['Menu'], [
            '{label}'=> $item->title ??  Az::l('Категории'),
            '{items}' =>  $sub_menu
        ]);   */
        return $menu;
    }

    public function codes()
    {
        $this->data = Az::$app->cores->menus->create('Дополнителные модули');
        /*   if ($this->_config['isAll']) {
                $this->data = ZArrayHelper::merge(
                    $this->data,
                    (new ALL())->run()
                );
            }*/

        //$this->all($this->data);
        /*$categories = CoreCategory::find()->all();

        $categoryListCode = '';

        $child_ids = [];
        foreach ($categories as $category) {
            $child_sub_arr = (array)$category->child;
            $child_sub_arr = array_map(function ($a) {
                return (int)$a;
            }, $child_sub_arr);
            $child_ids = array_merge($child_ids, $child_sub_arr);
        }
        $parent_categories = array_filter($categories, function ($a) use ($child_ids) {
            if (!in_array($a->id, $child_ids))
                return $a;
        });

        $categories = $parent_categories; */

        $this->_layout['main'] = strtr($this->_layout['main'], [
            '{Menus}' => $this->all(/*$categories*/ $this->data),
            '{contact}' => $this->_config['contact'],
            '{Track}' => $this->_config['track'],
            '{pay}' => $this->_config['pay'],
            '{track}' => $this->_config['track'],
            '{offerta}' => $this->_config['offerta'],

        ]);
        $this->css = $this->_layout['css'];
        $this->htm = $this->_layout['main'];
    }
}

//if($item->title != 'Mega'){
