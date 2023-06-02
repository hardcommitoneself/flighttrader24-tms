<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use App\Models\Ticket;

class SameSeat implements ValidationRule
{
    /**
     * Ticket id
     * 
     * @var string
     */
    protected $id;

    public function __construct(string $id)
    {
        $this->id = $id;
    }

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        try {
            $exist = Ticket::findOrFail($this->id)->where('seat', $value)->exists();

            if($exist) {
                $fail('The :attribute is the same.');
            }
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
