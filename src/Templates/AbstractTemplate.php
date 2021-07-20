<?php

declare(strict_types=1);

namespace Inisiatif\Package\WhatsApp\Templates;

use MessageBird\Objects\Conversation\Content;
use MessageBird\Objects\Conversation\SendMessage;
use MessageBird\Objects\Conversation\HSM\Message as HSMMessage;

abstract class AbstractTemplate extends BaseTemplate
{
    abstract public function params(): array;

    protected function getHsmMessage(): HSMMessage
    {
        $hsm = new HSMMessage();
        $hsm->namespace = 'be0ed813_b6f1_4da4_9d37_b2c2d125ff13';
        $hsm->templateName = $this->templateName();
        $hsm->language = $this->language();
        $hsm->params = $this->params();

        return $hsm;
    }

    protected function getSendMessage(Content $content): SendMessage
    {
        $message = new SendMessage();
        $message->to = $this->number();
        $message->from = '81e9b4b3-eb61-46f1-9c1b-32c5f5aa6bc4';
        $message->type = 'hsm';

        $message->content = $content;

        return $message;
    }
}
