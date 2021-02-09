<?php

declare(strict_types=1);

namespace Inisiatif\Package\WhatsApp\Contracts;

use MessageBird\Objects\Conversation\Message;

interface TemplateInterface
{
    public function message(): Message;

    public function params(): array;

    public function number(): string;
}
