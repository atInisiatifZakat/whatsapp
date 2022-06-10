<?php

declare(strict_types=1);

namespace Inisiatif\Package\WhatsApp\Templates;

use MessageBird\Objects\Conversation\Content;
use MessageBird\Objects\Conversation\HSM\Params;
use MessageBird\Objects\Conversation\SendMessage;

final class QurbanVerified extends AbstractTemplate
{
    private string $to;

    private string $amount;

    private string $qurbanNames;

    private string $link;

    public function __construct(string $to, string $qurbanNames, string $amount, string $link)
    {
        $this->to = $to;
        $this->qurbanNames = $qurbanNames;
        $this->amount = $amount;
        $this->link = $link;
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
        $qurbanNames = new Params();
        $qurbanNames->default = $this->qurbanNames;

        $amount = new Params();
        $amount->default = $this->amount;

        $link = new Params();
        $link->default = $this->link;

        return [$qurbanNames, $amount, $link];
    }

    public function templateName(): string
    {
        return 'notifikasi_verifikasi_qurban';
    }

    protected function buildMessage(): SendMessage
    {
        $content = new Content();
        $content->hsm = $this->getHsmMessage();

        return $this->getSendMessage($content);
    }
}
