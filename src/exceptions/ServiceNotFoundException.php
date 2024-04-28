<?php
/**
 * Created by PhpStorm.
 * User: Henrik
 * Date: 4/1/2018
 * Time: 8:37 AM.
 */
declare(strict_types=1);

namespace henrik\container\exceptions;

use Exception;
use Psr\Container\NotFoundExceptionInterface;
use Throwable;

class ServiceNotFoundException extends Exception implements NotFoundExceptionInterface
{
    public function __construct(string $id, int $code = 0, ?Throwable $previous = null)
    {
        $message = sprintf('Service by this id `%s` not found', $id);
        parent::__construct($message, $code, $previous);
    }
}