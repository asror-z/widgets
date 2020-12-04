<?php

/**
 *
 *
 * Author:  Asror Zakirov
 * https://www.linkedin.com/in/asror-zakirov
 * https://www.facebook.com/asror.zakirov
 * https://github.com/asror-z
 *
 */

namespace zetsoft\widgets\themes;


use zetsoft\system\kernels\ZWidget;

class ZLightboxWidget extends ZWidget
{

    public $config = [];

    public $_config = [
        'type' =>'main',
    ];


    public const type = [
        'main' => 'main'

    ];
    public $layout = [];
    public $_layout = [
        'main' => <<<HTML
<div class="row">
  <div class="col-md-12">
    <div id="mdb-lightbox-ui"></div>
    <div class="mdb-lightbox no-margin">
      <figure class="col-md-4">
        <a href="https://mdbootstrap.com/img/Photos/Horizontal/Nature/12-col/img%20(117).jpg" data-size="1600x1067">
          <img src="https://mdbootstrap.com/img/Photos/Horizontal/Nature/4-col/img%20(117).jpg" class="img-fluid">
        </a>
      </figure>
      <figure class="col-md-4">
        <a href="https://mdbootstrap.com/img/Photos/Horizontal/Nature/12-col/img%20(98).jpg" data-size="1600x1067">
          <img src="https://mdbootstrap.com/img/Photos/Horizontal/Nature/4-col/img%20(98).jpg" class="img-fluid" />
        </a>
      </figure>
      <figure class="col-md-4">
        <a href="https://mdbootstrap.com/img/Photos/Horizontal/Nature/12-col/img%20(131).jpg" data-size="1600x1067">
          <img src="https://mdbootstrap.com/img/Photos/Horizontal/Nature/4-col/img%20(131).jpg" class="img-fluid" />
        </a>
      </figure>
      <figure class="col-md-4">
        <a href="https://mdbootstrap.com/img/Photos/Horizontal/Nature/12-col/img%20(123).jpg" data-size="1600x1067">
          <img src="https://mdbootstrap.com/img/Photos/Horizontal/Nature/4-col/img%20(123).jpg" class="img-fluid" />
        </a>
      </figure>
      <figure class="col-md-4">
        <a href="https://mdbootstrap.com/img/Photos/Horizontal/Nature/12-col/img%20(118).jpg" data-size="1600x1067">
          <img src="https://mdbootstrap.com/img/Photos/Horizontal/Nature/4-col/img%20(118).jpg" class="img-fluid" />
        </a>
      </figure>
      <figure class="col-md-4">
        <a href="https://mdbootstrap.com/img/Photos/Horizontal/Nature/12-col/img%20(128).jpg" data-size="1600x1067">
          <img src="https://mdbootstrap.com/img/Photos/Horizontal/Nature/4-col/img%20(128).jpg" class="img-fluid" />
        </a>
      </figure>
      <figure class="col-md-4">
        <a href="https://mdbootstrap.com/img/Photos/Horizontal/Nature/12-col/img%20(132).jpg" data-size="1600x1067">
          <img src="https://mdbootstrap.com/img/Photos/Horizontal/Nature/4-col/img%20(132).jpg" class="img-fluid" />
        </a>
      </figure>
      <figure class="col-md-4">
        <a href="https://mdbootstrap.com/img/Photos/Horizontal/Nature/12-col/img%20(115).jpg" data-size="1600x1067">
          <img src="https://mdbootstrap.com/img/Photos/Horizontal/Nature/4-col/img%20(115).jpg" class="img-fluid" />
        </a>
      </figure>
      <figure class="col-md-4">
        <a href="https://mdbootstrap.com/img/Photos/Horizontal/Nature/12-col/img%20(133).jpg" data-size="1600x1067">
          <img src="https://mdbootstrap.com/img/Photos/Horizontal/Nature/4-col/img%20(133).jpg" class="img-fluid" />
        </a>
      </figure>
    </div>
  </div>
</div>
HTML

    ];

   
    public function asset()
    {

    }

    public function codes()
    {

        if($this->_config['visible'])
            $this->htm = $this->_layout[$this->_config['type']];

        $this->htm = strtr($this->_layout['main'], []);
    }


}
