<?php

/**
 *
 *
 * Author:  AzimjonToirov
 * https://tympanus.net/Development/MorphingSearch/
 *
 */

namespace zetsoft\widgets\blocks;


use zetsoft\system\kernels\ZWidget;

class ZMorphingSearchWidget extends ZWidget
{

    public $config = [];
    public $_config = [
        'searchIconPath' => 'url("/render/block/assets/MorphingSearch/icon-silver.png")'
    ];

    public  $layout=[];
    public  $_layout=[

        'main'=><<<HTML
            <div id="morphsearch" class="morphsearch">
                <form class="morphsearch-form">
                    <input class="morphsearch-input" type="search" placeholder="Search...">
                    <button class="morphsearch-submit" type="submit">Search</button>
                </form>
<!--
        <div class="morphsearch-content">
            <a class="dummy-media-object" href="#">
                <img class="round" src="/render/images/assets/image/profile.png">
                <h3>Something</h3>
            </a>
            <a class="dummy-media-object" href="#">
                <img class="round" src="/render/images/assets/image/profile.png">
                <h3>Something</h3>
            </a>
            <a class="dummy-media-object" href="#">
                <img class="round" src="/publish/image/profile.png">
                <h3>Something</h3>
            </a>
        </div>&lt;!&ndash; /morphsearch-content &ndash;&gt;
-->
                <span class="morphsearch-close"></span>
             </div><!-- /morphsearch -->
                  <div class="overlay"></div>
HTML,
         'css'=><<<CSS
.morphsearch {
	width: 200px;
	min-height: 30px;
	background: #f1f1f1;
	position: absolute;
	z-index: 10;
	top: 180px !important;
	-webkit-transform-origin: 100% 0;
	transform-origin: 100% 0;
	-webkit-transition-property: min-height, width, top, right;
	transition-property: min-height, width, top, right;
	-webkit-transition-duration: 0.5s;
	transition-duration: 0.5s;
	-webkit-transition-timing-function: cubic-bezier(0.7,0,0.3,1);
	transition-timing-function: cubic-bezier(0.7,0,0.3,1);
}

.morphsearch.open {
	width: 100%;
	min-height: 80%;
	top: 0px;
	right: 0px;
}

.morphsearch-form {
	width: 100%;
	height: 40px;
	-webkit-transition-property: width, height, -webkit-transform;
	transition-property: width, height, transform;
	-webkit-transition-duration: 0.5s;
	transition-duration: 0.5s;
	-webkit-transition-timing-function: cubic-bezier(0.7,0,0.3,1);
	transition-timing-function: cubic-bezier(0.7,0,0.3,1);
}

.morphsearch.open .morphsearch-form {
	width: 80%;
	height: 160px;
	-webkit-transform: translate3d(0,3em,0);
	transform: translate3d(0,3em,0);
}

.morphsearch-input {
	width: 90%;
	height: 100%;
	padding: 0 10% 0 10px;
	font-weight: 700;
	border: none;
	background: transparent;
	font-size: 0.8em;
	color: #ec5a62;
	-webkit-transition: font-size 0.5s cubic-bezier(0.7,0,0.3,1);
	transition: font-size 0.5s cubic-bezier(0.7,0,0.3,1);
}

.morphsearch-input::-ms-clear { /* remove cross in IE */
    display: none;
}

.morphsearch.hideInput .morphsearch-input {
	color: transparent;
	-webkit-transition: color 0.3s;
	transition: color 0.3s;
}

.morphsearch.open .morphsearch-input {
	font-size: 7em;
}

/* placeholder */
.morphsearch-input::-webkit-input-placeholder {
	color: #c2c2c2;
}

.morphsearch-input:-moz-placeholder {
	color: #c2c2c2;
}

.morphsearch-input::-moz-placeholder {
	color: #c2c2c2;
}

.morphsearch-input:-ms-input-placeholder {
	color: #c2c2c2;
}

/* hide placeholder when active in Chrome */
.gn-search:focus::-webkit-input-placeholder {
	color: transparent;
}

input[type="search"] { /* reset normalize */
	-webkit-box-sizing: border-box; 
	box-sizing: border-box;	
}

.morphsearch-input:focus,
.morphsearch-submit:focus {
	outline: none;
}

.morphsearch-submit {
	position: absolute;
	width: 80px;
	height: 80px;
	text-indent: 100px;
	overflow: hidden;
	right: 0;
	top: 50%;
	background: transparent url(/render/block/assets/MorphingSearch/icon-silver.png) no-repeat center center;
	background-size: 100%;
	border: none;
	pointer-events: none;
	transform-origin: 50% 50%;
	opacity: 0;
	-webkit-transform: translate3d(-30px,-50%,0) scale3d(0,0,1);
	transform: translate3d(-30px,-50%,0) scale3d(0,0,1);
}

.morphsearch.open .morphsearch-submit {
	pointer-events: auto;
	opacity: 1;
	-webkit-transform: translate3d(-30px,-50%,0) scale3d(1,1,1);
	transform: translate3d(-30px,-50%,0) scale3d(1,1,1);
	-webkit-transition: opacity 0.3s, -webkit-transform 0.3s;
	transition: opacity 0.3s, transform 0.3s;
	-webkit-transition-delay: 0.5s;
	transition-delay: 0.5s;
}

.morphsearch-close {
	width: 36px;
	height: 36px;
	position: absolute;
	right: 1em;
	top: 1em;
	overflow: hidden;
	text-indent: 100%;
	cursor: pointer;
	pointer-events: none;
	opacity: 0;
	-webkit-transform: scale3d(0,0,1);
	transform: scale3d(0,0,1);
}

.morphsearch.open .morphsearch-close {
	opacity: 1;
	pointer-events: auto;
	-webkit-transform: scale3d(1,1,1);
	transform: scale3d(1,1,1);
	-webkit-transition: opacity 0.3s, -webkit-transform 0.3s;
	transition: opacity 0.3s, transform 0.3s;
	-webkit-transition-delay: 0.5s;
	transition-delay: 0.5s;
}

.morphsearch-close::before,
.morphsearch-close::after {
	content: '';
	position: absolute;
	width: 2px;
	height: 100%;
	top: 0;
	left: 50%;
	border-radius: 3px;
	opacity: 0.2;
	background: #000;
}

.morphsearch-close:hover.morphsearch-close::before,
.morphsearch-close:hover.morphsearch-close::after {
	opacity: 1;
}

.morphsearch-close::before {
	-webkit-transform: rotate(45deg);
	transform: rotate(45deg);
}

.morphsearch-close::after {
	-webkit-transform: rotate(-45deg);
	transform: rotate(-45deg);
}

.morphsearch-content {
	color: #333;
	margin-top: 4.5em;
	width: 100%;
	height: 0;
	overflow: hidden;
	padding: 0 10.5%;
	background: #f1f1f1;
	position: absolute;
	pointer-events: none;
	opacity: 0;
}

.morphsearch.open .morphsearch-content {
	opacity: 1;
	height: auto;
	overflow: visible; /* this breaks the transition of the children in FF: https://bugzilla.mozilla.org/show_bug.cgi?id=625289 */
	pointer-events: auto;
	-webkit-transition: opacity 0.3s 0.5s;
	transition: opacity 0.3s 0.5s;
}

.dummy-column {
	width: 30%;
	padding: 0 0 6em;
	float: left;
	opacity: 0;
	-webkit-transform: translate3d(0,100px,0);
	transform: translateY(100px);
	-webkit-transition: -webkit-transform 0.5s, opacity 0.5s;
	transition: transform 0.5s, opacity 0.5s;
}

.morphsearch.open .dummy-column:first-child {
	-webkit-transition-delay: 0.4s;
	transition-delay: 0.4s;
}

.morphsearch.open .dummy-column:nth-child(2) {
	-webkit-transition-delay: 0.45s;
	transition-delay: 0.45s;
}

.morphsearch.open .dummy-column:nth-child(3) {
	-webkit-transition-delay: 0.5s;
	transition-delay: 0.5s;
}

.morphsearch.open .dummy-column {
	opacity: 1;
	-webkit-transform: translate3d(0,0,0);
	transform: translate3d(0,0,0);
}
/* Overlay */
.overlay {
	position: fixed;
	top: 0;
	left: 0;
	width: 100%;
	height: 100%;
	background: rgba(0,0,0,0.5);
	opacity: 0;
	pointer-events: none;
	-webkit-transition: opacity 0.5s;
	transition: opacity 0.5s;
	-webkit-transition-timing-function: cubic-bezier(0.7,0,0.3,1);
	transition-timing-function: cubic-bezier(0.7,0,0.3,1);
}

.morphsearch.open ~ .overlay {
	opacity: 1;
}


@media screen and (max-width: 53.125em) {
	.morphsearch-input {
		padding: 0 25% 0 10px;
	}
	.morphsearch.open .morphsearch-input {
		font-size: 2em;
	}

	.morphsearch.open .morphsearch-submit {
		-webkit-transform: translate3d(0,-50%,0) scale3d(0.5,0.5,1);
		transform: translate3d(0,-50%,0) scale3d(0.5,0.5,1);
	}
}

@media screen and (max-width: 60.625em) {
	.morphsearch {
		width: 80%;
		top: 10%;
		right: 10%;
	}
}

CSS,
          'js'=> <<<JS

    (function () {
        var morphSearch = document.getElementById('morphsearch'),
            input = morphSearch.querySelector('input.morphsearch-input'),
            ctrlClose = morphSearch.querySelector('span.morphsearch-close'),
            isOpen = isAnimating = false,
            toggleSearch = function (evt) {
                // return if open and the input gets focused
        if (evt.type.toLowerCase() === 'focus' && isOpen) return false;
        var offsets = morphsearch.getBoundingClientRect();
        if (isOpen) {
            classie.remove(morphSearch, 'open');
                    // todo: hardcoded times, should be done after transition ends
            if (input.value !== '') {
                setTimeout(function () {
                    classie.add(morphSearch, 'hideInput');
                setTimeout(function () {
                    classie.remove(morphSearch, 'hideInput');
                    input.value = '';
                    }, 300);
                    }, 500);
            }
            input.blur();    } 
            else {
                    classie.add(morphSearch, 'open');
                 }
            isOpen = !isOpen;
            };
        input.addEventListener('focus', toggleSearch);
        ctrlClose.addEventListener('click', toggleSearch);
        document.addEventListener('keydown', function (ev) {
            var keyCode = ev.keyCode || ev.which;
            if (keyCode === 27 && isOpen) {
                toggleSearch(ev);
            }
        });
        morphSearch.querySelector('button[type="submit"]').addEventListener('click', function (ev) {
            ev.preventDefault();
        });
    })();

JS

    ];
    public function asset()
    {
       $this->fileCss('/render/block/assets/MorphingSearch/component.css');
       $this->fileJs('/render/block/assets/MorphingSearch/classie.js');
    }

    public function codes()
    {
        $this->htm = strtr($this->_layout["main"],[]);

        $this->js = strtr($this->_layout["js"],[]);

        $this->css = strtr($this->_layout["css"],[]);

    }
}
