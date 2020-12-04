<?php

/**
 *
 *
 * Author:  Asror Zakirov
 * https://www.linkedin.com/in/asror-zakirov
 * https://www.facebook.com/asror.zakirov
 * https://github.com/asror-z
 * Created by: Mustafayev Saidbek
 * Refactored:
 */

namespace zetsoft\widgets\inptest;

use zetsoft\system\kernels\ZWidget;

class ZFilepondWidget2 extends ZWidget
{
    /**
     * http://eyuf.zettest.uz/core/tester/asror/main.aspx?path=render\inptest\ZFileInputWidget\active-jsonb_7#menu
     * Configuration
     */
    public $config = [];
    public $_config = [
        'allowFileSizeValidation' => false
    ];

    /**
     *
     * Plugin Events
     * https://select2.org/programmatic-control/events
     */
    public $event = [];
    public $_event = [];

    /**
     *
     * Constants
     */
    public function asset()
    {
        $this->fileCss('https://unpkg.com/filepond/dist/filepond.min.css');
        $this->fileCss('https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.css');

        $this->fileJs('https://unpkg.com/filepond-plugin-file-encode/dist/filepond-plugin-file-encode.min.js');
        $this->fileJs('https://unpkg.com/filepond-plugin-file-validate-size/dist/filepond-plugin-file-validate-size.min.js');
        $this->fileJs("https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.js");
        $this->fileJs('https://unpkg.com/filepond-plugin-image-exif-orientation/dist/filepond-plugin-image-exif-orientation.min.js');
        $this->fileJs("https://unpkg.com/filepond-plugin-image-cropLength/dist/filepond-plugin-image-cropLength.js");
        $this->fileJs("https://unpkg.com/filepond-plugin-image-resize/dist/filepond-plugin-image-resize.js");
        $this->fileJs("https://unpkg.com/filepond-plugin-image-transform/dist/filepond-plugin-image-transform.js");
        $this->fileJs('https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.js');
//        $this->fileJs('https://unpkg.com/filepond/dist/filepond.min.js');
        $this->fileJs('https://unpkg.com/filepond/dist/filepond.js');
    }

    public function codes()
    {
        $this->htm = <<<HTML
<!--        <form action="" method="post">-->
            <input type="file" />
<!--            <input type="submit" value="Upload Photo(s)" name="B1" class="btn btn-info" />-->
<!--            <input type="hidden" name="sentPhotos" value="12345" />-->
<!--        </form>-->
HTML;

        $this->js = <<<JS
            // register desired plugins...
            FilePond.registerPlugin(
                // encodes the file as base64 data...
                FilePondPluginFileEncode,
                // validates the size of the file...
                FilePondPluginFileValidateSize, 
                // validates the file type...
                FilePondPluginFileValidateType,
                // corrects mobile image orientation...
                FilePondPluginImageExifOrientation,
                // calculates & dds cropping info based on the input image dimensions and the set cropLength ratio
                FilePondPluginImageCrop,
                //  calculates & adds resize information
                FilePondPluginImageResize,
                // applies the image modifications supplied by the Image cropLength and Image resize plugins before the image is uploaded
                FilePondPluginImageTransform,
                // previews dropped images...
                FilePondPluginImagePreview
            );
            // Select the file input and use create() to turn it into a pond
            FilePond.create( document.querySelector('input[type="file"]'), { 
                allowMultiple: true,
                allowFileEncode: true,
                maxFiles:5,
                required: true,
                maxParallelUploads:5,
                instantUpload:false,
                acceptedFileTypes: ['image/*'],
                // imageResizeTargetWidth: 50,
                //imageResizeMode: 'contain',
                // imageCropAspectRatio: '1:1',
                // imageTransformVariants: {
                //     'v2_100px': transforms => 
                //     {
                //         transforms.resize.size.width = 100;
                //         return transforms;
                //     },
                //     'v3_200px': transforms => {
                //         transforms.resize.size.width = 200;
                //         return transforms;
                //     }
                // },
                // imageTransformOutputQuality: 50,
                // imageTransformOutputMimeType: 'image/jpeg',
               
                onaddfile: (err, fileItem) => {
                    console.log(err, fileItem);
                },
               
                // alter the output property
                 onpreparefile: (fileItem, outputFiles) => {
                    console.log(fileItem, outputFiles);
                    // loop over the outputFiles array
                    // outputFiles.forEach(output => {
                    //     const img = new Image();
                    //     // output now is an object containing a `name` and a `file` property, we only need the `file`
                    //     img.src = URL.createObjectURL(output.file);
                    //     document.body.appendChild(img);
                    // })
                 }
            });
            
            FilePond.setOptions({
                server: {
                    timeout: 7000,
                    process: {
                        url: './process',
                        method: 'POST',
                        headers: {
                            'x-customheader': 'Hello World'
                        },
                        withCredentials: false,
                        onload: (response) => response.key,
                        onerror: (response) => response.data,
                        ondata: (formData) => {
                            formData.append('Hello', 'World');
                            return formData;
                        }
                    },
                    // revert: './revert',
                    // restore: './restore/',
                    // load: './load/',
                    // fetch: './fetch/',
                    
                }
            });
            
JS;
    }

}
