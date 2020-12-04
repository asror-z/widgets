<?php

/**
 *
 *
 * Created By: Shakxzod Namazbaev
 * Created_at: 03.12.2019
 * Refactored By: Xakimjon Ergashov
 * Refactored_at 05.05.2020
 *
 */

namespace zetsoft\widgets\navigat;

use rmrevin\yii\fontawesome\FA;
use rmrevin\yii\fontawesome\FAS;
use zetsoft\system\assets\ZColor;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZVarDumper;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\former\ZAjaxWidget;
use function Amp\Parallel\Worker\factory;

class ZButtonWidget_U extends ZWidget
{

    /**
     * Configuration
     */
    public $config = [];
    public $_config = [

        /**
         *
         * ALL
         */

        'text' => '',
        'isPjax' => false,
        'title' => '',
        'dataTarget' => '',
        'method' => ZButtonWidget::method['none'],
        'toggle' => ZButtonWidget::toggle['tooltip'],
        'color' => ZColor::color['none'],
        'class' => 'border-none',
        'hidden' => false,

        /*
         * Image
         *
         * */
        'img' => false,
        'imgClass' => '',
        'src' => '/render/asrorz/flags/uz.png',
        'imgWidth' => '42px',/*default*/
        'imgHeight' => '42px',/*default*/

        'attributes' => [],

        /**
         *
         * Button
         */
        'btn' => true,
        'btnType' => ZButtonWidget::btnType['link'],
        'btnStyle' => ZButtonWidget::btnStyle['btn-transparent'],
        'btnRounded' => true,
        'btnFloating' => false,
        'btnSize' => ZColor::btnSize['default'],


        /**
         *
         * Links
         */
        'url' => '#',
        'target' => ZButtonWidget::target['_self'],

        /**
         *
         * Badge
         */
        'badge' => '100',
        'badgeType' => ZButtonWidget::badgeType['badge-default'],

        /**
         *
         * Confirm
         */
        'hasConfirm' => false,
        'confirm' => 'Вы уверены?',
        'confirmTitle' => 'Подтверждение',
        'canselLabelText' => 'cancel',
        'confirmLabelText' => 'ok',
        'blank' => false,


        /**
         *
         * Tooltip
         */
        'hintRounded' => true,
        'ttSize' => ZButtonWidget::ttSize['medium'],
        'ttSide' => ZButtonWidget::ttSide['top'],
        'ttColor' => ZButtonWidget::ttColor['default'],
        'ttAnimate' => ZButtonWidget::ttAnimate['bounce'],
        'download' => false,
        /**
         *
         * Icon
         */
        'iconSizePx' => '',
        'icon' => '',
        'iconsSm' => false,
    ];

    /**
     *
     * Plugin Events
     * https://select2.org/programmatic-control/events
     */
    public $event = [];
    public $_event = [
        'click' => ' ',
        'confirmEvent' => <<<JS
        
JS,
    ];

    public const btnType = [
        'link' => 'link',
        'reset' => 'reset',
        'button' => 'button',
        'submit' => 'submit',
        'settingBtn' => 'settingBtn',
        'sweetBtn' => 'sweetBtn'
    ];

    public const target = [
        '_blank' => '_blank',
        '_self' => '_self',
        '_top' => '_top',
    ];

    public const toggle = [
        'tooltip' => 'tooltip',
        'collapse' => 'collapse',
        'dropdown' => 'dropdown',
        'modal' => 'modal',
        'tab' => 'tab',
        'pill' => 'pill',
        'button' => 'button',
        'buttons' => 'buttons',
    ];
    public const iconSize = [
        'default' => '',
        '0' => 'fa-0',
        '1x' => 'fa-1x',
        '2x' => 'fa-2x',
        '3x' => 'fa-3x',
        '4x' => 'fa-4x',
        '5x' => 'fa-5x',
    ];

    public const btnScale = [
        'default' => '',
        '0' => '0rem',
        '0.1' => '0.1rem',
        '0.2' => '0.2rem',
        '0.3' => '0.3rem',
        '0.4' => '0.4rem',
        '0.5' => '0.5rem',
        '0.6' => '0.6rem',
        '0.7' => '0.7rem',
        '0.8' => '0.8rem',
        '0.9' => '0.9rem',
        '1' => '1rem',
        '1.1' => '1.1rem',
        '1.2' => '1.2rem',
        '1.3' => '1.3rem',
        '1.4' => '1.4rem',
        '1.5' => '1.5rem',
        '1.6' => '1.6rem',
        '1.7' => '1.7rem',
        '1.8' => '1.8rem',
        '1.9' => '1.9rem',
        '2' => '2rem',
        '2.1' => '2.1rem',
        '2.2' => '2.2rem',
        '2.3' => '2.3rem',
        '2.4' => '2.4rem',
        '2.5' => '2.5rem',
        '10' => '10rem'
    ];


    public $layout = [];
    public $_layout = [

        'attributes' => ' {key}="{value}"',

        'attr' => <<<HTML
 {attributes} id="{id}" data-toggle="{data-toggle}" data-pjax="{data-pjax}" class="{btnSize} {btn} {btn-rounded} ovr-button {btn-floating}  {icons-sm} {btnStyle} {color} hint--{ttSide} hint--{ttColor} hint--{ttSize} hint--{ttAnimate} {hint--rounded} {class} " aria-label="{title}" aria-hidden="{aria-hidden}" {hidden} {disabled}
HTML,

        'button' => <<<HTML
    <button data-target="{data-target}" type="{btn-type}" {attrCode} name="{name}">{iconCode} {text} </button> {badgeCode}
HTML,

        'link' => <<<HTML
    <a href="{url}" target="{target}" {data-method} {download} {attrCode}> {iconCode}{text} {imgCode}</a> {badgeCode}
HTML,

        'confirm' => <<<JS
            $('#{id}').on("click", function (event) {
            
                bootbox.confirm({
                    title: "{confirmTitle}",  
                    message: "{confirm}",
                    buttons: {
                        cancel: {
                            label: '<i class="fa fa-times"></i> {canselLabelText}'
                        },
                        confirm: {
                            label: '<i class="fa fa-check"></i> {confirmLabelText}'
                        }
                    },
                    callback: function (result) {
                                if (result === true) {
                            {confirmEvent}
                        }
                        else {
                            console.log(event); 
                        }
                    }
                });
            });
JS,

        'method' => <<<HTML
data-method="{data-method}" 
HTML,
        'icon' => <<<HTML
    <i class="{icon}{iconSize}"></i>
HTML,

        'img' => <<<HTML
    <img src="{src}" class="{class}" id="{id}" alt="img" width="{imgWidth}" height="{imgHeight}">
HTML,

        'badge' => <<<HTML
    <span class="badge {badgeType} counter">{badge}</span>
HTML,

        'event' => <<<JS
            $('body #{id}')
                .on('click', {click})
                {confirmCode}
                {clickCode}

           {pjax} 
JS,

        'pjax' => <<<JS
            $('body').on('pjax:end', function() {
                $('body #{id}')
                .on('click', {click})
                {confirmCode}
                {clickCode}
            });
JS,
    ];

    public function codes()
    {
        $confirmCode = '';
        if ($this->_config['hasConfirm'])
            $confirmCode = strtr($this->_layout['confirm'], [
                '{id}' => $this->id,
                '{url}' => $this->urlMain,
                '{confirm}' => $this->_config['confirm'],
                '{confirmTitle}' => $this->_config['confirmTitle'],
                '{canselLabelText}' => $this->_config['canselLabelText'],
                '{confirmLabelText}' => $this->_config['confirmLabelText'],
                '{confirmEvent}' => $this->eventCode('confirmEvent'),
            ]);

        $clickCode = '';
        if ($this->modelCheck()) {
            if ($this->_config['blank']) {
                $clickCode = <<<JS
            $('#{$this->id}').on('click', function() {
                  window.open('{$this->value}')
            });
JS;
            }
        } else {
            if ($this->_config['blank']) {
                $clickCode = <<<JS
            $('#{$this->id}').on('click', function() {
                  window.open('{$this->_config['url']}')
            });
JS;
            }
        }

        $pjax = '';
        if ($this->_config['isPjax'])
            $pjax = strtr($this->_layout['pjax'], [
                '{id}' => $this->id,
                '{click}' => $this->eventCode('click'),
                '{confirmCode}' => $confirmCode,
                '{clickCode}' => $clickCode
            ]);

        $this->js .= strtr($this->_layout['event'], [
            '{id}' => $this->id,
            '{pjax}' => $pjax,
            '{click}' => $this->eventCode('click'),
            '{confirmCode}' => $confirmCode,
            '{clickCode}' => $clickCode
        ]);

        $badgeCode = '';
        if ($this->_config['hasBadge'])
            $badgeCode = strtr($this->_layout['badge'], [
                '{badge}' => $this->_config['badge'],
                '{badgeType}' => $this->_config['badgeType'],
            ]);

        $dataMethod = '';
        if ($this->_config['method'] !== self::method['none'])
            $dataMethod = strtr($this->_layout['method'], [
                '{data-method}' => $this->_config['method'],
            ]);

        $attributes = '';
        if (!empty($this->_config['attributes'])) {

            foreach ($this->_config['attributes'] as $key => $attribute) {
                $attributes .= strtr($this->_layout['attributes'], [
                    '{key}' => $key,
                    '{value}' => $attribute,
                ]);
            }

        }

        $attrCode = strtr($this->_layout['attr'], [
            '{attributes}' => $attributes,
            '{id}' => $this->id,
            '{text}' => $this->_config['text'],
            '{title}' => $this->_config['title'],
            '{class}' => $this->_config['class'],
            '{data-toggle}' => $this->_config['toggle'],
            '{btnStyle}' => $this->_config['btnStyle'],
            '{btnType}' => $this->_config['btnType'],
            '{btnSize}' => $this->_config['btnSize'],
            '{color}' => $this->_config['color'],
            '{data-pjax}' => $this->_config['pjax'] ? '1' : '0',
            '{btn-floating}' => $this->_config['btnFloating'] ? 'btn-floating' : '',
            '{hint--rounded}' => $this->_config['hintRounded'] ? 'hint--rounded' : '',
            '{aria-hidden}' => $this->_config['ariaHidden'] ? 'true' : '',
            '{btn-rounded}' => $this->_config['btnRounded'] ? 'btn-rounded' : '',
            '{btn}' => $this->_config['btn'] ? 'btn' : '',
            '{icons-sm}' => $this->_config['iconsSm'] ? 'icons-sm' : '',
            '{ttSize}' => $this->_config['ttSize'],
            '{ttSide}' => $this->_config['ttSide'],
            '{ttColor}' => $this->_config['ttColor'],
            '{ttAnimate}' => $this->_config['ttAnimate'],
            '{hidden}' => $this->_config['hidden'] ? 'hidden="hidden"' : '',
            '{disabled}' => $this->_config['readonly'] ? 'disabled' : '',
        ]);


        if ($this->_config['btnType'] === ZButtonWidget::btnType['link'])
            $_layout = $this->_layout['link'];
        else
            $_layout = $this->_layout['button'];

        $iconCode = strtr($this->_layout['icon'], [
            '{icon}' => $this->_config['icon'],
            '{iconSize}' => $this->_config['iconSizePx']
        ]);

        $imgCode = '';
        if ($this->_config['img']) {
            $imgCode = strtr($this->_layout['img'], [
                '{src}' => $this->_config['src'],
                '{class}' => $this->_config['imgClass'],
                '{id}' => $this->id,
                '{imgWidth}' => $this->_config['imgWidth'],
                '{imgHeight}' => $this->_config['imgHeight'],
            ]);
        }

        if (is_array($this->value)) {
            $this->value = ZVarDumper::beauty($this->value);
        }

        if ($this->modelCheck()) {
            $this->htm .= strtr($_layout, [
                /**
                 *
                 * Button
                 */
                '{data-target}' => $this->_config['dataTarget'],
                '{btn-type}' => $this->_config['btnType'],
                /**
                 *
                 * Links
                 */
                '{text}' => $this->_config['text'],
                '{url}' => $this->value,
                '{target}' => $this->_config['target'],
                '{data-method}' => $dataMethod,
                '{attrCode}' => $attrCode,
                '{badgeCode}' => $badgeCode,
                '{iconCode}' => $iconCode,
                '{imgCode}' => $imgCode,
                '{download}' => $this->_config['download'] ? 'download' : '',
                '{btnSize}' => $this->_config['btnSize'],
            ]);
        } else
            $this->htm .= strtr($_layout, [
                /**
                 *
                 * Button
                 */
                '{data-target}' => $this->_config['dataTarget'],
                '{btn-type}' => $this->_config['btnType'],
                '{name}' => empty($this->_config['name']) ? '' : $this->_config['name'],
                /**
                 *
                 * Links
                 */
                '{text}' => $this->_config['text'],
                '{url}' => $this->_config['url'],
                '{target}' => $this->_config['target'],
                '{data-method}' => $dataMethod,
                '{attrCode}' => $attrCode,
                '{badgeCode}' => $badgeCode,
                '{iconCode}' => $iconCode,
                '{imgCode}' => $imgCode,
                '{download}' => $this->_config['download'] ? 'download' : '',
            ]);
    }
}
