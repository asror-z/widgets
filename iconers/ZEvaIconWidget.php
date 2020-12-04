<?php

namespace zetsoft\widgets\iconers;

use zetsoft\system\kernels\ZWidget;

/**
 *
 * https://github.com/akveo/eva-icons
 * https://akveo.github.io/eva-icons/#/
 *
 * Created By: Abdurakhmonov Umid
 *
 */
class ZEvaIconWidget extends ZWidget
{

    /**
     * Configuration
     */
    public $config = [];
    public $_config = [
        'grapes' => true,

    ];


    public $layout = [];
    public $_layout = [
        'main' => <<<HTML
        <div class="col">
        <i data-eva="github"></i>
        <i data-eva="github" data-eva-fill="blue" data-eva-hover="true"></i>
        <i class="eva eva-5x eva-github"  {readonly}></i>    
        <i class="eva eva-5x eva-github-outline"></i>
        </div> 
HTML,

        'js' => <<<JS
    
    eva.replace({ animation: { type: 'pulse', infinite: true, hover: false },   fill: 'red', width: '100px', height: '100px' })

            
    
JS,

        'css' => <<<CSS
    
 
CSS,

    ];


    public function asset()
    {

        $this->fileJs('https://cdn.jsdelivr.net/npm/eva-icons@1.1.3/eva.min.js');


        /*     $this->fileCss('/publish/yarner/eva-icons/style/eva-icons.css');
             $this->fileJs('/publish/yarner/eva-icons/eva.js');*/

    }


    public function codes()
    {


        $this->htm = strtr($this->_layout['main'], [
            
            '{readonly}' => $this->_config['readonly'] ? 'readonly' : '',

        ]);
        $this->js = strtr($this->_layout['js'], [

        ]);

        $this->css = strtr($this->_layout['css'], [

        ]);

    }

}
