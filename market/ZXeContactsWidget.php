<?php

/**
 *
 *
 * Author:  Asror Zakirov
 * https://www.linkedin.com/in/asror-zakirov
 * https://github.com/asror-z
 *
 */

namespace zetsoft\widgets\market;

use zetsoft\models\drag\DragForm;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\former\ZFormWidget;

/**
 *
 * Class ZXeContactsWidget
 *
 * Created By: Shahzod Gulomqodirov
 */

class ZXeContactsWidget extends ZWidget
{
    /**
     * Configuration
     */
    public $config = [];
    public $_config = [
        'location' => '795 South Park Avenue, Long Island, Newyork, NY 94107.',
        'number' => '+1 908 875 7678',
        'email' => 'adsada@cacsc.ru',
        'facebook'=>'' ,
        'twitter'=>'',
        'linkedln'=>'',
        'youtube'=>'',
        'pinterest'=>'',
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
          <!-- Contact -->
        <section class="contact-area">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 col-md-5">
                    	<div class="contact-box-tp">
                    		<h4 class="text-uppercase font-weight-bold">Contact Info</h4>
                    	</div>
                        <div class="row">
                            <div class="col-md-12 mt-4">
                                <div class="contact-box d-flex">
                                    <div class="loc">
                                        <i class="fa fa-map-marker"></i>
                                    </div>
                                    <div class="contact-content">
                                        <h6 class="text-uppercase font-weight-normal">Our Location</h6>
                                        <p class="text-black-50">{location}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 mt-4">
                                <div class="contact-box d-flex">
                                    <div class="contact-icon">
                                        <i class="fa fa-envelope"></i>
                                    </div>
                                    <div class="contact-content">
                                        <h6 class="text-uppercase font-weight-normal">Email Address</h6>
                                        <p class="text-black-50">{email}<br>{email}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 mt-4">
                                <div class="contact-box d-flex">
                                    <div class="contact-icon">
                                        <i class="fa fa-phone"></i>
                                    </div>
                                    <div class="contact-content">
                                        <h6 class="text-uppercase font-weight-normal">Phone Number</h6>
                                        <p class="text-black-50">{number}<br>{number}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mt-3">
                        	<ul class="list-unstyled list-inline">
                        		<li class="list-inline-item social" style="background-color:#0542FF;"><a href="{facebook}"><i class="text-white fa fa-facebook"></i></a></li>
                        		<li class="list-inline-item social" style="background-color:#34FFF0;"><a href="{twitter}"><i class="text-white fa fa-twitter"></i></a></li>
                        		<li class="list-inline-item social" style="background-color:#41A8FF;"><a href="{linkedln}"><i class="text-white fa fa-linkedin"></i></a></li>
                        		<li class="list-inline-item social" style="background-color:#FF0405;"><a href="{youtube}"><i class="text-white fa fa-youtube"></i></a></li>
                        		<li class="list-inline-item social" style="background-color:#9B191A;"><a href="{pinterest}"><i class="text-white fa fa-pinterest"></i></a></li>
                        	</ul>
                        </div>
                    </div>

                </div>
            </div>
        </section>
        <!-- End Contact -->
          
HTML,

      
    ];

    /**
     *
     * Constants
     */


    public function asset()
    {
        $this->fileCss('https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.12.1/css/all.min.css');
        $this->fileCss('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css');
        $this->fileCss('https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.css');
        $this->fileCss('https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css');
        $this->fileCss('/render/asrorz/mdb/css/mdb.min.css');
    }

    public function codes()
    {
        //  $this->htm = \kartik\select2\Select2::widget($this->options);

        $this->htm = strtr($this->_layout['main'], [
            '{location}' => $this->_config['location'],
            '{email}' => $this->_config['email'],
            '{number}' => $this->_config['number'],
            '{youtube}'=>$this->_config['youtube'],
            '{facebook}'=>$this->_config['facebook'],
            '{twitter}'=>$this->_config['twitter'],
            '{linkedln}'=>$this->_config['linkedln'],
            '{pinterest}'=>$this->_config['pinterest'],

        ]);

        


    }
}
