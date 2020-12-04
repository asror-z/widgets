<?php

namespace zetsoft\widgets\audios;

use Codeception\PHPUnit\ResultPrinter\HTML;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use function GuzzleHttp\Psr7\str;
use zetsoft\system\kernels\ZWidget;
use kartik\widgets\Select2;
use yii\web\JsExpression;

/**
 *
 * https://plyr.io/
 * https://github.com/sampotts/plyr
 *
 * Created By: Asror Zakirov
 * Refactored:
 */
class ZPlyrWidget extends ZWidget
{

    /**
     * Configuration
     */
    public $config = [];
    public $_config = [
        'type' => ZPlyrWidget::types['video'],
        'grapes' => true

    ];


    /**
     *
     * Plugin Events
     * https://select2.org/programmatic-control/events
     */
    public $event = [];
    public $_event = [

    ];

    public $layout = [];
    public $_layout = [
        'youtube' => <<<HTML
           <div class="myClass plyr__video-embed" id="{id}">
    <iframe
        src="https://www.youtube.com/watch?v=znzlsYjxy6o"
        allowfullscreen
        allowtransparency
        allow="autoplay"
    ></iframe>
</div>
HTML,
        'audio' => <<<HTML
               <audio class="myClass" id="{id}" controls>
                <source src="https://uzhits.net/music/dl2/2019/12/06/Munisa_Rizayeva_-_Kuch_ber.mp3" type="audio/mp3" />
                <source src="/path/to/audio.ogg" type="audio/ogg" />
            </audio>
HTML,
        'video' => <<<HTML
        <video poster="/path/to/poster.jpg" class="myClass" id="{id}" ' widget='{widget}' playsinline controls {readonly}>
         <source src="https://www.youtube.com/watch?v=NgLVxhNEbn4" type="video/mp4" />
    <track kind="captions" label="English captions" src="/path/to/captions.vtt" srclang="en" default />
</video>
HTML,
        'vimeo' => <<<HTML
 <div class="myClass plyr__video-embed" id="{id}">
    <iframe
        src="https://www.youtube.com/watch?v=znzlsYjxy6o"
        allowfullscreen
        allowtransparency
        allow="autoplay"
    ></iframe>
</div>

HTML,

        'css' => <<<CSS
    .myClass  {
      margin-top: 100px;
      margin-left: 50px;
    }
CSS,
        'js' => <<<JS
           console.log("Test");
JS

    ];


    /**
     *
     * Constants
     */
    public const types = [
        'youtube' => 'youtube',
        'audio' => 'audio',
        'video' => 'video',
        'vimeo' => 'vimeo',

    ];


    public function asset()
    {
        /* $this->fileCss('/publish/yarner/plyr/dist/plyr.css');
         $this->fileJs('/publish/yarner/plyr/dist/plyr.js');*/
        $this->fileCss('https://cdn.jsdelivr.net/npm/plyr@3.5.10/dist/plyr.css');
        $this->fileJs('https://cdn.jsdelivr.net/npm/plyr@3.5.10/dist/plyr.min.js');
    }


    public function codes()
    {
        //  $this->htm = \kartik\select2\Select2::widget($this->options);

        $this->htm = $this->_layout[$this->_config['type']];
        $this->htm .= strtr($this->_layout['audio'], [
            '{id}' => $this->id,
            '{widget}' => $this->dataWidget,
            '{config}' => json_encode($this->_config)
        ]);


        $this->js = strtr($this->_layout['js'], []);

        $this->css = strtr($this->_layout['css'], []);


    }

}
