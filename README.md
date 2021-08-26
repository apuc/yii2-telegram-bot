# yii2-telegram-bot

Yii2 Extension that using [kavalar/telegram_bot](https://github.com/apuc/telegram_bot)

# Using

Add your component inside the config/main.php
```php
return [
    'components' => [
        'telegram_bot' => [ 
              'class' => 'kavalar\yii2-telegram-bot\TelegramBotApi',
              'templates' => [
                    'Hello' => "Hello ~name~",             
                    'Bye' => "Bye ~name~",             
               ]    
        ]
];
```
And config/main-local.php
```php
return [
    'components' => [
        'telegram_bot' => [ 
              'telegramBotToken' => "Your bot Token",      
              'telegramChatId' => "Chat id if needed",      
        ]
];
```
Use like component 
```php
...
    $properties = [
        'name' => 'Jhon'
    ];
    \Yii::$app->telegram_bot->sendRenderedMessage('Hello', $properties);
    
    //specify chat id
    \Yii::$app->telegram_bot->sendRenderedMessage('Hello', $properties, 123123123);
    
    //if there is no properties in template
    \Yii::$app->telegram_bot->sendRenderedMessage('Hello');
...
```

For details about templates and properties look [kavalar/telegram_bot docs](https://github.com/apuc/telegram_bot#__constructtemplates)


