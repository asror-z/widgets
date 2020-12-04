<?php

namespace zetsoft\widgets\audios;

use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use function GuzzleHttp\Psr7\str;
use zetsoft\system\kernels\ZWidget;
use kartik\widgets\Select2;
use yii\web\JsExpression;

/**
 *
 * https://github.com/sampotts/plyr
 * https://plyr.io/
 *
 * Created By: Zohidjon Ergashev
 * Refactored:
 */
class ZPlayersVideoPlyrWidget extends ZWidget
{

    /**
     * Configuration
     */
    public $config = [];
    public $_config = [
        'type' => ZPlayersVideoPlyrWidget::type['video'],
        'enabled' => true,
        'title' => '',
        'debug' => false,
        'autoplay' => true,
        'autopause' => true,
        'quality' => ZPlayersVideoPlyrWidget::qualitie['576'],
        'displayDuration' => true,
        'hideControls' => true,
        'disableContextMenu' => true,
        'controlsDownload' => true,
        'controls' => [
            self::Control_Airplay,
            self::Control_Mute,
            self::Control_Play,
            self::Control_Play_Large,
           // self::Control_Progress,
        ],
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


    /**
     *
     * Constants
     */
    public const type = [
        'youtube' => 'youtube',
        'vimeo' => 'vimeo',
        'video' => 'video',
        'audio' => 'audio',
    ];

    public const qualitie = [
        '4320' => 4320,
        '2880' => 2880,
        '2160' => 2160,
        '1440' => 1440,
        '1080' => 1080,
        '720' => 720,
        '576' => 576,
        '480' => 480,
        '360' => 360,
        '240' => 240,
    ];



    public const Control_Play_Large = 'play-large';
    public const Control_Restart = 'restart';
    public const Control_Rewind = 'rewind';
    public const Control_Play = 'play';
    public const Control_Fast_Forward = 'fast-forward';
    public const Control_Progres = 'progress';
    public const Control_Current_Time = 'current-time';
    public const Control_Duration = 'duration';
    public const Control_Mute = 'mute';
    public const Control_Volume = 'volume';
    public const Control_Caption = 'captions';
    public const Control_Setting = 'settings';
    public const Control_Pip = 'pip';
    public const Control_Airplay = 'airplay';
    public const Control_Download = 'download';
    public const Control_Fullscreen = 'fullscreen';

    public function asset()
    {
       /* $this->fileCss('/publish/yarner/plyr/dist/plyr.css');
        $this->fileJs('/publish/yarner/plyr/dist/plyr.js');*/
        $this->fileCss('https://cdn.jsdelivr.net/npm/plyr@3.5.10/dist/plyr.css');
        $this->fileJs('https://cdn.jsdelivr.net/npm/plyr@3.5.10/dist/plyr.js');
    }

    public function codes()
    {

        $this->layout = [
            'audio' => <<<HTML
         <audio id="{$this->id}" controls>
    <source src="/slick/mp3.mp3" type="audio/mp3"/>
</audio>
HTML,

            'video' => <<<HTML
       <video poster="/render/images/assets/image/layer5.png" id="{$this->id}" playsinline controls>
       
    <source src="https://v.mover.uz/JRCqSNqm_m.mp4" type="video/mp4" />
</video>

HTML,

            'vimeo' => <<<HTML
      <div id="{$this->id}" data-plyr-provider="vimeo" data-plyr-embed-id="76979871"></div>
HTML,


            'youtube' => <<<HTML
         <div id="{$this->id}" data-plyr-provider="youtube" data-plyr-embed-id="Ob1VG9CoNLM"></div>
HTML

        ];
        //  $this->htm = \kartik\select2\Select2::widget($this->options);
        
        $this->htm .= strtr($this->_layout[$this->_config['type']],[
            
            '{readonly}' => $this->_config['readonly'] ? 'readonly' : '',
        ]);


        $this->js = strtr($this->js, [
            '{enabled}' => $this->jscode($this->_config['enabled']),
            '{autoplay}' => $this->jscode($this->_config['autoplay']),
            '{controls}' => $this->jscode($this->_config['controls']),
        ]);

        // todo: js
        $this->js .= <<<JS
            constdefault = {
        // Disable
        enabled: {enabled},

        // Custom media title
        title: '',

        // Logging to console
        debug: true,

        // Auto play (if supported)
        autoplay: {autoplay},

        // Only allow one media playing at once (vimeo only)
        autopause: true,

        // Allow inline playback on iOS (this effects YouTube/Vimeo-HTML5 requires the attribute present)
        // TODO: Remove iosNative fullscreen option in favour of this (logic needs work)
        playsinline: true,

        // Default time to skip when rewind/fast forward
        seekTime: 10,

        // Default volume
        volume: 1,
        muted: false,

        // Pass a custom duration
        duration: null,

        // Display the media duration on load in the current time position
        // If you have opted to display both duration and currentTime, this is ignore
        displayDuration: true,

        // Invert the current time to be a countdown
        invertTime: true,

        // Clicking the currentTime inverts it's value to show time left rather than elapsed
        toggleInvert: true,
        ratio: null,
        clickToPlay: true,
        hideControls: true,
        resetOnEnd: false,
        disableContextMenu: true,
        loadSprite: true,
        iconPrefix: 'plyr',
        iconUrl: 'https://cdn.plyr.io/3.5.6/plyr.svg',
        blankVideo: '/videos/blank.mp4',
        loop: {
            active: false,
 
        },
        speed: {
            selected: 1,
            options: [0.5, 0.75, 1, 1.25, 1.5, 1.75, 2],
        },
        keyboard: {
            focused: true,
            global: true,
        },
        tooltips: {
            controls: false,
            seek: true,
        },
        captions: {
            active: false,
            language: 'auto',
            update: false,
        },
        fullscreen: {
            enabled: true, // Allow fullscreen?
            fallback: true, // Fallback using full viewport/window
            iosNative: false, // Use the native fullscreen in iOS 
        },
        storage: {
            enabled: true,
            key: 'plyr',
        },
        controls: {controls},
        settings: ['captions', 'quality', 'speed'],
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
        events: [
            'ended',
            'progress',
            'stalled',
            'playing',
            'waiting',
            'canplay',
            'canplaythrough',
            'loadstart',
            'loadeddata',
            'loadedmetadata',
            'timeupdate',
            'volumechange',
            'play',
            'pause',
            'error',
            'seeking',
            'seeked',
            'emptied',
            'ratechange',
            'cuechange',

            // Custom events
            'download',
            'enterfullscreen',
            'exitfullscreen',
            'captionsenabled',
            'captionsdisabled',
            'languagechange',
            'controlshidden',
            'controlsshown',
            'ready',

            // YouTube
            'statechange',

            // Quality
            'qualitychange',

            // Ads
            'adsloaded',
            'adscontentpause',
            'adscontentresume',
            'adstarted',
            'adsmidpoint',
            'adscomplete',
            'adsallcomplete',
            'adsimpression',
            'adsclick',
        ],

        // Advertisements plugin
        // Register for an account here: http://vi.ai/publisher-video-monetization/?aid=plyrio
      /*  ads: {
            enabled: {ads.enabled},
            publisherId: '',
            tagUrl: '',
        },

        // Preview Thumbnails plugin
        previewThumbnails: {
            enabled: {previewThumbnails.enabled},
            src: '',
        },     */

        // Vimeo plugin
        vimeo: {
            byline: false,
            portrait: false,
            title: false,
            speed: true,
            transparent: false,
        },

        // YouTube plugin
        youtube: {
            noCookie: false, // Whether to use an alternative version of YouTube without cookies
            rel: 0, // No related vids
            showinfo: 0, // Hide info
            iv_load_policy: 3, // Hide annotations
            modestbranding: 1, // Hide logos as much as possible (they still show one in the corner when paused)
        },
    };

    const player6 = new Plyr('{$this->id}', defaults);
JS;



        $this->css = <<<CSS
    .myClass  {
        background:#e3334d;
    }
CSS;


    }




}
