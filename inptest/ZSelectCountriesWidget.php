<?php

/*
 * /https://github.com/Lokeseshwari/SelectCountry
 * / asset silka
 */

namespace zetsoft\widgets\inptest;

use zetsoft\system\kernels\ZWidget;


class ZSelectCountriesWidget extends ZWidget
{

    public $config = [];
    public $_config = [
        'responsiveDropdown' => false,
        'icon' => '',
        'multiple' => true,

    ];

    public function asset()
    {
//        $this->fileCss('/publish/yarner/country-select-js/build/css/countrySelect.css');
//        $this->fileCss('/publish/yarner/country-select-js/build/css/asset.css');
//        $this->fileJs('/publish/yarner/country-select-js/src/js/countrySelect.js');
        $this->fileCss('https://cdn.jsdelivr.net/npm/country-select-js@2.0.1/build/css/countrySelect.css');
        $this->fileCss('https://cdn.jsdelivr.net/npm/country-select-js@2.0.1/build/css/asset.css');
        $this->fileJs('https://cdn.jsdelivr.net/npm/country-select-js@2.0.1/src/js/countrySelect.js');
    }


    public $layout = [];
    public $_layout = [
        'main' => <<<HTML
              
              <span>{getIcon}</span> 
           <input type="text" class="form-control" {class} id="{id}" name="{modelClass}[{attribute}][]" value="{value}"><span></span><span>{place}</span>
            
HTML,
        'icon' => <<<HTML
          <i class="icon-prefix prefix {icon}"></i>
 
HTML,
        'jsCode' => <<<JS
   $("#{id}").countrySelect({
                defaultCountry: "",   // str uz
                onlyCountries: undefined,    // arr ['uz','kz','ru'],
                excludeCountries: ['uz','kz','ru'],
                preferredCountries: ['uz','kz','ru'],
                responsiveDropdown: {responsiveDropdown},  // size
                multiple: true,
            });
JS,
        'place' => <<<HTML
        {placeholder}
HTML,
    ];

    public function codes()
    {
        $getIcon = '';
        if ($this->_config['hasIcon'] == true) {
            $getIcon = $this->htm .= strtr($this->_layout['icon'], [

                '{icon}' => $this->_config['icon'],

            ]);
        } else {
            $getIcon = '';
        }


        $getPlace = '';
        if ($this->_config['hasPlace']) {
            $getPlace = strtr($this->_layout['place'], [
                '{placeholder}' => $this->_config['placeholder'],
            ]);
        }


        $this->htm = strtr($this->_layout['main'], [
            '{id}' => $this->id,
            '{value}' => $this->value,
            '{modelClass}' => $this->modelClassName,
            '{attribute}' => $this->attribute,
            '{placeholder}' => $this->_config['placeholder'],
            '{multiple}' => $this->jscode($this->_config['multiple']),
            '{class}' => $this->_config['class'],
            '{getIcon}' => $getIcon,
            '{place}' => $getPlace,

        ]);

        $this->js = strtr($this->_layout['jsCode'], [
            '{id}' => $this->id,
            '{responsiveDropdown}' => $this->jscode($this->_config['responsiveDropdown']),
        ]);

    }

}
