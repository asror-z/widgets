<?php

/**
 *
 *
 * Author:  Asror Zakirov
 * https://www.linkedin.com/in/asror-zakirov
 * https://github.com/asror-z
 * Abdurakhmonov Umid
 *
 */

namespace zetsoft\widgets\inptest;


use zetsoft\system\kernels\ZWidget;

class ZjQueryConditionalWidget extends ZWidget
{
  public $config = [];
  public $_config = [

  ];


  public $event = [];
  public $_event = [
      'click' => ' console.log("self | $eventClick") ',
      'dblclick' => ' console.log("self | $eventDblclick") ',
      'mouseenter' => ' console.log("self | $eventMouseEnter") ',
      'mouseleave' => ' console.log("self | $eventMouseLeave") ',
      'keyup' => ' console.log("self | $eventKeyup") ',
  ];

  public $layout = [];
  public $_layout = [

      'main' => <<<HTML
            
   <div class="container">
    <h1>jQuery Conditional</h1>
     <div class="form-group">
	     <label for="book" class="control-label">Choose a book</label>
	      <select name="book" id="book" class="form-control input-block" value="" data-conditional="book">
          <option value=""></option>
          <option value="Birds from 'Murica">Birds from 'Murica</option>
          <option value="They see me rollin'">They see me rollin'</option>
	      </select>
     </div>
     <div class="hide conditional-logic" data-condition="book" data-match="Birds from 'Murica">
	   <div class="form-group">
	    	<label for="bird_favorite" class="control-label">Your favorite bird was<span class="text-danger">*</span></label>
	    	<input type="text" name="bird_favorite" id="bird_favorite" class="form-control">
	   </div>
	  <div class="form-group">
        <label for="bird_least" class="control-label">Your least-favorite bird was<span class="text-danger">*</span></label>
        <input type="text" name="bird_least" id="bird_least" class="form-control">
	  </div>
  </div>

   <div class="hide conditional-logic" data-condition="book" data-match="They see me rollin'">
	    <div class="form-group">
        <label for="why_hate" class="control-label">Why do you think they're hatin'?<span class="text-danger">*</span></label>
        <input type="text" name="why_hate" id="why_hate" class="form-control">
	    </div>
   </div>
   
    <h3>License</h3>
      <p>Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated
        documentation files (the "Software"), to deal in the Software without restriction, including without limitation
        the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and
        to permit persons to whom the Software is furnished to do so, subject to the following conditions:
       </p>
</div>
HTML,

      'js' => <<<JS
         ;(function($) {
	$.fn.conditional = function(options) {
		if (!this.length) { return this; }
		var opts = $.extend(true, {}, $.conditional.defaults, options);
		this.each(function() {
			var el = $(this),
				conditional = el.data('conditional');
			el.on(opts.eventName, function() {
				var value = el.val(),
					elements = $('[data-condition="'+ conditional +'"]');
				// Hide all
				opts.onDeactivate(elements, opts, function() {
					// Show the one(s) that match
					elements.each(function() {
						var element = $(this);
						if ( element.data('match') == value ) {
							opts.onActivate(element, opts);
						}
					});

				});
			});
			el.trigger(opts.eventName);
		});
		return this;
	};
	$.conditional = {
		defaults: {
			className: 'hide',
			eventName: 'change',
			onActivate: function(element, opts) {
				element.removeClass(opts.className);
			},
			onDeactivate: function(elements, opts, callback) {
				elements.addClass(opts.className);
				callback.call();
			},
			autoBind: true
		}
	};
	// Auto-binding via HTML5 datas
	if ( $.conditional.defaults.autoBind ) {
		$('[data-conditional]').conditional();
	}}) (jQuery);



JS,

      'event' => <<<JS
             $('#{id}')
            .on('click', {click})
            .on('dblclick', {dblclick})
            .on('keyup', {keyup})
            .on('mouseenter', {mouseenter})
            .on('mouseleave', {mouseleave});
JS,

      'style' => <<<CSS

CSS,

  ];


  public function asset()
  {
   /* $this->fileCss('https://cdn.jsdelivr.net/npm/bootstrap.min.js@3.3.5/bootstrap.min.css');*/
  }

  public function codes()
  {

    $getPlace = '';
    if ($this->_config['hasPlace']) {

      $getPlace .= $this->js = strtr($this->js, [
          '{search}' => $this->_config['placeholder'],
      ]);

    }

    $this->js .= strtr($this->_layout['event'], [
        '{id}' => $this->id,
        '{click}' => $this->eventCode('click'),
        '{keyup}' => $this->eventCode('keyup'),
        '{dblclick}' => $this->eventCode('dblclick'),
        '{mouseenter}' => $this->eventCode('mouseenter'),
        '{mouseleave}' => $this->eventCode('mouseleave'),
    ]);

    $this->htm .= strtr($this->_layout['main'], [
        '{id}' => $this->id,
        '{name}' => $this->modelCheck() ? $this->name : '',
        '{value}' => $this->modelCheck() ? $this->value : '',
        '{placeholder}' => $this->modelCheck() ? $this->_config['placeholder'] : '',
        '{widget}' => $this->dataWidget,
    ]);


    $this->js .= strtr($this->_layout['js'], [
        '{id}' => $this->id,
        '{search}' => $getPlace,
    ]);

    $this->css = $this->_layout['style'];

  }

}
