<?php

/**
 *
 * Class ZCatcDisplaceWidget
 * http://demos.krajee.com/widget-details/select2
 *
 * Created By: ElnurController Suyunov
 * Refactored: Asror Zakirov;
 */

namespace zetsoft\widgets\actions;


use zetsoft\system\kernels\ZWidget;

class ZCatcDisplaceWidget extends ZWidget
{


  public $config = [];
  public $_config = [
      'ready' => true,
      'main' => 'main'
  ];
  public $layout = [];
  public $_layout = [


      'main' => <<<HTML
<section class="non-code" id="">
    <h3>Basic usage</h3>
    <div class="demo__wrapper">
        <div class="demo__actions">
            <button>Standard</button>
            <button>Constrain</button>
            <button>Relative to</button>
            <button>Events</button>
            <button>Handle</button>
            <button>Ignore</button>
        </div>
        
        
        
    </div>
    <div class="magnifier-asset">
        <div class="magnifier-demo__image-wrapper">
            <img id="magnifier-img"
                 src="https://images.unsplash.com/26/city-scape.jpg?dpr=2&auto=format&fit=cropLength&w=1199&h=799&q=80&cs=tinysrgb&cropLength=">
            <span class="magnifier-demo__zoomer"></span>
        </div>
        <div class="magnifier-demo__zoom-preview"></div>
    </div>
    <div class="sorting-asset">
        <div class="sorting-demo__wrapper">
            <span class="sorting-demo__corner top-left">
                <span data-name="top left" class="sorting-demo__progress"></span>
            </span>
            <span class="sorting-demo__corner top-right">
                <span data-name="top right" class="sorting-demo__progress"></span>
            </span>
            <span class="sorting-demo__corner bottom-left">
                <span data-name="bottom left" class="sorting-demo__progress"></span>
            </span>
            <span class="sorting-demo__corner bottom-right">
                <span data-name="bottom right" class="sorting-demo__progress"></span>
            </span>

            <span class="sorting-demo__sortable one"></span>
            <span class="sorting-demo__sortable two"></span>
            <span class="sorting-demo__sortable three"></span>
            <span class="sorting-demo__sortable four"></span>
        </div>
    </div>

    <div class="sorting-demo__options">
        <button class="sorting-demo__reset-button">Reset asset</button>
    </div>

    <h3>Align to grid (via customFn)</h3>
    <div class="custom-fn">
        <div class="custom-fn__wrapper">
            <span class="custom-fn__div"></span>
        </div>
    </div>

</section>
 <!-- <script src="/render/actions/ZCatcDisplaceWidget/assets/bundle.js"></script>-->
 
  <script src="https://cdn.statically.io/gh/catc/displace/ad0caa56/docs/bundle.js"></script>
HTML


  ];

  public function asset()
  {
    $this->fileCss('https://cdn.statically.io/gh/catc/displace/ad0caa56/docs/material.css');

    
    //$this->fileCss('/render/actions/ZCatcDisplaceWidget/assets/material.css');
    //$this->fileJs('/render/actions/ZCatcDisplaceWidget/assets/bundle.js');
  }


  public function codes()
  {

    if ($this->_config['main'])
      $this->htm = $this->_layout[$this->_config['main']];
  }
}
