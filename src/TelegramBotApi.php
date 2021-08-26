<?php

namespace kavalar;

use \yii\base\Component;

class TelegramBotApi extends Component
{
    public $templates;
    public $telegramBotToken;
    public $telegramChatId;

    protected $bot = null;

    public function __construct($config = [])
    {
        parent::__construct($config);
    }

    /**
     * This method renders template with given properties and send it to telegram chat.
     * On success, the sent \TelegramBot\Api\Types\Message is returned.
     * @param $template_name
     * @param array $properties
     * @param string $telegramChatId
     * @return \TelegramBot\Api\Types\Message
     * @throws exceptions\NoSuchParameterException
     * @throws exceptions\NoSuchTemplateException
     * @throws EmptyTelegramChatId
     */
    public function sendRenderedMessage($template_name, $properties = [], $telegramChatId = '') {
        if(empty($telegramChatId)) {
            $telegramChatId = $this->telegramChatId;
            if(empty($telegramChatId)) {
                throw new EmptyTelegramChatId();
            }
        }

        if(empty($this->bot)) {
            $this->bot = new TelegramBotService($this->telegramBotToken);
        }

        $message =
            (new BotNotificationTemplateProcessor($this->templates))->renderTemplate($template_name, $properties);

        return $this->bot->sendMessageTo($telegramChatId, $message);
    }

}