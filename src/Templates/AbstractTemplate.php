<?php

declare(strict_types=1);

namespace Inisiatif\Package\WhatsApp\Templates;

use MessageBird\Objects\Conversation\Content;
use MessageBird\Objects\Conversation\Message;
use MessageBird\Objects\Conversation\HSM\Language;
use Inisiatif\Package\WhatsApp\Contracts\TemplateInterface;
use MessageBird\Objects\Conversation\HSM\Message as HSMMessage;

abstract class AbstractTemplate implements TemplateInterface
{
    abstract public function message(): Message;

    abstract public function params(): array;

    abstract public function number(): string;

    abstract protected function templateName(): string;

    protected function language(): Language
    {
        $language = new Language();
        $language->policy = Language::DETERMINISTIC_POLICY;
        $language->code = 'id';

        return $language;
    }

    protected function buildMessage(): Message
    {
        $hsm = new HSMMessage();
        $hsm->namespace = 'be0ed813_b6f1_4da4_9d37_b2c2d125ff13';
        $hsm->templateName = $this->templateName();
        $hsm->language = $this->language();
        $hsm->params = $this->params();

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
