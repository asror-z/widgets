<?php

namespace zetsoft\widgets\former;

use Yii;
use kartik\builder\TabularForm;
use rmrevin\yii\fontawesome\FA;
use yii\data\ArrayDataProvider;
use yii\helpers\ArrayHelper;
use zetsoft\system\actives\ZActiveRecord;
use zetsoft\system\assets\ZColor;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\helpers\ZHTML;
use zetsoft\system\helpers\ZUrl;
use zetsoft\system\kernels\ZWidget;
use zetsoft\system\Az;
use zetsoft\widgets\navigat\ZButtonWidget;

/**
 * @author Shukurullo Odilov, Daho
 * @source https://demos.krajee.com/builder-details/tabular-form
*/


class ZTabularWidget extends ZWidget
{

	public $dataProvider;
	public $form;
	public $title;
	public $attributes = [];
	public $config = [];
	public $_config = [

		'gridType' => self::GridTypes['PRIMARY'],
		'title' => "",
		'refreshUrl' => "tabular",  // url for refresh current page
		'viewUrl' => 'view',
		'createUrl' => 'create',
		'deleteUrl' => 'delete',  // url for delete single item
		'indexUrl' => 'index',  // url for return for index page
		'deleteAllUrl' => 'delete-all',  // url for delete selected rows
		'pageSize' => 10,   // pageSize for Pagination
		'formName' => '',
		'attributeDefaults' => [],
		'staticOnly' => false,
		'rowHighlight' => true,
		'compositeKeySeparator' => '_',
		'rowSelectedClass' => '',
		'gridClass' => null,
		'gridSettings' => [],
		'serialColumn' => [],
		'checkboxColumn' => [],
		'actionColumn' => [],
		'columnsWidth' => [],

//		Toolbar buttons options
		'toolbarButtons' => [
			'template' => "{refresh}{create}{index}{save}{deleteAll}",
			'buttons' => [], 
		],

		'paginationOptions' => [
			'class' => 'zetsoft\system\column\ZPagination',
			'pageParam' => 'page',
			'pageSizeParam' => 'per-page',
			'forcePageParam' => true,
			'params' => null,
			'urlManager' =>  null,
			'validatePage' => true,
			'totalCount' => 0,
			'defaultPageSize' => 20,
			'pageSizeLimit' => [1,50],
		],

		'sortOptions' => [
			'class' => 'zetsoft\system\column\ZSort',
			'enableMultiSort' => true,
			'sortParam' => 'sort',
			'defaultOrder' => null,
			'separator' => ',',
			'params' => null,
			'urlManager' => null,
			'sortFlags' => SORT_REGULAR,
		] ,
	];


		public const GridTypes = [
			"DEFAULT" => 'default',
			"PRIMARY" => 'primary',
			"INFO" => 'info',
			"DANGER" => 'danger',
			"WARNING" => 'warning',
			"SUCCESS" => 'success',
			"ACTIVE" => 'active',
		];

		public function codes()
		{

			// Default Options
			$_options = [
				'gridSettings' => [
					'pjax' => true,
					'panelTemplate'=>"{panelBefore}{items}{pager}{panelAfter}",
					'toolbar' => [
						[
							'content' => $this->renderToolbarButtons(),
						]
					],
					'panel' => [
						'options' =>  [
							'style' => 'border:none',
						],
						'heading'=>"<i class='fas fa-book'></i> {$this->_config['title']}",
						'before' => "",
						'type'=> $this->_config['gridType'],
						'footer'=> true,
						'after' => "",
					]  ,

				],
				'checkboxColumn' => $this->renderCheckboxColumn(),
				'actionColumn'=> [
					'template' => '{view}{delete}'
				],
			];

			$this->renderDataProvider();

			$columns = Az::$app->forms->tabular->generate($this->model, $this->attributes, $this->_config['columnsWidth']);
			
			$options = [
				'dataProvider' => $this->dataProvider,
				'form' => $this->form,
				'attributes' => $columns,
				'formName' => $this->_config['formName'],
				'attributeDefaults' => $this->_config['attributeDefaults'],
				'staticOnly' => $this->_config['staticOnly'],
				'rowHighlight' => $this->_config['rowHighlight'],
				'compositeKeySeparator' => $this->_config['compositeKeySeparator'],
				'rowSelectedClass' => $this->_config['rowSelectedClass'],
				'gridClass' => $this->_config['gridClass'],
				'gridSettings' => $this->_config['gridSettings'],
				'serialColumn' => $this->_config['serialColumn'],
				'checkboxColumn' => $this->_config['checkboxColumn'],
				'actionColumn' => $this->renderActionColumn(),
			];

			$options = ArrayHelper::merge($_options, $options);
			$this->htm = TabularForm::widget($options);

//			JS

			$this->js = <<<JS
			var input = $('.z-input-checkbox')
			input.change(function() {
			    var key = $(this).data('key')
			    if($(this).prop("checked") == true){
			        	 $(this).parents('tr').addClass("table-success");
		            }
		            else {
		                $(this).parents('tr').removeClass("table-success");
		            }
			})
JS;


		}

		public function renderDataProvider(){

			if ($this->dataProvider === null) {
				if ($this->model instanceof ZActiveRecord) {
					$this->model->search = true;
					$this->dataProvider = $this->model->search();
				}else{
					$this->dataProvider = new ArrayDataProvider([
						'allModels' => $this->model,
					]);
				}

				//			Pagination options
				$paginationOptions = $this->_config['paginationOptions'];
				if (!isset($paginationOptions['pageSize'])){
					$paginationOptions['pageSize'] = $this->_config['pageSize'];
				}
				if (!isset($paginationOptions['route'])){
					$paginationOptions['route'] = $this->urlParamStr;
				}
				$this->dataProvider->setPagination($paginationOptions);

				//	Set Sort Options
				$sortOptions = $this->_config['sortOptions'];
				if (!isset($sortOptions['route'])){
					$sortOptions['route'] = $this->urlParamStr;
				}
				$this->dataProvider->setSort($sortOptions);
			}
		}

		#region renderCheckboxColumn()

		public function renderCheckboxColumn(){

			$headerInput =    ZHtml::checkbox('selection_all', false, [	'class' => 'select-on-check-all custom-control-input', 'id' => 'selection-all-'.$this->id]) ;
			$headerLabel = ZHtml::label("", 'selection-all-'.$this->id, ['class' => "custom-control-label" ]);
			$header = ZHtml::tag('div', $headerInput.$headerLabel, ['class' => "custom-control custom-checkbox"]); ;

			return [
				'checkboxOptions' => [
					'class' => 'kv-row-checkbox ',
				],
				'content' => function ($model, $key, $index, $column) {
					$opt = isset($this->_config['checkboxColumn']['checkboxOptions']) ?  $this->_config['checkboxColumn']['checkboxOptions'] : [];
					if (!isset($opt['id']) || $opt['id'] === null) {
						$opt['id'] = 'input-checkbox-'.$key;
					}
					$opt['data-key'] = $key;
					$opt['value'] = $key;
					ZHtml::addCssClass($opt, 'kv-row-checkbox custom-control-input z-input-checkbox checkbox-'.$this->modelClassName);
					$input = ZHtml::checkbox('selection[]', false, $opt);
					$label = ZHtml::label("", $opt['id'], ['class' => "custom-control-label" ]);
					return ZHtml::tag('div', $input.$label, ['class' => "custom-control custom-checkbox"]);
				},

				'header' => $header,
			];
		}
		
		#endregion
		
		public function renderToolbarButtons(){

			$result = "";
			$template = $this->_config['toolbarButtons']['template'];
			$buttons = $this->_config['toolbarButtons']['buttons'];
			$defaultButtons = $this->defaultButtons();
			$allButtons = ZArrayHelper::merge($defaultButtons, $buttons);
			
			foreach ($allButtons as $buttonName => $button){
				$template = strtr($template, ["{".$buttonName."}" => $button]);
			}

			return ZHtml::tag('div', $template, ['class' => 'btn-group p-0 mr-2 btn-mini fa-2x']);

		}

		public function defaultButtons(){

			return [
			  	'refresh' => ZButtonWidget::widget([
			  		'config' => [
			  			'url' => $this->_config['refreshUrl'] ? ZUrl::to([$this->_config['refreshUrl']]) : ZUrl::current(),
			  			'btnType' => ZButtonWidget::btnType['link'],
			  			'btnSize' => ZColor::btnSize['default'],
			  			'btnRounded' => false,
			  			'btnFloating' => false,
			  			'pjax' => true,
			  			'title' => 'Перезагрузить',
			  			'toggle' => ZButtonWidget::toggle['tooltip'],

			  			'hasIcon' => true,
			  			'icon' => 'fas fa-refresh',
			  			'class' => 'btn-outline-success text-success',
					]
				]),
				'create' => ZButtonWidget::widget([
			  		'config' => [
			  			'url' => ZUrl::to([$this->_config['createUrl']]),
			  			'btnType' => ZButtonWidget::btnType['link'],
			  			'btnSize' => ZColor::btnSize['default'],
			  			'btnRounded' => false,
			  			'btnFloating' => false,
			  			'title' => 'Добавить',
			  			'toggle' => ZButtonWidget::toggle['tooltip'],

			  			'hasIcon' => true,
			  			'pjax' => false,
			  			'icon' => 'fas fa-plus',
			  			'class' => 'btn-outline-success text-success',
					]
				]),

				'index' => ZButtonWidget::widget([
			  		'config' => [
			  			'url' => ZUrl::to([$this->_config['indexUrl']]),
			  			'btnType' => ZButtonWidget::btnType['link'],
			  			'btnSize' => ZColor::btnSize['default'],
			  			'btnRounded' => false,
			  			'btnFloating' => false,
			  			'title' => "Перейти к списку",
			  			'toggle' => ZButtonWidget::toggle['tooltip'],

			  			'hasIcon' => true,
			  			'pjax' => false,
			  			'icon' => 'fas fa-list',
			  			'class' => 'btn-outline-primary text-primary',
					]
				]),

				'save' => ZButtonWidget::widget([
					'config' => [
						'btnType' => ZButtonWidget::btnType['submit'],
			  			'btnSize' => ZColor::btnSize['default'],
			  			'btnRounded' => false,
			  			'btnFloating' => false,
			  			'title' => 'Сохранить',
			  			'toggle' => ZButtonWidget::toggle['tooltip'],

			  			'hasIcon' => true,
			  			'icon' => 'fas fa-save',
			  			'class' => 'btn-outline-primary text-primary',
					],
				]),

				'deleteAll' => ZCheckButtonWidget::widget([

					'config' => [
						'hasIcon' => true,
						'title' => 'удалить?',
						'grapes' => false,
						'url' => ZUrl::to([
							'/api/core/app/delete-all',
							'modelClassName' => $this->modelClassName
						]),
						'class' => 'checkbox-' . $this->modelClassName,
						'btnStyle' => ZButtonWidget::btnStyle['btn-outline-danger rounded-0'],
						'btnRounded' => false,
						'icon' => 'fas fa-trash-alt',
						'confirm' => true,
						'message' => Az::l('Вы хотите удалить этот элемент(ы)?'),
						'modelClassName' => $this->modelClassName
					]
				])
			];

		}

		public function renderActionColumn(){

                return [
                        'buttons' => [
							'delete' => function ($url, $model, $key ) {
								return ZButtonWidget::widget([
									'config' => [
										'title' => Az::l('Удалить'),
										'url' => ZUrl::to([
											'/api/core/app/' . $this->_config['deleteUrl'],
											'modelClassName' => $this->modelClassName,
											'id' => $model->id,
										]),
										'hasIcon' => true,
										'icon' => 'fas fa-' . FA::_TRASH,
										'btnRounded' => false,
										'btn' => false,
										'hasConfirm' => true,
										'confirmTitle' => Az::l('Удалить'),
										'сonfirm' => Az::l('Are you sure you want DELETE columns?'),
									],
									'event' => [
										'click' => 'function (event){e.preventDefault()}'
									]
								]);
							},
						]

                ];

		}
	}

	?>
