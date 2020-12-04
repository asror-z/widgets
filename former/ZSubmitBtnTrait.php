<?php
/**
 *
 *
 * Author:  Asror Zakirov
 * Date:    9/17/2019
 * https://www.linkedin.com/in/asror-zakirov
 * https://www.facebook.com/asror.zakirov
 * https://github.com/asror-z
 *
 */

namespace zetsoft\widgets\former;

use rmrevin\yii\fontawesome\FA;
use zetsoft\system\helpers\ZHTML;
use zetsoft\widgets\navigat\ZButtonWidget;

trait ZSubmitBtnTrait
{

    protected function submit()
    {
        if (!$this->_config['submitBtn'])
            return false;

        echo ZButtonWidget::widget([
            'id' => $this->id,
            'config' => [
                'btnType' => ZButtonWidget::btnType['submit'],
                'text' => 'сохранить',
                'icon' => 'fa fa-'.FA::_SAVE,
                'btnStyle' => ZButtonWidget::btnStyle['btn-primary'],
                'btnRounded' => false,

            ],
            'event' => [
                'click' => ''
            ]
        ]);
        return true;
    }
}
