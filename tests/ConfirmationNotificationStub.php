<?php declare(strict_types=1);

namespace Inisiatif\Package\WhatsApp\Tests;

use Illuminate\Notifications\Notification;
use Inisiatif\Package\WhatsApp\Contracts\TemplateInterface;
use Inisiatif\Package\WhatsApp\Templates\DonationConfirmation;
use Inisiatif\Package\WhatsApp\Concerns\WhatsAppAwareInterface;

final class ConfirmationNotificationStub extends Notification implements WhatsAppAwareInterface
{
    public function toWhatsApp($notifiable): TemplateInterface
    {
        return new DonationConfirmation('+6281318788271', 'Fulan', '1.000.000');
    }
}
