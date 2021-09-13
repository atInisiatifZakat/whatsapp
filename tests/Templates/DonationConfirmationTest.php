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
        $this->assertCount(4, $confirmation->message()->content->hsm->params);
        $this->assertSame('donation_confirmation_v5', $confirmation->message()->content->hsm->templateName);

        $this->assertSame('Foo Bar', $confirmation->message()->content->hsm->params[0]->default);
        $this->assertSame('zakat, infaq dan shodaqoh', $confirmation->message()->content->hsm->params[1]->default);
        $this->assertSame('1.000.000', $confirmation->message()->content->hsm->params[2]->default);
        $this->assertSame('zakat, infaq dan shodaqoh', $confirmation->message()->content->hsm->params[3]->default);
    }
}
