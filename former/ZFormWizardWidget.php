<?php

/**
 *
 *
 * Author:  Asror Zakirov
 * Date:    06.06.2019
 * https://www.linkedin.com/in/asror-zakirov
 * https://www.facebook.com/asror.zakirov
 * https://github.com/asror-z
 *
 *
 *
 */

namespace zetsoft\widgets\former;

use rmrevin\yii\fontawesome\FA;
use zetsoft\models\user\UserBlocked;
use zetsoft\system\assets\ZColor;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\inputes\ZInputLatinWidget;
use zetsoft\widgets\market\ZHotOfferWidget;
use zetsoft\widgets\themes\ZCardWidget;
use zetsoft\widgets\themes\ZColWidget;
use zetsoft\widgets\themes\ZRowWidget;
use zetsoft\widgets\themes\ZVenCardWidget;

class ZFormWizardWidget extends ZWidget
{
    /**
     * Configuration
     */
    public $config = [];
    public $_config = [
        'wizardClass' => self::wizardClass['smart']
    ];

    public const wizardClass = [
        'smart' => ZSmartWizardWidget::class,
        'icard' => ZCardWidget::class,
        'none' => 'none'
    ];

    public $_layout = [
        'card' => <<<HTML
    <div class="d-flex">{cards}</div>
HTML

    ];

    /**
     *
     * Wrapping with Cards
     * @throws \Exception
     */
    public function codes()
    {
        if ($this->_config['wizardClass'] === self::wizardClass['none'])
        {
            $this->htm = ZFormWidget::widget([
                'model' => $this->model,
                'form' => $this->form
            ]);
            return null;
        }
        $form = $this->activeBegin();

        $data = []; //data for ZSmartWizardWidget
        $cards = $this->model->cards;    //Get Cards
        $stepCode = null;

        $i = 0;
        //Iterate Cards
        $stepNumber = 0;
        foreach ($cards as $card) {
            $stepNumber++;
            $stepTitle = $card['title']; //For Steptitle
            $steps = '';
            foreach ($card['items'] as $item) {
                $steps .= ZFormCardWidget::widget([
                    'model' => $this->model,
                    'config' => [
                        'title' => $item['title'],
                        'ident' => $i,
                        'form' => $form
                    ]
                ]);
                $i++;
            }
            $data[] = ['id' => $stepNumber, 'title' => $stepTitle, 'content' => $steps];  //generate data for ZSmartWizardWidget
            if ($this->_config['wizardClass'] === self::wizardClass['icard'])
                $stepCode .= $this->_config['wizardClass']::widget([
                    'config' => [
                        'content' => $steps,
                        'title' => $stepTitle,
                        //'bodyClass' => 'd-flex'
                    ]
                ]);
            
        }
        if ($this->_config['wizardClass'] === self::wizardClass['smart'])
            echo ZSmartWizardWidget::widget([
                'data' => $data
            ]);
        if ($this->_config['wizardClass'] === self::wizardClass['icard'])
            $this->htm = strtr($this->_layout['card'],[
                '{cards}' => $stepCode
            ]);

        $this->activeEnd();

    }

}
