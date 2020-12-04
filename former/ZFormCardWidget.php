<?php

/**
 *
 *
 * Author:  Asror Zakirov
 * Date:    06.06.2019
 * https://www.linkedin.com/in/asror-zakirov
 * https://www.facebook.com/asror.zakirov
 * https://github.com/asror-z
 *
 *
 *
 */

namespace zetsoft\widgets\former;

use rmrevin\yii\fontawesome\FA;
use zetsoft\models\user\UserBlocked;
use zetsoft\system\assets\ZColor;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\inputes\ZInputLatinWidget;
use zetsoft\widgets\market\ZHotOfferWidget;
use zetsoft\widgets\themes\ZCardWidget;
use zetsoft\widgets\themes\ZColWidget;
use zetsoft\widgets\themes\ZRowWidget;
use zetsoft\widgets\themes\ZVenCardWidget;

class ZFormCardWidget extends ZWidget
{
    /**
     * Configuration
     */
    public $config = [];
    public $_config = [
        'title' => 'Title',
        'cardType' => ZCardWidget::type['dynCard'],
        'formType' => ZFormWidget::type['block'],
        'ident' => 0,
        'form' => null,
    ];

    /**
     *
     * Wrapping with Cards
     * @throws \Exception
     */
    public function codes()
    {

        ZCardWidget::begin([
            'config' => [
                'title' => $this->config['title'],
                'type' => $this->_config['cardType'],
            ]
        ]);
        echo ZFormWidget::widget([
            'model' => $this->model,
            'form' => $this->config['form'],
            'config' => [
                'type' => $this->_config['formType'],
                'ident' => $this->config['ident'],
                'topBtn' => false,
                'botBtn' => false,
            ]
        ]);
        ZCardWidget::end();

    }

    //Generate CardWidget with FromWidget

}
