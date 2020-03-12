# Laravel Feishu logger

Send logs to Feishu group via Feishu Custom bot

## Install

```

composer require haokaiyang/laravel-feishu-logging

```

Document: [机器人 | 如何在群聊中使用机器人？](https://getfeishu.cn/hc/zh-cn/articles/360024984973-%E6%9C%BA%E5%99%A8%E4%BA%BA-%E5%A6%82%E4%BD%95%E5%9C%A8%E7%BE%A4%E8%81%8A%E4%B8%AD%E4%BD%BF%E7%94%A8%E6%9C%BA%E5%99%A8%E4%BA%BA-#%E4%BD%BF%E7%94%A8%E6%9C%BA%E5%99%A8%E4%BA%BA)

Define feishu custom bot Token and set as environment parameters. Add to your environment file

token is a part of Feishu Webhook url

if your Webhook is (https://open.feishu.cn/open-apis/bot/hook/xxxxxxxxxxxxxxxxxxxxxxxxxxx)

token is 'xxxxxxxxxxxxxxxxxxxxxxxxxxx'

```
FEISHU_LOGGER_BOT_TOKEN=token
```


Add to <b>config/logging.php</b> file new channel:
if you want to setting different feishu custom bot,you can define token into channel setting

```php
'feishu' => [
    'driver' => 'custom',
    'via'    => Logger\FeishuLogger::class,
    'level'  => 'debug',
    'token'  => env('FEISHU_LOGGER_BOT_TOKEN', 'YOUR-CUSTOM-BOT-TOKEN'),
]
```

If your default log channel is a stack, you can add it to the <b>stack</b> channel like this
```php
'stack' => [
    'driver' => 'stack',
    'channels' => ['single', 'feishu'],
]
```

Or you can simply change the default log channel in the .env 
```
LOG_CHANNEL=feishu
```

Publish config file
```
php artisan vendor:publish --provider "Logger\FeishuLoggerServiceProvider"
```
