# yii2-mail-object

This wraps mail object that can be instantiated rather standalone.

[![Build Status](https://travis-ci.org/urbanindo/yii2-mail-object.svg)](https://travis-ci.org/urbanindo/yii2-mail-object)

## Usage

Create new mail object class using `MailObject`.

e.g.

```php
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
```

Create `html.php` and `text.php` for HTML-formatted and plain text email respectively.

To send the object, simply.

```php
$mail = new DummyMail();
$mail->send();
```

## Testing

To run testing, execute

```text
./vendor/bin/phing test
```
