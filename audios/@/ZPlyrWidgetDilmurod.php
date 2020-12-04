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
class ZPlyrWidgetDilmurod extends ZWidget
{

    /**
     * Configuration
     */
    public $config = [];
    public $_config = [
        'type' => ZPlyrWidgetDilmurod::type['audio'],

        'youtubeUrl' => 'https://www.youtube.com/watch?v=znzlsYjxy6o',
        'audioPath' => 'https://uzhits.net/music/dl2/2019/12/06/Munisa_Rizayeva_-_Kuch_ber.mp3',
        'videoUrl' => 'https://cdn.plyr.io/static/demo/View_From_A_Blue_Moon_Trailer-576p.mp4',

    ];

    public const type = [
        'youtube' => 'youtube',
        'audio' => 'audio',
        'video' => 'video',
        'vimeo' => 'vimeo',

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
           <div class="myClass youtube-plyr plyr__video-embed" id="youtube-{id}">
                <iframe src="{youtubeUrl}"
                    allowfullscreen
                    allowtransparency
                    allow="autoplay">
                </iframe>
            </div>
HTML,
        'audio' => <<<HTML
               <audio class="myClass mt-5 audio-plyr" id="audio-{id}" controls>
                    <source src="{audioPath}" type="audio/mp3" />
               </audio>
HTML,
        'video' => <<<HTML
            <video data-poster='https://cdn.plyr.io/static/demo/View_From_A_Blue_Moon_Trailer-HD.jpg' class='myClass video-plyr' id='video-{id}'  widget='{widget}' playsinline controls>
                 <source src="{videoUrl}" type="video/mp4" />
                    <track kind="captions" label="English captions" src="https://cdn.plyr.io/static/demo/View_From_A_Blue_Moon_Trailer-HD.en.vtt" srclang="en" default />
        </video>
HTML,
        'vimeo' => <<<HTML
 <div class="myClass vimeo-plyr plyr__video-embed" id="vimeo-{id}">
    <iframe
        src="https://www.youtube.com/watch?v=znzlsYjxy6o"
        allowfullscreen
        allowtransparency
        allow="autoplay"
    ></iframe>
</div>

        

HTML,
        'controls' => [
            'play-large',
            'restart',
            'rewind',
            'play',
            'fast-forward',
            'progress',
            'current-time',
            'duration',
            'mute',
            'volume',
            'captions',
            'settings',
            'pip',
            'airplay',
            'download',
            'fullscreen',
        ],


        'css' => <<<CSS
    .myClass  {
      margin-top: 100px;
      margin-left: 50px;
    }
CSS,
        'js' => <<<JS
            const players = new Plyr.setup('.{type}-plyr', {
                controls: {controls},
            });
            console.log("Test");
JS

    ];


    /**
     *
     * Constants
     */


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

        $this->htm = strtr($this->_layout[$this->_config['type']], [
            '{id}' => $this->id,
            '{youtubeUrl}' => $this->_config['youtubeUrl'],
            '{videoUrl}' => $this->_config['videoUrl'],
            '{widget}' => $this->dataWidget,
            '{config}' => json_encode($this->_config),
            '{audioPath}' => $this->_config['audioPath']
        ]);


        $this->js = strtr($this->_layout['js'], [
            '{id}' => $this->id,
            '{type}' => $this->_config['type'],
            '{controls}' =>$this->jscode($this->_layout['controls']),
        ]);

        $this->css = strtr($this->_layout['css'], []);


    }

}
