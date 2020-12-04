<?php
/**
 *
 *
 * Author:  Musoxon Adulkhamidov
 *
 *
 */


namespace zetsoft\widgets\animo;

use rmrevin\yii\fontawesome\FA;
use yii\bootstrap\Html;
use zetsoft\dbitem\chat\FriendItem;
use zetsoft\models\user\UserFriend;
use zetsoft\models\user\User;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\helpers\ZUrl;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\former\ZAjaxWidget;
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\widgets\pjax\ZJqueryPjaxWidget;
use zetsoft\widgets\pjax\ZPjaxWidget;

class ZShepherdWidget extends ZWidget
{

    /**
     * Configuration
     */
    public $isRead = false;
    public $config = [];
    public $_config = [

    ];

    public const type = [];

    public $event = [];
    public $_event = [

    ];
    public $layout = [];
    public $_layout = [

        'friendAll' => <<<HTML
<div class="container-narrow">
    <div class="jumbotron">
        <a class="btn btn-success" href="javascript:void(0);" onclick="javascript:introJs().start();">Show me how</a>
    </div>
    <div class="row-fluid marketing">
        {mainContent}
    </div>
</div>
HTML,
        'mainContent' => <<<HTML
        <div class="span1" data-step="{step}" data-intro="More features, more fun."  data-position='left'>
            {content}
        </div>
HTML,

    ];

    public function asset()
    {
        $this->fileJs('');
        $this->fileCss('');
    }

    public function codes()
    {
        $content = '';
        foreach ($this->data as $key => $item) {
            $key++;
            $content .= strtr($this->_layout['mainContent'], [
                '{content}' => $item,
                '{step}' => $key
            ]);

        }
        $this->htm .= strtr($this->_layout['friendAll'], [
            '{mainContent}' => $content,
        ]);
    }
}
