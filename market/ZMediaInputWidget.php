<?php

namespace zetsoft\widgets\market;

use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use function GuzzleHttp\Psr7\str;
use zetsoft\system\kernels\ZWidget;
use kartik\widgets\Select2;
use yii\web\JsExpression;

/**
 *
 * Class ZKSelect2Widget
 * http://demos.krajee.com/widget-details/select2
 *
 * Created By: Zilola Ikramova

 */

class ZMediaInputWidget extends ZWidget
{

    /**
     * Configuration
     */
    public $config = [];
    public $_config = [

    ];


    /**
     *
     * Plugin Events
     * https://select2.org/programmatic-control/events
     */
    public $event = [];
    public $_event = [

    ];


    /**
     * Constants */
    public function asset()
    {
//    $this->fileCss("./demo_files/typeahead.min.css");
//        $this->fileCss("./demo_files/font-awesome.min.css");
//        $this->fileCss("./demo_files/bootstrap.css");
//     $this->fileJs("./demo_files/analytics.js.download");
//        $this->fileJs("./demo_files/watch.js.download");
    }


     public $layout = [];
     public $_layout = [
         'main' => <<<HTML

        <div class="col-xs-8 header-search-input">
     <form action="https://www.mediapark.uz/site/search" method="GET">
         <div class="tt-scrollable-menu"><span class="twitter-typeahead"
                                               style="position: relative; display: inline-block;"><input
                 type="text" class="form-control tt-hint" data-krajee-typeahead="typeahead_3fe4d359"
                 readonly="" autocomplete="off" spellcheck="false" tabindex="-1" dir="ltr"
                 style="position: absolute; top: 0px; left: 0px; border-color: transparent; box-shadow: none; opacity: 1; background: none 0% 0% / auto repeat scroll padding-box border-box rgb(235, 235, 235);"><input
                 type="text" id="w0" class="form-control tt-input" name="text" required=""
                 placeholder="Поиск" data-krajee-typeahead="typeahead_3fe4d359" autocomplete="off"
                 spellcheck="false" dir="auto"
                 style="position: relative; vertical-align: top; background-color: transparent;"><pre
                 aria-hidden="true"
                 style="position: absolute; visibility: hidden; white-space: pre; font-family: RalewayLight, sans-serif; font-size: 14px; font-style: normal; font-variant: normal; font-weight: 400; word-spacing: 0px; letter-spacing: 0px; text-indent: 0px; text-rendering: auto; text-transform: none;"></pre><div
                 class="tt-menu"
                 style="position: absolute; top: 100%; left: 0px; z-index: 100; display: none;"><div
                 class="tt-dataset tt-dataset-kvTypData_c8fa271f"></div></div></span></div>
         <button type="submit" class="btn-search"><i class="fa fa-search"></i></button>
     </form>
 </div>

HTML,
         'css' => <<<CSS
      .header-search-input {
            position: relative;
            margin: 50px auto;
            display: inline-block;
            
        }
        .form-control {
        width: 400px;
        }

        .btn-search {
            top: 5px;
            right: 10px;
            position: absolute;
            border: none;
            background: transparent;
            cursor: pointer;
            z-index: 1;
            outline: none;
        }
        .fa-search {
            color: darkgrey;
            cursor: pointer;
        }
CSS,

     ];


    public function codes()
    {

        $this ->htm .= strtr($this ->_layout['main'],[]);
        $this ->css = strtr($this ->_layout['css'],[]);
    }

}
