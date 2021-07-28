<?php

declare(strict_types=1);

namespace Inisiatif\Package\WhatsApp\Templates;

use MessageBird\Objects\Conversation\Content;
use MessageBird\Objects\Conversation\HSM\Params;
use MessageBird\Objects\Conversation\SendMessage;

final class DonationConfirmation extends AbstractTemplate
{
    private string $to;

    private string $amount;

    private string $name;

    public function __construct(string $to, string $name, string $amount)
    {
        $this->to = $to;
        $this->name = $name;
        $this->amount = $amount;
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
        $name = new Params();
        $name->default = $this->name;

        $amount = new Params();
        $amount->default = $this->amount;

        return [$name, $amount];
    }

    public function templateName(): string
    {
        return 'donation_confirmation_v1';
    }

    protected function buildMessage(): SendMessage
    {
        $content = new Content();
        $content->hsm = $this->getHsmMessage();

        return $this->getSendMessage($content);
    }
}
