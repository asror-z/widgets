<?php

namespace zetsoft\widgets\inptest;

use zetsoft\system\kernels\ZWidget;
/**
 *
 * https://github.com/Fabianlindfors/multi.js
 * https://fabianlindfors.se/multijs/
 * Created By: Sunnat Ermatov
 * Refactored: Murodo`v Mirbosit
 */

class ZMultiJsWidget extends ZWidget
{

    /**
     * Configuration
     */
    public $config = [];
    public $_config = [
        'theme' => ZMultiJsWidget::theme['classic'],
        'size' => ZMultiJsWidget::size['lg'],
        'grapes' => true,
    ];

    public $event = [];
    public $_event = [
    ];

    public static $grapes = [
        'enable' => true,
        'icon' => '',
        'image' => '/render/inputes/ZSelect2Widget/image/icon.png',
        'name' => Azl . 'Select2',
        'title' => Azl . '<b>safasfsa</b><img src="/render/inputes/ZSelect2Widget/image/icon.png"/>',

    ];
    
    /**
     * Constants
     */
    public const theme = [
        'default' => 'default',
        'classic' => 'classic',
        'bootstrap' => 'bootstrap'
    ];

    public const size = [
        'lg' => 'lg',
        'md' => 'md',
        'sm' => 'sm'
    ];

    public $layout = [];
    public $_layout = [
        'main' => <<<HTML
    <div class="row">
	<div class="col-xs-5">
		<select name="{name}" id="{id}" class="form-control">
			<option></option>
			{content}
		</select>
	</div>
</div>
HTML,

        'js' => <<<JS
		  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
		  ga('create', 'UA-45755328-17', 'auto');
		  ga('send', 'pageview')
JS,
    ];

    public function asset()
    {
        $this->fileCss('https://cdnjs.cloudflare.com/ajax/libs/multi-select/0.9.12/css/multi-select.min.css');
        $this->fileJs('https://cdnjs.cloudflare.com/ajax/libs/multi-select/0.9.12/js/jquery.multi-select.min.js');
    }

    public function codes()
    {
        $this->htm .= strtr($this->_layout['main'], [
            '{id}' => $this->id,
            '{name}' => $this->name,
        ]);
    }
}
