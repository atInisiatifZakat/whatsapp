<?php

declare(strict_types=1);

namespace Inisiatif\Package\WhatsApp\Events;

use MessageBird\Objects\Conversation\SendMessageResult;
use Inisiatif\Package\WhatsApp\Contracts\TemplateInterface;

final class MessageWasSend
{
    public $notifiable;

    private TemplateInterface $template;

    private SendMessageResult $messageResult;

    public function __construct(TemplateInterface $template, SendMessageResult $messageResult, $notifiable)
    {
        $this->template = $template;
        $this->notifiable = $notifiable;
        $this->messageResult = $messageResult;
    }

    public function getMessageResult(): SendMessageResult
    {
        return $this->messageResult;
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
