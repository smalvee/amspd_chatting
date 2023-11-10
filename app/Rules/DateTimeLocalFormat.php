<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use DateTime;

class DateTimeLocalFormat implements Rule
{
    public function passes($attribute, $value)
    {
        // Check if the value is in the correct datetime-local format
        return DateTime::createFromFormat('Y-m-d\TH:i', $value) !== false;
    }

    public function message()
    {
        return 'The :attribute must be in the correct datetime-local format.';
    }
}
