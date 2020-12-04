<?php

/**
 *
 *
 * Author:  Asror Zakirov
 * https://www.linkedin.com/in/asror-zakirov
 * https://github.com/asror-z
 *
 */

namespace zetsoft\widgets\bozor;


use zetsoft\system\kernels\ZWidget;

class ZRegModal extends ZWidget
{
    public $config = [];
    public $_config = [
    ];

    public $event = [];
    public $_event = [
    ];

    public $layout = [];
    public $_layout = [
        'main' => <<<HTML
               <div class="modal-wrapper">
    <button class="modal-wrapper__close" type="button" data-qa="undefined-close">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 12 12">
            <path fill="#CCC" fill-rule="nonzero"
                  d="M7.019 6l4.638 4.638a.72.72 0 1 1-1.019 1.019L6 7.019l-4.638 4.638a.72.72 0 1 1-1.019-1.019L4.981 6 .343 1.362A.72.72 0 1 1 1.362.343L6 4.981 10.638.343a.72.72 0 1 1 1.019 1.019L7.019 6z"></path>
        </svg>
    </button>
    <div>
        <div class="auth-modal__content auth-modal__content--top auth-modal__content--with-bottom">
            <div class="auth-modal__tabs">
                <button type="button" class="auth-modal__tab auth-modal__tab--active" id="sign_in_user">Вход</button>
                <button type="button" class="auth-modal__tab" id="sign_up_user">Регистрация</button>
            </div>
            {sign_in}
            {sign_up}
            {reg_btn}
        </div>

    </div>
</div>
HTML,

        'sign_in' => <<<HTML
            <form novalidate="" class="auth-modal__form" id="sign_in">
                <input type="hidden" name="authenticity_token" value="zZ6E83i11chxUvaYHfu/kVTTa8edGOAVIgSRVDDDZN0=">
                <div>
                    <div class="auth-input">
                        <div class="auth-input__container">
                            <input class="auth-input__control auth_input__label auth-input__control--empty" name="email"
                                                type="email" value="" placeholder="Электронная почта">
                            <div class="auth-input__icons"></div>
                        </div>
                        <div class="auth-input__error"></div>
                    </div>
                    <div class="auth-input">
                        <div class="auth-input__container"><input
                                class="auth-input__control auth_input__label auth-input__control--empty" name="password" type="password" placeholder="Пароль"
                                value="">
                            <div class="auth-input__icons">
                                <svg xmlns="http://www.w3.org/2000/svg" class="auth-input__icon-eye">
                                    <path fill="#000" fill-rule="evenodd"
                                          d="M0 5c1.845-3.04 4.742-5 8-5s6.155 1.96 8 5c-1.845 3.04-4.742 5-8 5S1.845 8.04 0 5zm8 3a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm0-2a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="auth-input__error"></div>
                    </div>
                    <div class="auth-modal__checkbox-wrapper">
                        <div class="checkbox">
                        <input type="hidden" class="checkbox__input" name="rememberMe"
                                                     value="true"><label
                                class="checkbox__label checkbox__label--active">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 11 9" class="checkbox__check">
                                <path fill="#FFF" fill-rule="nonzero" transform="translate(-4 -5)"
                                      d="M8.436 11.894L13.1 5.556a.75.75 0 1 1 1.208.888l-5.15 7a.75.75 0 0 1-1.101.117L4.502 10.41a.75.75 0 1 1 .996-1.122l2.938 2.607z"></path>
                            </svg>
                            <span>Запомнить меня</span>
                            <div class="checkbox__error"></div>
                        </label></div>
                        <div class="auth-modal__forgotten">Забыли пароль?</div>
                    </div>       
                </div>
            </form>
HTML,

        'sign_up' => <<<HTML
            <form novalidate="" class="auth-modal__form" id="sign_up" style="display: none;">
                <input type="hidden" name="authenticity_token" value="zZ6E83i11chxUvaYHfu/kVTTa8edGOAVIgSRVDDDZN0=">
                <div>
                    <div class="auth-input">
                        <div class="auth-input__container"><label class="auth-input__label">Электронная
                            почта</label>
                            <input class="auth-input__control auth-input__control--empty" name="email"
                                                type="email" value="">
                            <div class="auth-input__icons"></div>
                        </div>
                        <div class="auth-input__error"></div>
                    </div>
                    <div class="auth-input">
                        <div class="auth-input__container"><label class="auth-input__label">Пароль</label><input
                                class="auth-input__control auth-input__control--empty" name="password" type="password"
                                value="">
                            <div class="auth-input__icons">
                                <svg xmlns="http://www.w3.org/2000/svg" class="auth-input__icon-eye">
                                    <path fill="#000" fill-rule="evenodd"
                                          d="M0 5c1.845-3.04 4.742-5 8-5s6.155 1.96 8 5c-1.845 3.04-4.742 5-8 5S1.845 8.04 0 5zm8 3a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm0-2a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="auth-input__error"></div>
                    </div>
                    <div class="auth-input">
                        <div class="auth-input__container"><input
                                class="auth-input__control auth_input__label auth-input__control--empty" name="password" type="password" placeholder="Подтвердить пароль "
                                value="">
                            <div class="auth-input__icons">
                                <svg xmlns="http://www.w3.org/2000/svg" class="auth-input__icon-eye">
                                    <path fill="#000" fill-rule="evenodd"
                                          d="M0 5c1.845-3.04 4.742-5 8-5s6.155 1.96 8 5c-1.845 3.04-4.742 5-8 5S1.845 8.04 0 5zm8 3a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm0-2a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="auth-input__error"></div>
                    </div>
                    <div class="auth-modal__checkbox-wrapper">
                        <div class="checkbox">
                        <input type="hidden" class="checkbox__input" name="rememberMe"
                                                     value="true"><label
                                class="checkbox__label checkbox__label--active">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 11 9" class="checkbox__check">
                                <path fill="#FFF" fill-rule="nonzero" transform="translate(-4 -5)"
                                      d="M8.436 11.894L13.1 5.556a.75.75 0 1 1 1.208.888l-5.15 7a.75.75 0 0 1-1.101.117L4.502 10.41a.75.75 0 1 1 .996-1.122l2.938 2.607z"></path>
                            </svg>
                            <span>Запомнить меня</span>
                            <div class="checkbox__error"></div>
                        </label></div>
                        <div class="auth-modal__forgotten">Забыли пароль?</div>
                    </div>
                    
                </div>
            </form>
HTML,

        'sign_vendor' => <<<HTML
            <form novalidate="" class="auth-modal__form" id="sign_vendor" style="display: none;">
                <input type="hidden" name="authenticity_token" value="zZ6E83i11chxUvaYHfu/kVTTa8edGOAVIgSRVDDDZN0=">
                <div>
                    <div class="auth-input">
                        <div class="auth-input__container"><label class="auth-input__label">Электронная
                            почта</label>
                            <input class="auth-input__control auth-input__control--empty" name="email"
                                                type="email" value="">
                            <div class="auth-input__icons"></div>
                        </div>
                        <div class="auth-input__error"></div>
                    </div>
                    <div class="auth-input">
                        <div class="auth-input__container"><label class="auth-input__label">Пароль</label><input
                                class="auth-input__control auth-input__control--empty" name="password" type="password"
                                value="">
                            <div class="auth-input__icons">
                                <svg xmlns="http://www.w3.org/2000/svg" class="auth-input__icon-eye">
                                    <path fill="#000" fill-rule="evenodd"
                                          d="M0 5c1.845-3.04 4.742-5 8-5s6.155 1.96 8 5c-1.845 3.04-4.742 5-8 5S1.845 8.04 0 5zm8 3a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm0-2a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="auth-input__error"></div>
                    </div>
                    <div class="auth-modal__checkbox-wrapper">
                        <div class="checkbox">
                        <input type="hidden" class="checkbox__input" name="rememberMe"
                                                     value="true"><label
                                class="checkbox__label checkbox__label--active">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 11 9" class="checkbox__check">
                                <path fill="#FFF" fill-rule="nonzero" transform="translate(-4 -5)"
                                      d="M8.436 11.894L13.1 5.556a.75.75 0 1 1 1.208.888l-5.15 7a.75.75 0 0 1-1.101.117L4.502 10.41a.75.75 0 1 1 .996-1.122l2.938 2.607z"></path>
                            </svg>
                            <span>Запомнить меня</span>
                            <div class="checkbox__error"></div>
                        </label></div>
                        <div class="auth-modal__forgotten">Забыли пароль?</div>
                    </div>
                    
                </div>
            </form>
HTML,

        'reg_btn' => <<<HTML
                    <button class="auth-modal__button--login button_27Rk2 button_3DPxY button_67_Eh button_1gP6z button_2VujQ"
                            type="submit">Войти
                    </button>
                    <div class="auth-modal__separator">
                        <div class="auth-modal__separator-line"></div>
                        или
                        <div class="auth-modal__separator-line"></div>
                    </div>
                    <button class="sberbank_button_3CHZk button_27Rk2 button_3DPxY button_67_Eh button_1gP6z button_2VujQ"
                            type="button">
                        <svg viewBox="0 0 23 23" class="sberbank_button_35ecI">
                            <g transform="translate(58.42 11)">
                                <circle fill="none" cx="-46.9" cy="0.5" r="11"></circle>
                                <path fill-rule="evenodd" clip-rule="evenodd" fill="#fff"
                                      d="M-37.1-4.5c.8 1.6 1.2 3.3 1.2 5 0 6.1-4.9 11-11 11s-11-4.9-11-11v-.7l6.7 3.8 14.1-8.1zm-1.4-2c.3.3.5.6.7 1l-13.5 7.7-6.5-3.7.3-1.2 6.2 3.6 12.8-7.4zm-1.8-1.7c.3.3.7.5 1 .8L-51.2-.6-57-3.8c.2-.4.3-.7.5-1.1l5.2 3 11-6.3zm-1-.7l-9.9 5.7-4.6-2.7c.2-.3.5-.6.8-.9l3.9 2.2 8.6-4.9c.3.1.8.4 1.2.6z"></path>
                            </g>
                        </svg>
                        Войти по Vendor
                    </button>
                    <div class="sberbank_button_39xhg">
                        <svg width="9" height="12" viewBox="0 0 9 12" class="sberbank_button_1cI8y">
                            <path fill="#999"
                                  d="#"></path>
                        </svg>
                        Это безопасно и удобно. Ваши данные защищены шифрованием
                    </div>
HTML,

        'css' => <<<CSS
            .auth-modal__tab{
                font-size: 0.8rem!important;
                font-weight: bold!important;
            }
            
CSS,

        'js' => <<<JS
            
              $(document).ready(function() {
                   let tabs=$('.auth-modal__tab');
                   tabs.on('click',function() {
                       if($(this)[0].id==='sign_in_user'){ 
                            $('#sign_in').show();$('#sign_up').hide();
                            $('#sign_in_user').addClass('auth-modal__tab--active') 
                            $('#sign_up_user').removeClass('auth-modal__tab--active')
                       }else{
                            $('#sign_in').hide();$('#sign_up').show();
                            $('#sign_up_user').addClass('auth-modal__tab--active')
                            $('#sign_in_user').removeClass('auth-modal__tab--active') 
                       }
                   })
                   
              })
JS,

    ];

    public function asset()
    {
        $this->fileCss('/render/bozor/@ Pages/page_17_RegModal/demo_files/application_sbermarket-e83066f9.css');
    }

    public function codes()
    {
        $this->htm = strtr($this->_layout['main'], [
            '{sign_in}' => $this->_layout['sign_in'],
            '{sign_up}' => $this->_layout['sign_up'],
            '{sign_vendor}' => $this->_layout['sign_vendor'],
            '{reg_btn}' => $this->_layout['reg_btn'],
        ]);

        $this->js = $this->_layout['js'];
        $this->css = $this->_layout['css'];

    }


}
