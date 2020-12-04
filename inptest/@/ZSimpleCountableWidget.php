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




namespace zetsoft\widgets\inptest;


use rmrevin\yii\fontawesome\FA;
use rmrevin\yii\fontawesome\FAS;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\helpers\ZHTML;
use zetsoft\system\kernels\ZWidget;

/**
 *
 * CreatedBy: Javohir Abdufattokhov
 *
    https://github.com/aaronrussell/jquery-simply-countable/blob/master/asset.html
 *
 */
class ZSimpleCountableWidget extends ZWidget
{
    public $config = [];
    public $_config = [
        'countType' => ZSimpleCountableWidget::countType['characters'],
        'maxCount' => 100
    ];

    public const countType = [
        'words' => 'words',
        'characters' => 'characters'
    ];

    public $event = [];
    public $_event = [
        'click' => "function(){console.log('{className} | click')}",
        'overCount' => "function (count, countable, counter) {
            console.log('{className} | This is max count');
            }"
    ];

    public $layout = [];
    public $_layout = [


        'main' => <<<HTML
          <form>
            <p>You have <span id=\"counter\"></span> characters left.</p>
            <p><textarea id=\"{id}-textarea\" cols=\"50\" rows=\"4\" name=\"{name}\" value=\"{value}\"></textarea></p>
        </form>
HTML,



        'fjs' => <<<JS
          $(document).ready(function()
        {
            $('#{id}-textarea').simplyCountable();

        });
JS,
        'js' => <<<JS
          
          (function($){
            $.fn.simplyCountable = function(options){
                options = $.extend({
                    counter:            '#counter',
                    countType:          'characters',
                    maxCount:           {maxCount},
                    strictMax:          false,
                    countDirection:     'down',
                    safeClass:          'safe',
                    overClass:          'over',
                    thousandSeparator:  ',',
                    onOverCount: {onOverCount},
                    onSafeCount: function (count, countable, counter) {
                    },
                    onMaxCount: function (count, countable, counter) {
                    }
                }, options);

                var navKeys = [33,34,35,36,37,38,39,40];

                return $(this).each(function(){

                    var countable = $(this);
                    var counter = $(options.counter);
                    if (!counter.length) { return false; }

                    var countCheck = function(){

                        var count;
                        var revCount;

                        var reverseCount = function(ct){
                            return ct - (ct*2) + options.maxCount;
                        };
                        var countInt = function(){
                            return (options.countDirection === 'up') ? revCount : count;
                        };
                        var numberFormat = function(ct){
                            var prefix = '';
                            if (options.thousandSeparator){
                                ct = ct.toString();
                                // Handle large negative numbers
                                if (ct.match(/^-/)) {
                                    ct = ct.substr(1);
                                    prefix = '-';
                                }
                                for (var i = ct.length-3; i > 0; i -= 3){
                                    ct = ct.substr(0,i) + options.thousandSeparator + ct.substr(i);
                                }
                            }
                            return prefix + ct;
                        };
                        var changeCountableValue = function(val){
                            countable.val(val).trigger('change');
                        };
                        /* Calculates count for either words or characters */
                        if (options.countType === 'words'){
                            count = options.maxCount - $.trim(countable.val()).split(/\s+/).length;
                            if (countable.val() === ''){ count += 1; }
                        }
                        else { count = options.maxCount - countable.val().length; }
                        revCount = reverseCount(count);
                        /* If strictMax set restrict further characters */
                        if (options.strictMax && count <= 0){
                            var content = countable.val();
                            if (count < 0) {
                                options.onMaxCount(countInt(), countable, counter);
                            }
                            if (options.countType === 'words'){
                                var allowedText = content.match( new RegExp('\\s?(\\S+\\s+){'+ options.maxCount +'}') );
                                if (allowedText) {
                                    changeCountableValue(allowedText[0]);
                                }
                            }
                            else { changeCountableValue(content.substring(0, options.maxCount)); }
                            count = 0, revCount = options.maxCount;
                        }
                        counter.text(numberFormat(countInt()));

                        /* Set CSS class rules and API callbacks */
                        if (!counter.hasClass(options.safeClass) && !counter.hasClass(options.overClass)){
                            if (count < 0){ counter.addClass(options.overClass); }
                            else { counter.addClass(options.safeClass); }
                        }
                        else if (count < 0 && counter.hasClass(options.safeClass)){
                            counter.removeClass(options.safeClass).addClass(options.overClass);
                            options.onOverCount(countInt(), countable, counter);
                        }
                        else if (count >= 0 && counter.hasClass(options.overClass)){
                            counter.removeClass(options.overClass).addClass(options.safeClass);
                            options.onSafeCount(countInt(), countable, counter);
                        }
                    };
                    countCheck();

                    countable.on('keyup blur paste', function (event) {
                        switch(e.type) {
                            case 'keyup':
                                // Skip navigational key presses
                                if ($.inArray(e.which, navKeys) < 0) { countCheck(); }
                                break;
                            case 'paste':
                                // Wait a few miliseconds if a paste event
                                setTimeout(countCheck, (e.type === 'paste' ? 5 : 0));
                                break;
                            default:
                                countCheck();
                                break;
                        }
                    });
                });
            };
        })(jQuery);
JS,
        'event' => <<<JS
        $('#{id}-textarea').on('click', {click})
                
JS,
    ];
    public function codes()
    {

        $this->htm = strtr($this->_layout['main'], [
            '{id}' => $this->id,
            '{name}' => $this->name,
            '{value}' => $this->value,
        ]);

        $this->js =strtr($this->_layout['fjs'],[
            '{id}' => $this->id,
        ]);
        
        $this->js .= strtr($this->_layout['js'],[
            '{id}' => $this->id,
            '{countType}' => $this->_config['countType'],
            '{maxCount}' => $this->_config['maxCount'],
            '{onOverCount}' => $this->eventCode('overCount'),
         ]);

        $this->js .= strtr($this->_layout['event'],[
            '{id}' => $this->id,
            '{click}' => $this->eventCode('click')
        ]);


    }
}

