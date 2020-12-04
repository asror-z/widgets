<?php

/**
 * Created by Navruzov Sergey.
 * Date: 11.06.2019
 * Time: 11:46
 */

namespace zetsoft\widgets\inptest;


use zetsoft\system\kernels\ZWidget;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\web\JsExpression;

/**
 * Class    ZIntlTelWidget
 * @package widgets\inputes
 *
 * docs
 * https://github.com/jackocnr/intl-tel-input
 */
class ZIntlTelWidget extends ZWidget
{

    /**
     * Configuration
     */
    public $config = [];
    public $_config = [

    ];

    /** @var string HTML tag type of the widget input ("tel" by default) */
    public $sHtmlTagType = 'tel';
    /** @var array Default widget options of the HTML tag */
    public $aDefaultOption = ['autocomplete' => "off"];
    /** @var array Options of the JS-widget */

    public $sSelectedCountry = '';


    /**
     *
     * Constants
     */
    public const theme = [
        'default' => 'default',
        'classic' => 'classic',
        'bootstrap' => 'bootstrap',
        'krajee' => 'krajee',
        'krajee-bs4' => 'krajee-bs4',
    ];


    /**
     * autoPlaceholder options
     */
    public const Placholder_Polite = 'polite';
    public const Placholder_Aggressive = 'aggressive';
    public const Placholder_Off = 'off';

    /**
     * placeholderNumberType options
     */
    const Placeholder_Mobile = 'MOBILE';
    const Placeholder_FixedLine = 'FIXED LINE';

    private $_sModelName;


   public function asset() {
   
       $this->fileCss('https://cdn.jsdelivr.net/npm/intl-tel-input@16.0.11/build/css/intlTelInput.css');
       
       $this->fileJs('/publish/yarner/intl-tel-input/build/js/intlTelInput.js');
   }

   public function code() {
        
   }

    protected function _init()
    {
        parent::_init();

        $className = $this->modelClassName;

        $this->_sModelName = bname($className);

        if (isset($this->model->{$this->attribute}['countryCode']) && $this->model->{$this->attribute}['countryCode']) {
            $this->sSelectedCountry = $this->model->{$this->attribute}['countryCode'];
        }
    }



    protected function _js()
    {
        $this->options = [
            'allowDropdown' => true,
            'autoHideDialCode' => true,
            'autoPlaceholder' => self::Placholder_Polite,
            'customContainer' => '',
            'customPlaceholder' => null,
            'dropdownContainer' => null,
            'excludeCountries' => [],
            'formatOnDisplay' => true,
            'geoIpLookup' => null,
            'hiddenInput' => '',
            'initialCountry' => $this->sSelectedCountry,
            'localizedCountries' => [],
            'nationalMode' => true,
            'onlyCountries' => [],
            'placeholderNumberType' => self::Placeholder_Mobile,
            'preferredCountries' => ['us', 'gb'],
            'separateDialCode' => true,
            'utilsScript' => 'build/js/utils.js'
        ];


        $id = ArrayHelper::getValue($this->options, 'id');

        $jsOptions = Json::encode($this->options);

        $this->js = <<<JS
            var telInput = document.querySelector("#$id");
            var iti = window.intlTelInput(telInput, $jsOptions);
            
            telInput.addEventListener("countrychange", function() {
                var countryCode = iti.getSelectedCountryData().iso2;
                var dialCode = iti.getSelectedCountryData().dialCode;
                $(document).find('input[name="{$this->_sModelName}[{$this->attribute}][countryCode]"]').val(countryCode);
                $(document).find('input[name="{$this->_sModelName}[{$this->attribute}][dialCode]"]').val(dialCode);
                console.log('ZIntlTelWidget | countrychange');
            });
            telInput.addEventListener("open:countrydropdown", function() {
                console.log('ZIntlTelWidget | open:countrydropdown');
            });
            telInput.addEventListener("close:countrydropdown", function() {
                console.log('ZIntlTelWidget | close:countrydropdown');
            });
JS;
        /*       $this->registerJs($this->js);*/
    }


    public function codes()
    {
        //init
        $className = $this->modelClassName;

        $this->_sModelName = bname($className);

        if (isset($this->model->{$this->attribute}['countryCode']) && $this->model->{$this->attribute}['countryCode']) {
            $this->sSelectedCountry = $this->model->{$this->attribute}['countryCode'];
        }
        //init
        $id = ArrayHelper::getValue($this->options, 'id');

        $jsOptions = Json::encode($this->options);
        $this->js = <<<JS
        var telInput = document.querySelector("#$id");
            var iti = window.intlTelInput(telInput, $jsOptions);
            
            telInput.addEventListener("countrychange", function() {
                var countryCode = iti.getSelectedCountryData().iso2;
                var dialCode = iti.getSelectedCountryData().dialCode;
                $(document).find('input[name="{$this->_sModelName}[{$this->attribute}][countryCode]"]').val(countryCode);
                $(document).find('input[name="{$this->_sModelName}[{$this->attribute}][dialCode]"]').val(dialCode);
                console.log('ZIntlTelWidget | countrychange');
            });
            telInput.addEventListener("open:countrydropdown", function() {
                console.log('ZIntlTelWidget | open:countrydropdown');
            });
            telInput.addEventListener("close:countrydropdown", function() {
                console.log('ZIntlTelWidget | close:countrydropdown');
            });
JS;


        $options = ArrayHelper::merge($this->aDefaultOption, $this->options);
        if ($this->model) {
            $inputs = '';
            $inputs .= Html::activeInput($this->sHtmlTagType, $this->model, $this->attribute . '[number]', $options);
            $inputs .= Html::activeInput('hidden', $this->model, $this->attribute . '[dialCode]', $options);
            $inputs .= Html::activeInput('hidden', $this->model, $this->attribute . '[countryCode]', $options);
            return $inputs;
        }
        return Html::input($this->sHtmlTagType, $this->name, $this->value, $options);
    }

}
