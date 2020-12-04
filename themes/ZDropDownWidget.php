<?php

use zetsoft\dbitem\data\TabItem;

/**
 *
 *
 * @author  Daho
 * @copyright 12.07.2020
 *
 */

namespace zetsoft\widgets\themes;


use zetsoft\system\kernels\ZWidget;

class ZDropDownWidget extends ZWidget
{
    public $_config = [
        'title' => 'DropDown',
        'class' => 'btn btn-primary',
        'link' => true,
    ];
    public $_layout = [
        'main' => <<<HTML
<div class="dropdown">
  <button class="{class} dropdown-toggle" type="button" id="ddbutton{id}" data-toggle="dropdown" aria-haspopup="false" aria-expanded="false">
    {title}
  </button>
  
  <div class="dropdown-menu" aria-labelledby="ddbutton{id}">
    {links}
  </div>
</div>
HTML,
    'links' => <<<HTML
         <a  href="{link}">{text}</a>
HTML,
        'no-link' => <<<HTML
            {text}
HTML,

    ];

    public function codes()
    {
        $links = null;
        /** @var TabItem $item */
        foreach ($this->data as $item){
            $l = 'no-link';
            if ($this->_config['link']) {
                $l = 'link';
            }
            $links .= strtr($this->_layout[$l], [
                '{text}' => $item->title,
                '{link}' => $item->url,
                '{class}' => $item->class,
            ]);

        }

        $this->htm = strtr($this->_layout['main'], [
            '{id}' => $this->id,
            '{links}' => $links,
            '{title}' => $this->_config['title'],
            '{class}' => $this->_config['class']
        ]);
    }

}
