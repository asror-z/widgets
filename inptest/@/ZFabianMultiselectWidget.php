<?php

/**
 *
 * class ZFabianMultiselectWidget
 *
 * https://fabianlindfors.se/multijs/
 * https://github.com/fabianlindfors/multi.js
 *
 * created:  Nigoraxon G'aniyeva
 * refactored:
 */

namespace zetsoft\widgets\inptest;


use zetsoft\system\kernels\ZWidget;

class ZFabianMultiselectWidget extends ZWidget
{
    /**
     * Configuration
     */
    public $config = [];
    public $_config = [
        'name' => ''
    ];


    /**
     *
     * Plugin Events
     *
     */
    public $event = [];
    public $_event = [

    ];

    public function asset()
    {


        $this->fileCss('https://cdnjs.cloudflare.com/ajax/libs/multi.js/0.5.1/multi.min.css');
        $this->fileJs('https://cdnjs.cloudflare.com/ajax/libs/multi.js/0.5.1/multi.min.js');
    }


    public function codes()
    {
        {
            $arr = '';
            $counter = 0;

            $items = [
                [
                    'name' => 'Apple',
                ],
                [
                    'name' => 'Banana',
                ],
                [
                    'name' => 'Blueberry',
                ],
                [
                    'name' => 'Cherry',
                ],
                [
                    'name' => 'Coconut',
                ],

            ];
            $arr .= <<<HTML
          <select multiple="multiple" name="favorite_fruits" id="fruit_select">
          
HTML;
            foreach ($items as $item) {

                $arr .= <<<HTML
           <option> {$item['name']}</option>
      
        <hr>

        
HTML;
                $counter++;
            }
            $arr .= <<<HTML
        </select>
        
HTML;
            $this->htm .= <<<HTML
    <div class="MultiSelect">
            <i class="icon-prefix prefix fa fa-eye"></i>
                    {$arr}
            </div>
HTML;

            $this->htm .= <<<HTML

HTML;


           $this->css = <<<css

            .MultiSelect {
                max-width: 500px;
                padding: 0 20px;
            }
css;

            $this->js = <<<js
var select = document.getElementById( 'fruit_select' );
			multi(select, {
            "enable_search": true,
            "search_placeholder": "Search...",
            "non_selected_header": null,
            "selected_header": null,
            "limit": -1,
            "limit_reached": function () {},
});
js;


        }
    }
}
