<?php

declare(strict_types=1);

namespace Inisiatif\Package\WhatsApp\Tests\HSM;

use PHPUnit\Framework\TestCase;
use Inisiatif\Package\WhatsApp\HSM\Text;
use Inisiatif\Package\WhatsApp\HSM\Image;
use Inisiatif\Package\WhatsApp\HSM\Media;
use Inisiatif\Package\WhatsApp\HSM\Component;
use MessageBird\Objects\Conversation\Content;
use Inisiatif\Package\WhatsApp\HSM\MediaMessage;
use MessageBird\Objects\Conversation\HSM\Language;

final class MediaMessageTest extends TestCase
{
    public function testValidImageMessage(): void
    {
        $language = new Language();
        $language->policy = Language::DETERMINISTIC_POLICY;
        $language->code = 'id';

        $text1 = new Text();
        $text1->text = 'Sample text 1';

        $text2 = new Text();
        $text2->text = 'Sample text 2';

        $body = new Component();
        $body->type = Component::TYPE_BODY;
        $body->parameters = [$text1, $text2];

        $media = new Media();
        $media->url = 'https://example.com/flight.jpg';

        $image = new Image();
        $image->image = $media;

        $header = new Component();
        $header->type = Component::TYPE_HEADER;
        $header->parameters = [$image];

        $hsm = new MediaMessage();
        $hsm->namespace = 'be0ed813_b6f1_4da4_9d37_b2c2d125ff13';
        $hsm->templateName = 'test_media_complex';
        $hsm->language = $language;
        $hsm->components = [$header, $body];

        $content = new Content();
        $content->hsm = $hsm;

        $this->assertSame([
            'hsm' => [
                'components' => [
                    [
                        'type' => 'header',
                        'parameters' => [
                            [
                                'type' => 'image',
                                'image' => [
                                    'url' => 'https://example.com/flight.jpg',
                                ],
                            ],
                        ],
                    ],
                    [
                        'type' => 'body',
                        'parameters' => [
                            [
                                'type' => 'text',
                                'text' => 'Sample text 1',
                            ],
                            [
                                'type' => 'text',
                                'text' => 'Sample text 2',
                            ],
                        ],
                    ],
                ],
                'namespace' => 'be0ed813_b6f1_4da4_9d37_b2c2d125ff13',
                'templateName' => 'test_media_complex',
                'language' => [
                    'policy' => 'deterministic',
                    'code' => 'id',
                ],
                'params' => null,
            ],
        ], json_decode(json_encode($content), true));
    }
}
