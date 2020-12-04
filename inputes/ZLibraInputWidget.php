<?php

namespace zetsoft\widgets\inputes;

use zetsoft\system\kernels\ZWidget;

class ZLibraInputWidget extends ZWidget
{
    public $config = [];
    public $_config = [
        'objectName' => 'libra',
        'mode' => self::mode['manual'],
        'inputSelector' => '',
        'buttonSelector' => '',
        'toggleSelector' => '',
        'autorun' => false,
        'wsPort' => 7977,
    ];

    public const mode = [
        'auto' => 'auto',
        'manual' => 'manual',
    ];

    public $layout = [];
    public $_layout = [
        'js' => <<< JS
var {objectName} = {
    mode: {
        AUTO: 'auto',
        MANUAL: 'manual'
    },
    
    params: {
        mode: '{mode}',
        inputSelector: '{inputSelector}',
        toggleSelector: '{toggleSelector}',
        wsPort: Number('{wsPort}')
    },
    
    state: {
        lastWeight: 0,
        isConnected: false,
        isLiveLocked: false,
        connectionTries: 0,
    },
    
    start() {
        this.connect();

        if (this.getWeightInputValue() === 0) {
            this.setWeightInputValue(0);
        } else {
            this.setLiveLocked(true);
        }
        
        if (this.params.mode === this.mode.AUTO) {
            this.getToggleButton().on('click', handleToggleClick.bind(this));
            
            function handleToggleClick() {
                setTimeout((function() {
                  this.state.isLiveLocked = this.getToggleButton().hasClass('active');
                }).bind(this), 0); // setTimeout is needed so that 'click' handler runs after bootstrap toggles the button (it happens asynchronously after 'click' handler is run
            }
        }
    },
    
    connect() {
        if (this.state.connectionTries >= 5) {
            return;
        }
        
        this.state.connectionTries++;
        var ws = new WebSocket('ws://localhost:' + this.params.wsPort);
        ws.addEventListener('open', onOpen.bind(this));
        ws.addEventListener('message', onMessage.bind(this));
        ws.addEventListener('close', reconnect.bind(this));

        function onOpen() {
            this.state.isConnected = true;
            this.state.connectionTries = 0;
        }

        function onMessage(_ref) {
            var data = _ref.data;
            this.onWeight(JSON.parse(data).weight);
        }

        function reconnect() {
            var _this = this;

            this.state.isConnected = false;
            ws.removeEventListener('close', reconnect);
            ws.removeEventListener('message', onMessage);
            
            setTimeout(() => this.connect(), 3000);
        }
    },
    
    updateWeight() {
        if (this.state.isConnected) {
            this.setWeightInputValue(this.state.lastWeight);
        }
    },
    
    setLiveLocked(isLocked) {
        this.state.isLiveLocked = isLocked;
        
        if (this.getToggleButton().hasClass('active') !== isLocked) {
            this.getToggleButton().button('toggle');
        }
    },
    
    getToggleButton() {
        return $(this.params.toggleSelector);
    },
    
    onWeight(weight) {
        this.state.lastWeight = weight;

        if (this.params.mode !== this.mode.AUTO || this.state.isLiveLocked) {
            return;
        }

        this.setWeightInputValue(weight);
    },
    
    getWeightInput() {
        return $(this.params.inputSelector);
    },
    
    setWeightInputValue(weight) {
        this.getWeightInput().val(weight);
    },
    
    getWeightInputValue() {
        return Number(this.getWeightInput().val());
    }
};

    if (Boolean('{autorun}')) {
        {objectName}.start();
    }
JS,
    ];

    public function codes()
    {
        $this->js = strtr($this->_layout['js'], [
            '{id}' => $this->id,
            '{objectName}' => $this->_config['objectName'],
            '{mode}' => $this->_config['mode'],
            '{inputSelector}' => $this->_config['inputSelector'],
            '{toggleSelector}' => $this->_config['toggleSelector'],
            '{wsPort}' => $this->_config['wsPort'],
        ]);
    }
}
