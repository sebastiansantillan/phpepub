<?php

declare(strict_types=1);

namespace PHPEpub\Exception;

use Exception;

/**
 * Excepción personalizada para errores relacionados con EPUB
 */
class EpubException extends Exception
{
    public function __construct(string $message = "", int $code = 0, ?Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
