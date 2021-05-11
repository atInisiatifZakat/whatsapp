<?php

declare(strict_types=1);

namespace Inisiatif\Package\WhatsApp\Events;

use MessageBird\Objects\Conversation\Conversation;
use Inisiatif\Package\WhatsApp\Contracts\TemplateInterface;

final class MessageWasSend
{
    public $notifiable;

    private Conversation $conversation;

    private TemplateInterface $template;

    public function __construct(TemplateInterface $template, Conversation $conversation, $notifiable)
    {
        $this->conversation = $conversation;
        $this->template = $template;
        $this->notifiable = $notifiable;
    }

    public function getConversation(): Conversation
    {
        return $this->conversation;
    }

    public function getTemplate(): TemplateInterface
    {
        return $this->template;
    }

    /**
     * @return mixed
     */
    public function getNotifiable()
    {
        return $this->notifiable;
    }
}
