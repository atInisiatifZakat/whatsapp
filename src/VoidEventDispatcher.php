<?php

declare(strict_types=1);

namespace Inisiatif\Package\WhatsApp;

use Illuminate\Contracts\Events\Dispatcher;

final class VoidEventDispatcher implements Dispatcher
{
    public function listen($events, $listener = null): void
    {
    }

    public function hasListeners($eventName): bool
    {
        return false;
    }

    public function subscribe($subscriber): void
    {
    }

    public function until($event, $payload = [])
    {
        return null;
    }

    public function dispatch($event, $payload = [], $halt = false)
    {
        return null;
    }

    public function push($event, $payload = []): void
    {
    }

    public function flush($event): void
    {
    }

    public function forget($event): void
    {
    }

    public function forgetPushed(): void
    {
    }
}
