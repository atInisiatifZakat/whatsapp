<?php

declare(strict_types=1);

namespace Inisiatif\Package\WhatsApp\Templates;

use Inisiatif\Package\WhatsApp\HSM\Component;
use MessageBird\Objects\Conversation\Content;
use MessageBird\Objects\Conversation\Message;
use Inisiatif\Package\WhatsApp\HSM\MediaMessage;

abstract class AbstractMediaTemplate extends BaseTemplate
{
    /**
     * @return Component[]
     */
    abstract public function components(): array;

    protected function buildMessage(): Message
    {
        $hsm = new MediaMessage();
        $hsm->namespace = 'be0ed813_b6f1_4da4_9d37_b2c2d125ff13';
        $hsm->templateName = $this->templateName();
        $hsm->language = $this->language();
        $hsm->components = $this->components();

        $content = new Content();
        $content->hsm = $hsm;

        $message = new Message();
        $message->type = 'hsm';
        $message->channelId = '81e9b4b3-eb61-46f1-9c1b-32c5f5aa6bc4';
        $message->to = $this->number();
        $message->content = $content;

        return $message;
    }
}
