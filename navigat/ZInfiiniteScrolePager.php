<?php

/**
 *
 *
 * Author:  Asror Zakirov
 * https://www.linkedin.com/in/asror-zakirov
 * https://github.com/asror-z
 *
 */

namespace zetsoft\widgets\navigat;


use nirvana\infinitescroll\InfiniteScrollPager;
use zetsoft\system\kernels\ZWidget;

class ZInfiiniteScrolePager extends InfiniteScrollPager
{
      protected function registerLinkTags()
      {
          vdd($this->pagination->getLinks());
      }
}
