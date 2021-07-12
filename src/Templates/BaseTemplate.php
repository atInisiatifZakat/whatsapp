<?php

declare(strict_types=1);

namespace Inisiatif\Package\WhatsApp\Templates;

use MessageBird\Objects\Conversation\Message;
use MessageBird\Objects\Conversation\HSM\Language;
use Inisiatif\Package\WhatsApp\Contracts\TemplateInterface;

abstract class BaseTemplate implements TemplateInterface
{
    abstract public function message(): Message;

    abstract public function number(): string;

    abstract protected function templateName(): string;

    abstract protected function buildMessage(): Message;

    protected function language(): Language
    {
        $language = new Language();
        $language->policy = Language::DETERMINISTIC_POLICY;
        $language->code = 'id';

        return $language;
    }
}
