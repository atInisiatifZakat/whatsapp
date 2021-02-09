<?php

declare(strict_types=1);

namespace Inisiatif\Package\WhatsApp;

use Exception;
use RuntimeException;
use MessageBird\Client;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Events\Dispatcher;
use MessageBird\Objects\Conversation\Conversation;
use Inisiatif\Package\WhatsApp\Events\MessageWasSend;
use Inisiatif\Package\WhatsApp\Events\MessageWasFailed;
use Inisiatif\Package\WhatsApp\Concerns\WhatsAppAwareInterface;

final class WhatsAppChannel
{
    private Client $client;

    private Dispatcher $dispatcher;

    public function __construct(Client $client, ?Dispatcher $dispatcher = null)
    {
        $this->client = $client;
        $this->dispatcher = $dispatcher ?: new VoidEventDispatcher();
    }

    /**
     * @param mixed $notifiable
     * @noinspection PhpExpressionResultUnusedInspection
     */
    public function send($notifiable, Notification $notification): Conversation
    {
        if (! $notification instanceof WhatsAppAwareInterface) {
            throw new RuntimeException('Notification must me instanceof ' . WhatsAppAwareInterface::class);
        }

        $message = $notification->toWhatsApp($notifiable);

        try {
            $conversation = $this->client->conversations->start($message);

            $this->dispatcher->dispatch(MessageWasSend::class, $conversation);

            return $conversation;
        } catch (Exception $e) {
            $error = sprintf('%s: %s', get_class($e), $e->getMessage());

            $this->dispatcher->dispatch(MessageWasFailed::class, [$message, $error]);

            throw new RuntimeException($e->getMessage());
        }
    }
}
