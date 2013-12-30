<?php

namespace Pamil\Rounder\Exception;

/**
 * @author Kamil Kokot <kamkok512@gmail.com>
 */
class RoundingModeNotImplemented extends \RuntimeException implements ExceptionInterface
{
    public function __construct($roundingMode)
    {
        parent::__construct(sprintf(
            "Rounding mode '%s' not implemented yet. Check %s::ROUND_* for available rounding modes.",
            $roundingMode,
            "Pamil\\Rounder\\Rounder"
        ));
    }
} 