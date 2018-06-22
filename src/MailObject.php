<?php
/**
 * @author Petra Barus <petra@urbanindo.com>
 */

namespace UrbanIndo\Yii2\MailObject;

use yii\base\BaseObject;
use yii\mail\BaseMailer;
use yii\mail\BaseMessage;
use yii\helpers\Inflector;

/**
 * Class MailObject
 * @author Petra Barus <petra@urbanindo.com>
 * @package UrbanIndo\Yii2\MailObject
 */
abstract class MailObject extends BaseObject
{
    const DEFAULT_LAYOUT_DIRECTORY = '@app/mail/layouts/';

    /**
     * @var BaseMessage
     */
    private $_message;

    /**
     * @var mixed[]|string
     */
    public $viewTypes = ['html', 'text'];

    /**
     * @return string[]
     */
    protected function getSender(): array
    {
        return ['john.doe@example.com' => 'John Doea'];
    }

    /**
     * @return string[]
     */
    protected function getReplyTo(): array
    {
        return [];
    }

    public function getMailer(): BaseMailer
    {
        return \Yii::$app->get('mailer');
    }

    protected function getMessage(): BaseMessage
    {
        return $this->_message;
    }

    abstract protected function getSubject(): string;

    /**
     * @return mixed[]
     */
    abstract protected function getContentParams(): array;

    /**
     * @return mixed[] of email to name.
     */
    abstract protected function getRecipient(): array;


    /**
     * @return string[] of email.
     */
    protected function getCc(): array
    {
        return [];
    }

    /**
     * @return string[] of email.
     */
    protected function getBcc(): array
    {
        return [];
    }

    protected function getLayoutDirectory(): string
    {
        return self::DEFAULT_LAYOUT_DIRECTORY;
    }

    /**
     * @return string|null
     */
    protected function getViewDirectory()
    {
        return null;
    }

    private function getViewPath(): string
    {
        $class = new \ReflectionClass($this);
        $directory = $this->getViewDirectory();
        if ($directory === null) {
            $directory = Inflector::camel2id($class->getShortName());
        }
        return dirname($class->getFileName()) .
            \DIRECTORY_SEPARATOR . 'views' .
            \DIRECTORY_SEPARATOR . $directory;
    }

    private function initViews()
    {
        $mailer = $this->getMailer();
        $layoutDirectory = $this->getLayoutDirectory();
        $mailer->htmlLayout = $layoutDirectory . 'html.php';
        $mailer->textLayout = $layoutDirectory . 'text.php';
        $mailer->viewPath = $this->getViewPath();
    }

    /**
     * @return mixed[]
     */
    private function getViews(): array
    {
        return [
            'html' => 'html',
            'text' => 'text'
        ];
    }

    private function composeMessage()
    {
        $contentParams = $this->getContentParams();
        $this->_message = $this->getMailer()
            ->compose($this->getViews(), $contentParams);
        $this->_message->setFrom($this->getSender())
            ->setTo($this->getRecipient())
            ->setCc($this->getCc())
            ->setBcc($this->getBcc())
            ->setSubject($this->getSubject());
    }

    public function send(): bool
    {
        $this->initViews();
        $this->composeMessage();
        return $this->_message->send();
    }
}
