<?php

declare(strict_types=1);

namespace Inisiatif\Package\WhatsApp\Tests;

use Mockery;
use RuntimeException;
use MessageBird\Client;
use PHPUnit\Framework\TestCase;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Events\Dispatcher;
use Inisiatif\Package\WhatsApp\WhatsAppChannel;
use Inisiatif\Package\WhatsApp\VoidEventDispatcher;
use MessageBird\Objects\Conversation\SendMessageResult;
use Inisiatif\Package\WhatsApp\Concerns\WhatsAppAwareInterface;

final class WhatsAppChannelTest extends TestCase
{
    public function testShouldThrowExceptionWhenSend(): void
    {
        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage('Notification must me instanceof ' . WhatsAppAwareInterface::class);

        $httpClient = new TestHttpClient(Client::CONVERSATIONSAPI_ENDPOINT);

        $client = new Client('FooBarSecret', $httpClient);

        $channel = new WhatsAppChannel($client, new VoidEventDispatcher());

        $channel->send([], new class() extends Notification {
        });
    }

    public function testCanSendConfirmationTemplate(): void
    {
        $dispatcher = Mockery::mock(Dispatcher::class);
        $dispatcher->shouldReceive('dispatch')->once();

        $httpClient = new TestHttpClient(Client::CONVERSATIONSAPI_ENDPOINT);

        $client = new Client('FooBarSecret', $httpClient);

        $channel = new WhatsAppChannel($client, $dispatcher);

        $conversation = $channel->send([], new ConfirmationNotificationStub());

        $this->assertInstanceOf(SendMessageResult::class, $conversation);
    }
}
