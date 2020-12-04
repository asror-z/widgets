<?php

/**
 *
 *
 * Author: Asror Zakirov
 * https://www.linkedin.com/in/asror-zakirov
 * https://www.facebook.com/asror.zakirov
 * https://github.com/asror-z
 *
 */

namespace zetsoft\widgets\inputes;

use phpDocumentor\Reflection\Types\Self_;
use zetsoft\service\utility\Views;
use zetsoft\system\kernels\ZWidget;

class ZAwesompleteWidget extends ZWidget
{
    /**
     * https://iqbalfn.github.io/bootstrap-image-checkbox/#
     * https://github.com/iqbalfn/bootstrap-image-checkbox
     * /core/tester/asror/main.aspx?path=render/inputes/ZBootstrapImgCheckboxWidget/active.php
     */
    public $config = [];
    public $_config = [

    ];
    public const type = [
        'checkbox' => 'checkbox',
        'radio' => 'radio'
    ];

    public const content =[
             'hide' => 'none',
             'show' => 'block'
    ];

    public $layout = [];
    public $_layout = [

    'main' => <<<HTML
     <section id="ajax-example">
    <input type="text" id="{id}" value="{value}" name="{name}">
</section>

HTML,

        'js' => <<<JS
        
    function fetchSuggestions(query, cb) {
            $.ajax({
                type: 'GET',
                url: 'https://nominatim.openstreetmap.org/search?q=' +  query + '&format=json',
                success: function (response) {
                    var suggestions = response.map(function (i) {
                        return i.display_name;
                    });

                    cb(suggestions);
                },

            })
        }

        const input = document.getElementById('{id}');
        const awesomplete = new Awesomplete(input);
        input.addEventListener('keyup', function (e) {
            const query = e.target.value;

            if (query.length < 3) {
                return;
            }

            fetchSuggestions(query, function (suggestions) {
                awesomplete.list = suggestions;

                var mark = document.querySelector('li[role=option]');

                if(mark){
                    mark.addEventListener('click', function (e) {
                        let currentText = e.target.innerText;
                        console.log(event.target.innerText);
                    })
                }
            });
        });

JS,
    ];

    public function asset()
    {

        $this->fileJs('https://cdn.jsdelivr.net/npm/awesomplete@1.1.5/awesomplete.min.js');
        $this->fileCss('https://cdn.jsdelivr.net/npm/awesomplete@1.1.5/awesomplete.css');

    }

    public function codes()
    {
        $this->htm = strtr($this->_layout['main'], [
            '{id}' => $this->id,
            '{value}' => $this->value,
            '{name}' =>$this->name

        ]);
        //vdd($this->value);
        $this->js = strtr($this->_layout['js'], [

            '{id}' => $this->id

        ]);
        
    }
}
