<?php

namespace Logger;

use Monolog\Logger;
use Monolog\Formatter\NormalizerFormatter;

/**
 * Class FeishuLogger
 * @package Logger
 */
class FeishuLogger
{
    /**
     * Create a custom Monolog instance.
     * @param array $config
     * @return Logger
     */
    public function __invoke(array $config): Logger
    {
        $feishuHandler = new FeishuHandler();
        $feishuHandler->setBubble($config['bubble'] ?? true);
        $feishuHandler->setLevel($config['level'] ?? 'debug');
        $dateFormat = $config['date_format'] ?? config('feishu-logger.date_format');
        $feishuHandler->setFormatter(
            new NormalizerFormatter($dateFormat)
        );
        $token = $config['token'] ?? config('feishu-logger.token');
        $feishuHandler->setWebhook('https://open.feishu.cn/open-apis/bot/hook/' . $token);

        return new Logger(config('app.name'),
            [$feishuHandler]
        );
    }
}