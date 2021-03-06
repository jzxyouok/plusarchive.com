<?php

namespace app\widgets;

use Yii;
use yii\base\InvalidParamException;
use yii\base\Widget;
use yii\helpers\Json;

/**
 * Toastr class file.
 * @link https://github.com/CodeSeven/toastr
 */
class Toastr extends Widget
{
    /**
     * @var string
     */
    public $type = 'success';

    /**
     * @var string
     */
    public $title;

    /**
     * @var string
     */
    public $message;

    /**
     * @var array
     */
    public $options = [];

    private $_allowedTypes = [
        'info',
        'warning',
        'success',
        'error',
    ];

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        $this->options = Json::htmlEncode($this->options);
    }

    /**
     * @inheritdoc
     * @throw InvalidConfigException
     */
    public function run()
    {
        if (!in_array($this->type, $this->_allowedTypes, true)) {
            throw new InvalidParamException(self::class.'::type property must be either '.implode('|', $this->_allowedTypes));
        }
        $this->registerClientScript();
    }

    /**
     * Registers the needed JavaScript.
     */
    public function registerClientScript()
    {
        $view = $this->getView();
        $view->registerJs("toastr.options = $this->options;");
        $view->registerJs("toastr.$this->type('$this->message', '$this->title');");
    }
}
