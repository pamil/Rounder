<?php

namespace Pamil\Rounder\Exception;

/**
 * @author Kamil Kokot <kamkok512@gmail.com>
 */
class RoundingModeNotFound extends \RuntimeException implements ExceptionInterface
{
    /**
     * @param string $roundingMode
     */
    public function __construct($roundingMode)
    {
        parent::__construct(sprintf(
            "Rounding mode '%s' not found. Check %s::ROUND_* for available rounding modes.",
            $roundingMode,
            "Pamil\\Rounder\\Rounder"
        ));
    }
} 