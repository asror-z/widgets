<?php

/**
 *
 *
 * Author:  Asror Zakirov
 *
 * https://www.linkedin.com/in/asror-zakirov
 * https://www.facebook.com/asror.zakirov
 * https://github.com/asror-z
 *
 */

namespace zetsoft\widgets\themes;


use yii\bootstrap\Html;
use zetsoft\system\kernels\ZWidget;

class ZRowWidget extends ZWidget
{

    public $config = [];
    public $_config = [
         'justify' => ZRowWidget::Justifie['justify_content_none'],
         'align' => ZRowWidget::Align['align_items_none'],
         'gutter' => ZRowWidget::Gutter['no-gutters']
    ];

    public const Gutter = [
        'no-gutters' => 'no-gutters',
        'no_gutters_none' => ''
    
    ];
    
    public const Align = [
        'align-items-start' => 'align-items-start', 
        'align-items-center' => 'align-items-center', 
        'align-items-end' => 'align-items-end', 
        'align_items_none' => '', 
    ];

    public const Justifie = [
        'justify_content_none'=> 'justify_content_none',
        'justify-content-md-start'=> 'justify-content-md-start',
        'justify-content-md-center'=> 'justify-content-md-center',
        'justify-content-md-end' => 'justify-content-md-end',
        'justify-content-md-around'=> 'justify-content-md-around',
        'justify-content-md-between' => 'justify-content-md-between',
    ];

	public function init()
	{
		parent::init();
        $this->_options['class'] = "row {$this->_config['gutter']} {$this->_config['justify']} {$this->_config['align']}";
		ob_start();
	}

	public function codes()
	{
		$content = ob_get_clean();

		$this->htm = HTML::tag('div', $content, $this->_options);
		
	}


}
