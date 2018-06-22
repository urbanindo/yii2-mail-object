<?php
/**
 * @author Petra Barus <petra@urbanindo.com>
 */

namespace Tests\UrbanIndo\Yii2\MailObject;

use UrbanIndo\Yii2\MailObject\MailObject;

/**
 * @author Petra Barus <petra@urbanindo.com>
 */
class DummyMail extends MailObject
{
    protected function getSubject(): string
    {
        return 'Hello, World!';
    }

    protected function getContentParams(): array
    {
        return [
            'recipientName' => 'Jane Doe',
        ];
    }

    protected function getRecipient(): array
    {
        return [
            'jane.doe@example.com' => 'Jane Doe',
        ];
    }

}