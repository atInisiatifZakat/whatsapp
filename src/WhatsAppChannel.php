<?php

declare(strict_types=1);

namespace Inisiatif\Package\WhatsApp;

use Exception;
use RuntimeException;
use MessageBird\Client;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Events\Dispatcher;
use Inisiatif\Package\WhatsApp\Events\MessageWasSend;
use Inisiatif\Package\WhatsApp\Events\MessageWasFailed;
use MessageBird\Objects\Conversation\SendMessageResult;
use Inisiatif\Package\WhatsApp\Concerns\WhatsAppAwareInterface;

final class WhatsAppChannel
{
    private Client $client;

    private Dispatcher $dispatcher;

    public function __construct(Client $client, Dispatcher $dispatcher)
    {
        $this->client = $client;
        $this->dispatcher = $dispatcher;
    }

    /**
     * @param mixed $notifiable
     */
    public function send($notifiable, Notification $notification): SendMessageResult
    {
        if (! $notification instanceof WhatsAppAwareInterface) {
            throw new RuntimeException('Notification must me instanceof ' . WhatsAppAwareInterface::class);
        }

        $template = $notification->toWhatsApp($notifiable);

        try {
            $result = $this->client->conversationSend->send($template);

            $this->dispatcher->dispatch(new MessageWasSend($template, $result, $notifiable));

            return $result;
        } catch (Exception $e) {
            $error = sprintf('%s: %s', get_class($e), $e->getMessage());

            $this->dispatcher->dispatch(new MessageWasFailed($error, $template, $notifiable));

            throw new RuntimeException($e->getMessage(), (int) $e->getCode(), $e);
        }
    }
}
