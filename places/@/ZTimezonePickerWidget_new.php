<?php

/**
 *
 * Class ZTimeZonePickerWidget
 * Author:  Asror Zakirov
 * https://www.linkedin.com/in/asror-zakirov
 * https://www.facebook.com/asror.zakirov
 * https://github.com/asror-z
 *
 */

namespace zetsoft\widgets\places;


use zetsoft\system\kernels\ZWidget;

/**
 *
 * http://kevalbhatt.github.io/timezone-picker/
 * https://github.com/kevalbhatt/timezone-picker
 *
 * Created By: AzimjonToirov
 * Modifyed by: Javohir Abdufattohov
 */
class ZTimezonePickerWidget_new extends ZWidget
{
    public $config = [];
    public $_config = [

    ];

    public function asset()
    {

        /*
         * YARN
         *
    $this->fileJs('/publish/yarner/moment/min/moment-with-locales.js');
    $this->fileJs('/publish/yarner/moment-timezone/builds/moment-timezone-with-data-2010-2020.min.js');
    $this->fileJs('/publish/yarner/timezone-picker/timezone-picker.js');

                */

        $this->fileJs('https://cdn.jsdelivr.net/npm/moment@2.24.0/min/moment-with-locales.js');
        $this->fileJs('https://cdn.jsdelivr.net/npm/moment-timezone@0.5.28/builds/moment-timezone-with-data.js');
        $this->fileJs('https://cdn.jsdelivr.net/npm/timezone-picker@2.0.0-1/src/TimezonePicker.js');

    }

    public function codes()
    {
        $className = bname($this->model::className());

        $this->htm = <<<HTML
        <div id="map"></div>
        <input type="hidden" name="{$className}[{$this->attribute}][time_zone]" id="MapTimeZone">
        <input type="hidden" name="{$className}[{$this->attribute}][country]" id="MapCountry">
        <input type="hidden" name="{$className}[{$this->attribute}][zone_name]" id="MapZoneName">

HTML;

        $this->css = <<<CSS
    .dropdown-toggle{
        display: block !important; 
    }
CSS;

        $this->js = <<<JS
       $('#map').timezonePicker({
            width: 600,
            height: 250,
            selectBox: true,
            showHoverText: true,
            quickLink: [{
                "ANAT": "ANAT",
                "PST": "PST",
                "MST": "MST",
                "CST": "CST",
                "EST": "EST",
                "IST": "IST",
                "GMT": "GMT",
                "LONDON": "Europe/London",
            }]
        });
        
        var send_val;
        
        var arr = new Array(3);
        
        $('#map').on("map:clicked" , function(){
           var send_val = $('#map').data('timezonePicker').getValue();
           
            arr[0] = send_val[0].timezone;
            arr[1] = send_val[0].zonename;
            arr[2] = send_val[0].country;
       
       console.log(arr);
       console.log(send_val[0].country);
            
           $('#MapTimeZone').val(arr[0]);
           $('#MapCountry').val(arr[1]);
           $('#MapZoneName').val(arr[2]);
           
           
        });
   
JS;

    }
}
