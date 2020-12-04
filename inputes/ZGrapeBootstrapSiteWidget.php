<?php

/**
 *
 *
 * Author: Asror Zakirov
 * https://www.linkedin.com/in/asror-zakirov
 * https://www.facebook.com/asror.zakirov
 * https://github.com/asror-z
 *
 */

namespace zetsoft\widgets\inputes;

use zetsoft\dbitem\App\eyuf\CheckboxItem;
use zetsoft\system\kernels\ZWidget;

class ZGrapeBootstrapSiteWidget extends ZWidget
{
    /**
     * https://iqbalfn.github.io/bootstrap-image-checkbox/#
     * https://github.com/iqbalfn/bootstrap-image-checkbox
     * /core/tester/asror/main.aspx?path=render/inputes/ZBootstrapImgCheckboxWidget/active.php
     */

    public static $grapes = [
        'enable' => true,
        'icon' => '',
        'height' => '600px',
        'width' => '840px',
        'image' => '/render/inputes/ZFileInputWidget/image/icon.png',
        'name' => Azl . 'Select2',
        'title' => Azl . '<b>Title</b>',
    ];
    public $config = [];
    public $_config = [
        'grapes' => true
    ];

    public $event = [];
    public $_event = [
    
    ];

    public $layout = [];
    public $_layout = [

        'main' => <<<HTML
    <div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
      <h5 class="my-0 mr-md-auto font-weight-normal">Company name</h5>
      <nav class="my-2 my-md-0 mr-md-3">
        <a class="p-2 text-dark" href="">Features</a>
        <a class="p-2 text-dark" href="">Enterprise</a>
        <a class="p-2 text-dark" href="">Support</a>
        <a class="p-2 text-dark" href="">Pricing</a>
      </nav>
      <a class="btn btn-outline-primary" href="">Sign up</a>
    </div>

    <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
      <h1 class="display-4">Pricing</h1>
      <p class="lead">Quickly build an effective pricing table for your potential customers with this Bootstrap example. It's built with default Bootstrap components and utilities with little customization.</p>
    </div>

    <div class="container">
      <div class="card-deck mb-3 text-center">
        <div class="card mb-4 shadow-sm">
          <div class="card-header">
            <h4 class="my-0 font-weight-normal">Free</h4>
          </div>
          <div class="card-body">
            <h1 class="card-title pricing-card-title">$0 <small class="text-muted">/ mo</small></h1>
            <ul class="list-unstyled mt-3 mb-4">
              <li>10 users included</li>
              <li>2 GB of storage</li>
              <li>Email support</li>
              <li>Help center access</li>
            </ul>
            <button type="button" class="btn btn-lg btn-block btn-outline-primary">Sign up for free</button>
          </div>
        </div>
        <div class="card mb-4 shadow-sm">
          <div class="card-header">
            <h4 class="my-0 font-weight-normal">Pro</h4>
          </div>
          <div class="card-body">
            <h1 class="card-title pricing-card-title">$15 <small class="text-muted">/ mo</small></h1>
            <ul class="list-unstyled mt-3 mb-4">
              <li>20 users included</li>
              <li>10 GB of storage</li>
              <li>Priority email support</li>
              <li>Help center access</li>
            </ul>
            <button type="button" class="btn btn-lg btn-block btn-primary">Get started</button>
          </div>
        </div>
        <div class="card mb-4 shadow-sm">
          <div class="card-header">
            <h4 class="my-0 font-weight-normal">Enterprise</h4>
          </div>
          <div class="card-body">
            <h1 class="card-title pricing-card-title">$29 <small class="text-muted">/ mo</small></h1>
            <ul class="list-unstyled mt-3 mb-4">
              <li>30 users included</li>
              <li>15 GB of storage</li>
              <li>Phone and email support</li>
              <li>Help center access</li>
            </ul>
            <button type="button" class="btn btn-lg btn-block btn-primary">Contact us</button>
          </div>
        </div>
      </div>

      <footer class="pt-4 my-md-5 pt-md-5 border-top">
        <div class="row">
          <div class="col-12 col-md">
            <img class="mb-2" src="./Pricing example for Bootstrap_files/bootstrap-solid.svg" alt="" width="24" height="24">
            <small class="d-block mb-3 text-muted">© 2017-2018</small>
          </div>
          <div class="col-6 col-md">
            <h5>Features</h5>
            <ul class="list-unstyled text-small">
              <li><a class="text-muted" href="">Cool stuff</a></li>
              <li><a class="text-muted" href="">Random feature</a></li>
              <li><a class="text-muted" href="">Team feature</a></li>
              <li><a class="text-muted" href="">Stuff for developers</a></li>
              <li><a class="text-muted" href="">Another one</a></li>
              <li><a class="text-muted" href="">Last time</a></li>
            </ul>
          </div>
          <div class="col-6 col-md">
            <h5>Resources</h5>
            <ul class="list-unstyled text-small">
              <li><a class="text-muted" href="">Resource</a></li>
              <li><a class="text-muted" href="">Resource name</a></li>
              <li><a class="text-muted" href="">Another resource</a></li>
              <li><a class="text-muted" href="">Final resource</a></li>
            </ul>
          </div>
          <div class="col-6 col-md">
            <h5>About</h5>
            <ul class="list-unstyled text-small">
              <li><a class="text-muted" href="">Team</a></li>
              <li><a class="text-muted" href="">Locations</a></li>
              <li><a class="text-muted" href="">Privacy</a></li>
              <li><a class="text-muted" href="">Terms</a></li>
            </ul>
          </div>
        </div>
      </footer>
    </div>

HTML,

        'css' => <<<CSS
      
CSS,

        'js' => <<<JS
    
JS,
    ];

    public function asset()
    {
    
    }

    public function codes()
    {


        $this->htm = strtr($this->_layout['main'], [
        
        ]);

        $this->js = strtr($this->_layout['js'], [
            
        ]);
        $this->css = strtr($this->_layout['css'], [
        
        ]);
    }
}
