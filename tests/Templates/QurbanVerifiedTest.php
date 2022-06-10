<?php

declare(strict_types=1);

namespace Inisiatif\Package\WhatsApp\Tests\Templates;

use PHPUnit\Framework\TestCase;
use MessageBird\Objects\Conversation\SendMessage;
use Inisiatif\Package\WhatsApp\Contracts\TemplateInterface;
use Inisiatif\Package\WhatsApp\Templates\QurbanVerified;

final class QurbanVerifiedTest extends TestCase
{
    public function testCanCreateQurbanConfirmationObject(): void
    {
        $to = '+6287889292327';
        $amount = '1.000.000';
        $qurbanNames = 'Apple | Orange';
        $link = 'https://izi.or.id/';

        $confirmation = new QurbanVerified($to, $qurbanNames, $amount, $link);

        $this->assertInstanceOf(TemplateInterface::class, $confirmation);
        $this->assertInstanceOf(SendMessage::class, $confirmation->message());
        $this->assertSame($to, $confirmation->number());
        $this->assertEquals($confirmation->message()->content->hsm->params, $confirmation->params());
        $this->assertCount(3, $confirmation->message()->content->hsm->params);
        $this->assertSame('notifikasi_verifikasi_qurban', $confirmation->message()->content->hsm->templateName);

        $this->assertSame('Apple | Orange', $confirmation->message()->content->hsm->params[0]->default);
        $this->assertSame('1.000.000', $confirmation->message()->content->hsm->params[1]->default);
        $this->assertSame('https://izi.or.id/', $confirmation->message()->content->hsm->params[2]->default);
    }
}
