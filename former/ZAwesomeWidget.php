<?php

/**
 *
 *
 * @author: Ikramova Zilola
 *
 */

namespace zetsoft\widgets\former;


use zetsoft\system\helpers\ZHTML;
use zetsoft\system\kernels\ZWidget;

/**
 * ZRadioButtonGroup
 * @package widgets\inputes
 * https://getbootstrap.com/docs/4.3/components/button-group/
 */
class ZAwesomeWidget extends ZWidget
{

    public $config = [];
    public $_config = [
        'background'=> "#0f37a9",
        'active_background'=> "rgb(149, 211, 255)",
        'placeholder_color'=> "#97bce0",
        'placeholder_active_color'=> "#0f37a9",
        'option_color'=> "#405463",
        'vertical_padding'=> "15px",
        'horizontal_padding'=> "20px",
        'immersive'=> "false",
    ];




    public $layout=[];
    public $_layout=[
         'html' => <<<HTML

<select id="{id}" name="food_selector" data-placeholder="Select a food to eat">
    <option value="pancakes">Pancakes</option>
    <option value="biscuits">Biscuits</option>
     <option value="more">More to come:)</option>
    
    ...
</select>
HTML,




        'js' => <<<JS
    $(document).ready(function(){
        $('#{id}').awselect({
            background:'{background}', 
            active_background:'{active_background}', 
            placeholder_color:'{placeholder_color}', // the light blue placeholder color
            placeholder_active_color: '{placeholder_active_color}', // the dark blue placeholder color
            option_color:'{option_color}', // the option colors
            vertical_padding: '{vertical_padding}', //top and bottom padding
            horizontal_padding: '{horizontal_padding}', // left and right padding,
            immersive: {immersive} // immersive option, demonstrated at the next example
        });
    });
JS,
    ];

    public function asset()
    {
        $this->fileJs('https://cdn.statically.io/gh/prevwong/awesome-select/dbec93a0/package/js/awselect.min.js');
        $this->fileCss('https://cdn.statically.io/gh/prevwong/awesome-select/dbec93a0/package/css/awselect.min.css');
    }

    public function codes()
    {
        $this->htm = strtr($this->_layout['html'],[
             '{id}'=> $this->id
        ]);

        $this->js = strtr($this->_layout['js'],[
            '{id}'=> $this->id,
            '{background}' => $this->_config['background'],
            '{active_background}' => $this->_config['active_background'],
            '{placeholder_color}' => $this->_config['placeholder_color'],
            '{placeholder_active_color}' => $this->_config['placeholder_active_color'],
            '{option_color}' => $this->_config['option_color'],
            '{vertical_padding}' => $this->_config['vertical_padding'],
            '{horizontal_padding}' => $this->_config['horizontal_padding'],
            '{immersive}' => $this->_config['immersive']
        ]);
    }
}
