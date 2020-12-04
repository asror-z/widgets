<?php

/**
 *
 *
 * Author:  Asror Zakirov
 * https://www.linkedin.com/in/asror-zakirov
 * https://www.facebook.com/asror.zakirov
 * https://github.com/asror-z
 *
 */

namespace zetsoft\widgets\former;


use zetsoft\former\auth\AuthLoginForm;
use zetsoft\system\assets\ZColor;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZHTML;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\navigat\ZButtonWidget;

class ZLoginWidget extends ZWidget
{

    public $config = [];
    public $_config = [];

    /*
     * Layouts
     * */
    public $layout = [];
    public $_layout = [];


    public function codes()
    {
        $loginForm = new AuthLoginForm();

        if ($this->formModel($loginForm) === true) {

            if (Az::$app->cores->auth->login($loginForm)) {

                $this->urlRedirect('/shop/admin/core-product/index.aspx');
            }
        }


        $form = $this->activeBegin();

        echo ZFormWidget::widget([
            'model' => $loginForm,
            'form' => $form,
            'config' => [
                'topBtn' => false,
                'botBtn' => false,
            ]
        ]);

        echo ZButtonWidget::widget([
            'id' => 'copy-stacktrace',
            'config' => [
                'hasIcon' => true,
                'btnType' => ZButtonWidget::btnType['link'],
                'btnRounded' => false,
                'btnFloating' => true,
                'icon' => 'fab fa-github',
                //'title' => 'Перейти на главную',
                'color' => ZColor::gradient['mean-fruit-gradient'],
                'url' => '/cores/auth/oauth.aspx?service=github',
                'blank' => false,
                'target' => ZButtonWidget::target['_self'],
                'iconColor' => '#ffffff',
                'title' => 'github'
            ],
        ]);
        echo ZHTML::submitButton(Az::l('Вход в систему'), [
            'class' => 'btn btn-success'
        ]);
        $this->activeEnd();
    }
}
