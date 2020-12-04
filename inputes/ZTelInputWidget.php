<?php

/**
 *
 *
 * Author:  Asror Zakirov
 * Created by:  Elnur Suyunov
 * Refactored by:  Dilmurod Axmadov
 * https://www.linkedin.com/in/asror-zakirov
 * https://www.facebook.com/asror.zakirov
 * https://github.com/asror-z
 *
 */

namespace zetsoft\widgets\inputes;


use zetsoft\system\kernels\ZWidget;

/**
 * https://github.com/jackocnr/intl-tel-input
 * https://intl-tel-input.com/
 * Class ZTelInputWidget
 * @package zetsoft\widgets\inputes
 */
class ZTelInputWidget extends ZWidget
{


    public $config = [];
    public $_config = [
        'hideClass' => 'hide',
        'errorMap' => ["Invalid number",
            "Invalid country code",
            "Too short",
            "Too long",
            "Invalid number"],
        'autoPlacehol' => 'polite',
        'auto' => 'auto',
        'placeNumType' => "MOBILE",
        'types' => ZTelInputWidget::type['blur'],
        'placeholder' => '',
        'icon' => '',
    ];

    public static $grapes = [
        'enable' => true,
        'icon' => '',
        'image' => '/render/inputes/ZTelInputWidget/image/icon.png',
        'name' => Azl . 'TelInput',
        'title' => Azl . '<b>safasfsa</b><img src="/render/inputes/ZTelInputWidget/image/icon.png"/>',

    ];
    public const type = [
        'blur' => 'blur',
        'countrychange' => 'countrychange'
    ];


    public function asset()
    {
        $this->fileCss('https://cdn.jsdelivr.net/npm/intl-tel-input@16.0.11/build/css/intlTelInput.css');
        $this->fileCss('https://cdn.jsdelivr.net/npm/intl-tel-input@16.0.11/examples/css/isValidNumber.css');
        $this->fileCss('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css');
        $this->fileJs('https://cdn.jsdelivr.net/npm/intl-tel-input@16.0.11/build/js/intlTelInput.js');
        $this->fileJs('https://cdn.jsdelivr.net/npm/intl-tel-input@16.0.11/build/js/intlTelInput-jquery.js');
        $this->fileJs('https://cdn.jsdelivr.net/npm/intl-tel-input@16.0.11/build/js/utils.js');
        $this->fileJs('https://cdn.jsdelivr.net/npm/intl-tel-input@16.0.11/src/js/data.js');
    }


    public function codes()
    {


        $this->layout = [
            'main' => <<<HTML
        <div id="{id}">
        <span>{getIcon}</span>
        <input 
        id="{idApp}"
        name="{name}" 
        type="tel" 
        value="{value}" placeholder="{placeholder}">
        <span id="{id}-val" class="{hideClass}">✓ Valid</span>
        <span id="{id}-hide" class="{hideClass}"></span>
    &nbsp;
    
</div>
HTML,

            'icon' => <<<HTML
          <i class="icon-prefix prefix {$this->_config['icon']}"></i>
HTML,

            'jsoptions' => <<<JS
var jsoptions={
       //staticDefinitionSymbol : '*',
       allowDropdown : true,
       autoHideDialCode : true,
       autoPlaceholder : '{autoPlacehol}',
       customContainer : '',
       customPlaceholder : function(selectedCountryPlaceholder, selectedCountryData) {
    return " " + selectedCountryPlaceholder;
  },
       dropdownContainer : null,
       excludeCountries : [],           
       formatOnDisplay : true,           
       geoIpLookup : function(success, failure) {
         $.get("https://ipinfo.io", function() {}, "jsonp").always(function(resp) {
          var countryCode = (resp && resp.country) ? resp.country : "";
         success(countryCode);
               });
            },           
       hiddenInput : '',           
       initialCountry : '{auto}',           
       localizedCountries : '{}',           
       nationalMode : true,           
       onlyCountries: [],           
       placeholderNumberType : '{placeNumType}',              
      separateDialCode : false,           
};
 var input = document.querySelector("#{idApp}"),
  errorMsg = document.querySelector("#{id}-hide"),
  validMsg = document.querySelector("#{id}-val");
 var errorMap = {errorMap};
 var iti = window.intlTelInput(input, jsoptions);
 var types='{types}';
 var phoneNumber = iti.getNumber();
var reset = function() {
  input.classList.remove("error");
  errorMsg.innerHTML = "";
  errorMsg.classList.add("hide");
  validMsg.classList.add("hide");
};
input.addEventListener('blur', function() {
  reset();
  if (input.value.trim()) {
    if (iti.isValidNumber()) {
      validMsg.classList.remove("hide");
      console.log(iti.getNumber());
    } else {
      input.classList.add("error");
      var errorCode = iti.getValidationError();
      errorMsg.innerHTML = errorMap[errorCode];
      errorMsg.classList.remove("hide");
    }
  }
});
$('#hiddenTelInput').val(iti.getNumber());
console.log(iti.getNumber());
// on keyup / change flag: reset
input.addEventListener('change', reset);
input.addEventListener('keyup', reset);
JS,

            'css' => <<<CSS
        

    
    
CSS,
        ];
        $getIcon = '';
       /*
        if ($this->_config['hasIcon'] = true) {
            $getIcon = $this->htm .= strtr($this->_layout['icon'], [
                '{icon}' => $this->_config['icon'],
            ]);
        } else {
            $getIcon = '';
        }   */

        $getPlace = '';
        if ($this->_config['hasPlace']) {
            $getPlace = $this->_config['placeholder'];
        } else {
            $getPlace = '';
        }

        $this->htm = strtr($this->layout['main'], [
            '{id}' => $this->id,
            '{idApp}' => $this->idApp,
            '{name}' => $this->name,
            '{hideClass}' => $this->_config['hideClass'],
            '{value}' => $this->jscode($this->value),
            '{placeholder}' => $getPlace,
            '{getIcon}' => $getIcon
        ]);


        $this->js = strtr($this->layout['jsoptions'], [
            '{id}' => $this->id,
            '{idApp}' => $this->idApp,
            '{errorMap}' => $this->jscode($this->_config['errorMap']),
            '{hideClass}' => $this->jscode($this->_config['hideClass']),
            '{autoPlacehol}' => $this->jscode($this->_config['autoPlacehol']),
            '{auto}' => $this->jscode($this->_config['auto']),
            '{placeNumType}' => $this->jscode($this->_config['placeNumType']),
            '{types}' => $this->jscode($this->_config['types']),


        ]);

    }

}
