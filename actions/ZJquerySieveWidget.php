<?php

/**
 *
 *
 * Author:  Maftuna Qodirova
 * https://github.com/rmm5t/jquery-sieve
 *
 */

namespace zetsoft\widgets\actions;


use zetsoft\system\kernels\ZWidget;


class ZJquerySieveWidget extends ZWidget
{
    /**
     * Configuration
     */
    public $config = [];
    public $_config = [
        'grapes' => true,
    ];

    public const type = [

    ];


    public $event = [];
    public $_event = [

    ];

  public function asset()
  {

    $this->fileJs('https://raw.githubusercontent.com/rmm5t/jquery-sieve/master/sieve.jquery.json');

    $this->fileJs('https://code.jquery.com/jquery-1.9.1.min.js');
    $this->fileJs('https://cdn.statically.io/gh/rmm5t/jquery-sieve/a6c89093/dist/jquery.sieve.min.js');

    $this->fileCss('https://netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css');
    $this->fileCss('https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.css');


  }


  public $layout = [];
    public $_layout =[

        'main' => <<<HTML
  
  <div class="container" 
                      '>
    <div class="row">
        <div class="col-md-4">
            <h4>US President Birthplaces</h4>
            <div id="presidents">
                <div class="row form-inline">
                                </div>
                <table class="table table-hover table-bordered table-sieve">
                    <thead>
                    <tr>
                        <th>President</th>
                        <th>Birthplace</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr style="display: table-row;"><td>Zachary Taylor</td><td>Barboursville, Virginia</td></tr>
                    <tr style="display: table-row;"><td>Warren G. Harding</td><td>Blooming Grove, Ohio</td></tr>
                    <tr style="display: table-row;"><td>John Quincy Adams</td><td>Braintree, Massachusetts</td></tr>
                    <tr style="display: table-row;"><td>John F. Kennedy</td><td>Brookline, Massachusetts</td></tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="col-md-4">
            <h4>Good Quotes </h4>
            <div class="row form-inline">
            
            </div>
            <div id="paragraphs" class="p-sieve">
                <p style="display: block;"><em>"Moral indignation is jealousy with a halo."</em> - <strong>H. G. Wells (1866-1946)</strong></p>
                <p style="display: block;"><em>"Glory is fleeting, but obscurity is forever."</em> - <strong>Napoleon Bonaparte (1769-1821)</strong></p>
                <p style="display: block;"><em>"The fundamental cause of trouble in the world is that the stupid are cocksure while the intelligent are full of doubt."</em> - <strong>Bertrand Russell (1872-1970)</strong></p>
                <p style="display: block;"><em>"Victory goes to the player who makes the next-to-last mistake."</em> - <strong>Chessmaster Savielly Grigorievitch Tartakower (1887-1956)</strong></p>
                <p style="display: block;"><em>"Don't be so humble - you are not that great."</em> - <strong>Golda Meir (1898-1978) to a visiting diplomat</strong></p>
            </div>
        </div>

        <div class="col-md-4">
            <h4>US State Capitals</h4>
            <div id="capitals">
                <div class="row form-inline">
                
                </div>
                <table class="table table-hover table-bordered table-sieve">
                    <thead>
                    <tr>
                        <th>State</th>
                        <th>Capital</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr style="display: table-row;"><td>Alabama</td><td>Montgomery</td></tr>
                    <tr style="display: table-row;"><td>Alaska</td><td>Juneau</td></tr>
                    <tr style="display: table-row;"><td>Arizona</td><td>Phoenix</td></tr>
                    <tr style="display: table-row;"><td>Arkansas</td><td>Little Rock</td></tr>
                    <tr style="display: table-row;"><td>California</td><td>Sacramento</td></tr>
                    <tr style="display: table-row;"><td>Colorado</td><td>Denver</td></tr>
                    <tr style="display: table-row;"><td>Connecticut</td><td>Hartford</td></tr>
                    <tr style="display: table-row;"><td>Delaware</td><td>Dover</td></tr>
                    <tr style="display: table-row;"><td>Florida</td><td>Tallahassee</td></tr>
                    <tr style="display: table-row;"><td>Georgia</td><td>Atlanta</td></tr>
                    <tr style="display: table-row;"><td>Hawaii</td><td>Honolulu</td></tr>
                    <tr style="display: table-row;"><td>Idaho</td><td>Boise</td></tr>
                    <tr style="display: table-row;"><td>Illinois</td><td>Springfield</td></tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

HTML,

        'js' => <<<JS
$(document).ready(function(){


     $(document).ready(function() {
        $("table.sieve").sieve();
    });

    $(document).ready(function() {
        $("section.sieve").sieve({ itemSelector: "p" });
    });
    
   var searchTemplate = "<div class='row form-inline'><label style='float: right;'>Search: <input type='text' class='form-control' placeholder='(start typing)'></label></div>"
    $(".table-sieve").sieve({ searchTemplate: searchTemplate });
    searchTemplate = "<div class='row form-inline'><label style='float: right;'>Find a Quote: <input type='text' class='form-control' placeholder='(try typing &quot;einstein&quot;)'></label></div>"
    $(".p-sieve").sieve({ searchTemplate: searchTemplate, itemSelector: "p" });
    
    var _gaq = _gaq || [];
    _gaq.push(['_setAccount', 'UA-604149-6']);
    _gaq.push(['_trackPageview']);

    (function() {
        var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
        ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
        var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
    })();  
    });

    
    
JS,

        'css' => <<<CSS
       
CSS,
    ];




    public function codes()
    {

        $this->htm = strtr($this->_layout['main'], [
            
            '{readonly}' => $this->_config['readonly'] ? 'readonly' : ''
        ]);

        $this->js = strtr($this->_layout['js'], []);



    }


}
