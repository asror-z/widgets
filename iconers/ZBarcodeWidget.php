<?php

namespace zetsoft\widgets\iconers;

use zetsoft\service\cores\Langs;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\widgets\inputes\ZInputWidget;
use function GuzzleHttp\Psr7\str;
use zetsoft\system\kernels\ZWidget;
use kartik\widgets\Select2;
use yii\web\JsExpression;

/**
 *
 * Class ZBarcodeWidget
 * http://demos.krajee.com/widget-details/select2
 * Created By: Скала Джонсон
 * Refactored: Майк Тайсон
 */
class ZBarcodeWidget extends ZWidget
{

    /**
     * Configuration
     */
    public $config = [];
    public $_config = [
        'barCode' => true,
        'type' => 'model',
        'addCode' => false,
        'id',
    ];

    public function asset()
    {
        $this->fileJs('https://cdn.jsdelivr.net/npm/onscan.js@1.5.2/onscan.js');
    }

    public $layout = [];
    public $_layout = [

        'barcodeCheck' => <<<JS
          $(document).find('#{inputId}').focus(); 

       $('#{inputId}').on('change', function() {
          var inputVal = $(this).val()
          let trs = $('.tr-dynawidget')
          trs.each(function(key, value) {                
             let code = $(value).find('[data-code]').attr('data-code')
             if (inputVal === code) {
                var checkBox = $(this).find('.kv-row-checkbox')
                checkBox.prop('checked', true)
                checkBox.trigger('change')
             }
          })
       })
       
       if(document.scannerDetectionData === undefined)
         onScan.attachTo(document, {
           scanButtonKeyCode:true,
           scanButtonLongPressTime:500,
           timeBeforeScanTest:100,
           avgTimeByChar:30,
           minLength:6,
           suffixKeyCodes:[9,13],
           prefixKeyCodes:['-'],
           ignoreIfFocusOn:true,
           stopPropagation:true,
           preventDefault:false,
           reactToKeydown:true,
           reactToPaste:false,
           singleScanQty:1,
           reactToKeyDown:true,
           onScan: function(sCode, iQty) {
               $('#{inputId}').val(sCode);
               
               let trs = $(document).find('.tr-dynawidget');
               trs.each(function(key, value) {                
                   
                  let code = $(value).find('[data-code]').attr('data-code')
                    
                  if (sCode === code) {
                     var checkBox = $(this).find('.kv-row-checkbox')
                     checkBox.prop('checked', true)
                     checkBox.trigger('change')
                  }
               })
           },
           keyCodeMapper: function(oEvent) {
                      
                if (oEvent.which == '189') {
                  return '-';
                }                
                
                if (oEvent.which >= 48 && oEvent.which <= 57) {
                    return onScan.decodeKeyEvent(oEvent);
                } else {
                    return null;
                }
          } 
       })
JS,

        'barcode' => <<<JS
 if(document.scannerDetectionData === undefined)
      onScan.attachTo(document, {
          scanButtonKeyCode:true,
          scanButtonLongPressTime:500,
          timeBeforeScanTest:100,
          avgTimeByChar:30,
          minLength:6,
          suffixKeyCodes:[9,13],
          prefixKeyCodes:['-'],
          ignoreIfFocusOn:true,
          stopPropagation:true,
        //preventDefault:true,
          reactToKeydown:true,
          reactToPaste:false,
          singleScanQty:1,
          reactToKeyDown:true,
          onScan: function(sCode, iQty) {
             let filterCode = $(document).find('#shoporder-code')
             filterCode.val(sCode)
             filterCode.trigger('change')
          },
          keyCodeMapper: function(oEvent) {
                if (oEvent.which == '189') {
                  return '-';
                }                
                if (oEvent.which >= 48 && oEvent.which <= 57) {
                    return onScan.decodeKeyEvent(oEvent);
                } else {
                    return null;
                }
          }
      })
JS,

    ];

    public function codes()
    {

        $barcode = '';
        if ($this->_config['type'] === 'model') {

            if ($this->_config['addCode'] && !$this->_config['barCode']) {

                $barcode = strtr($this->_layout['barcode'], []);

            } else {
                $barcode = strtr($this->_layout['barcodeCheck'], [
                    '{inputId}' => $this->config['id'] . '-barcode',
                ]);
            }
        }
        $this->js = $barcode;
    }
}
