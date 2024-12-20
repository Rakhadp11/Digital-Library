<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class MixedCaseWithNumbers implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return preg_match('/[A-Z]/', $value) &&
            preg_match('/[a-z]/', $value) &&
            preg_match('/[0-9]/', $value);
    }

    public function message()
    {
        return 'The :attribute must contain at least one uppercase letter, one lowercase letter, and one number.';
    }
}
