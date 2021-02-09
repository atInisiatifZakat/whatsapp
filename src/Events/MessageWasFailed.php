<?php

declare(strict_types=1);

namespace Inisiatif\Package\WhatsApp\Events;

use Inisiatif\Package\WhatsApp\Contracts\TemplateInterface;

final class MessageWasFailed
{
    private string $message;

    private TemplateInterface $template;

    public function __construct(string $message, TemplateInterface $template)
    {
        $this->template = $template;
        $this->message = $message;
    }

    public function getTemplate(): TemplateInterface
    {
        return $this->template;
    }
}
