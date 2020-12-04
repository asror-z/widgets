<?php

/**
 *
 *
 * Author:  Asror Zakirov
 * https://www.linkedin.com/in/asror-zakirov
 * https://www.facebook.com/asror.zakirov
 * https://github.com/asror-z
 *
 */

/**
 * https://github.com/gitrequests/img-checkbox
 */

namespace zetsoft\widgets\inptest;

use zetsoft\system\kernels\ZWidget;

class ZImgCheckBoxWidgetOLD extends ZWidget
{
    public function asset(){
        $this->fileCss('https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css');
        $this->fileCss('/render/inptest/ZImgCheckBoxWidgetOLD/assets/imgCheckBox/animation.imgcheckbox.min.css');
        $this->fileCss('/render/inptest/ZImgCheckBoxWidgetOLD/assets/imgCheckBox/css.css');
        $this->fileJs('/render/inptest/ZImgCheckBoxWidgetOLD/assets/imgCheckBox/holder.min.js');
        $this->fileJs('/render/inptest/ZImgCheckBoxWidgetOLD/assets/imgCheckBox/jquery.imgcheckbox.min.js');
        
    }


    public function codes()
    {
        $this->htm = <<<HTML
    <div class="body-wrapper">
        <figure>
            <div class="figure-content"><img src="holder.js/200x200"></div>
            <figcaption><i class="fa fa-check fa-5x"></i></figcaption>
            <label><input type="checkbox" name="name"> Label</label>
        </figure>
        <figure>
            <div class="figure-content"><img src="holder.js/200x200"></div>
            <figcaption><i class="fa fa-check fa-5x"></i></figcaption>
            <label><input type="checkbox" name="name"> Label</label>
        </figure>
        <figure>
            <div class="figure-content"><img src="holder.js/200x200"></div>
            <figcaption><i class="fa fa-check fa-5x"></i></figcaption>
            <label><input type="checkbox" name="name"> Label</label>
        </figure>
    </div>
HTML;

        $this->js = <<<JS
        $(document).ready(function(){
            Holder.run();
        
           $('figure').imgCheckbox({
                width: '200px',
                height: 'auto',
                textColor: 'white',
                overlayBgColor: 'blue',
                overlayOpacity: '0.4',
                round: true,
                animation: true,
                animationDuration: 300,
            });
        });


JS;

    }
}
