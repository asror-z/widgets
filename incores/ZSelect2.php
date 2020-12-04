<?php

/**
 *
 *
 * Author:  Asror Zakirov
 * https://www.linkedin.com/in/asror-zakirov
 * https://github.com/asror-z
 *
 */

namespace zetsoft\widgets\incores;


use kartik\base\Config;
use kartik\select2\Select2;
use zetsoft\system\helpers\ZHTML;

class ZSelect2 extends Select2
{

  

    public function registerAssets()
    {
        if (!CLI)
            parent::registerAssets();
    }


}
