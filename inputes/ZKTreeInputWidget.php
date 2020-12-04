<?php

namespace zetsoft\widgets\inputes;

use kartik\tree\TreeViewInput;
use zetsoft\system\kernels\ZWidget;

/**
 *
 *
 * Author:  Asror Zakirov
 * https://www.linkedin.com/in/asror-zakirov
 * https://www.facebook.com/asror.zakirov
 * https://github.com/asror-z
 *
 * CreatedBy: Javohir Abdufattokhov
 *
 * https://demos.krajee.com/tree-manager
 * https://demos.krajee.com/tree-manager-demo/tree-view-input
 */

class ZKTreeInputWidget extends ZWidget
{
    /**
     *
     * Configuration
     */
    public $config = [];
    public $_config = [
        'name' => 'kv-product', // input name
        'value' => '1,2',     // values selected (comma separated for multiple select)
        'query' => null,
        'headingOptions'=>ZKTreeInputWidget::headingOptions,
        'rootOptions' => ZKTreeInputWidget::rootOptions,
        'asDropdown' => true,   // will render the tree input widget as a dropdown.
        'multiple' => true,     // set to false if you do not need multiple selection
        'fontAwesome' => true,  // render font awesome icons
        'options'=>ZKTreeInputWidget::options,

    ];

    public const headingOptions = [
        'label' => 'Categories',
    ];

    public const rootOptions = [
        'label'=>'<i class="fa fa-tree"></i>',  // custom root label
        'class'=>'text-success'
    ];

    public const options = [
        'label'=>'<i class="fa fa-tree"></i>',  // custom root label
        'class'=>'text-success'
    ];

    /**
     *
     * Plugin Events
     *
     */
    public $event = [];
    public $_event = [

    ];

    public $layout = [];
    public $_layout = [

    ];

    public function codes()
    {
        $this->options = [
            'name' =>$this->_config['name'], // input name
            'value' => $this->_config['value'],     // values selected (comma separated for multiple select)
            'query' => $this->_config['query'],
            'headingOptions'=>$this->_config['headingOptions'],
            'rootOptions' =>$this->_config['rootOptions'],
            'fontAwesome' => $this->_config['fontAwesome'],  // render font awesome icons
            'asDropdown' =>$this->_config['asDropdown'],   // will render the tree input widget as a dropdown.
            'multiple' =>$this->_config['multiple'],     // set to false if you do not need multiple selection
            'options'=>$this->_config['options'],
        ];

       $this->htm = TreeViewInput::widget($this->options);

    }

}

