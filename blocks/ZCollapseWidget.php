<?php
/**
 * Created by PhpStorm.
 * User: Администратор
 * Date: 19.04.2019
 * Time: 16:21
 */

namespace zetsoft\widgets\blocks;

use zetsoft\system\kernels\ZWidget;
use kartik\widgets\Alert;

class ZCollapseWidget extends ZWidget
{

    public $config = [];
    public $_config = [
        'links' => [],
        'contents' => ['dvdvds'],
    ];

    public function asset()
    {


        $this->fileJs('https://ghcdn.rawgit.org/abdi0987/ViaJS/0.2.3/lib/app.js');
        $this->fileCss('https://cdn.statically.io/gh/abdi0987/ViaJS/v1.0.0/css/stylesheet.css');

        
    }


    public function codes()
    {

        $ids = '';


        foreach ($this->_config['links'] as $key => $value) {
            $this->htm .= <<<HTML
 
                        <a class="btn btn-link" data-toggle="collapse" href="#id-{$key}" aria-expanded="false" aria-controls="id-{$key}">
                           {$value}
                        </a>
HTML;

        }

        $this->htm .= <<<HTML
<a  class="btn btn-link" data-toggle="collapse" data-target=".multi-collapse" href="#{$ids}" aria-controls="{$ids}">All of Links</a>
HTML;



        foreach ($this->_config['contents'] as $key => $value) {
            $ids .= "id-{$key} ";
            $this->htm .= <<<HTML
 
                        <div class="collapse multi-collapse" id="id-{$key}">
                            <div class="card card-body">
                                {$value}
                            </div>
                        </div>
HTML;

        }



    }

}

