<?php

/**
 *
 *
 * Author:  Abdumalikov Otabek
 *
 */

namespace zetsoft\widgets\navigat;

use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use function GuzzleHttp\Psr7\str;
use zetsoft\system\kernels\ZWidget;
use kartik\widgets\Select2;
use yii\web\JsExpression;

class ZJqueryCollapseWidget extends ZWidget
{

    public $config = [];
    public $_config = [
        'items'
    ];


    public function asset()
    {
        $this->fileCss('/publish/navigs/jquery-collapse/material.css');
        $this->fileJs('/publish/navigs/jquery-collapse/jquery.min.js');
       $this->fileJs('/publish/navigs/jquery-collapse/jquery.collapse.js');
      $this->fileJs('/publish/yarner/jquery-collapse/src/jquery.collapse.js');
        $this->fileJs('https://cdn.jsdelivr.net/npm/jquery-collapse@1.1.2/src/jquery.collapse.js');
       $this->fileJs('/publish/navigs/jquery-collapse/jquery.collapse_storage.js');
       $this->fileJs('/publish/yarner/jquery-collapse/src/jquery.collapse_storage.js');
        $this->fileJs('https://cdn.jsdelivr.net/npm/jquery-collapse@1.1.2/src/jquery.collapse_storage.js');
    }

    public function codes()
    {
        $arr = '';

        $items = $this->_config['items'];

        foreach ($items as $item) {
            $arr .= <<<HTML
            
            <h3 data-collapse-summary="" class="close"><a href="#">{$item['title']}</a></h3>
            <div aria-hidden="true" style="display: none;">
                <div class="content">
                    <p>{$item['text']}</p>
                </div>
            </div>         
                         
HTML;
        }


     $this->js = <<<JS
          $("#css3-animated-example").collapse({
                accordion: true,
                persist: true,
                open: function() {
                    this.addClass("open");
                    this.css({ height: this.children().outerHeight() });
                },
                close: function() {
                    this.css({ height: "0px" });
                    this.removeClass("open");
                }
            });
JS;


        $this->htm .= <<<HTML
            <section id="examples">
                <div class="col c2">
                    <div id="css3-animated-example">
                        {$arr}
                    </div>
                    <script>
                        $("#css3-animated-example").collapse({
                            accordion: true,
                            persist: true,
                            open: function() {
                                this.addClass("open");
                                this.css({ height: this.children().outerHeight() });
                            },
                            close: function() {
                                this.css({ height: "0px" });
                                this.removeClass("open");
                            }
                        });
                    </script>
                </div>
            </section>
HTML;
          $this->css = <<<CSS
               .close {
                    float: none!important;}
               
CSS;




}

 
}
