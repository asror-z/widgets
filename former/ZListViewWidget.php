<?php
/**
 * Created by PhpStorm.
 * User: Odilov Shukurullo
 * Date: 04.06.2019
 * Time: 14:29
 *
 * @Docs: https://www.yiiframework.com/doc/api/2.0/yii-widgets-listview
 */

namespace zetsoft\widgets\former;

use yii\data\ActiveDataProvider;
use yii\data\ArrayDataProvider;
use yii\data\Pagination;
use yii\data\Sort;
use zetsoft\dbitem\data\Form;
use zetsoft\system\Az;
use zetsoft\system\column\ZLinkPager;
use zetsoft\system\column\ZPagination;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\sorter\ZLinkSorterWidget;
use yii\widgets\ListView;

/**
 * @author Odilov Shukurullo
 * refactored: by Daho
 *
 */
class ZListViewWidget extends ZWidget
{


    public $provider;

    public $config = [];
    public $_config = [

        // BaseList View public variables
        'type' => self::type['item'],
        'pager' => [
            'class' => ZLinkPager::class,

        ],
        'sorter' => [], // array,
        'summary' => null,
        'summaryOptions' => ['class' => 'summary'],
        'showOnEmpty' => false,
        'emptyText' => '',
        'emptyTextOptions' => [],
        'layout' => "{sorter}{summary}\n{items}\n{pager}",

        // List View public variables

        'itemOptions' => ['class' => 'item'],
        'itemView' => null,
        'viewParams' => [],
        'separator' => "\n",
        'options' => ['class' => 'list-view'],
        'beforeItem' => null,
        'afterItem' => null,

        // additional configs

        'pageSize' => 2,
        'page' => 1,
        'attributes' => [],
        
    ];

    public const type = [
        'item' => 'item',
        'form' => 'form',
        'model' => 'model',
    ];


    public function codes()
    {
        if ($this->_config['type'] !== self::type['item']) {
            $attributes = [];
            /** @var Form $column */
            foreach ($this->model->columns as $key => $column) {
                if ($column->sort) {
                    $attributes[$key] = [
                        'label' => $column->title
                    ];
                }
            }
        } else{
            $attributes = $this->_config['attributes'];
        }
            $sort = new Sort([
                'attributes' => $attributes,
                'enableMultiSort' => true,
            ]);

            if (empty($this->_config['sorter'])) {
                $this->_config['sorter'] = [
                    'class' => ZLinkSorterWidget::class,
                    'sort' => $sort,
                    'config' => [
                        'wrapperTag' => 'span', // default: li
                        'linkOptions' => ['class' => 'primary m-2'],
                        'clearLinkConfigs' => [
                            'options' => ['class' => 'text-danger m-2'], // html options for Clear link
                        ],
                    ],
                ];
            }

        switch ($this->_config['type']) {
            case self::type['model']:
            {
                $this->model->search = true;
                $this->provider = $this->model->search();
                break;
            }
            case self::type['form']:

                $this->provider = $this->model->searchForm($this->data);
                break;

            case self::type['item']:
            {
                $this->provider = new ArrayDataProvider([
                    'allModels' => $this->data,
                    'pagination' => new Pagination([
                        'pageSize' => $this->_config['pageSize'],
                        'page' => $this->_config['page']
                    ])
                ]);
            }
        }


        //$this->provider->setPagination(['pageSize' => $this->_config['pageSize']]);

        $this->provider->sort = $sort;

        $options['dataProvider'] = $this->provider;
        $options['options'] = $this->_config['options'];
        $options['pager'] = $this->_config['pager'];
        $options['sorter'] = $this->_config['sorter'];
        $options['summary'] = $this->_config['summary'];
        $options['summaryOptions'] = $this->_config['summaryOptions'];
        $options['showOnEmpty'] = $this->_config['showOnEmpty'];
        $options['emptyText'] = $this->_config['emptyText'];
        $options['emptyTextOptions'] = $this->_config['emptyTextOptions'];
        $options['layout'] = $this->_config['layout'];
        $options['itemOptions'] = $this->_config['itemOptions'];
        $options['itemView'] = $this->_config['itemView'];
        $options['viewParams'] = $this->_config['viewParams'];
        $options['separator'] = $this->_config['separator'];
        $options['itemView'] = $this->_config['itemView'];
        $options['beforeItem'] = $this->_config['beforeItem'];
        $options['afterItem'] = $this->_config['afterItem'];

        $this->htm = ListView::widget($options);
    }

}

