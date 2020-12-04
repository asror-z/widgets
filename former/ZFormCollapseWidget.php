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
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\widgets\navigat\ZGAccordionWidget;
use zetsoft\widgets\navigat\ZLiloAccordionWidget;
use zetsoft\widgets\themes\ZCardWidget;
use zetsoft\widgets\themes\ZColWidget;
use zetsoft\widgets\themes\ZRowWidget;
use zetsoft\widgets\themes\ZVenCardWidget;

class ZFormCollapseWidget extends ZWidget
{
    /**
     * Configuration
     */
     public $config = [];
     public $_config = [
          'widgetClass' => ZLiloAccordionWidget::class,
          'widgetOptions' => [
                'accordion' => true,

          ],
          'showStepNumber' => false,
          'cardWidget' => null,
          'cardOptions' => [
            
          ]
     ];

    /**
     *
     * Wrapping with Cards
     * @throws \Exception
     */
    public function codes()
    {

        $form = $this->activeBegin();

        $data = []; //data for ZSmartWizardWidget

        $cards = $this->model->cards;    //Get Cards
        
        foreach ($cards as $card) {

            foreach ($card['items'] as $item) {

                $steps2 = ZFormWidget::widget([
                    'model' => $this->model,
                    'form' => $form,
                    'config' => [

                        'topBtn' => false,
                        'botBtn' => false,
                    ]
                ]);

            $data[] = [ 'title' => $item['title'], 'content' => $steps2];
            }

        }


        ZCardWidget::begin([
            'config' => [
                'title' => $this->model->className,
                'type' => ZCardWidget::type['dynCard'],
            ]
        ]);

        echo $this->_config['widgetClass']::widget([
            'data' => $data,
            'config' => $this->_config['widgetOptions']
        ]);

        /*echo ZLiloAccordionWidget::widget([
            'data' => $data
        ]);*/




        echo ZButtonWidget::widget([
            'id' => $this->id,
            'config' => [
                'btnType' => ZButtonWidget::btnType['submit'],
                'text' => Az::l('Сохранить'),
                'pjax' => 0,
                'icon' => 'fa fa-' . FA::_SAVE,
                'btnStyle' => ZButtonWidget::btnStyle['btn-outline-primary'],
                'btnRounded' => true,
                'name' => 'submitBtn',
                'class' => 'py-0 mt-4',
            ],
            /*'event' => [
                'click' => $this->eventCode('buttonClick')
            ]*/

        ]);
        ZCardWidget::end();
        $this->activeEnd();

    }

}
