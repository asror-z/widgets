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

namespace zetsoft\widgets\animo;

use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\kernels\ZWidget;

class ZReboundgenWidget extends ZWidget

{
    public $config = [];
    public $_config = [

      
    ];
   
  
     public $layout=[];
     public $_layout=[
        'main'=><<<HTML
      <article class="type-system-sans">
        <div class="animations-container">
         <div class="example-container">
            <code>.bounceInRight</code>
            <div class="animation-example" data-anim="bounceInRight"></div>
        </div>
      </article>
HTML,
        'css'=><<<CSS
pre > code {
        padding: 0;
        margin: 0;
        font-size: 100%;
        word-break: normal;
        white-space: pre;
        background: transparent;
        border: 0;
    }

    pre code:before,
    .markdown-body pre code:after {
        content: normal;
    }

    pre code {
        display: inline;
        max-width: initial;
        padding: 0;
        margin: 0;
        overflow: initial;
        line-height: inherit;
        word-wrap: normal;
        background-color: transparent;
        border: 0;
    }

    pre {
        word-wrap: normal;
        white-space: pre;
        white-space: pre-wrap;
    }
CSS,
        'js'=><<<JS
   $(function () {
        $(".animation-example").on('mouseover', function () {
            var anim = $(this).attr("data-anim");
            $(this).removeClass(anim);
            $(this).addClass(anim);

            $(this).one('webkitAnimationEnd oanimationend MSAnimationEnd animationend',
                function (e) {
                    // code to execute after transition ends
                    $(this).removeClass(anim);

                });
        });
    });
JS

     ];
    public function asset()
    {
        $this->fileCss('testing/animo/All/assets/all/css/Dwarcher Reboundgen/styles.min.css');
        $this->fileJs('testing/animo/All/assets/all/css/Dwarcher Reboundgen/analytics.js');
    
    }

    public function codes()
    {
        $this->htm= strtr($this->_layout["main"],[]);
        $this->css= strtr($this->_layout["css"],[]);
        $this->js= strtr($this->_layout["js"],[]);
    }

}
