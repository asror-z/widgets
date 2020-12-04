<?php
/**
 * Class ZGoogleWidget
 */
namespace zetsoft\widgets\places;

use zetsoft\system\kernels\ZWidget;
use yii\web\View;

class ZGoogleModalZoir extends ZWidget{
    #region Congif
    /**
     * Configuration
     */
    public $widgetId;
    public $config = [];
    public $_config = [

    ];

    public $_layout = [
        'main' => <<<HTML
            <button class="btn btn-success startBtn" >Start Driving</button>          
            <!--<button onclick="closeWin()">Close "myWindow"</button>-->   
             
HTML,

        'css' => <<<CSS
     
    

CSS,
        'js' => <<<JS
          var myWindow;

    $('.startBtn').on('click',function openWin() {
        myWindow = window.open("/core/tester/asror/main.aspx?path=render/places/ZGoogleWidget/ReadType/navigation/navigationZoir3.php", "myWindow", "width=400,height=500");
        
    });

    function closeWin() {
        myWindow.close();
    }

JS,


    ];

    public function asset()
    {
        $this->fileJs('https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.4.0/bootbox.min.js', View::POS_END);
        $this->fileCss('\render\places\ZGoogleWidget\asset\main\css\style.css');
    }


    public function codes(){
        $this->htm = strtr($this->_layout['main'], [
           
        ]);

        $this->css = $this->_layout['css'];


        $this->js = strtr($this->_layout['js'], [

        ]);
    }
}

