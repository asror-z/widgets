<?php

namespace zetsoft\widgets\inputes;

use kartik\tree\TreeViewInput;
use kartik\tree\TreeView;
use zetsoft\models\test\TestTreeAvto;
use zetsoft\models\test\TreeAvto;
use zetsoft\system\kernels\ZWidget;

/**
 * @author NurbekMakhmudov
 *
 * https://demos.krajee.com/tree-manager
 * https://demos.krajee.com/tree-manager-demo/tree-view
 */
class ZKTreeViewWidget extends ZWidget
{
    public $_config = [
        'query' => '',
        'headingOptions' => ZKTreeViewWidget::headingOptions,
        'rootOptions' => ZKTreeViewWidget::rootOptions,
        'topRootAsHeading' => true,
        'fontAwesome' => true,
        'isAdmin' => true,
        'options'=>ZKTreeInputWidget::options,

        'iconEditSettings'=> [
            'show' => 'list',
            'listData' => [
                'folder' => 'Folder',
                'file' => 'File',
                'mobile' => 'Phone',
                'bell' => 'Bell',
            ]
        ],
        'softDelete' => true,
        'cacheSettings' => ['enableCache' => true]
    ];

    /**
     * Configuration
     */
    public $config = [];

    public const headingOptions = [
        'label' => 'Store'
    ];

    public const rootOptions = [
        'label'=>'<span class="text-primary">Products</span>',
    ];

    public const options = [
        'label'=>'Products',     // custom root label
    ];

    /**
     * Tree Plugin Events
     * https://demos.krajee.com/tree-manager#tree-plugin-events
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

       $this->htm = Tree::find()->addOrderBy('root, lft');

    }

}

