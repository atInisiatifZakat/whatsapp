<?php

declare(strict_types=1);

namespace Inisiatif\Package\WhatsApp\Tests\Templates;

use PHPUnit\Framework\TestCase;
use MessageBird\Objects\Conversation\SendMessage;
use Inisiatif\Package\WhatsApp\Contracts\TemplateInterface;
use Inisiatif\Package\WhatsApp\Templates\DonationConfirmation;

final class DonationConfirmationTest extends TestCase
{
    public function testCanCreateConfirmationObject(): void
    {
        $to = '+6281318788271';
        $amount = '1.000.000';
        $name = 'Foo Bar';

        $confirmation = new DonationConfirmation($to, $name, $amount);

        $this->assertInstanceOf(TemplateInterface::class, $confirmation);
        $this->assertInstanceOf(SendMessage::class, $confirmation->message());
        $this->assertSame($to, $confirmation->number());
        $this->assertEquals($confirmation->message()->content->hsm->params, $confirmation->params());
        $this->assertSame('donation_confirmation_v1', $confirmation->message()->content->hsm->templateName);
    }
}
