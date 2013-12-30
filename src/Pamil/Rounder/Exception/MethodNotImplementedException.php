<?php

namespace Pamil\Rounder\Exception;

/**
 * @author Kamil Kokot <kamkok512@gmail.com>
 */
class MethodNotImplementedException extends \RuntimeException implements ExceptionInterface
{
    /**
     * @param string $methodName Unimplemented method name (use __METHOD__)
     */
    public function __construct($methodName)
    {
        parent::__construct(sprintf("Method %s() not implemented yet.", $methodName));
    }
} 