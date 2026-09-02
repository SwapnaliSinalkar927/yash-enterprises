<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class SlugMatchesName implements ValidationRule
{
    protected $name;

    public function __construct($name)
    {
        $this->name = $name;
    }

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if ($value !== \Str::slug($this->name, '_')) {
            $fail('The slug does not match the name.');
        }
    }
}
