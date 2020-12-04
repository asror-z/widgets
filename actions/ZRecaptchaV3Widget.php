<?php

/**
 *
 * Class ZCatcDisplaceWidget
 * http://demos.krajee.com/widget-details/select2
 *
 * Created By: ElnurController Suyunov
 * Refactored: Asror Zakirov;
 * Refactored: Xakimjon Ergashov;
 */

namespace zetsoft\widgets\actions;


use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\inputes\ZKSelect2Widget;


class ZRecaptchaV3Widget extends ZWidget
{


    public $config = [];
    public $_config = [
        'url' => '/render/actions/ZRecaptchaV3Widget/form.aspx',
        'method_type' => ZRecaptchaV3Widget::method_type['post'],
        'site_key' => '6LcDHLwZAAAAAI3W7vkMBOleSFpq5i-TmXHZHfE9',
    ];

    /**
     *
     * Constants
     */

     public const method_type = [
        'post' => 'post',
        'get' => 'get',
     ];



    public $layout = [];
    public $_layout = [

        'main' => <<<HTML
            <script src="https://www.google.com/recaptcha/api.js?render={site_key}"></script>
            <h1>Google reCAPTHA Demo</h1>
            <form id="{id}" action="{url}" method="post">
                <input type="hidden" value="{value}">
                <input type="email" name="email" placeholder="Type your email" size="40"><br><br>
                <textarea name="comment" rows="8" cols="39"></textarea><br><br>
                <input type="submit" name="submit" value="Post comment"><br><br>
            </form>
            
HTML,

        'js' => <<<JS
 // when form is submit
    $('#{id}').submit(function () {
        // we stoped it
        event.preventDefault();
        var email = $('#email').val();
        var comment = $("#comment").val();
        // needs for recaptacha ready
        grecaptcha.ready(function () {
            // do request for recaptcha token
            // response is promise with passed token
            grecaptcha.execute('{site_key}', {action: 'create_comment'}).then(function (token) {
                // add token to form
                $('#{id}').prepend('<input type="hidden" name="g-recaptcha-response" value="' + token + '">');
                $.post("{url}", {email: email, comment: comment, token: token}, function (event) {
                    console.log('result');
                    console.log(result);
                    if (result) {
                        alert('Thanks for posting comment.')
                    } else {
                        alert('You are spammer ! Get the @$%K out.')
                    }
                });
            });
        });
    });
JS

    ];

    public function asset()
    {
        
    }


    public function codes()
    {


        $this->js = strtr($this->_layout['js'], [
            '{id}' => $this->jscode($this->id),
            '{site_key}' => $this->_config['site_key'],
            '{url}' => $this->_config['url'],

        ]);


        $this->htm = strtr($this->_layout['main'], [
            '{id}' => $this->id,
            '{method_type}' => $this->_config['method_type'],
            '{site_key}' => $this->_config['site_key'],
        ]);


    }
}
