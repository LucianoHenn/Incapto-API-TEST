<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\ValidationRule;
use Closure;

class ValidCommands implements ValidationRule
{

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $invalidPositions = [];
        $length = strlen($value);

        for ($i = 0; $i < $length; $i++) {
            if (!in_array($value[$i], ['L', 'R', 'M'])) {
                $invalidPositions[] = $i;
            }
        }
       
        if (!empty($invalidPositions)) {
            $positions = implode(', ', $invalidPositions);
            $fail("The $attribute field contains invalid characters at positions: $positions.");
        }
     
    }
}

