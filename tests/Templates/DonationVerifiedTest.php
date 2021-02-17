<?php

declare(strict_types=1);

namespace Inisiatif\Package\WhatsApp\Tests\Templates;

use PHPUnit\Framework\TestCase;
use MessageBird\Objects\Conversation\Message;
use Inisiatif\Package\WhatsApp\Templates\DonationVerified;
use Inisiatif\Package\WhatsApp\Contracts\TemplateInterface;

final class DonationVerifiedTest extends TestCase
{
    public function testCanCreateConfirmationObject(): void
    {
        $to = '+6281318788271';
        $amount = '1.000.000';
        $name = 'Foo Bar';

        $confirmation = new DonationVerified($to, $amount, $name);

        $this->assertInstanceOf(TemplateInterface::class, $confirmation);
        $this->assertInstanceOf(Message::class, $confirmation->message());
        $this->assertSame($to, $confirmation->number());
        $this->assertEquals($confirmation->message()->content->hsm->params, $confirmation->params());
        $this->assertSame('donation_verified_v2', $confirmation->message()->content->hsm->templateName);
    }
}
