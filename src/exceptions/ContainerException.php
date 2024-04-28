<?php
/**
 * Created by PhpStorm.
 * User: Henrik
 * Date: 4/1/2018
 * Time: 8:40 AM.
 */
declare(strict_types=1);

namespace henrik\container\exceptions;

use Exception;
use Psr\Container\ContainerExceptionInterface;

class ContainerException extends Exception implements ContainerExceptionInterface {}