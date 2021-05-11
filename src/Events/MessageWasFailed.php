<?php

declare(strict_types=1);

namespace Inisiatif\Package\WhatsApp\Events;

use Inisiatif\Package\WhatsApp\Contracts\TemplateInterface;

final class MessageWasFailed
{
    public $notifiable;

    private string $message;

    private TemplateInterface $template;

    public function __construct(string $message, TemplateInterface $template, $notifiable)
    {
        $this->template = $template;
        $this->message = $message;
        $this->notifiable = $notifiable;
    }

    public function getTemplate(): TemplateInterface
    {
        return $this->template;
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * @return mixed
     */
    public function getNotifiable()
    {
        return $this->notifiable;
    }
}
