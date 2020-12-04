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

namespace zetsoft\widgets\former;


use kartik\export\ExportMenu;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use zetsoft\system\Az;


/**\
 * Class    ZExportMenuWidget
 * @package zetsoft\widgets\former]
 *
 * https://github.com/kartik-v/yii2-export
 * https://demosbs3.krajee.com/export
 */
class ZExportMenu extends ExportMenu
{

    public $config = [];
    public $_config = [


    ];
    public static $grapes = [
        'enable' => false,
        'icon' => 'fa',
        'src' => '/render/inputes/ZSelect2Widget/image/icon.png',
        'name' => Azl . 'Select2',
        'title' => Azl . '<b>safasfsa</b><img src="/render/inputes/ZSelect2Widget/image/icon.png"/>',
    ];
    public $target = ExportMenu::TARGET_BLANK;
    public $krajeeDialogSettings = [];
    public $showConfirmAlert = false;
    public $enableFormatter = true;
    public $asDropdown = true;
    public $pjaxContainerId = null;
    public $clearBuffers = true;
    public $dropdownOptions = [];
    public $initProvider = true;
    public $showColumnSelector = false;
    public $enableAutoFormat = true;
    public $columnSelector = [];
    public $columnSelectorOptions = [];
    public $columnSelectorMenuOptions = ['class' => 'primary-color',];
    public $columnBatchToggleSettings = [];
    public $container = ['class' => 'btn-group ', 'role' => 'group'];
    public $template = "{columns}\n{menu}";
    public $timeout = -1;
    public $exportFormOptions = ['class' => 'danger-color'];
    public $exportFormHiddenInputs = [];
    public $selectedColumns;
    public $disabledColumns = [];
    public $hiddenColumns = [];
    public $noExportColumns = [];
    public $exportFormView = '_form';
    public $exportColumnsView;
    public $fontAwesome = true;
    public $stripHtml = true;
    public $exportConfig = [];
    
    public $exportRequestParam = 'export';
    public $exportTypeParam = 'type';
    public $exportColsParam = 'columns';
    public $colSelFlagParam = 'selector';
    public $styleOptions = [];
    public $headerStyleOptions = [];
    public $boxStyleOptions = [];
    public $contentBefore = [];
    public $contentAfter = [];
    public $autoWidth = true;
    public $encoding = ExportMenu::ENCODING_UTF8;
    public $filename = 'Full export';
    public $folder = '@runtime/export';
    public $linkPath = '';
    public $linkFileName = 'Full export';
    public $stream = true;
    public $deleteAfterSave = false;
    public $afterSaveView = '_view';
    public $batchSize = 0;
    public $messages = [];
    
    public $onInitExcel = null;
    public $onInitWriter = null;
    public $onInitSheet = null;
    public $onRenderHeaderCell = null;
    public $onRenderDataCell = null;
    public $onRenderFooterCell = null;
    public $onRenderSheet = null;
    public $onGenerateFile = null;
    
    public $docProperties = [];
    public $dynagrid = false;
    public $dynagridOptions = ['options' => ['id' => 'dynagrid-export-menu']];
    public $emptyText = 'No Data found';

    public $groupedRowStyle = [
        'font' => [
            'bold' => false,
            'color' => [
                'argb' => Color::COLOR_DARKBLUE,
            ],
        ],
        'fill' => [
            'type' => Fill::FILL_SOLID,
            'color' => [
                'argb' => Color::COLOR_WHITE,
            ],
        ],
    ];

    public $sheetName = 'Worksheet';
    public $supplementSheets = null;
    public $dataValidation = null;
    public $exportType = self::FORMAT_EXCEL_X;
    public $triggerDownload = false;


    public function init()
    {

        $this->dropdownOptions = [

            'icon' => '<i class="fal fa-file-export"></i>',
            'label' => null,
            'title' => Az::l('Экспортировать'),
            'itemsBefore' => [],
            'itemsAfter' => [],
            'menuOptions' => [],
            'class' => 'btn btn-primary',
        ];

        $this->columnSelectorOptions = [

            'class' => 'btn btn-primary',
            'icon' => '<i class="fa fa-list"></i>',
            'label' => '',
            'title' => Az::l('Выберите столбцы для экспорта'),
        ];

        $this->columnBatchToggleSettings = [

            'show' => true,
            'label' => Az::l('Выбрать все'),
            'options' => ['class' => 'kv-toggle-all']
        ];

        $this->messages = [

            'allowPopups' => Az::l('Отключите все блокировщики всплывающих окон в вашем браузере, чтобы обеспечить правильную загрузку...'),
            'confirmDownload' => Az::l('Чтобы продолжить, нажмите OK?'),
            'downloadProgress' => Az::l('Генерация файла. Пожалуйста, подождите .... Все готово! Нажмите в любом месте здесь, чтобы закрыть это окно, как только вы загрузили файл.'),
        ];

        $this->exportConfig = [
            ExportMenu::FORMAT_HTML => [
                'icon' => 'fas fa-download',
                'iconOptions' => [],
                'linkOptions' => [],
                'label' => Az::l('HTML'),
                'extension' => 'html',
                'alertMsg' => Az::l(''),
                'mime' => 'text/html',
                'writer' => ExportMenu::FORMAT_HTML,
                'options' => [],

                'showHeader' => true,
                'showPageSummary' => true,
                'showFooter' => true,
                'showCaption' => true,
            ],
            ExportMenu::FORMAT_CSV => [
                'label' => Az::l('CSV'),
                'icon' => 'fas fa-download',
                'iconOptions' => [],
                'linkOptions' => [],
                'options' => [],
                'alertMsg' => Az::l(''),
                'mime' => 'application/csv',
                'extension' => 'csv',
                'writer' => ExportMenu::FORMAT_CSV,

                'showHeader' => true,
                'showPageSummary' => true,
                'showFooter' => true,
                'showCaption' => true,
            ],
          
            ExportMenu::FORMAT_TEXT => [
                'label' => Az::l('TXT'),
                'icon' => 'fas fa-download',
                'iconOptions' => [],
                'linkOptions' => [],
                'options' => [],
                'alertMsg' => Az::l(''),
                'mime' => 'text/plain',
                'extension' => 'csv',
                'writer' => ExportMenu::FORMAT_TEXT,

                'showHeader' => true,
                'showPageSummary' => true,
                'showFooter' => true,
                'showCaption' => true,
            ],
            ExportMenu::FORMAT_PDF => [
                'label' => Az::l('PDF'),
                'icon' => 'fas fa-download',
                'iconOptions' => ['class' => 'text-danger'],
                'linkOptions' => [],
                'options' => [],
                'alertMsg' => Az::l(''),
                'mime' => 'application/pdf',
                'extension' => 'pdf',
                'writer' => ExportMenu::FORMAT_PDF,

                'showHeader' => true,
                'showPageSummary' => true,
                'showFooter' => true,
                'showCaption' => true,
            ],
            ExportMenu::FORMAT_EXCEL => [
                'label' => Az::l('XLS'),
                'icon' => 'fas fa-download',
                'iconOptions' => ['class' => 'text-success'],
                'linkOptions' => [],
                'options' => [],
                'alertMsg' => '',
                'mime' => 'application/vnd.ms-excel',
                'extension' => 'xls',
                'writer' => ExportMenu::FORMAT_EXCEL,
            ],
            ExportMenu::FORMAT_EXCEL_X => [
                'label' => Az::l('XLSX'),
                'icon' => 'fas fa-download',
                'iconOptions' => [],
                'linkOptions' => [],
                'options' => [],
                'alertMsg' => Az::l(''),
                'mime' => 'application/application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                'extension' => 'xlsx',
                'writer' => ExportMenu::FORMAT_EXCEL_X,

                'showHeader' => true,
                'showPageSummary' => true,
                'showFooter' => true,
                'showCaption' => true,
            ],
        ];


        parent::init();

    }

    public function codes(){
        
    }


}
