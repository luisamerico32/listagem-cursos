<?php

namespace Cursos\Helper;

trait FlashMessageTrait
{
    public function defineMessage(string $class_message, string $message): void
    {
        $_SESSION['class_message'] = $class_message;
        $_SESSION['message'] = $message;
    }
}