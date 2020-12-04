<?php

namespace zetsoft\widgets\former;

use zetsoft\system\kernels\ZWidget;

//**
// *
// *
// * Author:  Tojiboyev jamshid
// *
// * url:
// */core/tester/asror/main.aspx?path=render/former/ZJqueryStepsWidget/sample.php
// *
// * github:
// * https://github.com/rstaib/jquery-steps/wiki
// *
// *
class ZJqueryStepsWidget extends ZWidget
{

    public $config = [];
    public $_config = [
            'id' => 'example-basic',
            'headerTag' => 'h3', // h1 | h2 ... h6
            'bodyTag' => 'section', // div
            'contentContainerTag' => 'div',
            'actionContainerTag' => 'div',
            'stepsContainerTag' => 'div',
            'cssClass' => 'wizard',
            'stepsOrientation' => '$.fn.steps.stepsOrientation.horizontal',
            'autoFocus' => true,
            'enableAllSteps' => false,
            'enableKeyNavigation' => true,
            'enablePagination' => true,
            'suppressPaginationOnFocus' => true,
            'enableContentCache' => true,
            'enableCancelButton' => false,
            'enableFinishButton' => true,
            'preloadContent' => true,
            'showFinishButtonAlway' => false,
            'forceMoveForward' => false,
            'saveState' => false,
            'startIndex' => '0',
            'cancel' => 'Cancel',
            'current' => 'current step:',
            'pagination' => 'Pagination',
            'finish' => 'Finish',
            'next' => 'Next',
            'previous' => 'Previous',
            'loading' => 'Loading ...',
        ' transitionEffect' => 'slideLeft', // slide | fade |  $.fn.steps.transitionEffect.none,
        'ransitionEffectSpeed' => 200,
    ];

    public const type = [
//        'get' => 'GET',
//        'post' => 'POST',
//        'put' => 'PUT',
    ];
    public const dataType = [
//        'html' => 'html',
//        'script' => 'script',
//        'json' => 'json',
//        'xml' => 'xml',
    ];


    public $event = [];
    public $_event = [
//         'onStepChanging' => 'function (event, currentIndex, newIndex) { return true; }',
//         'onStepChanged' => 'function (event, currentIndex, priorIndex) { }',
//         'onCanceled' => 'function (event) { }',
//         'onFinishing' => 'function (event, current?Index) { return true; }',
//         'onFinished' => 'function (event, currentIndex) { }',
//         'onInit' => 'function (event, currentIndex) { }',
//         'onContentLoaded' => 'function (event, currentIndex) { }',

    ];
    public $layout = [];
    public $_layout = [

    'main' => <<<HTML
        <div id="{id}">
    <h3>Keyboard</h3>
    <section>
        <p>Try the keyboard navigation by clicking arrow left or right!</p>
    </section>
    <h3>Effects</h3>
    <section>
        <p>Wonderful transition effects.</p>
    </section>
    <h3>Pager</h3>
    <section>
        <p>The next and previous buttons help you to navigate through your content.</p>
    </section>
</div>
HTML,


        'js' => <<<JS

           $("#example-basic").steps({ 

        /* Appearance */
        headerTag: {headerTag},
        bodyTag: {bodyTag},
        contentContainerTag: {contentContainerTag},
        actionContainerTag: {actionContainerTag},
        stepsContainerTag: { stepsContainerTag},
        cssClass: {cssClass},
        stepsOrientation: {stepsOrientation},
        /* Behaviour */
        autoFocus: {autoFocus}, 
        enableAllSteps: {enableAllSteps},
        enableKeyNavigation: {enableKeyNavigation},
        enablePagination: {enablePagination},
        suppressPaginationOnFocus: {suppressPaginationOnFocus},
        enableContentCache: {enableContentCache},
        enableCancelButton: {enableCancelButton},
        enableFinishButton: {enableFinishButton},
        preloadContent: {preloadContent},
        showFinishButtonAlways: {showFinishButtonAlways},
        forceMoveForward: {forceMoveForward},
        saveState: {saveState},
        startIndex: { startIndex},

        /* Transition Effects */
        transitionEffect: { transitionEffect},
        transitionEffectSpeed: {transitionEffectSpeed},

        /* Labels */
        labels: {
            cancel: {cancel},
            current: {current},
            pagination: {pagination},
            finish: {finish},
            next: {next},
            previous: {previous},
            loading: {loading},
        },
    })
JS,

    ];
    public function asset()
    {

        $this->fileCss('https://cdn.jsdelivr.net/npm/jquery-steps@1.1.0/demo/css/jquery.steps.css');
        $this->fileJs('https://cdn.jsdelivr.net/npm/jquery-steps@1.1.0/build/jquery.steps.js"');
    }


    public function codes()
    {
        $this->htm .= strtr($this->_layout['main'],[
            '{id}' => $this->_config['id'],

        ]);



        $this->js = strtr($this->_layout['js'], [

//            '{id}' => $this->jscode($this->_config['id']),
            '{headerTag}' => $this->jscode($this->_config['headerTag']),
            '{bodyTag}' => $this->jscode($this->_config['bodyTag']),
            '{contentContainerTag}' => $this->jscode($this->_config['contentContainerTag']),
            '{actionContainerTag}' => $this->jscode($this->_config['actionContainerTag']),
            '{stepsContainerTag}' => $this->jscode($this->_config['stepsContainerTag']),
            '{cssClass}' => $this->jscode($this->_config['cssClass']),
            '{stepsOrientation}' => $this->jscode($this->_config['stepsOrientation']),
            '{autoFocus}' => $this->jscode($this->_config['autoFocus']),
            '{enableAllSteps}' => $this->jscode($this->_config['enableAllSteps']),
            '{enableKeyNavigation}' => $this->jscode($this->_config['enableKeyNavigation']),
            '{enablePagination}' => $this->jscode($this->_config['enablePagination']),
            '{suppressPaginationOnFocus}' => $this->jscode($this->_config['suppressPaginationOnFocus']),
            '{enableContentCache}' => $this->jscode($this->_config['enableContentCache']),
            '{enableCancelButton}' => $this->jscode($this->_config['enableCancelButton']),
            '{enableFinishButton}' => $this->jscode($this->_config['enableFinishButton']),
            '{preloadContent}' => $this->jscode($this->_config['preloadContent']),
//            '{showFinishButtonAlway}' => $this->jscode($this->_config['ashowFinishButtonAlway']),
            '{forceMoveForward}' => $this->jscode($this->_config['forceMoveForward']),
            '{saveState}' => $this->jscode($this->_config['saveState']),
            '{startIndex}' => $this->jscode($this->_config['startIndex']),
            '{cancel}' => $this->jscode($this->_config['cancel']),
            '{current}' => $this->jscode($this->_config['current']),
            '{pagination}' => $this->jscode($this->_config['pagination']),
            '{finish}' => $this->jscode($this->_config['finish']),
            '{next}' => $this->jscode($this->_config['next']),
            '{previous}' => $this->jscode($this->_config['previous']),
            '{loading}' => $this->jscode($this->_config['loading']),
//            '{transitionEffect}' => $this->jscode($this->_config['transitionEffect']),
//            '{transitionEffectSpeed}' => $this->jscode($this->_config['transitionEffectSpeed']),
            /**
             *
             * Events
             */
//            '{onStepChanging}' => $this->eventCode('onStepChanging'),
//            '{onStepChanged}' => $this->eventCode('onStepChanged'),
//            '{onCanceled}' => $this->eventCode('onCanceled'),
////            '{ontimeout}' => $this->eventCode('ontimeout'),
//            '{onFinishing}' => $this->eventCode('onFinishing'),
//            '{onFinished}' => $this->eventCode('onFinished'),
//            '{onInit}' => $this->eventCode('onInit'),

        ]);

    }
}
