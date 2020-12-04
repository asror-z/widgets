<?php

namespace zetsoft\widgets\former;

use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use function GuzzleHttp\Psr7\str;
use zetsoft\system\kernels\ZWidget;
use kartik\widgets\Select2;
use yii\web\JsExpression;

/**
 *
 * https://colorlib.com/wp/free-bootstrap-wizards/
 *
 * Created By: Daho
 */
class ZWizardStepsWidget extends ZWidget
{

    /**
     * Configuration
     */
    public $config = [];
    public $_config = [
        'type' => ZWizardStepsWidget::type['wiz1'],
        'title' => 'Wizard Title',
        'picture' => '/render/former/ZWizardStepsWidget/assets/img1.jpg',
        'data' => [
            /*['Step1 title', '', '/render/images/assets/image/filter_images/img1.jpg'],
            ['Step2 title', '', '/render/images/assets/image/filter_images/img2.jpg'],
            ['Step3 title', '', '/render/images/assets/image/filter_images/img3.jpg'],
            ['Step4 title', '', '/render/images/assets/image/filter_images/img4.jpg'],
            ['Step5 title', '', '/render/images/assets/image/filter_images/img5.jpg'],
            ['Step6 title', '', '/render/images/assets/image/filter_images/img6.jpg'],*/
        ],
        'wizardColor' => '',
        'backgroundColor' => '#50C7C7',

    ];

    public static $grapes = [
        'enable' => true,
        'icon' => '',
        'image' => '/render/former/ZWizardStepsWidget/image/icon.png',
        'name' => Azl . 'WizardSteps',
        'title' => Azl . '<b>safasfsa</b><img src="/render/former/ZWizardStepsWidget/image/icon.png"/>',

    ];

    /**
     *
     * Constants
     */
    public const type = [
        'wiz1' => 'wiz1',
        'wiz2' => 'wiz2',
        'wiz3' => 'wiz3',
        'wiz4' => 'wiz4',
    ];

    public $layout = [];
    public $_layout = [
        'wiz1' => <<<HTML
        <div class="wrapper">
        <div id="wizard">
        {section}
</div>
</div>    
HTML,
        'wiz2' => <<<HTML
        <div class="inner">
				<div class="image-holder">
					<img class="wizardpicture2" src="{wizardPicture}" alt="">
					<h3>{wizardTitle}</h3>
				</div>
            	<div id="wizard">
            		{section}
					
            	</div>
			</div>
HTML,
        'wiz3' => <<<HTML
           <div class="wrapper">
			<div class="image-holder">
				<img src="{wizardPicture}" alt="">
			</div>
            <form action="">
            	<div id="wizard">
            	{section}
            	</div>
            </form>
		    </div>
HTML,
        'wiz4' => <<<HTML
        <div class="wrapper">
            <div>
            	<div id="wizard">
            		             
					<p>{section}</p>
            	</div>
            </div>
		</div>
HTML,
        'sectionWiz1' => <<<HTML
            <h2></h2>
                 <section>
                    <div class="inner">
						<div class="image-holder">
							<img src="{imgSrc}" alt="">
                                    </div>
                                    <div class="form-content" >
                                        <div class="form-header h-75">
                                            <h3>{formHeader}</h3>
							</div>

							<p>{paragraph}</p>
						</div>
					</div>
                </section>
HTML,
        'sectionWiz2' => <<<HTML
                  	<!-- SECTION 1 -->
	                <h4>{h4}</h4>
	                <section>
						<p>{sectionParagraph}</p>
						<button class="forward">
						    Book now
							<i class="zmdi zmdi-long-arrow-right"></i>
						</button>
	                </section>
HTML,
        'sectionWiz3' => <<<HTML
                    .steps ul{ulConcat}:before {
                          content: "{contentValue}"; }</style>
                           <h4></h4>
                                        <section>
                                            <p>{sectionParagraph}</p>
                                        </section>     
HTML,
        'sectionWiz4' => <<<HTML
                    
       <h4></h4>
	                <section>
	                    <p>{sectionParagraph}</p>
	                </section>
      
HTML,
    ];




    public function asset()
    {
        $this->fileCss("/render/former/ZWizardStepsWidget/assets/wizard/css/{$this->_config['type']}.css");
        $this->fileCss('/render/former/ZWizardStepsWidget/assets/wizard/fonts/material-design-iconic-font/css/material-design-iconic-font.css');

        $this->fileJs('https://cdn.jsdelivr.net/npm/jquery@3.4.1/dist/jquery.min.js');
        $this->fileJs('/render/former/ZWizardStepsWidget/assets/wizard/js/jquery.steps.js');
        $this->fileJs('/render/former/ZWizardStepsWidget/assets/wizard/js/jquery.validate.min.js');
        $this->fileJs('/render/former/ZWizardStepsWidget/assets/wizard/js/additional-methods.min.js');
        $this->fileJs("/render/former/ZWizardStepsWidget/assets/wizard/js/{$this->_config['type']}.js");
    }


    private function sectionGenerator()
    {
        $section = '';

        $count = count($this->_config['data']);
        foreach ($this->_config['data'] as $key => $value) {
            $k = ($key) ? '.step-' . ($key + 1) : '';
            $c = $key + 1;
            switch ($this->_config['type']) {
                case 'wiz1':
                {
                    $section .= strtr($this->_layout['sectionWiz1'], [
                        '{imgSrc}' => $value[2],
                        '{formHeader}' => $value[0],
                        '{paragraph}' => $value[1],
                    ]);
                    break;
                }
                case 'wiz2':
                {
                    $section .= strtr($this->_layout['sectionWiz2'], [
                        '{h4}' => $value[0],
                        '{sectionParagraph}' => $value[1],
                    ]);
                    break;
                }
                case 'wiz3':
                    $section .= strtr($this->_layout['sectionWiz3'], [
                        '{ulConcat}' => $k,
                        '{contentValue}' => $value[0],
                        '{sectionParagraph}' => $value[1],
                    ]);
                    break;
                case 'wiz4':
                {
                    $section .= strtr($this->_layout['sectionWiz4'], [
                        '{sectionParagraph}' => $value[1],
                    ]);
                    break;
                }
            }

        }

        return $section;

    }



    public function codes()
    {

        $this->htm .= strtr($this->_layout[$this->_config['type']],[
            '{section}' => $this->sectionGenerator(),
            '{wizardTitle}' => $this->_config['title'],
            '{wizardPicture}' => $this->_config['picture'],
            
        ]);

        
        $this->css = <<<CSS

 
.image-holder img {
    height: 520px;
}

.inner {
    margin: auto;
    margin-top: 25px;
background-color: {$this->_config['wizardColor']};
}

.wizardpicture2{
    width: 100%;
}

.wizardpicture4{
    height: 90vh!important;
    margin: 5vh;
    padding-top: 0;
    vertical-align: top;
}
.warpper{
    padding: 0!important;
    margin: 0!important;
    background-color: #0b91ea;

}

.wizard > .steps li a:before{
    width: 30px;
    margin-right: -8px;
    z-index: -1;
}

.wizard > .steps li a:after{
    margin-left: 35px;

}

.wizard > .steps li a{
    margin-right: 25px;
}
.selected{
    width: 20px;
}
.wizard > .steps li.checked a:after {
    width: 30px;
}
CSS;
        $count = count($this->_config['data']);
    }

}
