<?php

namespace zetsoft\widgets\notifier;


use zetsoft\system\kernels\ZWidget;

/**
 *
 *
 */
class ZIframeWidget extends ZWidget
{

	/**
	 * Configuration
	 */
	public $config = [];
	public $_config = [
		'url' => '/shop/cores/auth/register-frame.aspx',
		'scrolling' => 'yes',   //not supported in HTML5
		'width' => '100%',
		'height' => '500',

	];
    public static $grapes = [
        'enable' => true,
        'icon' => '',
        'image' => '/render/notifier/ZIframeWidget/image/icon.png',
        'name' => Azl . 'Iframe',
        'title' => Azl . '<b>safasfsa</b><img src="/render/notifier/ZIframeWidget/image/icon.png"/>',

    ];


    public $layout =[];
    public $_layout =[

        'main' => <<<HTML
    
    <iframe src="{url}" class="z-iframe iframe-scroll" scrolling="{scrolling}" height="{height}" width="{width}"  {readonly}></iframe>

        

HTML,


    ];

	public function codes()
	{
		$this->js = <<<JS
 
  function resizeIframe(obj) {
    obj.style.height = obj.contentWindow.document.documentElement.scrollHeight + 'px';
  }
  
  
  
  
/*   $(function () {
        $('iframe').responsiveIframe({this: 'isnt', that: 'is'});
    });
  */
 
JS;


		$this->css = <<<CSS
		.iframe-scroll{
			overflow: scroll !important;
		}
        .z-iframe{
          border: none;
        }
        
    
CSS;

		$this->htm = strtr($this->_layout['main'], [
			'{url}' => $this->_config['url'],
			'{scrolling}' => $this->_config['scrolling'],
			'{width}' => $this->_config['width'],
			'{height}' => $this->_config['height'],
			'{name}' => $this->_config['name'],
            
            '{readonly}' => $this->_config['readonly'] ? 'readonly' : '',
		]);


	}

}
