<?php


namespace zetsoft\widgets\market;


use zetsoft\system\kernels\ZWidget;

class ZXeMartLangWidget extends ZWidget
{
    public $config = [];
    public $_config = [
        'pages'=>[
            'home'=>[
                'page_title'=>'home',
                'page_href'=>'/'
            ],
            'settings'=>[
                'page_title'=>'settings',
                'page_href'=>'/'
            ]
        ],
        'blogs'=>[
            'blog1'=>[
                'blog_title'=>'blog1',
                'blog_href'=>'/'
            ],
            'blog2'=>[
                'blog_title'=>'blog2',
                'blog_href'=>'/'
            ],
        ],
        'contact'=>[
            'contact_title'=>'sadas',
            'contact_href'=>'dasdasda'
        ]


    ];


    public $layout = [];
    public $__layout = [

        'main' => <<<HTML

<section class="znavbar sticky-menu">
    <div class="container">
        <div class="row">
            <div class="col-lg-2 col-md-3 {class}">
                <div class="sticky-logo">
                    <a href="index.html"><img src="images/logo.png" alt="" class="img-fluid"></a>
                </div>
            </div>
            <div class="col-lg-6 col-md-7">
                <div class="dropdown-menu dropdown-success">
                    <ul class="list-unstyled list-inline">

                        <li class="list-inline-item"><a>PAGES <i class="fa fa-angle-down"></i></a>
                            <ul class="dropdown list-unstyled">
                                {content_page}z
                            </ul>
                        </li>
                        <li class="list-inline-item"><a>BLOG <i class="fa fa-angle-down"></i></a>
                            <ul class="dropdown list-unstyled ">
                                {content_blog}
                            </ul>
                        </li>
<!--                        <li class="list-inline-item"><a href="20-contact.html">CONTACT</a></li>-->
                        {contact}
                    </ul>
                </div>
            </div>
            <div class="col-lg-4 col-md-2">
                <div class="carts-area d-flex">
                    <div class="src-box">
                        <form action="#">
                            <input type="text" name="search" placeholder="Search Here">
                            <button type="button" name="button"><i class="fa fa-search"></i></button>
                        </form>
                    </div>
                    <div class="wsh-box ml-auto">
                        <a href="" data-toggle="tooltip" data-placement="top" title="" data-original-title="Wishlist">
                            <img src="/render/market/@Other/ZXeMartLangWidget/html/images/heart.png" alt="favorite">
                            <span>0</span>
                        </a>
                    </div>
                    <div class="cart-box ml-4">
                        <a href="" data-toggle="tooltip" data-placement="top" title="" class="cart-btn" data-original-title="Shopping Cart">
                            <img src="/render/market/@Other/ZXeMartLangWidget/html/images/cart.png" alt="cart">
                            <span>2</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<div style="height:120vh;">
</div>




HTML,
        'li_page' => <<<HTML
           <li><a href="{page_href}">{page_title}</a></li>
HTML,
        'li_blog' => <<<HTML
           <li><a href="{blog_href}">{blog_title}</a></li>
HTML,
        'contact'=> <<<HTML
        <li class="list-inline-item"><a href="{contact_href}">{contact_title}</a></li>
HTML,


    ];


    public function asset()
    {


        $this->fileCss('/render/market/XeMart - Ecommerce Template/html/css/assets/bootstrap.min.css');
        $this->fileCss('/render/market/XeMart - Ecommerce Template/html/css/assets/font-awesome.min.css');
        $this->fileCss('/render/market/XeMart - Ecommerce Template/html/css/assets/owl.carousel.min.css');
        //$this->fileCss('/render/market/XeMart - Ecommerce Template/html/css/assets/animate.css');
        $this->fileCss('/render/market/XeMart - Ecommerce Template/html/css/material.css');
        $this->fileCss('/render/market/XeMart - Ecommerce Template/html/css/assets/responsive.css');


        $this->fileJs('/render/market/XeMart - Ecommerce Template/html/js/assets/vendor/jquery-1.12.4.min.js');
        $this->fileJs('/render/market/XeMart - Ecommerce Template/html/js/assets/price-filter.js');
        $this->fileJs('/render/market/XeMart - Ecommerce Template/html/js/plugins.js');
        $this->fileJs('/render/market/XeMart - Ecommerce Template/html/js/custom.js');
        $this->fileJs('https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js');
        $this->fileJs('https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/js/bootstrap.min.js');
        $this->fileJs('https://cdn.jsdelivr.net/npm/owl.carousel@2.3.4/dist/owl.carousel.min.js');
        $this->fileJs('https://cdn.jsdelivr.net/npm/wow.js@1.2.2/dist/wow.min.js');
        $this->fileJs('/render/market/XeMart - Ecommerce Template/html/js/assets/jquery.meanmenu.min.js');

    }

    public function codes()
    {
        $pages=$this->_config['pages'];
        $blogs=$this->_config['blogs'];

        $content_pages='';
        $content_blogs='';
        $contact='';
        foreach ($pages as $page){
            $content_pages.= strtr($this->_layout['li_page'],[
               '{page_href}'=>$page['page_href'],
               '{page_title}'=>$page['page_title'],
            ]);
        }
        foreach ($blogs as $blog){
            $content_blogs.= strtr($this->_layout['li_blog'],[
                '{blog_href}'=>$blog['blog_href'],
                '{blog_title}'=>$blog['blog_title'],
            ]);
        }

        $contact.=strtr($this->_layout['contact'],[
           '{contact_href}'=>$this->_config['contact']['contact_href'],
           '{contact_title}'=>$this->_config['contact']['contact_title'],
        ]);

        $this->htm=strtr($this->_layout['main'],[
           '{content_blog}'=>$content_blogs,
           '{content_page}'=>$content_pages,
           '{contact}'=>$contact,
        ]);




    }

}
