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

namespace zetsoft\widgets\animo;

use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\kernels\ZWidget;

class  ZThreeJsWidget extends ZWidget

{
    public $config = [];
    public $_config = [

      
    ];
    public $layout = [];
    public $_layout = [


        <<<CSS

CSS,

        <<<JS
  var scene = new THREE.Scene();
    var camera = new THREE.PerspectiveCamera( 75, window.innerWidth/window.innerHeight, 0.1, 1000 );

    var renderer = new THREE.WebGLRenderer();
    renderer.setSize( window.innerWidth, window.innerHeight );
    document.body.appendChild( renderer.domElement );

    var geometry = new THREE.BoxGeometry( 1, 1, 1 );
    var material = new THREE.MeshBasicMaterial( { color: 0x00ff00 } );
    var cube = new THREE.Mesh( geometry, material );
    scene.add( cube );

    camera.position.z = 5;

    var animate = function () {
        requestAnimationFrame( animate );

        cube.rotation.x += 0.01;
        cube.rotation.y += 0.01;

        renderer.render( scene, camera );
    };

    animate();
JS,

    ];

    public function asset()
    {

       /*           <<<<<<YARN>>>>>
       $this->fileJs('/publish/yarner/three-js/three.js');
                    <<<<<<YARN>>>>>*/
        $this->fileJs('https://cdnjs.cloudflare.com/ajax/libs/three.js/110/three.min.js');
        
    
    }

    public function codes()
    {
    }

}
