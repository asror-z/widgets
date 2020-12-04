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


use kartik\builder\Form;

class ZForm extends Form
{
    protected function registerAssets()
    {
        if (!CLI)
            parent::registerAssets();
    }


}
