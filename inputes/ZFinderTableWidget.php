<?php

/**
 *
 *
 * Author:  jamshid Tojiboyev
 * https://www.linkedin.com/in/asror-zakirov
 * https://www.facebook.com/asror.zakirov
 * https://github.com/asror-z
 *
 */

namespace zetsoft\widgets\inputes;

use PhpOffice\PhpSpreadsheet\Shared\OLE\PPS\Root;
use zetsoft\system\kernels\ZWidget;
use function GuzzleHttp\Psr7\str;


/**
 * Class    ZImgRadioWidget
 * @package zetsoft\widgets\inputes
 *
 *
 */
class ZFinderTableWidget extends ZWidget
{

    /**
     * Configuration
     */

    public $config = [];
    public $_config = [

    ];


    public $layout = [];
    public $_layout = [
        'radio' => <<<HTML
<div class="col-lg-12">
        <h2>Extending</h2>
        <p>finderSelect was design to be easily extended. See the example below to see how the highlighting functions can be overridden to provide new functionality.</p>
        <table class="table table-condensed" id="demo5">
            <thead>
            <tr>
                <td><input type="checkbox"></td>
                <td>Name</td>
                <td>Type</td>
                <td>Last Accessed</td>
            </tr>
            </thead>
            <tbody>
            <tr class="stateSelected un-selected selected-current" style="cursor: pointer;">
                <td><input type="checkbox"></td>
                <td>hello.png</td>
                <td>Portable Networks Graphic image</td>
                <td>Friday, 24 July 2013 4:59PM</td>
                <td>Unsafe Zone. <a href="./demo_2_files/Hello.png" target="_blank"><i class="icon-edit"></i></a></td>
            </tr>
            <tr class="stateUnSelected selected-last un-selected" style="cursor: pointer;">
                <td><input type="checkbox"></td>
                <td>hello.png</td>
                <td>Portable Networks Graphic image</td>
                <td>Friday, 24 July 2013 4:59PM</td>
                <td>Unsafe Zone. <a href="./demo_2_files/Hello.png" target="_blank"><i class="icon-edit"></i></a></td>
            </tr>
            <tr class="stateSelected un-selected" style="cursor: pointer;">
                <td><input type="checkbox"></td>
                <td>hello.png</td>
                <td>Portable Networks Graphic image</td>
                <td>Friday, 24 July 2013 4:59PM</td>
                <td class="safezone">Click Safe Zone. <a href="./demo_2_files/Hello.png" target="_blank"><i class="icon-edit"></i></a></td>
            </tr>
            <tr class="stateSelected un-selected" style="cursor: pointer;">
                <td><input type="checkbox"></td>
                <td>hello.png</td>
                <td>Portable Networks Graphic image</td>
                <td>Friday, 24 July 2013 4:59PM</td>
                <td class="safezone">Click Safe Zone. <a href="./demo_2_files/Hello.png" target="_blank"><i class="icon-edit"></i></a></td>
            </tr>
            <tr class="stateSelected un-selected" style="cursor: pointer;">
                <td><input type="checkbox"></td>
                <td>hello.png</td>
                <td>Portable Networks Graphic image</td>
                <td>Friday, 24 July 2013 4:59PM</td>
                <td class="safezone">Click Safe Zone. <a href="./demo_2_files/Hello.png" target="_blank"><i class="icon-edit"></i></a></td>
            </tr>
            <tr class="stateSelected un-selected" style="cursor: pointer;">
                <td><input type="checkbox"></td>
                <td class="safezone">hello.png</td>
                <td class="safezone">Portable Networks Graphic image</td>
                <td class="safezone">Friday, 24 July 2013 4:59PM</td>
                <td class="safezone">Click Safe Zone. <a href="./demo_2_files/Hello.png" target="_blank"><i class="icon-edit"></i></a></td>
            </tr>
            <tr class="stateSelected un-selected" style="cursor: pointer;">
                <td><input type="checkbox"></td>
                <td class="safezone">hello.png</td>
                <td class="safezone">Portable Networks Graphic image</td>
                <td class="safezone">Friday, 24 July 2013 4:59PM</td>
                <td class="safezone">Click Safe Zone. <a href="./demo_2_files/Hello.png" target="_blank"><i class="icon-edit"></i></a></td>
            </tr>
            </tbody>
        </table>

    </div>
    

HTML,


        'js' => <<<JS
  $(function() {
        var demo1 = $('#demo1').finderSelect({children:"tr",totalSelector:".demo1-count",menuSelector:"#demo1-menu"});

        $(".demo1-trash").click(function(){
            demo1.finderSelect("selected").remove();
            demo1.finderSelect("update");
        });

        $(".demo1-preview").click(function(){
            demo1.finderSelect("selected").each(function(index){
                OpenInNewTab($(this).attr('data-url')+"?rand="+index);
            });
        });

        $(".demo1-edit").click(function(){
            demo1.finderSelect("selected").each(function(){
                OpenInNewTab('http://pixlr.com/editor/?image='+$(this).attr('data-url'));
            });
        });

        $('#demo2').find('tbody').finderSelect();
        $('#demo3').find('tbody').finderSelect({selectClass:"danger"});
        $('#demo4').finderSelect({selectClass:'label-success'});

        // Initialise the Demo with the Ctrl Click Functionality as the Default
        var demo5 = $('#demo5 tbody').finderSelect({enableDesktopCtrlDefault:true});

        // Add a hook to the highlight function so that checkboxes in the selection are also checked.
        demo5.finderSelect('addHook','highlight:before', function (event) {
            el.find('input').prop('checked', true);
        });


        // Add a hook to the unHighlight function so that checkboxes in the selection are also unchecked.
        demo5.finderSelect('addHook','unHighlight:before', function (event) {
            el.find('input').prop('checked', false);
        });

        // Enable Double Click Event.
        demo5.finderSelect("children").dblclick(function() {
            alert( "Double Click detected. Useful for linking to detail page." );
        });

        // Add a Safe Zone to show not all child elements have to be active.
        $(".safezone").on("mousedown", function (event){
            return false;
        });

        // Prevent Checkboxes from being triggered twice when click on directly.
        demo5.on("click", "input[type='checkbox']", function (event){
            e.preventDefault();
        });

        // Add Select All functionality to the checkbox in the table header row.
        $('#demo5').find("thead input[type='checkbox']").change(function () {
            if ($(this).is(':checked')) {
                demo5.finderSelect('highlightAll');
            } else {
                demo5.finderSelect('unHighlightAll');
            }
        });


        prettyPrint();


    });

    function OpenInNewTab(url )
    {
        var win=window.open(url, '_blank');
        win.focus();
    }

JS,

        'css' => <<<CSS
       
CSS,


    ];

    public function asset()
    {
        $this->fileJs('//cdnjs.cloudflare.com/ajax/libs/jquery.finderselect/0.6.0/jquery.finderselect.min.js');
        
    }

    public function codes()
    {

        $this->htm .= strtr($this->_layout['radio'], [
            '{id}' => $this->id,
            '{value}' => $this->value,
            '{name}' => $this->name,
            '{label}' => $this->_config['label'],
            '{content}' => $this->_config['content'],
            '{className}' => $this->className,

        ]);

        $this->css = strtr($this->_layout['css'], [
            '{width}' => $this->_config['width'],
            '{height}' => $this->_config['height'],
        ]);

        $this->value--;

        //vdd($this->value);
        $this->js = strtr($this->_layout['js'], [
            '{id}' => $this->id,
            '{checkMarkImage}' => $this->jscode($this->_config['checkMarkImage']),
            '{graySelected}' => $this->jscode($this->_config['graySelected']),
            '{scaleSelected}' => $this->jscode($this->_config['scaleSelected']),
            '{fixedImageSize}' => $this->jscode($this->_config['fixedImageSize']),
            '{checkMarkSize}' => $this->jscode($this->_config['checkMarkSize']),
            '{checkMarkPosition}' => $this->jscode($this->_config['checkMarkPosition']),
            '{scaleCheckMark}' => $this->jscode($this->_config['scaleCheckMark']),
            '{fadeCheckMark}' => $this->jscode($this->_config['fadeCheckMark']),
            '{addToForm}' => $this->jscode($this->_config['addToForm']),
            '{canDeselect}' => $this->jscode($this->_config['canDeselect']),
            '{radio}' => $this->jscode($this->_config['radio']),
            '{preselect}' => $this->value,
            //vdd($this->value)
        ]);


    }
}
