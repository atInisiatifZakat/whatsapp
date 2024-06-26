<?php

declare(strict_types=1);

namespace Inisiatif\Package\WhatsApp\Templates;

use MessageBird\Objects\Conversation\HSM\Language;
use Inisiatif\Package\WhatsApp\Contracts\TemplateInterface;

abstract class BaseTemplate implements TemplateInterface
{
    abstract public function message();

    abstract public function number(): string;

    abstract protected function buildMessage();

    protected function language(): Language
    {
        $language = new Language();
        $language->policy = Language::DETERMINISTIC_POLICY;
        $language->code = 'id';

        return $language;
    }
}
