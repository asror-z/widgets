<?php
/**
 *
 *
 * Author:  Asror Zakirov
 * Date:    20.05.2019
 * https://www.linkedin.com/in/asror-zakirov
 * https://www.facebook.com/asror.zakirov
 * https://github.com/asror-z
 *
 */

namespace zetsoft\widgets\consts;


interface ZMMenuWidgetConst
{

    /**
     * EFFECTS FOR THE MENU EXTENSIONS
     * fx-menu-fade-Use the "fade" effect
     * fx-menu-slide-Use the "slide" effect
     * fx-menu-zoom-Use the "zoom" effect
     */
    public const Extension_Menu_Fade = 'fx-menu-fade';
    public const Extension_Menu_Slide = 'fx-menu-slide';
    public const Extension_Menu_Zoom = 'fx-menu-zoom';

    /**
     * EFFECTS FOR THE PANELS EXTENSIONS
     * fx-panels-none-No effect for the panels
     * fx-panels-slide-0-Use the "slide 0" effect
     * fx-panels-slide-100-Use the "slide 100" effect
     * fx-panels-slide-up-Use the "slide up" effect
     * fx-panels-zoom-Use the "zoom" effect
     */
    public const Extension_Panels_None = 'fx-panels-none';
    public const Extension_Panels_Slide_0 = 'fx-panels-slide-0';
    public const Extension_Panels_Slide_100 = 'fx-panels-slide-100';
    public const Extension_Panels_Slide_Up = 'fx-panels-slide-up';
    public const Extension_Panels_Zoom = 'fx-panels-zoom';


    /**
     * EFFECTS FOR THE LISTITEMS EXTENSIONS
     * fx-listitems-drop-Use the "drop" effect
     * fx-listitems-fade-Use the "fade" effect
     * fx-listitems-slide-Use the "slide" effect
     *
     */
    public const Extension_ListItems_Drop = 'fx-listitems-drop';
    public const Extension_ListItems_Fade = 'fx-listitems-fade';
    public const Extension_ListItems_Slide = 'fx-listitems-slide';


    /**
     * FULLSCREEN EXTENSION
     * fullscreen-Open the menu in fullscreen mode
     */
    public const Extension_Fullscreen = 'fullscreen';


    /**
     * LISTVIEW EXTENSION
     * fullscreen-Open the menu in fullscreen mode
     */
    public const Extension_Listview_Justify = 'listview-justify';


    /**
     * MULTILINE EXTENSION
     * multiline-Truncated listitems to a single line
     */
    public const Extension_Multiline = 'multiline';


    /**
     * PAGE DIM EXTENSIONS
     * pagedim-white-Dim out the page to white
     * pagedim-black-Dim out the page to black
     */
    public const Extension_Pagedim_White = 'pagedim-white';
    public const Extension_Pagedim_Black = 'pagedim-black';


    /**
     * POPUP EXTENSION
     * popup-Open the menu as a popup
     */
    public const Extension_Popup = 'popup';


    /**
     * POSITIONING EXTENSIONS
     * position-right-Open the menu from the right
     * position-top-position the menu at the top
     * position-bottom-position the menu at the bottom
     */
    public const Extension_Position_Right = 'position-right';
    public const Extension_Position_Top = 'position-right';
    public const Extension_Position_Bottom = 'position-bottom';


    /**
     * Z-POSITIONING EXTENSION
     * position-back-Positions the menu behind the page
     * position-front-Positions the menu in front of the page
     */
    public const Extension_Position_Back = 'position-back';
    public const Extension_Position_Front = 'position-front';


    /**
     * PAGE SHADOWS EXTENSION
     * shadow-page-Add a shadow to the page
     */
    public const Extension_Shadow_Page = 'shadow-page';


    /**
     * PANEL SHADOWS EXTENSION
     * shadow-panels-Add a shadow to the panels
     */
    public const Extension_Shadow_Panel = 'shadow-panels';


    /**
     * THEMES EXTENSION
     * theme-dark-Apply the "dark" theme to the menu
     * theme-white-Apply the "white" theme to the menu
     * theme-black-Apply the "black" theme to the menu
     */
    public const Extension_Theme_Dark = 'theme-dark';
    public const Extension_Theme_White = 'theme-white';
    public const Extension_Theme_Black = 'theme-black';


    /**
     * TILEVIEW EXTENSION
     * tileview-Use a tileview layout
     */
    public const Extension_Tileview= 'tileview';


    /**
     *
     * SearchMenu Positions
     */

    public const Position_Top = 'top';
    public const Position_Bottom = 'bottom';


    /**
     * BORDER STYLES EXTENSIONS
     * border-full-Use the "full" border style
     * border-offset-Use the "offset" border style
     * border-none-Use the "none" border style
     */

    public const Border_Full = 'border-full';
    public const Border_Offset = 'border-offset';
    public const Border_None = 'border-none';


    /**
     *
     * Navbars List
     */

    public const Navbar_Searchfield = 'searchfield';
    public const Navbar_Breadcrumb = 'breadcrumbs';
    public const Navbar_Close = 'close';
    public const Navbar_Next = 'next';
    public const Navbar_Prev = 'prev';
    public const Navbar_Title = 'title';


    /**
     *
     * Wrappers List
     */
    public const Wrappers_Bootstrap4 = 'bootstrap4';
    public const Wrappers_Magento = 'magento';
    public const Wrappers_Olark = 'olark';
    public const Wrappers_Turbolink = 'turbolinks';
    public const Wrappers_Wordpres = 'wordpress';
    public const Wrappers_Angular = 'angular';



}
