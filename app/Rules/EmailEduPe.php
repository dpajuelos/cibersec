<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class EmailEduPe implements Rule
{
    public function passes($attribute, $value)
    {
        if (is_null($value)) {
            return false;
        }
        return preg_match('/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.(edu\.pe)$/', $value);
    }

    public function message()
    {
        return 'Email debe ser de dominio .edu.pe';
    }
}