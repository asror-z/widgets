<?php

namespace zetsoft\widgets\images;

use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\helpers\ZFileHelper;
use zetsoft\system\helpers\ZInflector;
use zetsoft\system\helpers\ZStringHelper;
use function GuzzleHttp\Psr7\str;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\themes\ZCardWidget;
use kartik\widgets\Select2;
use yii\web\JsExpression;

class ZFilterizrWidget extends ZWidget
{


    /**
     * Configuration
     */

    public $config = [];
    public $_config = [
        

    ];



    /**
     *
     * Plugin Events
     * https://select2.org/programmatic-control/events
     */
    public $event = [];
    public $_event = [


    ];


    public function asset()
    {
        $this->fileCss('/render/images/ZFilterizrWidget/assets/style.css');
        $this->fileJs('https://cdnjs.cloudflare.com/ajax/libs/filterizr/2.2.4/jquery.filterizr.min.js');
        $this->fileJs('/render/images/ZFilterizrWidget/assets/js.js');
    }


    public $layout = [];
    public $_layout = [
        'main' => <<<HTML
        <div class="container">

    <!-- Filter Controls - Simple Mode -->
    <div class="row">
        <!-- A basic setup of simple mode filter controls, all you have to do is use data-filter="all"
        for an unfiltered gallery and then the values of your categories to filter between them -->
        <ul class="simplefilter">
            Simple filter controls:
            <li class="fltr-controls active" data-filter="all">All</li>
            <li class="fltr-controls" data-filter="1">Cityscape</li>
            <li class="fltr-controls" data-filter="2">Landscape</li>
            <li class="fltr-controls" data-filter="3">Industrial</li>
            <li class="fltr-controls" data-filter="4">Daylight</li>
            <li class="fltr-controls" data-filter="5">Nightscape</li>
        </ul>
    </div>

    <!-- Filter Controls - Multifilter Mode -->
    <div class="row">
        <!-- A basic setup of multifilter controls, when the user toggles a category
        the corresponding items are rendered or hidden -->
        <ul class="multifilter">
            Multifilter controls:
            <li class="fltr-controls" data-multifilter="1">Cityscape</li>
            <li class="fltr-controls" data-multifilter="2">Landscape</li>
            <li class="fltr-controls" data-multifilter="3">Industrial</li>
        </ul>
    </div>

    <!-- Shuffle & Sort Controls -->
    <div class="row">
        <ul class="sortandshuffle">
            Sort &amp; Shuffle controls:
            <!-- Basic shuffle control -->
            <li class="fltr-controls shuffle-btn" data-shuffle>Shuffle</li>
            <!-- Basic sort controls consisting of asc/desc button and a select -->
            <li class="fltr-controls sort-btn active" data-sortAsc>Asc</li>
            <li class="fltr-controls sort-btn" data-sortDesc>Desc</li>
            <select class="fltr-controls" data-sortOrder>
                <option value="index">
                    Position
                </option>
                <option value="sortData">
                    Description
                </option>
            </select>
        </ul>
    </div>

    <!-- Search control -->
    <div class="row search-row">
        Search control:
        <input
                type="text"
                class="fltr-controls filtr-search"
                name="filtr-search"
                data-search
        />
    </div>

    <div class="row push-down">
        <!-- This is the set up of a basic gallery, your items must have the categories they belong to in a data-category
        attribute, which starts from the value 1 and goes up from there -->
        <div class="filtr-container">
            <div class="filtr-item" data-category="1, 5" data-sort="Busy streets">
                <img
                        class="img-responsive"
                        src="/render/images/ZFilterizrWidget/demo/img//city_1.jpg"
                        alt="sample image"
                        
                />
                <span class="item-desc">Busy Streets</span>
            </div>
            <div
                    class="filtr-item"
                    data-category="2, 5"
                    data-sort="Luminous night"
            >
                <img
                        class="img-responsive"
                        src="/render/images/ZFilterizrWidget/demo/img//nature_2.jpg"
                        alt="sample image"
                />
                <span class="item-desc">Luminous night</span>
            </div>
            <div class="filtr-item" data-category="1, 4" data-sort="City wonders">
                <img
                        class="img-responsive"
                        src="/render/images/ZFilterizrWidget/demo/img//city_3.jpg"
                        alt="sample image"
                />
                <span class="item-desc">city wonders</span>
            </div>
            <div class="filtr-item" data-category="3" data-sort="In production">
                <img
                        class="img-responsive"
                        src="/render/images/ZFilterizrWidget/demo/img//industrial_1.jpg"
                        alt="sample image"
                />
                <span class="item-desc">in production</span>
            </div>
            <div
                    class="filtr-item"
                    data-category="3, 4"
                    data-sort="Industrial site"
            >
                <img
                        class="img-responsive"
                        src="/render/images/ZFilterizrWidget/demo/img//industrial_2.jpg"
                        alt="sample image"
                />
                <span class="item-desc">industrial site</span>
            </div>
            <div
                    class="filtr-item"
                    data-category="2, 4"
                    data-sort="Peaceful lake"
            >
                <img
                        class="img-responsive"
                        src="/render/images/ZFilterizrWidget/demo/img//nature_1.jpg"
                        alt="sample image"
                />
                <span class="item-desc">peaceful lake</span>
            </div>
            <div class="filtr-item" data-category="1, 5" data-sort="City lights">
                <img
                        class="img-responsive"
                        src="/render/images/ZFilterizrWidget/demo/img//city_2.jpg"
                        alt="sample image"
                />
                <span class="item-desc">city lights</span>
            </div>
            <div class="filtr-item" data-category="2, 4" data-sort="Dreamhouse">
                <img
                        class="img-responsive"
                        src="/render/images/ZFilterizrWidget/demo/img//nature_3.jpg"
                        alt="sample image"
                />
                <span class="item-desc">dreamhouse</span>
            </div>
            <div
                    class="filtr-item"
                    data-category="3"
                    data-sort="Restless machines"
            >
                <img
                        class="img-responsive"
                        src="/render/images/ZFilterizrWidget/demo/img//industrial_3.jpg"
                        alt="sample image"
                />
                <span class="item-desc">restless machines</span>
            </div>
        </div>
    </div>

    
</div>
HTML,

        'jscode' => <<<JS
              
JS,
        'csscode' => <<<CSS


CSS,


    ];

    public function codes()
    {

        $this->htm = strtr($this->_layout['main'], [
           
        ]);

        $this->js = strtr($this->_layout['jscode'], [


        ]);

        $this->css = strtr($this->_layout['csscode'], [


        ]);


    }

}
