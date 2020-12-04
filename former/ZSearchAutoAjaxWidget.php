<?php

namespace zetsoft\widgets\former;
use zetsoft\system\kernels\ZWidget;





class ZSearchAutoAjaxWidget extends ZWidget
{

    public $config = [];
    public $_config = [
    ];


    public $layout = [];
    public $_layout = [

'main' =><<<HTML
      <input class="filter w10" type="text" id="filter-name" onkeyup="myFunction()" placeholder="Search for nameOn..">
HTML,

'js' => <<<JS
   $(function myFunction() {
        // Declare variables
        var input, filter, td, tr, i, txtValue;
        input = document.getElementById('filter-name');
        filter = input.value.toUpperCase();
        td = document.getElementsByClassName("w10");
        input = td.getElementsByTagName('input');

        // Loop through all list items, and hide those who don't match the search query
        for (i = 0; i < tr.length; i++) {
            input = tr[i].getElementsByTagName("input")[0];
            txtValue = input.textContent || input.innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                input[i].style.display = "";
            } else {
                input[i].style.display = "none";
            }
        }
    });
JS,

'css' => <<<CSS
      
    #myInput {
        background-position: 10px 12px; /* position the search icon */
        background-repeat: no-repeat; /* Do not repeat the icon image */
        width: 100%; /* Full-width */
        font-size: 16px; /* Increase font-size */
        padding: 12px 20px 12px 40px; /* Add some padding */
        border: 1px solid #ddd; /* Add a grey border */
        margin-bottom: 12px; /* Add some space below the input */
    }

    #myUL {
        /* Remove default list styling */
        list-style-type: none;
        padding: 0;
        margin: 0;
    }

    #myUL {
        border: 1px solid #ddd; /* Add a border to all links */
        margin-top: -1px; /* Prevent double borders */
        background-color: #f6f6f6; /* Grey background color */
        padding: 12px; /* Add some padding */
        text-decoration: none; /* Remove default text underline */
        font-size: 18px; /* Increase the font-size */
        color: black; /* Add a black text color */
        display: block; /* Make it into a block element to fill the whole list */
    }

    #myUL:hover:not{
        background-color: #eee; /* Add a hover effect to all links, except for headers */
    }
CSS,





];

    public function codes()
    {
        $this->htm = strtr($this->_layout['main'],[
            
        ]);
        $this->js = strtr($this->_layout['js'],[]);
        $this->css = strtr($this->_layout['css'],[]);
    }

}
