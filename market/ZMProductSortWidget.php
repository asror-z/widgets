<?php

namespace zetsoft\widgets\market;

use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use function GuzzleHttp\Psr7\str;
use zetsoft\system\kernels\ZWidget;
use kartik\widgets\Select2;
use yii\web\JsExpression;

/**
 * Created By: Ulugbek Mamatkulov
 * Url: /core/tester/asror/main.aspx?path=render/market/ZMProductSortWidget/Sample.php
 */

class ZMProductSortWidget extends ZWidget
{

    /**
     * Configuration
     */
    public $config = [];
    public $_config = [
        'sort-items' => [],
        'sort-label' => 'Сортировка:',
        'default-selected' => 'Без сортировки',
        'found-label' => 'Всего найдено',
        'found-number' => 25
    ];

    /**
     *
     * Plugin Events
     */
    public $event = [];
    public $_event = [];

     public $layout = [];
     public $_layout = [
         'main' => <<<HTML
                <ul class="row list-sort flex-center">
                    <li class="dropdown flex-center">
                        {sort-label}
                        <a class="btn dropdown-toggle btn-border" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {default-selected}
                        </a>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                            {sort-items}
                        </div>
                    </li>
                    <li class="flex-center">
                        {found-label}: {found-number} &nbsp;
                        <button class="btn btn-border">
                            <svg class="bi bi-grid-fill" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M1 2.5A1.5 1.5 0 012.5 1h3A1.5 1.5 0 017 2.5v3A1.5 1.5 0 015.5 7h-3A1.5 1.5 0 011 5.5v-3zm8 0A1.5 1.5 0 0110.5 1h3A1.5 1.5 0 0115 2.5v3A1.5 1.5 0 0113.5 7h-3A1.5 1.5 0 019 5.5v-3zm-8 8A1.5 1.5 0 012.5 9h3A1.5 1.5 0 017 10.5v3A1.5 1.5 0 015.5 15h-3A1.5 1.5 0 011 13.5v-3zm8 0A1.5 1.5 0 0110.5 9h3a1.5 1.5 0 011.5 1.5v3a1.5 1.5 0 01-1.5 1.5h-3A1.5 1.5 0 019 13.5v-3z" clip-rule="evenodd"></path>
                            </svg>
                        </button>
                        <button class="btn">
                            <svg class="bi bi-list list-icon" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M2.5 11.5A.5.5 0 013 11h10a.5.5 0 010 1H3a.5.5 0 01-.5-.5zm0-4A.5.5 0 013 7h10a.5.5 0 010 1H3a.5.5 0 01-.5-.5zm0-4A.5.5 0 013 3h10a.5.5 0 010 1H3a.5.5 0 01-.5-.5z" clip-rule="evenodd"></path>
                            </svg>
                        </button>
                        <button class="btn">
                            <svg class="bi bi-list-ul list-icon" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M5 11.5a.5.5 0 01.5-.5h9a.5.5 0 010 1h-9a.5.5 0 01-.5-.5zm0-4a.5.5 0 01.5-.5h9a.5.5 0 010 1h-9a.5.5 0 01-.5-.5zm0-4a.5.5 0 01.5-.5h9a.5.5 0 010 1h-9a.5.5 0 01-.5-.5zm-3 1a1 1 0 100-2 1 1 0 000 2zm0 4a1 1 0 100-2 1 1 0 000 2zm0 4a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd"></path>
                            </svg>
                        </button>
                    </li>
                </ul>
HTML,
         'css' => <<<CSS
                .list-sort {
                    list-style: none;
                    margin: 0px;
                    padding: 0px;
                    justify-content: space-between;
                }
                .list-icon {
                    font-size: 22px;
                }
                .flex-center {
                    display: flex;
                    align-items: center;
                    padding: 5px;
                }
                .btn-border {
                    border: 1px solid #80808059;
                }
                #dropdownMenuLink {
                    margin-left: 10px;
                }
CSS,];

    /**
     * Constants */
    public function asset()
    {
        $this->fileCss('https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css');
        $this->fileCss('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css');
    }

    public function codes()
    {
        $sort_items = '';
        foreach ($this->_config['sort-items'] as $item) {
            $sort_items .= '<a class="dropdown-item" href="#">' . $item . '</a>';
        }
        $this->htm = strtr($this->_layout['main'],[
            '{sort-items}' => $sort_items,
            '{sort-label}' => $this->_config['sort-label'],
            '{default-selected}' => $this->_config['default-selected'],
            '{found-label}' => $this->_config['found-label'],
            '{found-number}' => $this->_config['found-number']
            ]);
        $this->css = strtr($this->_layout['css'], []);
    }
}
