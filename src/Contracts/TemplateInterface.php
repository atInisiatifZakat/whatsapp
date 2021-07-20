<?php

declare(strict_types=1);

namespace Inisiatif\Package\WhatsApp\Contracts;

use MessageBird\Objects\Conversation\Message;
use MessageBird\Objects\Conversation\SendMessage;

interface TemplateInterface
{
    /**
     * @psalm-return SendMessage|Message
     */
    public function message();

    public function number(): string;
}
