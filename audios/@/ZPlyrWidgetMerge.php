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
class ZPlyrWidgetMerge extends ZWidget
{

    /**
     * Configuration
     */
    public $config = [];
    public $_config = [
        'type' => ZPlyrWidget::type['audio'],
        'posterPath' => 'https://cdn.plyr.io/static/demo/View_From_A_Blue_Moon_Trailer-HD.jpg',
        'controls' => [
            'play-large',
            'play',
            'progress',
            'current-time',
            'mute',
            'volume',
            'captions',
            'settings',
            'pip',
            'airplay',
            'fullscreen'
        ],
        'value' => false,
        'enabled' => true,
        'youtubeUrl' => 'https://www.youtube.com/watch?v=znzlsYjxy6o',
        'audioPath' => 'https://uzhits.net/music/dl2/2019/12/06/Munisa_Rizayeva_-_Kuch_ber.mp3',
        'videoUrl' => 'https://cdn.plyr.io/static/demo/View_From_A_Blue_Moon_Trailer-576p.mp4',
        'vimeoUrl' => 'https://www.youtube.com/watch?v=znzlsYjxy6o',

    ];

    public const type = [
        'youtube' => 'youtube',
        'audio' => 'audio',
        'video' => 'video',
        'vimeo' => 'vimeo',

    ];


    public static $grapes = [
        'width' => '600px',
        'height' => '150px',
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
            <video data-poster='{posterPath}' class='myClass video-plyr' id='video-{id}'  widget='{widget}' playsinline controls>
                 <source src="{videoUrl}" type="video/mp4" />
                    <track kind="captions" label="English captions" src="https://cdn.plyr.io/static/demo/View_From_A_Blue_Moon_Trailer-HD.en.vtt" srclang="en" default />
        </video>
HTML,
        'vimeo' => <<<HTML
 <div class="myClass vimeo-plyr plyr__video-embed" id="vimeo-{id}">
    <iframe
        src="{vimeoUrl}"
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
           
          $(document).ready(function() {
          
          let jk = $('.audio-plyr');

            jk.map((i,item) =>
                $($(item)[0].children[0]).attr('src').length>0?$(item).hide():''
            )
                       
         let players_{id} =  new Plyr.setup('.{type}-plyr', {
                quality: {
                    default: 576,
                    // The options to display in the UI, if available for the source media
                    options: [4320, 2880, 2160, 1440, 1080, 720, 576, 480, 360, 240],
                    forced: false,
                    onChange: null,
                },
                enabled: {enabled},
                title: '',
                debug: false,
                autoplay: false,
                autopause: true,
                playsinline: true,
                seekTime: 10,
                volume: 1,
                muted: false,
                duration: null,
                displayDuration: true,
                invertTime: true,
                toggleInvert: true,
                ratio: null, // The format must be `'w:h'` (e.g. `'16:9'`)
                clickToPlay: true,
                hideControls: true,
                resetOnEnd: false,
                disableContextMenu: true,
                blankVideo: 'https://cdn.plyr.io/static/blank.mp4',
                loadSprite: true,
                    iconPrefix: 'plyr',
                    iconUrl: 'https://cdn.plyr.io/3.6.2/plyr.svg',
                controls: {control},  
                i18n: {
                    restart: 'Restart',
                    rewind: 'Rewind {seektime}s',
                    play: 'Play',
                    pause: 'Pause',
                    fastForward: 'Forward {seektime}s',
                    seek: 'Seek',
                    seekLabel: '{currentTime} of {duration}',
                    played: 'Played',
                    buffered: 'Buffered',
                    currentTime: 'Current time',
                    duration: 'Duration',
                    volume: 'Volume',
                    mute: 'Mute',
                    unmute: 'Unmute',
                    enableCaptions: 'Enable captions',
                    disableCaptions: 'Disable captions',
                    download: 'Download',
                    enterFullscreen: 'Enter fullscreen',
                    exitFullscreen: 'Exit fullscreen',
                    frameTitle: 'Player for {title}',
                    captions: 'Captions',
                    settings: 'Settings',
                    pip: 'PIP',
                    menuBack: 'Go back to previous menu',
                    speed: 'Speed',
                    normal: 'Normal',
                    quality: 'Quality',
                    loop: 'Loop',
                    start: 'Start',
                    end: 'End',
                    all: 'All',
                    reset: 'Reset',
                    disabled: 'Disabled',
                    enabled: 'Enabled',
                    advertisement: 'Ad',
                    qualityBadge: {
                      2160: '4K',
                      1440: 'HD',
                      1080: 'HD',
                      720: 'HD',
                      576: 'SD',
                      480: 'SD',
                    },
          },
                settings: ['captions', 'quality', 'speed'],
                speed: {
                    selected: 1,
                    options: [0.5, 0.75, 1, 1.25, 1.5, 1.75, 2, 4],
                },
                keyboard: {
                    focused: true,
                    global: false,
                },
                urls: {
                    download: null,
                    vimeo: {
                      sdk: 'https://player.vimeo.com/api/player.js',
                      iframe: 'https://player.vimeo.com/video/{0}?{1}',
                      api: 'https://vimeo.com/api/v2/video/{0}.json',
                    },
                    youtube: {
                      sdk: 'https://www.youtube.com/iframe_api',
                      api: 'https://noembed.com/embed?url=https://www.youtube.com/watch?v={0}',
                    },
                    googleIMA: {
                      sdk: 'https://imasdk.googleapis.com/js/sdkloader/ima3.js',
                    },
                },
                listeners: {
                    seek: null,
                    play: null,
                    pause: null,
                    restart: null,
                    rewind: null,
                    fastForward: null,
                    mute: null,
                    volume: null,
                    captions: null,
                    download: null,
                    fullscreen: null,
                    pip: null,
                    airplay: null,
                    speed: null,
                    quality: null,
                    loop: null,
                    language: null,
                },
                selectors: {
                    editable: 'input, textarea, select, [contenteditable]',
                    container: '.plyr',
                    controls: {
                      container: null,
                      wrapper: '.plyr__controls',
                    },
                    labels: '[data-plyr]',
                    buttons: {
                        play: '[data-plyr="play"]',
                        pause: '[data-plyr="pause"]',
                        restart: '[data-plyr="restart"]',
                        rewind: '[data-plyr="rewind"]',
                        fastForward: '[data-plyr="fast-forward"]',
                        mute: '[data-plyr="mute"]',
                        captions: '[data-plyr="captions"]',
                        download: '[data-plyr="download"]',
                        fullscreen: '[data-plyr="fullscreen"]',
                        pip: '[data-plyr="pip"]',
                        airplay: '[data-plyr="airplay"]',
                        settings: '[data-plyr="settings"]',
                        loop: '[data-plyr="loop"]',
                    },
                    inputs: {
                        seek: '[data-plyr="seek"]',
                        volume: '[data-plyr="volume"]',
                        speed: '[data-plyr="speed"]',
                        language: '[data-plyr="language"]',
                        quality: '[data-plyr="quality"]',
                    },
                    display: {
                        currentTime: '.plyr__time--current',
                        duration: '.plyr__time--duration',
                        buffer: '.plyr__progress__buffer',
                        loop: '.plyr__progress__loop', // Used later
                        volume: '.plyr__volume--display',
                    },
                    progress: '.plyr__progress',
                    captions: '.plyr__captions',
                    caption: '.plyr__caption',
                }
            });
            console.log("{enabled}");
            
          })
            
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
        //vdd($this->value);
        //  $this->htm = \kartik\select2\Select2::widget($this->options);


        if ($this->_config['value']) {
            if (is_array($this->value)) {
                foreach ($this->value as $value) {
                    $this->_config['audioPath'] = $value;
                    $this->htm .= strtr($this->_layout[$this->_config['type']], [
                        '{audioPath}' => $this->_config['audioPath'],
                    ]);
                }
            } else {
                $this->_config['audioPath'] = $this->value;
            }
        }
        $isEnabled = null;

        //vd($this->_config['audioPath']);
        if (empty($this->_config['audioPath'])) {
            $this->_config['enabled'] = false;
            //$isEnabled = false;
            //vd('aa');
        }

        $this->htm .= strtr($this->_layout[$this->_config['type']], [
            '{id}' => $this->id,
            '{youtubeUrl}' => $this->_config['youtubeUrl'],
            '{videoUrl}' => $this->_config['videoUrl'],
            '{widget}' => $this->dataWidget,
            '{config}' => json_encode($this->_config),
            '{audioPath}' => $this->_config['audioPath'],
            '{vimeoUrl}' => $this->_config['vimeoUrl']
        ]);

        $idEx = $this->myId();

        $idEx = strtr($idEx, [
            '-' => '_'
        ]);

        $this->js = strtr($this->_layout['js'], [
            '{type}' => $this->_config['type'],
            '{control}' => $this->jscode($this->_config['controls']),
            '{enabled}' => $this->jscode($this->_config['enabled']),
            '{id}' => $idEx
        ]);

        $this->css = strtr($this->_layout['css'], []);


    }

}
