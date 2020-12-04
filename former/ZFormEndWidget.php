<?php

namespace zetsoft\widgets\former;

use kartik\builder\Form;
use kartik\builder\FormGrid;
use rmrevin\yii\fontawesome\FA;
use zetsoft\dbitem\data\ALLApp;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\kernels\ZWidget;
use zetsoft\system\module\Forms;
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\widgets\themes\ZCardWidget;

/**
 * Class ZFormWidget
 * http://demos.krajee.com/builder-details/form-grid
 */
class ZFormEndWidget extends ZWidget
{

    public static $grapes = [
        'enable' => false
    ];
    
    public function codes()
    {
        $this->activeEnd();
    }

}
