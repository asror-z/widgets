<?php

namespace zetsoft\widgets\inputes;

use zetsoft\system\kernels\ZWidget;

class ZLibraInputFinalWidget extends ZWidget
{
    public $config = [];
    public $_config = [
        'funcName' => 'libra',
        'wsPort' => 7977,
        'inputSelector' => '',
        'buttonSelector' => '',
        'toggleSelector' => '',
        'mode' => 'click-to-update',
        'autorun' => false,
    ];

    public $layout = [];
    public $_layout = [
        'js' => <<< JS
            const CONFIG = {
                mode: '{mode}',
                inputSelector: '{inputSelector}',
                buttonSelector: '{buttonSelector}',
                toggleSelector: '{toggleSelector}',
                wsPort: Number('{wsPort}'),
                autorun: Boolean('{autorun}'),
            };
            
            if (CONFIG.autorun) {
                {funcName}();
            }
            
            function {funcName}() {
                let lastWeight = 0;
                let isConnected = false;
                let isLiveLocked = false;
                
                if (CONFIG.inputSelector !== '') {
                    if ($(CONFIG.inputSelector).val() === '' || $(CONFIG.inputSelector).val() === '0') {
                        $(CONFIG.inputSelector).val(0);
                    } else {
                        isLiveLocked = true;
                        if (CONFIG.toggleSelector !== '') {
                            $(CONFIG.toggleSelector).button('toggle');
                        }
                    }
                }
                
                if (CONFIG.mode === 'click-to-update') {
                    if (CONFIG.buttonSelector !== '') {
                        $(CONFIG.buttonSelector).on('click', () => {
                            updateWeightInput(lastWeight);
                        });
                    }
                } else if (CONFIG.mode === 'live') {
                    if (CONFIG.toggleSelector !== '') {
                        $(CONFIG.toggleSelector).on('click', () => {
                            setTimeout(() => {
                                isLiveLocked = $(CONFIG.toggleSelector).hasClass('active');
                            }, 0);
                        });
                    }
                }
                
                connectToLibra(onData);
                
                function updateWeightInput(weight) {
                    if (!isConnected || CONFIG.inputSelector === '') {
                        return;
                    }
                    
                    $(CONFIG.inputSelector).val(weight);
                }
                
                function onData(data) {
                    const { weight } = data;
                    
                    lastWeight = weight;
                    
                    if (CONFIG.mode === 'live') {
                        if (isLiveLocked) {
                            return;
                        }
                        
                        updateWeightInput(weight);
                    }
                }
                
                function connectToLibra(onData) {
                    const ws = new WebSocket('ws://localhost:' + CONFIG.wsPort);
                    
                    ws.addEventListener('open', onOpen);
                    ws.addEventListener('message', onMessage);
                    ws.addEventListener('error', reconnect);
                    ws.addEventListener('close', reconnect);
                    
                    function onOpen() {
                        isConnected = true;
                    }
                    
                    function onMessage({ data }) {
                        onData(JSON.parse(data));
                    }
                    
                    function reconnect() {
                        isConnected = false;
                        
                        ws.removeEventListener('error', reconnect);
                        ws.removeEventListener('close', reconnect);
                        ws.removeEventListener('message', onMessage);
                        
                        setTimeout(() => {
                            connectToLibra(onData);
                        }, 1000);
                    }
                }
            }
        JS,
    ];

    public function codes()
    {
        $this->js = strtr($this->_layout['js'], [
            '{funcName}' => $this->_config['funcName'],
            '{wsPort}' => $this->_config['wsPort'],
            '{inputSelector}' => $this->_config['inputSelector'],
            '{buttonSelector}' => $this->_config['buttonSelector'],
            '{toggleSelector}' => $this->_config['toggleSelector'],
            '{mode}' => $this->_config['mode'],
            '{autorun}' => $this->_config['autorun'],
        ]);
    }
}
