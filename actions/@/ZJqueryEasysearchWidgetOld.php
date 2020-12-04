<?php

/**
 *
 *
 * Author:Abdumalikov Otabek
 * Refactored BY Xakimjon Ergashov
 * http://library.zettest.uz/render/Actions/Filtering/CSSJS/Archakov06%20Jquery-Easysearch/clean.htm
 * https://github.com/Archakov06/jQuery-easySearch
 *
 */

namespace zetsoft\widgets\actions;


use zetsoft\system\kernels\ZWidget;

class ZJqueryEasysearchWidget extends ZWidget
{



    public function asset()
    {
        $this->fileCss('/render/actions/ZJqueryEasysearchWidget/assets/jquerysctipttop.css');
        $this->fileCss('/render/actions/ZJqueryEasysearchWidget/assets/semantic.min.css');
        $this->fileJs('/render/actions/ZJqueryEasysearchWidget/assets/jquery-1.12.0.min.js');
        $this->fileJs('/render/actions/ZJqueryEasysearchWidget/assets/jquery.easysearch.js');
    }

    public function codes()
    {
          //  $this->htm = \kartik\select2\Select2::widget($this->options);

        $this->htm = <<<HTML
        <div id="jquery-script-menu">
<div class="ui container">
<h1>jQuery easySearch Plugin: Search in list</h1>
<div class="column">
<div class="ui input focus">`
<input type="text" id="searchInput" placeholder="Search..." value="">
	 </div></div>
<div class="column">
<ul class="ui middle aligned selection list">
  <li class="item"><img class="ui avatar image" src="\publish\action\Filtering\CSSJS\Archakov06 Jquery-Easysearch\clean_files\helen.jpg">
 
  <div class="content">
  <div class="header">Helen</div></div></li>
  <li class="item"><img class="ui avatar image" src="\publish\action\Filtering\CSSJS\Archakov06 Jquery-Easysearch\clean_files\christian.jpg">
  	     
  <div class="content">
  <div class="header">Christian</div></div></li>
  <li class="item"><img class="ui avatar image" src="\publish\action\Filtering\CSSJS\Archakov06 Jquery-Easysearch\clean_files\daniel.jpg">	   
    
  <div class="content">
  <div class="header">Daniel</div></div></li>
  <li class="item"><img class="ui avatar image" src="\publish\action\Filtering\CSSJS\Archakov06 Jquery-Easysearch\clean_files\christian.jpg">
  	     
  <div class="content">
  <div class="header">Marybelle</div></div></li>
  <li class="item"><img class="ui avatar image" src="\publish\action\Filtering\CSSJS\Archakov06 Jquery-Easysearch\clean_files\helen.jpg">	    
 
  <div class="content">
  <div class="header">Joeann</div></div></li>
  <li class="item"><img class="ui avatar image" src="\publish\action\Filtering\CSSJS\Archakov06 Jquery-Easysearch\clean_files\christian.jpg">
  	     
  <div class="content">
  <div class="header">Fallon</div></div></li>
  <li class="item"><img class="ui avatar image" src="\publish\action\Filtering\CSSJS\Archakov06 Jquery-Easysearch\clean_files\daniel.jpg">	   
    
  <div class="content">
  <div class="header">Arturo</div></div></li></ul></div></div>
</div>

HTML;

        $this->js = <<<JS
        		jQuery('#searchInput').jSearch({
	    selector  : 'ul',
	    child : 'li div.header',
	    minValLength: 0,
	    Found : function(elem, event){
	        $(elem).parent().parent().show();
	    },
	    NotFound : function(elem, event){
	        $(elem).parent().parent().hide();
	    },
	    After : function(t){
	        if (!t.val().length) $('ul li').show();
	    }
	});
    var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-36251023-1']);
  _gaq.push(['_setDomainName', 'jqueryscript.net']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

           
JS;


        $this->css = <<<CSS
        body { background-color:#fafafa;}
	.container {
		width: 50%;
		margin: 150px auto;
	}
	.column {
		margin-bottom: 20px;
	}
	div.input {
		width: 100%;
	}
	li:before {display: none;}
	ul.ui.list {margin-left: 0}
    
CSS;


    }
}
