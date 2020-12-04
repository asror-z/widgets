<?php

namespace zetsoft\widgets\animo;

use zetsoft\assets\consts\ZAnimateConst;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;



/**
 *
 * Class ZKSelect2Widget
 * http://demos.krajee.com/widget-details/select2
 *
 * Created By: Asror Zakirov
 * Refactored: Asror Zakirov
 */

class ZAnimateCssWidget extends ZWidget
{

    public const attention = [
        'bounce',
        'flash',
        'pulse',
        'rubberBand',
        'shake',
        'swing',
        'tada',
        'wobble',
        'jello',
    ];


    public const bounce = [
        'bounceIn',
        'bounceInDown',
        'bounceInLeft',
        'bounceInRight',
        'bounceInUp',
    ];

    public const fade = [
        'fadeIn',
        'fadeInDown',
        'fadeInDownBig',
        'fadeInLeft',
        'fadeInLeftBig',
        'fadeInRight',
        'fadeInRightBig',
        'fadeInUp',
        'fadeInUpBig',
    ];

    public const flip = [
        'flip',
        'flipInX',
        'flipInY',
    ];

    public const lightspeed = [
        'lightSpeedIn',
    ];

    public const rotate = [
        'rotateIn',
        'rotateInDownLeft',
        'rotateInDownRight',
        'rotateInUpLeft',
        'rotateInUpRight',
    ];

    public const slide = [
        'slideInUp',
        'slideInDown',
        'slideInLeft',
        'slideInRight',
    ];

    public const zoom = [
        'zoomIn',
        'zoomInDown',
        'zoomInLeft',
        'zoomInRight',
        'zoomInUp',
    ];

    public const special = [
        'jackInTheBox',
        'rollIn',
    ];

    public const special_out = [
        'hinge',
        'rollOut',
    ];

    public const out_flip = [
        'flipOutX',
        'flipOutY',
    ];

    public const out_fade = [
        'fadeOut',
        'fadeOutDown',
        'fadeOutDownBig',
        'fadeOutLeft',
        'fadeOutLeftBig',
        'fadeOutRight',
        'fadeOutRightBig',
        'fadeOutUp',
        'fadeOutUpBig',
    ];

    public const out_bounce = [
        'bounceOut',
        'bounceOutDown',
        'bounceOutLeft',
        'bounceOutRight',
        'bounceOutUp',
    ];

    public const out_zoom = [
        'zoomOut',
        'zoomOutDown',
        'zoomOutLeft',
        'zoomOutRight',
        'zoomOutUp',
    ];

    public const out_slide = [
        'slideOutUp',
        'slideOutDown',
        'slideOutLeft',
        'slideOutRight',
    ];

    public const out_rotate = [
        'rotateOut',
        'rotateOutDownLeft',
        'rotateOutDownRight',
        'rotateOutUpLeft',
        'rotateOutUpRight',
    ];


    public const out_lightspeed = [
        'lightSpeedOut',
    ];

    public static function types()
    {
        $return = [
            ZAnimateCssWidget::attention,
            ZAnimateCssWidget::bounce,
            ZAnimateCssWidget::fade,
            ZAnimateCssWidget::flip,
            ZAnimateCssWidget::lightspeed,
            ZAnimateCssWidget::zoom,
            ZAnimateCssWidget::special
        ];

        $return = array_merge(...$return);

        return $return;
        

    }
}
