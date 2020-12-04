<?php 

    namespace  zetsoft\widgets\sorter;

    use Yii;
    use yii\helpers\Html;
use yii\helpers\Inflector;
use yii\web\Request;
use yii\widgets\LinkSorter;
    use zetsoft\system\helpers\ZArrayHelper;
    use zetsoft\system\helpers\ZUrl;
    use zetsoft\system\kernels\ZWidget;
    use yii\base\InvalidConfigException;
    use yii\data\Sort;

    /**
     * ZLinkSorterWidget renders a list of sort links for the given sort definition.
     * ZLinkSorterWidget was created based on yii\widgets\LinkSorter.
     *
     * For more details and usage information on LinkSorter, see the [guide article on sorting](guide:output-sorting).
     *
     * @author Odilov Shukurullo
    */


	class ZLinkSorterWidget extends ZWidget
	{
		
        /**
         * @var Sort the sort definition
         */
        public $sort;

        /**
         * @var array list of the attributes that support sorting. If not set, it will be determined
         * using [[Sort::attributes]].
         */
        public $attributes;

        /**
         * Widget Configuration
        */

         public $config = [];
         public $_config = [

            // widget container tag
            'containerTag' => 'ul',
            'containerTagOptions' => [],

            // wrapper tag for every single link (includes clear link) 
            'wrapperTag' => 'li',
            'wrapperTagOptions' => [],

            // options for every single link 
            'linkOptions' => [],

            // sorting icon configs
            'hasSortingIcon' => true, // if false, sorting icon does not generate
            'sortingIconConfigs' => [
                'position' => self::position['after'], // generates icon after or before the label of the link
                'ascIcon' => 'fa fa-sort-alpha-down',
                'descIcon' => 'fa fa-sort-alpha-up',
            ],
    #region Clear
            // Clear link Configs
            'hasClearLink' => true, // if false, clear link does not generate
            'clearLinkConfigs' => [

                'label' => '<i class = "fa fa-trash"></i> Clear Sorting',

                'position' => 'end', // generates the clear link end (after sorting links) or begin (before sorting links) of the widget

                'options' => [], // html options for Clear link
                 
            ],
         ];

         #endRegion

         public const position = [
            'after' => 'after',
            'before' => 'before'
         ];
        
        /**
         * Initializes the sorter.
         */
        public function init()
        {
            parent::init();
            if ($this->sort === null) {
                throw new InvalidConfigException('The "sort" property must be set.');
            }
        }


        public $layout = [];
        public $_layout = [

            'addIconBefore' => <<<JS
                $('a.asc').prepend( '<i class = "{ascIcon}"></i> ');
                $('a.desc').prepend( '<i class = "{descIcon}"></i> ');
JS,
            'addIconAfter' => <<<JS
                  $('a.asc').append( ' <i class = "{ascIcon}"></i>');
                  $('a.desc').append( ' <i class = "{descIcon}"></i>');
JS,
        ];
	
        /**
         * Renders the sort links.
         */
        protected function renderSortLinks()
        {

        	$attributes = empty($this->attributes) ? array_keys($this->sort->attributes) : $this->attributes;
        	$links = "";

        	foreach ($attributes as $name) {
                $this->_config['linkOptions'] = ZArrayHelper::merge($this->_config['linkOptions'],['data-pjax' => 1]);
        		$link = $this->link($name, $this->_config['linkOptions']);

                // wrapping a link with wrapperTag
        		$links .= Html::tag($this->_config['wrapperTag'], $link, $this->_config['wrapperTagOptions']);

        	}
            return $links;
        }

        // Render single link 
        public function link($attribute, $options = [])
        {
            if (($direction = $this->sort->getAttributeOrder($attribute)) !== null) {
                $class = $direction === SORT_DESC ? 'desc' : 'asc';
                if (isset($options['class'])) {
                    $options['class'] .= ' ' . $class;
                } else {
                    $options['class'] = $class;
                }
            }


            $url = $this->createUrl($attribute);
            $options['data-sort'] = $this->sort->createSortParam($attribute);

            if (isset($options['label'])) {
                $label = $options['label'];
                unset($options['label']);
            } else {
                if (isset($this->sort->attributes[$attribute]['label'])) {
                    $label = $this->sort->attributes[$attribute]['label'];
                } else {
                    $label = Inflector::camel2words($attribute);
                }
            }

            return Html::a($label, $url, $options);
        }

        // Render url with sort params
        public function createUrl($attribute, $absolute = false)
        {
             // $sort = $this->httpGet('sort') . ',' . $attribute;

            if (($params = $this->sort->params) === null) {
                $request = Yii::$app->getRequest();
                $params = $request instanceof Request ? $request->getQueryParams() : [];
            }

            $params[$this->sort->sortParam] = $this->sort->createSortParam($attribute);
            $params[0] = $this->moduleId."/".$this->controlId."/".$this->actionId;

            $urlManager = $this->sort->urlManager === null ? Yii::$app->getUrlManager() : $this->sort->urlManager;

            if ($absolute) {
                $url = $urlManager->createAbsoluteUrl($params);
            }else{
                $url = $urlManager->createUrl($params);
            }
            return $url;
        }

        /**
         * Renders Clear Link to remove sorting
        */
        public function renderClearLink(){

            $params = Yii::$app->request->getQueryParams();
            $params[0] = $this->moduleId."/".$this->controlId."/".$this->actionId;
            
            if (isset($params['sort'])) {
                unset($params['sort']);
            }

            $clearUrl  = Yii::$app->urlManager->createUrl($params);
            $clearLink = Html::a($this->_config['clearLinkConfigs']['label'], $clearUrl, $this->_config['clearLinkConfigs']['options']);
            return Html::tag($this->_config['wrapperTag'], $clearLink, $this->_config['wrapperTagOptions']);

        }

        /*
         * Renders HTML content of the Widget
         * */
        public function generateHtml(){

            $content = '';
            $sortLinks = $this->renderSortLinks();
            if (!$this->_config['hasClearLink']){
                $content = $sortLinks;
            }
            else{
                $clearLink = $this->renderClearLink();
                if ($this->_config['clearLinkConfigs']['position'] === 'begin'){
                    $content =  $clearLink.$sortLinks;
                }
                else{
                    $content = $sortLinks.$clearLink;
                }
            }

            $this->_config['containerTagOptions']['id']  = $this->_config['containerTagOptions']['id'] ?? $this->getId();

            return Html::tag($this->_config['containerTag'], $content, $this->_config['containerTagOptions']);
        }

        public function codes(){

            // HTML

            $this->htm =  $this->generateHtml();

        //   JS

            if ($this->_config['hasSortingIcon']){
                $js = $this->_config['sortingIconConfigs']['position'] == 'before' ? $this->_layout['addIconBefore']:$this->_layout['addIconAfter'] ;
                $this->js = strtr($js, [
                    '{ascIcon}' => $this->_config['sortingIconConfigs']['ascIcon'],
                    '{descIcon}' => $this->_config['sortingIconConfigs']['descIcon'],
                ]);
            }

        }

    }

?>
