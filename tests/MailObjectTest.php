<?php

namespace Tests\UrbanIndo\Yii2\MailObject;

use PHPUnit\Framework\TestCase;

class MailObjectTest extends TestCase
{

    public function testSend()
    {
        $oldCount = $this->getMessageCount();

        $mail = new DummyMail();
        $result = $mail->send();
        $this->assertTrue($result);

        $newCount = $this->getMessageCount();
        $this->assertEquals($oldCount + 1, $newCount);
    }

    private function getMessageCount(): int
    {
        $messages = $this->getMessagesFromMailServer();
        if (!isset($messages) || !is_array($messages)) {
            return 0;
        }
        return count($messages);
    }

    private function getMessagesFromMailServer()
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL, MAILCATCHER_URL . '/messages');
        $result=curl_exec($ch);
        curl_close($ch);
        return json_decode($result, true);
    }
}