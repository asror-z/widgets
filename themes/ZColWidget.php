<?php

/**
 *
 *
 * Author:  Asror Zakirov
 * Refactored: AzimjonToirov
 * https://getbootstrap.com/
 *
 */

namespace zetsoft\widgets\themes;


use yii\bootstrap\Html;
use zetsoft\system\kernels\ZWidget;

class ZColWidget extends ZWidget
{
    public $config = [];
    public $_config = [
        'width' => 3,
        'prefix' => self::prefix['md'],
        'count' => 4,
    ];

    public const prefix = [
        'none' => '',
        'sm' => '-sm',
        'md' => '-md',
        'lg' => '-lg',
        'lx' => '-lx',
    ];

    public function init()
    {
        parent::init();
        ob_start();
    }

    public function codes()
    {
        $this->options['class'] = "col{$this->_config['prefix']}-{$this->_config['width']} border";
        $this->options['style'] = ['min-height' => '75px'];
        $content = ob_get_clean();
        $column = '';
        for ($i = 0; $i < $this->_config['count']; $i++)
            $column .= HTML::tag('div', $content, $this->options);

        $this->htm = HTML::tag('div', $column, [
            'class' => 'row'
        ]);
    }
}
