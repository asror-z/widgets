<?php

/**
 *
 *
 * Author:  Asror Zakirov
 *
 * https://www.linkedin.com/in/asror-zakirov
 * https://github.com/asror-z
 *
 */

namespace zetsoft\widgets\inputes;


use kartik\popover\PopoverX;
use rmrevin\yii\fontawesome\FA;
use yii\helpers\Json;
use zetsoft\system\kernels\ZWidget;

class ZPeriodWidget extends ZWidget
{

	/**
	 *
	 * Suffixes
	 */

	public const Suffix_One = 'one';
	public const Suffix_Two = 'two';
	public const Suffix_Three = 'three';
	public const Suffix_Four = 'four';


	/**
	 *
	 * Methods
	 */

	public const Method_Get = 'get';
	public const Method_Post = 'post';

	/**
	 *
	 * Layouts
	 */

	public const Layout_4_8 = [4, 8];
	public const Layout_5_7 = [5, 7];
	public const Layout_6_6 = [6, 6];
	public const Layout_7_5 = [7, 5];
	public const Layout_8_4 = [8, 4];
	public const Layout_9_3 = [9, 3];


	public $sTitle = 'ZCore Interactive Calendar v4';
	public $sButtonTitle = 'Получить данные';

	public $sSuffix = self::Suffix_One;
	public $aLayout = self::Layout_5_7;

	public $sMethod = self::Method_Post;


	/**
	 *
	 * Popover
	 */

	public $sPopType;

	public $bPop = false;
	public $sPopIcon = FA::_CALENDAR;
	public $sPopPlace = PopoverX::ALIGN_AUTO_RIGHT;
	public $sPopClass = 'fa-2x';
	public $sPopWidth = '60%';


	/**
	 *
	 *
	 *  Private Data
	 */

	private $_sID_Start;
	private $_sID_End;

	private $_dates;

	private $_sOption;
	private $_aOption;


	public function run()
	{
		$this->_init();
		$this->_opts();
		$this->_code();

		return $this->_echo();

	}

	public function _init()
	{
		$this->_sID_Start = "period_start_{$this->sSuffix}";
		$this->_sID_End = "period_end_{$this->sSuffix}";

		$this->_dates = $this->zcore->zDate->dates($this->sSuffix);
	}

	protected function _opts()
	{

		$this->_aOption = [

			'end' => "#{$this->_sID_End}",

			'title' => true,
			'cells' => [1, 3],
			'yearsLine' => true,

			'clearButtonInButton' => true,
			'clearButton' => true,
			'resizeButton' => true,
			'fullsizeButton' => true,
			'fullsizeOnDblClick' => true,
			'formatDateTime' => 'YYYY-MM-DD HH:mm:ss',
			'formatDate' => 'YYYY-MM-DD',
			'navigate' => true,
			'defaultEndTime' => '23:59:59',
			'draggable' => true,
			'mousewheel' => true,

			'reverseMouseWheel' => true,
			'mousewheelYearsLine' => true,

			'lang' => 'ru',
			'timepicker' => true,
			'animation' => true,
			'tabIndex' => true,
			'okButton' => true,
			'timepickerOptions' => [
				'dragAndDrop' => true,
				'mouseWheel' => true,
				'clickAndSelect' => true,
				'inverseMouseWheel' => true,
				'saveOnChange' => true,
				'twelveHoursFormat' => false,
				'hours' => true,
				'minutes' => true,
				'seconds' => false,
				'ampm' => false,
				'defaultTime' => '00:00:00'
			]
		];
	}


	/**
	 * Registers the client assets
	 */
	public function _code()
	{
		$this->_sOption = Json::encode($this->_aOption, JSON_PRETTY_PRINT);

		$this->writeJs("$('#{$this->_sID_Start}').periodpicker({$this->_sOption})");

	}


	public function _echo()
	{
		ob_start();

		echo ZHTML::beginForm('', $this->sMethod, [
			'enctype' => 'multipart/form-data',
			'class' => 'form-horizontal',
		]);

		ZBlockWidget::begin([
			'iWidth' => $this->aLayout[0],
			'sAlign' => ZBlockWidget::Align_Center
		]);

		echo ZHTML::textInput($this->_sID_Start, $this->_dates->sStartDate, [
			'id' => $this->_sID_Start,
			'name' => $this->_sID_Start,
		]);

		echo ZHTML::textInput($this->_sID_End, $this->_dates->sEndDate, [
			'id' => $this->_sID_End,
			'name' => $this->_sID_End,
		]);

		ZBlockWidget::end();

		ZBlockWidget::begin([
			'iWidth' => $this->aLayout[1]
		]);

		echo ZButtonWidget::widget([
			'aType' => ZButtonWidget::Type_Submit,
			'sIcon' => FA::icon(FA::_SEND_O),
			'sLabel' => $this->sButtonTitle,

			'sColor' => ZButtonWidget::Color_Default,
			'sState' => ZButtonWidget::State_Normal,
			'sSize' => ZButtonWidget::Size_Normal,

			'bMargin' => false,
			'bBlock' => false,
			'bFlat' => true,

			'aURL' => null,
			'sClick' => '',

			'bPjax' => true,
		]);

		ZBlockWidget::end();

		echo ZHTML::endForm();

		$this->sHtm .= ob_get_clean();


		if ($this->bPop)
			$this->_pop();

		return $this->sHtm;
	}


	private function _pop()
	{
		$this->sHtm = ZPopoverWidget::widget([
			'header' => $this->sTitle,
			'placement' => $this->sPopPlace,
			'size' => PopoverX::SIZE_LARGE,
			'sType' => $this->sPopType,
			'sWidth' => $this->sPopWidth,
			'content' => $this->sHtm,
			'toggleButton' => [
				'label' => FA::icon($this->sPopIcon),
				'class' => $this->sPopClass,
				'tag' => 'a'
			],
		]);

		$this->registerCss('.popover-content {
                padding: 8px 12px 45px 12px !important;
		}');
	}

}
