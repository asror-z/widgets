<?php

namespace zetsoft\widgets\animo;

use zetsoft\dbitem\core\WebItem;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use function GuzzleHttp\Psr7\str;
use zetsoft\system\kernels\ZWidget;
use kartik\widgets\Select2;
use yii\web\JsExpression;

/**
 *
 * https://www.linkedin.com/in/asror-zakirov
 * https://www.facebook.com/asror.zakirov
 * https://github.com/asror-z
 *
 * Created By: Asror Zakirov
 * Refactored: Asror Zakirov
 */
class ZSimpleLoaderWidget extends ZWidget
{

    public function asset()
    {
        $this->fileCss('/render/animo/All/assets/loaders/CSS JS/SimpleLoader/loader/css/loading.css');
        $this->fileJs('/render/animo/All/assets/loaders/CSS JS/SimpleLoader/loader/js/loading.js');
    }


    public function codes()
    {

        $this->htm = <<<HTML
    <div id="asrorz_simple_loading" class="simple-loading simple-loading-369"></div>
HTML;

        $this->js = <<<JS
    jQuery(document).on('pjax:end', function () {
        SimpleLoading.stop();
    });

    jQuery(document).ready(function () {
        SimpleLoading.stop();
    });
    
    $('iframe').on('load', () => {
        SimpleLoading.stop();
    })
    
    $(document).ready(() => {
        let allATags = $('a');
        $(allATags).click(function () {
            if ($(this).hasClass('zLoader')) {
                SimpleLoading.start();
                setTimeout(() => {
                    SimpleLoading.stop();
                }, 3500);
            }
        });
})
    
JS;
    }
}
