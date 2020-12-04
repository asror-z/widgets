<?php
/*
 * Created By: Shahzod Gulomqodirov
 * */

namespace zetsoft\widgets\market;

use zetsoft\former\auth\AuthRegisterForm;
use zetsoft\system\assets\ZColor;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\helpers\ZHTML;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\former\ZFormWidget;
use zetsoft\widgets\iconers\ZAuthIconWidget;
use zetsoft\widgets\navigat\ZButtonWidget;

class ZSigninWidget extends ZWidget
{

    public $config = [];
    public $_config = [

    ];

    /*
     * Events
     * */
    public $event = [];
    public $_event = [

    ];

    /*
     * Layouts
     * */
    public $layout = [];
    public $_layout = [

        'main' => <<<HTML

            

            <!-- Material form login -->
            <div class="card">

                <h5 class="card-header success-color white-text text-center py-4">
                    <strong>Sign in</strong>
                </h5>

                <!--Card content-->
                <div class="card-body px-lg-5 pt-0">

                    <!-- Form -->
                    <form class="text-center" style="color: #757575;" action="#!">

                        <!-- Email -->
                        <div class="md-form">
                            <input type="email" id="materialLoginFormEmail" class="form-control">
                            <label for="materialLoginFormEmail">E-mail</label>
                        </div>

                        <!-- Password -->
                        <div class="md-form">
                            <input type="password" id="materialLoginFormPassword" class="form-control">
                            <label for="materialLoginFormPassword">Password</label>
                        </div>

                        <div class="d-flex justify-content-around">
                            <div>
                                <!-- Remember me -->
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="materialLoginFormRemember">
                                    <label class="form-check-label" for="materialLoginFormRemember">Remember me</label>
                                </div>
                            </div>
                            <div>
                                <!-- Forgot password -->
                                <a href="">Forgot password?</a>
                            </div>
                        </div>

                        <!-- Sign in button -->
                        <button class="btn btn-outline-success btn-rounded btn-block my-4 waves-effect z-depth-0" type="submit">Sign in</button>

                        <!-- Register -->
                        <p>Not a member?
                            <a href="">Register</a>
                        </p>

                        <!-- Social login -->
                        <!--<p>or sign in with:</p>
                        <a type="button" class="btn-floating btn-fb btn-sm">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a type="button" class="btn-floating btn-tw btn-sm">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a type="button" class="btn-floating btn-li btn-sm">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                        <a type="button" class="btn-floating btn-git btn-sm">
                            <i class="fab fa-github"></i>
                        </a> */-->

                        <?php
                            echo ZAuthIconWidget::widget();
                        ?>

                    </form>
                    <!-- Form -->

                </div>

            </div>
            <!-- Material form login -->

HTML,
    ];


    public function asset()
    {

    }

    public function codes()
    {
        $form = $this->activeBegin();
        $model = new AuthRegisterForm();

        $action->icon =false;
        $action->type = WebItem::type['html'];

        $model->configs->nameOn = [
            'name',
            'email',
            'role'
        ];
        echo ZFormWidget::widget([
            'model' => $model,
            'form' => $form,
            'config' => [
                'topBtn' => false,
                'botBtn' => false,
            ],
        ]);

        $this->activeEnd();

        $this->htm .= strtr($this->_layout['main'], [
        ]);
    }
}
