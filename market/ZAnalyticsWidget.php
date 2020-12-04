<?php

/**
 *
 *
 * Author:  Asror Zakirov
 * https://www.linkedin.com/in/asror-zakirov
 * https://github.com/asror-z
 *
 */

namespace zetsoft\widgets\market;


use widgets\inptest\ZStarratingWidget;
use zetsoft\dbitem\chat\ReviewItem;
use zetsoft\models\shop\ShopBrand;
use zetsoft\models\user\UserCompany;
use zetsoft\models\user\ChatGroup;
use zetsoft\models\core\CoreInput;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\inputes\ZCKEditorWidget;
use zetsoft\widgets\inputes\ZKStarRatingWidget;


class ZAnalyticsWidget extends ZWidget
{
    public $data = [
    ];

    /**
     * Configuration
     */
    public $config = [];
    public $_config = [

    ];

    public $layout = [];
    public $_layout = [

        'main' => <<<HTML
        <div class="card">
            <div class="card-body" style="padding: 1rem !important;">
                <div class="card-title">Заказы</div>
                {content}
            </div>
        </div>
        

HTML,
        'item' => <<<HTML
        
        <div class="d-flex justify-content-between py-1">
            <div>
                <span class="badge badge-pill fp-10" style="background-color: {color}">&nbsp;</span>

                 <a href="{url}" target="_blank" class="card-link">{status}</a>
            </div>
            <span>{count}</span>
        </div>
             
HTML,

        'status' => <<<HTML
            
HTML,


    ];

    public function codes()
    {

        $content = '';
        foreach ($this->data as $item) {


                $content .= strtr($this->_layout['item'], [
                    '{color}' => $item->color,
                    '{status}' => $item->status,
                    '{count}' => $item->amount,
                    '{url}' => $item->url
                ]);
        }

        $this->htm .= strtr($this->_layout['main'], [
            '{content}' => $content,
        ]);
    }
}
