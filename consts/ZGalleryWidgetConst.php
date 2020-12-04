<?php
namespace zetsoft\widgets\consts;


interface ZGalleryWidgetConst
{

    /**
     * Grid Layout
     */
    public const Layout_Grid = 'grid';
    public const Layout_Justified = 'justified';
    public const Layout_Cascading = 'cascading';
    public const Layout_Mosaic = 'mosaic';
    /**
     * galleryDisplayMode
     * https://nanogallery2.nanostudio.org/documentation.html#ngy2_gallery
     */
    public const Gallery_Display_Mode_FullContent = 'fullContent';
    public const Gallery_Display_Mode_MoreButton = 'moreButton';
    public const Gallery_Display_Mode_Pagination = 'pagination';
    public const Gallery_Display_Mode_Row = 'rows';

    public const Gallery_Pagination_Mode_Rectangle = 'rectangles';
    public const Gallery_Pagination_Mode_Dot = 'dots';
    public const Gallery_Pagination_Mode_Number = 'numbers';

    public const Gallery_Sorting_None = '';
    public const Gallery_Sorting_TitleAsc = 'titleAsc';
    public const Gallery_Sorting_TitleDesc = 'titleDesc';
    public const Gallery_Sorting_Reversed = 'reversed';
    public const Gallery_Sorting_Random = 'random';

    public const Gallery_Theme_Dark = 'dark';
    public const Gallery_Theme_Light = 'light';

    public const Gallery_Display_Transition_None = 'none';
    public const Gallery_Display_Transition_SlideUp = 'slideUp';
    public const Gallery_Display_Transition_RotateX = 'rotateX';


    /**
     * THUMBNAILS
     * https://nanogallery2.nanostudio.org/documentation.html#ngy2_gallery_thumbnails
     */
    public const Thumbnail_Alignment_FillWidth = 'fillWidth';
    public const Thumbnail_Alignment_Left = 'left';
    public const Thumbnail_Alignment_Right = 'right';
    public const Thumbnail_Alignment_Center = 'center';
    public const Thumbnail_Alignment_Justified = 'justified';

    public const Thumbnail_Display_Transition_None = 'none';
    public const Thumbnail_Display_Transition_SlideUp = 'slideUp';
    public const Thumbnail_Display_Transition_SlideDown = 'slideDown';
    public const Thumbnail_Display_Transition_ScaleUp = 'scaleUp';
    public const Thumbnail_Display_Transition_ScaleDown = 'scaleDown';
    public const Thumbnail_Display_Transition_FadeIn = 'fadeIn';
    public const Thumbnail_Display_Transition_RandomScale = 'randomScale';
    public const Thumbnail_Display_Transition_FlipDown = 'flipDown';
    public const Thumbnail_Display_Transition_FlipUp = 'flipUp';
    public const Thumbnail_Display_Transition_SlideDown2 = 'slideDown2';
    public const Thumbnail_Display_Transition_SlideUp2 = 'slideUp2';
    public const Thumbnail_Display_Transition_SlideRight = 'slideRight';
    public const Thumbnail_Display_Transition_SlideLeft = 'slideLeft';
    public const Thumbnail_Display_Transition_Custom = 'custom';

    /**
     * THUMBNAIL LABELS
     * https://nanogallery2.nanostudio.org/documentation.html#ngy2_gallery_thumbnails_label
     *
     * @var string
     * overImageOnBottom', 'overImageOnTop', 'overImageOnMiddle', 'onBottom'
     */
    public const ThumbnailPosition_OverImageOnBottom = 'overImageOnBottom';
    public const ThumbnailPosition_OverImageOnTop = 'overImageOnTop';
    public const ThumbnailPosition_overImageOnMiddle = 'overImageOnMiddle';
    public const ThumbnailPosition_onBottom = 'onBottom';

    public const ThumbnailAlign_Center = 'center';
    public const ThumbnailAlign_Right = 'right';
    public const ThumbnailAlign_Left = 'left';

    /**
     * THUMBNAIL-TOUCH AND HOVER EFFECTS
     * https://nanogallery2.nanostudio.org/documentation.html#ngy2_gallery_thumbnails_hover
     */
    public const  Effect_On_Image_ImageBlurOn = 'imageBlurOn';
    public const  Effect_On_Image_ImageBlurOff = 'imageBlurOff';
    public const  Effect_On_Image_ImageGrayOn = 'imageGrayOn';
    public const  Effect_On_Image_ImageGrayOff = 'imageGrayOff';
    public const  Effect_On_Image_ImageSepiaOn = 'imageSepiaOn';
    public const  Effect_On_Image_ImageSepiaOff = 'imageSepiaOff';
    public const  Effect_On_Image_ImageScale150 = 'imageScale150';
    public const  Effect_On_Image_ImageScaleIn80 = 'imageScaleIn80';
    public const  Effect_On_Image_ImageScale150Outside = 'imageScale150Outside';
    public const  Effect_On_Image_ImageSlideUp = 'imageSlideUp';
    public const  Effect_On_Image_ImageSlideDown = 'imageSlideDown';
    public const  Effect_On_Image_ImageSlideRight = 'imageSlideRight';
    public const  Effect_On_Image_ImageSlideLeft = 'imageSlideLeft';

    public const Effect_On_Tools_Toolappear = 'toolappear';
    public const Effect_On_Tools_ToolsSlideDown = 'toolsSlideDown';
    public const Effect_On_Tools_ToolsSlideUp = 'toolsSlideUp';

    public const Effect_On_Label_LabelAppear = 'labelAppear';
    public const Effect_On_Label_LabelAppear75 = 'labelAppear75';
    public const Effect_On_Label_LabelOpacity50 = 'labelOpacity50';
    public const Effect_On_Label_ScaleLabelOverImage = 'scaleLabelOverImage';
    public const Effect_On_Label_DescriptionAppear = 'descriptionAppear';
    public const Effect_On_Label_LabelSlideUpTop = 'labelSlideUpTop';
    public const Effect_On_Label_LabelSlideUp = 'labelSlideUp';
    public const Effect_On_Label_LabelSlideDown = 'labelSlideDown';
    public const Effect_On_Label_DescriptionSlideUp = 'descriptionSlideUp';

    public const Effect_On_Whole_Thumbnail_Scale120 = 'scale120';

    public const Effect_On_Thumbnail_Border_BorderLighter = 'borderLighter';
    public const Effect_On_Thumbnail_Border_BorderDarker = 'borderDarker';

    public const Misc_OverScale = 'overScale';
    public const Misc_OverScaleOutside = 'overScaleOutside';
    public const Misc_SlideUp = 'slideUp';
    public const Misc_SlideDown = 'slideDown';
    public const Misc_SlideRight = 'slideRight';
    public const Misc_SlideLeft = 'slideLeft';

    /**
     *  THUMBNAIL-TOOLS
     * https://nanogallery2.nanostudio.org/documentation.html#ngy2_thumbnail_tools
     */
    public const Thumbnail_Toolbar_Image_Select = 'select';
    public const Thumbnail_Toolbar_Image_Share = 'share';
    public const Thumbnail_Toolbar_Image_Featured = 'featured';
    public const Thumbnail_Toolbar_Image_Download = 'download';
    public const Thumbnail_Toolbar_Image_Cart = 'cart';
    public const Thumbnail_Toolbar_Image_Info = 'info';

    public const Thumbnail_Toolbar_Album_Select = 'select';
    public const Thumbnail_Toolbar_Album_Share = 'share';
    public const Thumbnail_Toolbar_Album_Counter = 'counter';
    public const Thumbnail_Toolbar_Album_Counter2 = 'counter2';
    public const Thumbnail_Toolbar_Album_Cart = 'cart';

    /**
     * NAVIGATION
     * https://nanogallery2.nanostudio.org/documentation.html#ngy2_navigation
     */
    public const Gallery_Filter_Tags_False = false;
    public const Gallery_Filter_Tags_True = true;
    public const Gallery_Filter_Tags_Title = 'title';
    public const Gallery_Filter_Tags_Description = 'title';
    /**
     *  IMAGE DISPLAY-LIGHTBOX
     *  https://nanogallery2.nanostudio.org/documentation.html#ngy2_lightbox
     */
    public const Viewer_PreviousButton = 'previousButton';
    public const Viewer_NextButton = 'nextButton';
    public const Viewer_RotateLeft = 'rotateLeft';
    public const Viewer_RotateRight = 'rotateRight';
    public const Viewer_PageCounter = 'pageCounter';
    public const Viewer_PlayPauseButton = 'playPauseButton';
    public const Viewer_FullscreenButton = 'fullscreenButton';
    public const Viewer_InfoButton = 'infoButton';
    public const Viewer_LinkOriginalButton = 'linkOriginalButton';
    public const Viewer_CloseButton = 'closeButton';
    public const Viewer_DownloadButton = 'downloadButton';
    public const Viewer_ZoomButton = 'zoomButton';
    public const Viewer_ShareButton = 'shareButton';
    public const Viewer_Label = 'label';
    public const Viewer_MinimizeButton = 'minimizeButton';

    public const Image_Transition_Swipe2 = 'swipe2';
    public const Image_Transition_SlideAppear = 'slideAppear';
    public const Image_Transition_Swipe = 'swipe';

    public const Viewer_Position_BottomOverImage = 'bottomOverImage';
    public const Viewer_Position_Top = 'top';
    public const Viewer_Position_TopOverImage = 'topOverImage';
    public const Viewer_Position_Bottom = 'bottom';

    public const Viewer_Align_Center = 'center';
    public const Viewer_Align_Left = 'left';
    public const Viewer_Align_Right = 'right';

    public const Viewer_Theme_Dark = 'dark';
    public const Viewer_Theme_Light = 'light';
    public const Viewer_Theme_Border = 'border';

    public const Viewer_Image_Display_None = '';
    public const Viewer_Image_Display_BestImageQuality = 'bestImageQuality';
    public const Viewer_Image_Display_Upscale = 'upscale';

    public const Viewer_Transition_MediaKind_Img = 'img';
    public const Viewer_Transition_MediaKind_Iframe = 'iframe';

}
