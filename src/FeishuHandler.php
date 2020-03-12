<?php

namespace Logger;

use Monolog\Handler\AbstractProcessingHandler;
use GuzzleHttp\Client;

/**
 * Class FeishuHandler
 * @package Logger
 */
class FeishuHandler extends AbstractProcessingHandler
{
    protected $webhook;

    /**
     * @param string $webhook
     */
    public function setWebhook(string $webhook): void
    {
        $this->webhook = $webhook;
    }


    protected function write(array $record): void
    {
        $title = $record['message'];
        unset($record['message'], $record['formatted']);
        $text = json_encode($record, JSON_PRETTY_PRINT + JSON_UNESCAPED_UNICODE + JSON_UNESCAPED_SLASHES);
        (new Client())->post($this->webhook, [
            'http_errors' => false,
            'headers'     => ['Content-Type: application/json'],
            'body'        => json_encode(['title' => $title, 'text' => $text])
        ]);

    }
}