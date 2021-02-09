<?php

declare(strict_types=1);

namespace Inisiatif\Package\WhatsApp\Events;

use MessageBird\Objects\Conversation\Conversation;
use Inisiatif\Package\WhatsApp\Contracts\TemplateInterface;

final class MessageWasSend
{
    private Conversation $conversation;

    private TemplateInterface $template;

    public function __construct(TemplateInterface $template, Conversation $conversation)
    {
        $this->conversation = $conversation;
        $this->template = $template;
    }

    public function getConversation(): Conversation
    {
        return $this->conversation;
    }

    public function getTemplate(): TemplateInterface
    {
        return $this->template;
    }
}
