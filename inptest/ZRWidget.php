<?php

/**
 *
 *
 * Author:  Asror Zakirov
 * Date:    21.05.2019
 * https://www.linkedin.com/in/asror-zakirov
 * https://www.facebook.com/asror.zakirov
 * https://github.com/asror-z
 *
 */

namespace zetsoft\widgets\inptest;


use zetsoft\system\helpers\ZHTML;
use zetsoft\system\kernels\ZWidget;

/**
 * Class    ZHDropDownListWidget
 * @package widgets\inptest
 *
 * https://www.yiiframework.com/doc/api/2.0/yii-helpers-basehtml#activeCheckboxList()-detail
 * https://www.w3schools.com/bootstrap4/bootstrap_forms_inputs.asp
 */
class ZRWidget extends ZWidget
{
    /**
     * Configuration
     */
    public $config = [];
    public $_config = [

    ];

    public $layout = [];
    public $_layout = [
        'main' => <<<HTML
        <div id="root"></div>
        
        
        
        <script type="text/babel">
           const e = React.createElement;

        class LikeButton extends React.Component {
            constructor(props) {
             super(props);
             this.state = { liked: false };
            }

  render() {
    if (this.state.liked) {
      return 'You liked comment number ' + this.props.commentID;
    }

    return (
                <button onClick={() => this.setState({ liked: true }) }>
            Like
            </button>
        );
  }
}

// Find all DOM containers, and render Like buttons into them.
document.querySelectorAll('#root')
  .forEach(domContainer => {
    // Read the comment ID from a data-* attribute.
    const commentID = parseInt(domContainer.dataset.commentid, 10);
    ReactDOM.render(
      e(LikeButton, { commentID: commentID }),
      domContainer
    );
  });
</script>
        
        
HTML,
        'js' => <<<JS
          
JS,


    ];

    public const type = [
        'horizontal' => 'horizontal',
        'vertical' => 'vertical',
    ];

    public function asset()
    {
        $this->fileJs('https://unpkg.com/react@16/umd/react.development.js');
        $this->fileJs('https://unpkg.com/react-dom@16/umd/react-dom.development.js');
        $this->fileJs('https://unpkg.com/babel-standalone@6/babel.min.js');
    }

    public function codes()
    {

        $this->htm = strtr($this->_layout['main'], []);
        $this->js = strtr($this->_layout['js'], []);

    }
}
