<?php

namespace zetsoft\widgets\images;

use zetsoft\system\Az;
use zetsoft\system\helpers\ZFileHelper;
use zetsoft\system\kernels\ZWidget;

/**
 *
 * Class ZLightGalleryWidget2uX
 * http://
 *
 * Created By: Abdurakhmonov UMiD
 */
class ZLightGalleryWidget2uX extends ZWidget
{

    /**
     * Configuration
     */
    public $config = [];
    public $_config = [
        'thumbnailHeight' => '',
        'thumbnailWight' => '30%',
        'thumbnailborder' => '2px solid  #3243c7',
        'thumbnailborder-radius' => '4px',
        'thumbnailmargin' => '5px',
        


        'mode' => ZLightGalleryWidget::Mode['lg-slide-skew-ver-cross-rev'],
        'cssEasing' => 'cubic-bezier(0.25, 0s, 0.25, 1)',
        'speed' => 600,
        'height' => '100',
        'widht' => '100',
        'addClass' => '',
        'startClass' => 'lg-start-zoom',
        'backdropDuration' => 250,
        'hideBarsDelay' => 6000,
        'useLeft' => true,
        'closable' => true,
        'loop' => true,
        'escKey' => true,
        'keyPress' => false,
        'controls' => true,
        'slideEndAnimatoin' => true,
        'hideControlOnEnd' => true,
        'getCaptionFromTitleOrAlt' => true,
        'appendSubHtmlTo' => '.lg-sub-html',
        'subHtmlSelectorRelative' => true,
        'preload' => 1,
        'showAfterLoad' => true,
        'selector' => '',
        'selectorWith' => '',
        'nextHtml' => '',
        'prevHtml' => '',
        'download' => true,
        'counter' => true,
        'appendCounterTo' => '.lg-toolbar',
        'swipeThreshold' => 50,
        'enableDrag' => true,
        'enableTouch' => true,
        'dynamic' => true,
        'showThumbByDefault' => false,


        'zoom' => true,
        'scale' => 1,
        'enableZoomAfter' => 50,
        'actualSize' => true,

        'currentPagerPosition' => ZLightGalleryWidget2uX::currentPagerPosition['left'],
        'youtubeThumbSize' => ZLightGalleryWidget2uX::youtubeThumbSize['2'],
        'vimeoThumbSize' => ZLightGalleryWidget2uX::vimeoThumbSize['thumbnail_small'],
        'thumbnail' => true,
        'animateThumb' => true,
        'thumbWidth' => 100,
        'thumbContHeight' => 100,
        'thumbMargin' => 5,
        'exThumbImage' => false,
        'toggleThumb' => true,
        'pullCaptionUp' => true,
        'enableThumbDrag' => true,
        'enableThumbSwipe' => true,
        'loadYoutubeThumbnail' => true,
        'loadVimeoThumbnail' => true,
        'loadDailymotionThumbnail' => true,


        'videoMaxWidth' => '855px',
        'youtubePlayerParams' => '{modestbranding: 1, showinfo: 0, controls: 0}',
        'vimeoPlayerParams' => '{byline: 0, portrait: 0}',
        'dailymotionPlayerParams' => '{}',
        'vkPlayerParams' => '{}',
        'videojs' => false,

        'autoplay' => false,
        'pause' => 5000,
        'progressBar' => true,
        'fourceAutoplay' => true,
        'autoplayControls' => true,
        'appendAutoplayControlsTo' => '.lg-toolbar',
        'path' => '/upload',
    ];

    /**
     *
     * Plugin Events
     *
     */
    public $event = [];
    public $_event = [
        'change' => ' console.log("ZKSelect2Widget | $eventChange") ',

    ];


    public function asset()
    {
        $this->fileJs('https://cdn.jsdelivr.net/npm/lightgallery@1.6.12/dist/js/lightgallery.js');
        $this->fileCss('https://cdn.jsdelivr.net/npm/lightgallery@1.6.12/dist/css/lightgallery.css');
        $this->fileJs('https://cdn.jsdelivr.net/npm/lg-thumbnail@1.1.0/dist/lg-thumbnail.js');
        $this->fileJs('https://cdn.jsdelivr.net/npm/lg-zoom@1.1.0/dist/lg-zoom.js');
        $this->fileJs('https://cdn.jsdelivr.net/npm/lg-video@1.2.2/dist/lg-video.js');
        $this->fileJs('https://cdn.jsdelivr.net/npm/lg-autoplay@1.0.4/dist/lg-autoplay.js');

        //Not working with cdn
        $this->fileJs('https://cdn.jsdelivr.net/npm/lightgallery.js@1.1.3/dist/js/lightgallery.js');
        /*$this->fileJs('https://cdn.jsdelivr.net/npm/lg-video.js@1.0.0/dist/lg-video.js');*/
    }

    private function itemGen()
    {

        $item = '';
        $data = $this->data;
        $path = $this->_config['path'];


        if ($this->modelCheck()) {

            $path = '/upload/' . strtolower($this->modelClassName) . '/' . $this->attribute . '/' . $this->model->id;
        }

        $imagePath = Az::getAlias(Az::getAlias('@webroot') . $path);
        $files = ZFileHelper::findFiles($imagePath, [
            'only' => [
                '*.jpg',
                '*.png',
                '*.gif',
                '*.mp4'
            ]
        ]);
        if (empty($this->data)) {
            foreach ($files as $key => $val) {

                $listfile[bname($val)] = strtr($val, [
                    Az::getAlias('@webroot') => '',
                    '\\' => '/'
                ]);

            }
        }

        foreach ($listfile as $key => $value) {
            $item .= <<<HTML
            <a href="$value">
                  <img class="olcham" src="$value">
            </a>
HTML;
        }


        return $item;
    }


    public $layout = [];
    public $_layout = [

        'main' => <<<HTML
      <div class="container">
        
        <div id="lightgallery">
            {content}   
        </div>
      </div>
        
HTML,

        'js' => <<<JS
           lightGallery(document.getElementById('lightgallery'),{
                mode: '{mode}',
                cssEasing: '{cssEasing}',
                speed: {speed},
                height: '{height}',
                widht: '{widht}',
                addClass: '{addClass}',
                startClass: '{startClass}',
                backdropDuration: {backdropDuration},
                hideBarsDelay: {hideBarsDelay},
                useLeft: {useLeft},
                closable: {closable},
                loop: {loop},
                escKey: {escKey},
                keyPress: {keyPress},
                controls: {controls},
                slideEndAnimatoin: {slideEndAnimatoin},
                hideControlOnEnd: {hideControlOnEnd},
                getCaptionFromTitleOrAlt: {getCaptionFromTitleOrAlt},
                appendSubHtmlTo: '{appendSubHtmlTo}',
                subHtmlSelectorRelative: {subHtmlSelectorRelative},
                preload: {preload},
                showAfterLoad: {showAfterLoad},
                selector: '{selector}',
                selectorWith: '{selectorWith}',
                nextHtml: '{nextHtml}',
                prevHtml: '{prevHtml}',
                download: {download},
                counter: {counter},
                appendCounterTo: '{appendCounterTo}',
                swipeThreshold: {swipeThreshold},
                enableDrag: {enableDrag},
                enableTouch: {enableTouch},
                dynamic: {dynamic},
                showThumbByDefault: {showThumbByDefault},

        
        
                Zoom: {zoom},
                scale: {scale},
                enableZoomAfter: {enableZoomAfter},
                actualSize: {actualSize},
        
                thumbnail: {thumbnail},
                animateThumb: {animateThumb},
                currentPagerPosition: '{currentPagerPosition}',  //left, right
                thumbWidth: {thumbWidth},
                thumbContHeight: {thumbContHeight},
                thumbMargin: {thumbMargin},
                exThumbImage: {exThumbImage},
                toggleThumb: {toggleThumb},
                pullCaptionUp: {pullCaptionUp},
                enableThumbDrag: {enableThumbDrag},
                enableThumbSwipe: {enableThumbSwipe},
                loadYoutubeThumbnail: {loadYoutubeThumbnail},
                youtubeThumbSize: {youtubeThumbSize},   
                loadVimeoThumbnail: {loadVimeoThumbnail},
                vimeoThumbSize: '{vimeoThumbSize}', 
                loadDailymotionThumbnail: {loadDailymotionThumbnail},  
        
                
                videoMaxWidth: '{videoMaxWidth}',
                youtubePlayerParams: '{youtubePlayerParams}',    
                vimeoPlayerParams: '{vimeoPlayerParams}',      
                dailymotionPlayerParams: '{dailymotionPlayerParams}',
                vkPlayerParams: '{vkPlayerParams}',
                videojs: {videojs},
        
                autoplay: {autoplay},
                pause: {pause},
                progressBar: {progressBar},
                fourceAutoplay: {fourceAutoplay},
                autoplayControls: {autoplayControls},
                appendAutoplayControlsTo: '{appendAutoplayControlsTo}'
    });
    


    
    var lg = document.getElementById('lightgallery');

   lg.addEventListener('onBeforeSlide', function(event){
        console.log(event.detail.index, event.detail.fromTouch, event.detail.fromThumb);
    }, false);
     lightGallery(lg);
JS,

        'css' => <<<CSS
    .olcham {
       height: {thumbnailHeight};
       width: {thumbnailWight};
       border: {thumbnailborder};
       border-radius: {thumbnailborder-radius};
       margin: {thumbnailmargin};
    }
    .container{
    max-width: 85%;
    text-align: center;
    
    }
    
 
    
    
CSS,

    ];

    /**
     *
     * Constants
     */

    public const mode = [
        'lg-fade' => 'lg-fade',
        'lg-slide' => 'lg-slide',
        'lg-zoom-in' => 'lg-zoom-in',
        'lg-zoom-in-big' => 'lg-zoom-in-big',
        'lg-zoom-out' => 'lg-zoom-out',
        'lg-zoom-out-big' => 'lg-zoom-out-big',
        'lg-zoom-out-in' => 'lg-zoom-out-in',
        'lg-zoom-in-out' => 'lg-zoom-in-out',
        'lg-soft-zoom' => 'lg-soft-zoom',
        'lg-scale-up' => 'lg-scale-up',
        'lg-slide-circular' => 'lg-slide-circular',
        'lg-slide-circular-vertical' => 'lg-slide-circular-vertical',
        'lg-slide-vertical' => 'lg-slide-vertical',
        'lg-slide-vertical-growth' => 'lg-slide-vertical-growth',
        'lg-slide-skew-only' => 'lg-slide-skew-only',
        'lg-slide-skew-only-rev' => 'lg-slide-skew-only-rev',
        'lg-slide-skew-only-y' => 'lg-slide-skew-only-y',
        'lg-slide-skew-only-y-rev' => 'lg-slide-skew-only-y-rev',
        'lg-slide-skew' => 'lg-slide-skew',
        'lg-slide-skew-rev' => 'lg-slide-skew-rev',
        'lg-slide-skew-cross' => 'lg-slide-skew-cross',
        'lg-slide-skew-cross-rev' => 'lg-slide-skew-cross-rev',
        'lg-slide-skew-ver' => 'lg-slide-skew-ver',
        'lg-slide-skew-ver-rev' => 'lg-slide-skew-ver-rev',
        'lg-slide-skew-ver-cross' => 'lg-slide-skew-ver-cross',
        'lg-slide-skew-ver-cross-rev' => 'lg-slide-skew-ver-cross-rev',
        'lg-lollipop' => 'lg-lollipop',
        'lg-lollipop-rev' => 'lg-lollipop-rev',
        'lg-rotate' => 'lg-rotate',
        'lg-rotate-rev' => 'lg-rotate-rev',
        'lg-tube' => 'lg-tube',
    ];

    public const currentPagerPosition = [
        'middle' => 'middle',
        'left' => 'left',
        'right' => 'right'

    ];

    public const youtubeThumbSize = [
        '1' => 1,
        '2' => 2,
        '3' => 3,
        'mqdefault' => 'mqdefault',
        'hqdefault' => 'hqdefault',
        'default' => 'default',
        'sddefault' => 'sddefault',
        'maxresdefault' => 'maxresdefault'
    ];

    public const vimeoThumbSize = [
        'thumbnail_small' => 'thumbnail_small',
        'thumbnail_medium' => 'thumbnail_medium',
        'thumbnail_large' => 'thumbnail_large'
    ];


    public function codes()
    {
        $content = $this->itemGen();

        $this->htm = strtr($this->_layout['main'], [
            '{content}' => $content,
        ]);

        $this->css = strtr($this->_layout['css'], [
            '{thumbnailHeight}' => ($this->_config['thumbnailHeight']),
            '{thumbnailWight}' => ($this->_config['thumbnailWight']),
            '{thumbnailborder}' => ($this->_config['thumbnailborder']),
            '{thumbnailborder-radius}' => ($this->_config['thumbnailborder-radius']),
            '{thumbnailmargin}' => ($this->_config['thumbnailmargin']),

        ]);

        $this->js = strtr($this->_layout['js'], [
            '{mode}' => $this->jscode($this->_config['mode']),
            '{cssEasing}' => $this->jscode($this->_config['cssEasing']),
            '{speed}' => $this->jscode($this->_config['speed']),
            '{height}' => $this->jscode($this->_config['height']),
            '{widht}' => $this->jscode($this->_config['widht']),
            '{addClass}' => $this->jscode($this->_config['addClass']),
            '{backdropDuration}' => $this->jscode($this->_config['backdropDuration']),
            '{hideBarsDelay}' => $this->jscode($this->_config['hideBarsDelay']),
            '{useLeft}' => $this->jscode($this->_config['useLeft']),
            '{closable}' => $this->jscode($this->_config['closable']),
            '{loop}' => $this->jscode($this->_config['loop']),
            '{escKey}' => $this->jscode($this->_config['escKey']),
            '{keyPress}' => $this->jscode($this->_config['keyPress']),
            '{controls}' => $this->jscode($this->_config['controls']),
            '{slideEndAnimatoin}' => $this->jscode($this->_config['slideEndAnimatoin']),
            '{hideControlOnEnd}' => $this->jscode($this->_config['hideControlOnEnd']),
            '{getCaptionFromTitleOrAlt}' => $this->jscode($this->_config['getCaptionFromTitleOrAlt']),
            '{appendSubHtmlTo}' => $this->jscode($this->_config['appendSubHtmlTo']),
            '{subHtmlSelectorRelative}' => $this->jscode($this->_config['subHtmlSelectorRelative']),
            '{preload}' => $this->jscode($this->_config['preload']),
            '{showAfterLoad}' => $this->jscode($this->_config['showAfterLoad']),
            '{selector}' => $this->jscode($this->_config['selector']),
            '{selectorWith}' => $this->jscode($this->_config['selectorWith']),
            '{nextHtml}' => $this->jscode($this->_config['nextHtml']),
            '{prevHtml}' => $this->jscode($this->_config['prevHtml']),
            '{download}' => $this->jscode($this->_config['download']),
            '{counter}' => $this->jscode($this->_config['counter']),
            '{appendCounterTo}' => $this->jscode($this->_config['appendCounterTo']),
            '{swipeThreshold}' => $this->jscode($this->_config['swipeThreshold']),
            '{enableDrag}' => $this->jscode($this->_config['enableDrag']),
            '{enableTouch}' => $this->jscode($this->_config['enableTouch']),
            '{dynamic}' => $this->jscode($this->_config['dynamic']),
            '{showThumbByDefault}' => $this->jscode($this->_config['showThumbByDefault']),

            '{zoom}' => $this->jscode($this->_config['zoom']),
            '{scale}' => $this->jscode($this->_config['scale']),
            '{enableZoomAfter}' => $this->jscode($this->_config['enableZoomAfter']),
            '{actualSize}' => $this->jscode($this->_config['actualSize']),


            '{thumbnail}' => $this->jscode($this->_config['thumbnail']),
            '{animateThumb}' => $this->jscode($this->_config['animateThumb']),
            '{currentPagerPosition}' => $this->jscode($this->_config['currentPagerPosition']),
            '{thumbWidth}' => $this->jscode($this->_config['thumbWidth']),
            '{thumbContHeight}' => $this->jscode($this->_config['thumbContHeight']),
            '{thumbMargin}' => $this->jscode($this->_config['thumbMargin']),
            '{exThumbImage}' => $this->jscode($this->_config['exThumbImage']),
            '{toggleThumb}' => $this->jscode($this->_config['toggleThumb']),
            '{pullCaptionUp}' => $this->jscode($this->_config['pullCaptionUp']),
            '{enableThumbDrag}' => $this->jscode($this->_config['enableThumbDrag']),
            '{enableThumbSwipe}' => $this->jscode($this->_config['enableThumbSwipe']),
            '{loadYoutubeThumbnail}' => $this->jscode($this->_config['loadYoutubeThumbnail']),
            '{youtubeThumbSize}' => $this->jscode($this->_config['youtubeThumbSize']),
            '{loadVimeoThumbnail}' => $this->jscode($this->_config['loadVimeoThumbnail']),
            '{vimeoThumbSize}' => $this->jscode($this->_config['vimeoThumbSize']),
            '{loadDailymotionThumbnail}' => $this->jscode($this->_config['loadDailymotionThumbnail']),


            '{videoMaxWidth}' => $this->jscode($this->_config['videoMaxWidth']),
            '{youtubePlayerParams}' => $this->jscode($this->_config['youtubePlayerParams']),
            '{vimeoPlayerParams}' => $this->jscode($this->_config['vimeoPlayerParams']),
            '{dailymotionPlayerParams}' => $this->jscode($this->_config['dailymotionPlayerParams']),
            '{vkPlayerParams}' => $this->jscode($this->_config['vkPlayerParams']),
            '{videojs}' => $this->jscode($this->_config['videojs']),


            '{autoplay}' => $this->jscode($this->_config['autoplay']),
            '{pause}' => $this->jscode($this->_config['pause']),
            '{progressBar}' => $this->jscode($this->_config['progressBar']),
            '{fourceAutoplay}' => $this->jscode($this->_config['fourceAutoplay']),
            '{autoplayControls}' => $this->jscode($this->_config['autoplayControls']),
            '{appendAutoplayControlsTo}' => $this->jscode($this->_config['appendAutoplayControlsTo']),


        ]);

    }

}
