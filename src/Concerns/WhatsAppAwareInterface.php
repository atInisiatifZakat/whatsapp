<?php

declare(strict_types=1);

namespace Inisiatif\Package\WhatsApp\Concerns;

use Inisiatif\Package\WhatsApp\Contracts\TemplateInterface;

interface WhatsAppAwareInterface
{
    public function toWhatsApp($notifiable): TemplateInterface;
}
