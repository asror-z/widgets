<?php

/**
 *
 *
 * Author:  Shahzod Gulomqodirov
 *
 */

namespace zetsoft\widgets\market;


use zetsoft\system\kernels\ZWidget;

class ZSimleProductWidget extends ZWidget
{
    /**
     * Configuration
     */
    public $config = [];
    public $_config = [
         'image' => 'https://micoedward.com/wp-content/uploads/2018/04/Love-your-product.png',
         'aboutProduct' => 'Lorem ipsum dolor sit amet...',
         'date' => '2020.11.10',
         'color' => 'Black',
         'title1' => 'SEARCH BLOG',
         'title2' => 'RECENT POSTS',
         'icon' => 'fa fa-search',
    ];


    /**
     *
     * Plugin Events
     * https://select2.org/programmatic-control/events
     */
    public $event = [];
    public $_event = [

    ];

    public $layout = [];
    public $_layout = [

        'main' => <<<HTML
           <section class="blog-details">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-4">
                <div class="row">
                    <div class="col-md-12">
                        <div class="blog-sr">
                            <div class="sec-title">
                                <h6>{title1}</h6>
                            </div>
                            <form action="#">
                                <input type="text" name="search" placeholder="Search Here" required>
                                <button type="submit"><i class="{icon}"></i></button>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="blog-po">
                            <div class="sec-title">
                                <h6>{title2}</h6>
                            </div>
                            <div class="post-box">
                               <div class="rec-post d-flex">
                                    <div>
                                        <a href="#"><img src="https://micoedward.com/wp-content/uploads/2018/04/Love-your-product.png" alt=""></a>
                                    </div>
                                    <div>
                                        <p><a href="">{aboutProduct}</a></p>
                                        <span>{date}</span>
                                    </div>
                                </div>
                                <div class="rec-post d-flex">
                                    <div>
                                        <a href="#"><img src="https://micoedward.com/wp-content/uploads/2018/04/Love-your-product.png" alt=""></a>
                                    </div>
                                    <div>
                                        <p><a href="">{aboutProduct}</a></p>
                                        <span>{date}</span>
                                    </div>
                                </div>
                                <div class="rec-post d-flex">
                                    <div>
                                        <a href="#"><img src="https://micoedward.com/wp-content/uploads/2018/04/Love-your-product.png" alt=""></a>
                                    </div>
                                    <div>
                                        <p><a href="">{aboutProduct}</a></p>
                                        <span>{date}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
          
HTML,



    ];



    public function codes()
    {
        $this->htm = strtr($this->_layout['main'], [
            '{image}' => $this->_config['image'],
            '{date}' => $this->_config['date'],
            '{aboutProduct}' => $this->_config['aboutProduct'],
            '{title1}' => $this->_config['title1'],
            '{title2}' => $this->_config['title2'],
            '{icon}' => $this->_config['icon'],
        ]);

    }

}

