<?php

namespace zetsoft\widgets\images;

use kcfinder\file;
use PhpOffice\PhpSpreadsheet\Shared\OLE\PPS\Root;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZFileHelper;
use zetsoft\system\kernels\ZWidget;

/**
 *
 *
 *
 * Created By: Daho
 */
class ZNanoGaleryWidget extends ZWidget
{

    /**
     * Configuration
     */
    public $config = [];
    public $_config = [
        'path' => 'Develop\Projects\ALL\asrorz\zettest\execut\web\eyuf\image\\',
        'type' => ZNanoGaleryWidget::type['mosaic'],

        'thumbnailHeight' => 150,
        'thumbnailWidth' => 150,
        'galeryMosaic' => '[
          { "c": 2, "r": 2, "w": 2, "h": 2 },
          { "c": 2, "r": 2, "w": 1, "h": 2 },
          { "c": 2, "r": 2, "w": 1, "h": 2 },
          { "c": 2, "r": 2, "w": 1, "h": 2 },
          { "c": 2, "r": 2, "w": 2, "h": 2 }
      ]',

        'isImagesOpen' => true,
        'galleryDisplayMode' => ZNanoGaleryWidget::galeryDisplayMode['rows'],
        'galleryDisplayMoreStep' => 3,
        'galleryPaginationMode' => ZNanoGaleryWidget::galleryPaginationMode['dots'],
        'galleryMaxRows' => 3,
        'galleryLastRowFull' => false,
        'gallerySorting' => ZNanoGaleryWidget::gallerySorting['random'],
        'galleryMaxItems' => -1,
        'galleryResizeAnimation' => true,
        'galleryTheme' => ZNanoGaleryWidget::GaleryTheme['dark'],
        'isThumbnailSelectable' => false,
        'galleryRenderDelay' => 60,

        'thumbnailDisplayOutsideScreen' => false,
        'galleryDisplayTransition' => ZNanoGaleryWidget::galleryDisplayTransition['none'],
        'galleryDisplayTransitionDuration' => 1000,

        // ### Thumbnails ###
        'thumbnailAlignment' => ZNanoGaleryWidget::thumbnailAligment['center'],
        'thumbnailGutterWidth' => 2,
        'thumbnailGutterHeight' => 2,
        'thumbnailBorderHorizontal' => 2,
        'thumbnailBorderVertical' => 2,
        'thumbnailDisplayInterval' => 200,
        'thumbnailDisplayTransition' => ZNanoGaleryWidget::thumbnailDisplayTransition['randomScale'],
        'thumbnailDisplayTransitionDuration' => 240,
        'thumbnailStacks' => 0,
        'thumbnailWaitImageLoaded' => true,
        'thumbnailCrop' => false,
        'thumbnailSliderDelay' => 2000,

        // ### Thumbnail label ###
        'thumbnailLabelPosition' => ZNanoGaleryWidget::thumbnailLabelPosition['overImageOnBottom'],
        'thumbnailHideIcons' => true,
        'thumbnailLabelAlign' => ZNanoGaleryWidget::thumbnailLabelAlign['center'],
        'isLabelDisplay' => true,
        'thumbnailTitleMaxLength' => 0,
        'thumbnailTopLeftIcon' => ZNanoGaleryWidget::thumbnailIcon['cart'],
        'thumbnailTopRightIcon' => ZNanoGaleryWidget::thumbnailIcon['share'],
        'thumbnailBottomLeftIcon' => ZNanoGaleryWidget::thumbnailIcon['info'],
        'thumbnailBottomRightIcon' => ZNanoGaleryWidget::thumbnailIcon['download'],
        'displayBreadcrumb' => false,
        'breadcrumbOnlyCurrentLevel' => true,
        'breadcrumbAutoHideTopLevel' => false,
        'breadcrumbHideIcons' => false,
        'galleryFilterTags' => false,
        'thumbnailLevelUp' => false,
        'locationHash' => false,
        'touchAnimation' => false,
        'imageTransition' => ZNanoGaleryWidget::imageTransition['swipe'],
        'slideshowAutoStart' => false,
        'slideshowDelay' => 3000,
        'viewerFullscreen' => false,
        'viewerToolbarDisplay' => true,
        'viewerToolbarPosition' => ZNanoGaleryWidget::viewerToolbarPosition['bottomOverImage'],
        'viewerToolbarAlign' => ZNanoGaleryWidget::viewerToolbarAlign['center'],
        'viewerToolbarFullWidth' => false,
        'viewerTheme' => ZNanoGaleryWidget::viewerTheme['border'],
        'viewerImageDisplay' => ZNanoGaleryWidget::viewerImageDisplay['bestImageQuality'],
        'grapes' => true,
    ];

    public const type = [
        'grid' => 'grid',
        'justified' => 'justified',
        'cascading' => 'cascading',
        'mosaic' => 'mosaic',
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

    public $layout = [];
    public $_layout = [
        'main' => <<<HTML
          <div id="{id}">
               
          </div>
          HTML,



        'js' => <<<JS
            jQuery(document).ready(function () {
            jQuery("#{id}").nanogallery2({
            /*kind: 'flickr',*/
            items:[
                {galleryItem}
            ],
            {type}
            galleryMaxItems: {galleryMaxItems},
            galleryDisplayMode: 'pagination',                 // gallery pagination mode
            galleryMaxRows: 3,                                // gallery with max 3 rows
            //gallerySorting: 'random',
            thumbnailAlignment: 'fillWidth',
            thumbnailL1GutterWidth: 20,
            thumbnailL1GutterHeight: 20,
            thumbnailBorderHorizontal: 1,
            thumbnailBorderVertical: 1,
            thumbnailL1Label: {
            display: true, 
                position: '{thumbnailL1LabelPosition}', 
                hideIcons: true, 
                titleFontSize: '1.5em', 
                align: 'left'
                },
            thumbnailToolbarImage :  { 
                topLeft: 'select',
                bottomRight : 'featured,display,download,info,cart' 
                },
            thumbnailDisplayTransition: '{thumbnailDisplayTransition}',       // thumbnail display animation
            thumbnailDisplayTransitionDuration: {thumbnailDisplayTransitionDuration},
            thumbnailDisplayInterval: 200,
            thumbnailDisplayOrder: 'rowByRow',
            thumbnailHoverEffect2: 'toolsSlideUp|labelSlideDown',
            touchAnimation: true,
            touchAutoOpenDelay: -1,
            galleryTheme : { 
                thumbnail: { 
                    titleShadow : 'none', 
                    descriptionShadow : 'none', 
                    titleColor: '#fff', 
                    borderColor: '#fff', 
                    background: '#444',
                    backgroundImage: 'linear-gradient(315deg, #111 0%, #557 90%)'
                    },
                navigationPagination :  { 
                    background: '#3C4B5B', 
                    color: '#fff', 
                    colorHover: '#aaa', 
                    borderRadius: '4px' },
            },
            
		
  });
});
JS,
        'grid' => <<<JS
        thumbnailWidth:  {thumbnailWidth},
        thumbnailHeight: {thumbnailHeight},
JS,

        'mosaic' => <<<JS
        thumbnailWidth:  {thumbnailWidth},
        thumbnailHeight: {thumbnailHeight},
        galleryMosaic : {galleryMosaic}, 
JS,
        'cascading' => <<<JS
        thumbnailWidth:  {thumbnailWidth},
        thumbnailHeight: {thumbnailHeight},
JS,
        'justified' => <<<JS
        thumbnailWidth:  {thumbnailWidth},
        thumbnailHeight: {thumbnailHeight},
        galleryMosaic : {galleryMosaic}, 

JS,



    ];


    public function asset()
    {
       /* $this->fileJs('https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.1/jquery.min.js');*/
        $this->fileCss('https://cdn.jsdelivr.net/npm/nanogallery2@2.4.2/dist/css/nanogallery2.min.css');
        $this->fileJs('https://cdn.jsdelivr.net/npm/nanogallery2@2.4.2/dist/jquery.nanogallery2.js');
    }


    private function itemGen()
    {

        $item = '';
        $data = $this->data;
        $path = $this->_config['path'];
        //vdd($path);
        switch (true) {
            case  $this->modelCheck():
                $path = '/upload/' . $this->modelClassName . '/' . $this->attribute . '/' . $this->model->id;
                $files = ZFileHelper::findFiles($path, [
                    'only' => [
                        '*.jpg',
                        '*.png',
                        '*.gif'
                    ]
                ]);

                break;

            case  !empty($this->data):
                foreach ($this->data as $key => $val) {

                    $files[$key] = strtr($val, [
                        Az::getAlias('@webroot') => '',
                        '\\' => '/'
                    ]);

                }


                break;
            case  !empty($this->_config['path']):
                $imagePath =Root.'/'. $path;
                //vdd($imagePath);

                $files = ZFileHelper::findFiles($imagePath, [
                    'only' => [
                        '*.jpg',
                        '*.png',
                        '*.gif'
                    ]
                ]);
                //vdd($files);
                break;
        }

        foreach ($files as $key => $value){
            $newVal = str_replace('\\', '/', $value);
            $Newfiles[] = $newVal;
        }
        //vdd($Newfiles);
        foreach ($Newfiles as $key => $value) {
            $root = Root.'/';
            $root = str_replace('\\', '/', $root);
            $newVal2 = str_replace($root, '/', $value);
            $item .= <<<JS
{ src: '{$newVal2}', srct: '{$newVal2}', title: '$key' },
JS;

        }
        //vdd($item);
        return $item;

    }

    public function getBaseUrl()
    {
        return Az::getAlias(Az::getAlias('@webroot/') . $this->_config['path']);
    }


    public function codes()
    {   $type = '';
        //vdd($this->_config['thumbnailHeight']);
        switch ($this->_config['type']) {
            case 'grid':
            {
                $type= strtr($this->_layout['grid'], [
                    '{thumbnailHeight}' => $this->jscode($this->_config['thumbnailHeight']),
                    '{thumbnailWidth}' => $this->jscode($this->_config['thumbnailWidth']),

                ]);
                break;
            }
            case 'justified':
            {
                $type = strtr($this->_layout['justified'], [
                    '{thumbnailHeight}' => $this->jscode($this->_config['thumbnailHeight']),
                    '{thumbnailWidth}' => '"auto"',
                     '{galeryMosaic}' => $this->jscode($this->_config['galeryMosaic']),

                ]);
                break;
            }
            case 'cascading':
            {
                $type = strtr($this->_layout['cascading'], [
                    '{thumbnailHeight}' => '"auto"',
                    '{thumbnailWidth}' => $this->jscode($this->_config['thumbnailHeight']),

                ]);
                break;
            }
            case 'mosaic':
            {
                $type = strtr($this->_layout['mosaic'], [
                    '{thumbnailHeight}' => $this->jscode($this->_config['thumbnailHeight']),
                    '{thumbnailWidth}' => $this->jscode($this->_config['thumbnailWidth']),
                    '{galeryMosaic}' => $this->jscode($this->_config['galeryMosaic']),
                ]);
                break;
            }
        }


        /**
         * ^ "{ src: '/render/cpa/images/bg_top.png', srct: '/render/cpa/images/bg_top.png', title: '0' },{ src: '/render/cpa/images/first_bg1.png', srct: '/render/cpa/images/first_bg1.png', title: '1' },{ src: '/render/cpa/images/first_illustration1.png', srct: '/render/cpa/images/first_illustration1.png', title: '2' },{ src: '/render/cpa/images/footer-bg.png', srct: '/render/cpa/images//footer-bg.png', title: '3' },{ src: '/render/cpa/images/photo_2020-08-29_09-34-13.jpg', srct: '/render/cpa/images/photo_2020-08-29_09-34-13.jpg', title: '4' },{ src: '/render/cpa/images/photo_2020-08-29_09-34-18.jpg', srct: 'D:/Develop/Projects/ALL/asrorz/zetsoft/render/cpa/images//photo_2020-08-29_09-34-18.jpg', title: '5' },{ src: 'D:/Develop/Projects/ALL/asrorz/zetsoft/render/cpa/images//photo_2020-08-29_09-34-20.jpg', srct: 'D:/Develop/Projects/ALL/asrorz/zetsoft/render/cpa/images//photo_2020-08-29_09-34-20.jpg', title: '6' },{ src: 'D:/Develop/Projects/ALL/asrorz/zetsoft/render/cpa/images//photo_2020-08-29_09-34-24.jpg', srct: 'D:/Develop/Projects/ALL/asrorz/zetsoft/render/cpa/images//photo_2020-08-29_09-34-24.jpg', title: '7' },{ src: 'D:/Develop/Projects/ALL/asrorz/zetsoft/render/cpa/images//shield_top.png', srct: 'D:/Develop/Projects/ALL/asrorz/zetsoft/render/cpa/images//shield_top.png', title: '8' },{ src: 'D:/Develop/Projects/ALL/asrorz/zetsoft/render/cpa/images//Zeydoo_ill.png', srct: 'D:/Develop/Projects/ALL/asrorz/zetsoft/render/cpa/images//Zeydoo_ill.png', title: '9' }, ◀"
         *
         */

        $galleryItem = $this->itemGen();
        //vdd($galleryItem);
        $this->htm = strtr($this->_layout['main'], [
            '{id}' => $this->id,
        ]);



        $this->js .= strtr($this->_layout['js'], [
            '{id}' => $this->id,
            '{galleryItem}' => $galleryItem,
            '{galleryMaxItems}' => $this->_config['galleryMaxItems'],
            '{thumbnailL1LabelPosition}' => $this->jscode($this->_config['thumbnailLabelPosition']),
            '{thumbnailDisplayTransition}' => $this->jscode($this->_config['thumbnailDisplayTransition']),
            '{thumbnailDisplayTransitionDuration}' => $this->jscode($this->_config['thumbnailDisplayTransitionDuration']),
            '{thumbnailDisplayInterval}' => $this->jscode($this->_config['thumbnailDisplayInterval']),
            '{type}' => $type


        ]);

    }
}
