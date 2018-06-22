<?php
/**
 * Template taken from here
 * https://github.com/leemunroe/responsive-html-email-template
 */

/* @var $this \yii\web\View view component instance */
/* @var $message \yii\mail\MessageInterface the message being composed */
/* @var $content string main view render result */
?>
<?php $this->beginPage(); ?>

<?php $this->beginBody(); ?>
<?= $content; ?>

=====
Sent with Love.
<?php $this->endBody(); ?>
<?php $this->endPage(); ?>