<?php

declare(strict_types=1);

namespace Inisiatif\Package\WhatsApp\Templates;

use MessageBird\Objects\Conversation\Content;
use MessageBird\Objects\Conversation\HSM\Params;
use MessageBird\Objects\Conversation\SendMessage;

final class DonationVerified extends AbstractTemplate
{
    private string $to;

    private string $amount;

    private string $name;

    public function __construct(string $to, string $amount, string $name)
    {
        $this->to = $to;
        $this->amount = $amount;
        $this->name = $name;
    }

    public function message(): SendMessage
    {
        return $this->buildMessage();
    }

    public function number(): string
    {
        return $this->to;
    }

    public function params(): array
    {
        $amount = new Params();
        $amount->default = $this->amount;

        $name = new Params();
        $name->default = $this->name;

        return [$amount, $name];
    }

    protected function templateName(): string
    {
        return 'donation_verified_v2';
    }

    protected function buildMessage(): SendMessage
    {
        $content = new Content();
        $content->hsm = $this->getHsmMessage();

        return $this->getSendMessage($content);
    }
}
