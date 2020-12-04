<?php

namespace zetsoft\widgets\images;

use zetsoft\system\Az;
use zetsoft\system\helpers\ZFileHelper;
use zetsoft\system\kernels\ZWidget;

/**
 *
 *
 *
 * Created By: Daho
 * Refactored and Fixed By: Xakimjon Ergashov;
 */
class ZNanoGalery2Widget extends ZWidget
{

    /**
     * Configuration
     */
    public $config = [];
    public $_config = [
        'path' => '/image/',
        'type' => ZNanoGalery2Widget::type['justified'],
        'effect' => ZNanoGalery2Widget::hoverEffect['shufle'],
        'grapes' => true,
    ];

    public $options = [

        'galleryMosaic' =>  ZNanoGalery2Widget::galleryMosaic['default'],
        'isImagesOpen' => true,
        'galleryDisplayMode' => ZNanoGalery2Widget::galeryDisplayMode['rows'],
        'galleryDisplayMoreStep' => 3,
        'galleryPaginationMode' => ZNanoGalery2Widget::galleryPaginationMode['dots'],
        'galleryMaxRows' => 3,
        'galleryLastRowFull' => false,
        'gallerySorting' => ZNanoGalery2Widget::gallerySorting['random'],
        'galleryMaxItems' => 0,
        'galleryResizeAnimation' => true,
        'galleryTheme' => ZNanoGalery2Widget::GaleryTheme['dark'],
        'isThumbnailSelectable' => false,
        'galleryRenderDelay' => 60,
        'thumbnailBaseGridHeight' => 100,
        'thumbnailDisplayOutsideScreen' => false,
        'galleryDisplayTransition' => ZNanoGalery2Widget::galleryDisplayTransition['none'],
        'galleryDisplayTransitionDuration' => 1000,

        // ### Thumbnails ###
        'thumbnailAlignment' => ZNanoGalery2Widget::thumbnailAligment['center'],
        'thumbnailGutterWidth' => 2,
        'thumbnailGutterHeight' => 2,
        'thumbnailBorderHorizontal' => 0,
        'thumbnailBorderVertical' => 0, //2
        'thumbnailDisplayInterval' => 2,
        'thumbnailDisplayTransition' => ZNanoGalery2Widget::thumbnailDisplayTransition['randomScale'],
        'thumbnailDisplayTransitionDuration' => 240,
        'thumbnailStacks' => 0,
        'thumbnailStacksTranslateZ' => 0.3,
        'thumbnailStacksRotateX' =>    0.9,
        'thumbnailWaitImageLoaded' => true,
        'thumbnailCrop' => false,
        'thumbnailSliderDelay' => 2000,
        'thumbnailStacksRotateZ' => 0.4,

        // ### Thumbnail label ###
        'thumbnailLabelPosition' => ZNanoGalery2Widget::thumbnailLabelPosition['overImageOnBottom'],
        'thumbnailHideIcons' => true,
        'thumbnailLabelAlign' => ZNanoGalery2Widget::thumbnailLabelAlign['center'],
        'isLabelDisplay' => true,
        'thumbnailTitleMaxLength' => 0,
        'thumbnailTopLeftIcon' => ZNanoGalery2Widget::thumbnailIcon['cart'],
        'thumbnailTopRightIcon' => ZNanoGalery2Widget::thumbnailIcon['share'],
        'thumbnailBottomLeftIcon' => ZNanoGalery2Widget::thumbnailIcon['info'],
        'thumbnailBottomRightIcon' => ZNanoGalery2Widget::thumbnailIcon['download'],
        'displayBreadcrumb' => false,
        'breadcrumbOnlyCurrentLevel' => true,
        'breadcrumbAutoHideTopLevel' => false,
        'breadcrumbHideIcons' => false,
        'galleryFilterTags' => false,
        'thumbnailLevelUp' => false,
        'locationHash' => false,
        'touchAnimation' => false,
        'imageTransition' => ZNanoGalery2Widget::imageTransition['swipe'],
        'slideshowAutoStart' => false,
        'slideshowDelay' => 3000,
        'viewerFullscreen' => false,
        'viewerToolbarDisplay' => true,
        'viewerToolbarPosition' => ZNanoGalery2Widget::viewerToolbarPosition['bottomOverImage'],
        'viewerToolbarAlign' => ZNanoGalery2Widget::viewerToolbarAlign['center'],
        'viewerToolbarFullWidth' => false,
        'viewerTheme' => ZNanoGalery2Widget::viewerTheme['border'],
        'viewerImageDisplay' => ZNanoGalery2Widget::viewerImageDisplay['bestImageQuality'],

    ];
    

    public const type = [
        'grid' => 'grid',
        'justified' => 'justified',
        'cascading' => 'cascading',
        'mosaic' => 'mosaic',
    ];

    public const hoverEffect = [
     'shufle' => 'shufle',
     'parallax' => 'parallax',
     'popout' => 'popout',
     'rotate' => 'rotate',


    ];

    public const thumbnailBuildInit2 = [
        'transformOrigin' => "thumbnail_transform-origin_50% 150%",
        'translateY10px' => "title_translateY_10px",
    ];

    public const thumbnailHoverEffect2 = [
        'thumbHovEffect1' => "thumbnail_rotateZ_0deg_15deg_easeOutQuad_200_hoverin | thumbnail_rotateZ_15deg_-10deg_delay250_keyframe_hoverin_easeOutBack_400 | thumbnail_rotateZ_-10deg_0deg_keyframe_hoverout_easeOutBack_400",

        'thumbHovEffect2' => "thumbnail_rotateY_0deg_30deg_easeOutQuad_150_hoverin|thumbnail_rotateY_30deg_-30deg_delay160_keyframe_hoverin_easeOutQuad_200|thumbnail_rotateY_-30deg_0deg_delay320_keyframe_hoverin_easeOutQuad_150|title_translateX_0px_20px_easeOutQuad_150_hoverin|title_translateX_20px_-20px_delay160_keyframe_hoverin_easeOutQuad_200|title_translateX_-20px_0px_delay320_keyframe_hoverin_easeOutQuad_150|description_translateX_0px_12px_easeOutQuad_150_hoverin|description_translateX_12px_-12px_delay160_keyframe_hoverin_easeOutQuad_200|description_translateX_-12px_0px_delay320_keyframe_hoverin_easeOutQuad_150",

        'thumbHovEffect3' => "thumbnail_translateZ_0px_100px_easeOutQuad_400 | thumbnail_rotateX_0deg_10deg_easeOutBack_200 | thumbnail_rotateX_10deg_0deg_delay250_keyframe_hoverin_easeOutBack_400",

        'thumbHovEffect4' => "image_rotateZ_0deg_7deg_easeOutQuad_150_hoverin|image_rotateZ_7deg_-7deg_delay160_keyframe_hoverin_easeOutQuad_200|image_rotateZ_-7deg_0deg_delay320_keyframe_hoverin_easeOutQuad_150"

    ];

    public const galleryBuildInit2 = [
        'perspective_1000px' => "perspective_1000px",
        'perspective_900px' => "perspective_900px|perspective-origin_50% 150%",
        'perspective-origin' => "perspective-origin_50% 150%"
    ];

    public const thumbnailHeight = [
    'lg' => 300,
    'md' => 200,
    'sm' => 100,
    'auto' => 'auto',
    ];

    public const thumbnailWidth = [
        'lg' => 300,
        'md' => 200,
        'sm' => 100,
        'auto' => 'auto',

    ];

    public const galleryMosaic = [
    'default' => '
           galleryMosaic:
           [{ "c": 1, "r": 1, "w": 2, "h": 2 },
          { "c": 3, "r": 1, "w": 1, "h": 1 },
          { "c": 3, "r": 2, "w": 1, "h": 1 },
          { "c": 1, "r": 3, "w": 1, "h": 1 },
          { "c": 3, "r": 3, "w": 2, "h": 1 }]'
    ];

    public const thumbnailL1GutterWidth = [
        '90' => 90,
        '40' => 40,
    ];

    public const thumbnailL1GutterHeight = [
        '90' => 90,
        '40' => 40,
    ];

    public const thumbnailAligment = [
        'fillWidth' => 'fillWidth',
        'justified' => 'justified',
        'center' => 'center',
        'right' => 'right',
        'left' => 'left',
    ];

    public const galeryDisplayMode = [
        'fullContent' => 'fullContent',
        'pagination' => 'pagination',
        'moreButton' => 'moreButton',
        'rows' => 'rows',
    ];

    public const galleryPaginationMode = [
        'dots' => 'dots',
        'numbers' => 'numbers',
        'rectangles' => 'rectangles',
    ];

    public const gallerySorting = [
        'titleAsc' => 'titleAsc',
        'titleDesc' => 'titleDesc',
        'reversed' => 'reversed',
        'random' => 'random',
    ];

    public const GaleryTheme = [
        'light' => 'light',
        'dark' => 'dark',
    ];

    public const galleryDisplayTransition = [
        'none' => 'none',
        'rotateX' => 'rotateX',
        'slideUp' => 'slideUp',
    ];

    public const thumbnailDisplayTransition = [
        'scaleUp' => 'scaleUp',
        'slideUp' => 'slideUp',
        'slideDown' => 'slideDown',
        'scaleDown' => 'scaleDown',
        'fadeIn' => 'fadeIn',
        'randomScale' => 'randomScale',
        'flipDown' => 'flipDown',
        'flipUp' => 'flipUp',
        'slideDown2' => 'slideDown2',
        'slideUp2' => 'slideUp2',
        'slideRight' => 'slideRight',
        'slideLeft' => 'slideLeft',
        'custom' => 'custom',
    ];

    public const thumbnailLabelPosition = [
        'overImageOnBottom' => 'overImageOnBottom',
        'overImageOnTop' => 'overImageOnTop',
        'overImageOnMiddle' => 'overImageOnMiddle',
        'onBottom' => 'onBottom',
    ];

    public const thumbnailLabelAlign = [
        'center' => 'center',
        'right' => 'right',
        'left' => 'left',
    ];

    public const thumbnailIcon = [
        'none' => '',
        'select' => 'select',
        'share' => 'share',
        'featured' => 'featured',
        'download' => 'download',
        'cart' => 'cart',
        'info' => 'info',
        'display' => 'display'
    ];

    public const imageTransition = [
        'slideAppear' => 'slideAppear',
        'swipe' => 'swipe',
        'swipe2' => 'swipe2',
    ];

    public const viewerToolbarPosition = [
        'top' => 'top',
        'topOverImage' => 'topOverImage',
        'bottom' => 'bottom',
        'bottomOverImage' => 'bottomOverImage',
    ];

    public const viewerToolbarAlign = [
        'left' => 'left',
        'right' => 'right',
        'center' => 'center'
    ];

    public const viewerTheme = [
        'dark' => 'dark',
        'light' => 'light',
        'border' => 'border',
    ];

    public const viewerImageDisplay = [
        'bestImageQuality' => 'bestImageQuality',
        'upscale' => 'upscale',
    ];



    public function asset()
    {
        $this->fileCss('https://cdn.jsdelivr.net/npm/nanogallery2@2.4.2/dist/css/nanogallery2.min.css');
        $this->fileJs('https://cdn.jsdelivr.net/npm/nanogallery2@2.4.2/dist/jquery.nanogallery2.js');
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

        //vdd($imagePath);
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
          <img class="Popout" src="$value">
    </a>
HTML;
        }

        return $item;

    }


    public function codes()
    {

        $this->itemGen();
        $this->htm = <<<HTML
        <div id="nanogallery2"
             {content}
    </div>
HTML;

        $this->js .= <<<JS
           $(document).ready(function () {
              jQuery("#nanogallery2").nanogallery2({
                thumbnailWidth:  '{thumbnailWidth}',
                thumbnailHeight: '{thumbnailHeight}',
               // galleryMosaic: {galleryMosaic},
                locationHash:    false,
                thumbnailL1GutterWidth: '{thumbnailL1GutterWidth}',
                thumbnailL1GutterHeight: '{thumbnailL1GutterHeight}',
                thumbnailStacksRotateZ: '{thumbnailStacksRotateZ}',
                galleryBuildInit2: '{galleryBuildInit2}',
                thumbnailHoverEffect2: '{thumbnailHoverEffect2}',
                thumbnailBorderVertical: '{thumbnailBorderVertical}',
                thumbnailStacks: '{thumbnailStacks}',
                thumbnailBuildInit2: '{thumbnailBuildInit2}',
              });
              
            });
JS;



        $this->js = strtr($this->js, [
            '{path}' => $this->_config['path'],
        ]);

        $this->htm = strtr($this->htm, [
            '{content}' => $this->itemGen(),
        ]);


        switch ($this->_config['type']) {
            case 'grid':
            {
                $this->js = strtr($this->js, [
                    '{thumbnailHeight}' => ZNanoGalery2Widget::thumbnailHeight['md'],
                    '{thumbnailWidth}' => ZNanoGalery2Widget::thumbnailWidth['lg'],
                ]);
                break;
            }
            case 'justified':
            {
                $this->js = strtr($this->js, [
                    '{thumbnailHeight}' => ZNanoGalery2Widget::thumbnailHeight['md'],
                    '{thumbnailWidth}' => ZNanoGalery2Widget::thumbnailWidth['auto'],
                ]);
                break;
            }
            case 'cascading':
            {
                $this->js = strtr($this->js, [
                    '{thumbnailHeight}' => ZNanoGalery2Widget::thumbnailHeight['auto'],
                    '{thumbnailWidth}' => ZNanoGalery2Widget::thumbnailWidth['md'],
                ]);
                break;
            }
            case 'mosaic':
            {
                $this->js = strtr($this->js, [
                    '{thumbnailHeight}' => ZNanoGalery2Widget::thumbnailHeight['md'],
                    '{thumbnailWidth}' => ZNanoGalery2Widget::thumbnailWidth['md'],
                    '{galleryMosaic}' => $this->options['galleryMosaic'],

                ]);
                break;
            }

        }


        switch ($this->_config['effect']) {

            case 'shufle':

                $this->js = strtr($this->js,[

                    '{thumbnailL1GutterWidth}' => self::thumbnailL1GutterWidth['90'],

                    '{thumbnailL1GutterHeight}' => self::thumbnailL1GutterHeight['90'],

                    '{thumbnailBorderVertical}' => $this->options['thumbnailBorderVertical'],

                    '{thumbnailBorderHorizontal}' => $this->options['thumbnailBorderHorizontal'],

                    '{thumbnailStacks}' => $this->options['thumbnailStacks'],

                    '{thumbnailStacksRotateZ}' => $this->options['thumbnailStacksRotateZ'],

                    '{thumbnailBuildInit2}' => self::thumbnailBuildInit2['transformOrigin'],

                    '{thumbnailHoverEffect2}' => self::thumbnailHoverEffect2['thumbHovEffect1'],

                ]);
                break;

            case 'parallax':
                $this->js = strtr($this->js,[

                    '{thumbnailL1GutterWidth}' => self::thumbnailL1GutterWidth['90'],

                    '{thumbnailL1GutterHeight}' => self::thumbnailL1GutterHeight['90'],

                    '{thumbnailStacksRotateZ}' => $this->options['thumbnailStacksRotateZ'],

                    '{thumbnailBuildInit2}' => self::thumbnailBuildInit2['translateY10px'],

                    '{galleryBuildInit2}' => self::galleryBuildInit2['perspective_1000px'],

                      '{thumbnailHoverEffect2}' => self::thumbnailHoverEffect2['thumbHovEffect2'],
                    '{thumbnailHeight}' => ZNanoGalery2Widget::thumbnailHeight['md'],
                    '{thumbnailWidth}' => ZNanoGalery2Widget::thumbnailWidth['md'],

                    '{thumbnailBorderVertical}' => $this->options['thumbnailBorderVertical'],

                    '{thumbnailBorderHorizontal}' => $this->options['thumbnailBorderHorizontal'],
                ]);
                break;

            case 'popout':
                $this->js = strtr($this->js,[

                    '{thumbnailL1GutterWidth}' => self::thumbnailL1GutterWidth['40'],

                    '{thumbnailL1GutterHeight}' => self::thumbnailL1GutterHeight['40'],

                    '{thumbnailStacks}' => $this->options['thumbnailStacks'],

                    '{thumbnailStacksTranslateZ}' => $this->options['thumbnailStacksTranslateZ'],

                    '{thumbnailStacksRotateX}' => $this->options['thumbnailStacksRotateX'],

                    '{thumbnailBuildInit2}' => self::thumbnailBuildInit2['translateY10px'],

                    '{galleryBuildInit2}' => self::galleryBuildInit2['perspective_900px'],

                    '{thumbnailHoverEffect2}' => self::thumbnailHoverEffect2['thumbHovEffect3'],

                    '{thumbnailBorderVertical}' => $this->options['thumbnailBorderVertical'],

                    '{thumbnailBorderHorizontal}' => $this->options['thumbnailBorderHorizontal'],
                ]);
                break;

            case 'rotate':
                $this->js = strtr($this->js,[

                    '{thumbnailL1GutterWidth}' => self::thumbnailL1GutterWidth['90'],

                    '{thumbnailL1GutterHeight}' => self::thumbnailL1GutterHeight['90'],

                    '{thumbnailStacksRotateZ}' => $this->options['thumbnailStacksRotateZ'],

                    '{galleryBuildInit2}' => self::galleryBuildInit2['perspective-origin'],

                    '{thumbnailHoverEffect2}' => self::thumbnailHoverEffect2['thumbHovEffect4'],

                    '{thumbnailBorderVertical}' => $this->options['thumbnailBorderVertical'],

                    '{thumbnailBorderHorizontal}' => $this->options['thumbnailBorderHorizontal'],
                    
                ]);
                break;

        }


    }
}
