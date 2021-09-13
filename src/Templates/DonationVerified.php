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

    private string $funding;

    public function __construct(string $to, string $amount, string $name, string $funding = 'zakat, infaq dan shodaqoh')
    {
        $this->to = $to;
        $this->amount = $amount;
        $this->name = $name;
        $this->funding = $funding;
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

        $funding = new Params();
        $funding->default = $this->funding;

        return [$funding, $funding, $amount, $name, $funding];
    }

    public function templateName(): string
    {
        return 'donation_verified_v4';
    }

    protected function buildMessage(): SendMessage
    {
        $content = new Content();
        $content->hsm = $this->getHsmMessage();

        return $this->getSendMessage($content);
    }
}
