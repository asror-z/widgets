<?php
/**
 *
 *
 * Author:  Asror Zakirov
 *
 * https://www.linkedin.com/in/asror-zakirov
 * https://www.facebook.com/asror.zakirov
 * https://github.com/asror-z
 *
 */

namespace zetsoft\widgets\consts;


interface ZCardWidgetConst
{


    /**
     *
     * types
     */

    public const Type_Empty = '';
    public const Type_Primary = 'card-primary';
    public const Type_Succes = 'card-success';
    public const Type_Warning = 'card-warning';
    public const Type_Danger = 'card-danger';
    public const Type_Secondary = 'card-secondary';
    public const Type_Info = 'card-info';
    public const Type_Light = 'card-light';
    public const Type_Dark = 'card-dark';
    public const Type_Default = 'card-default';

    /**
     *
     * Gradients
     */

    public const Gradient_Empty = '';
    public const Gradient_Primary = 'bg-primary-gradient';
    public const Gradient_Succes = 'bg-success-gradient"';
    public const Gradient_Warning = 'bg-warning-gradient';
    public const Gradient_Danger = 'bg-danger-gradient';
    public const Gradient_Secondary = 'bg-secondary-gradient';
    public const Gradient_Info = 'bg-info-gradient';
    public const Gradient_Light = 'bg-light-gradient';
    public const Gradient_Dark = 'bg-dark-gradient';


    /**
     * Buttons
     */

    public const aBtnType = [
        self::Type_Primary,
        self::Type_Success,
        self::Type_Info,
        self::Type_Default,
    ];


}
