<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use App\Models\Ticket;

class UniqueSeat implements ValidationRule
{
    /**
     * Departure time
     * 
     * @var string
     */
    protected $departure_time;

    /**
     * Source airport
     * 
     * @var string
     */
    protected $source_airport;

    /**
     * Destination airport
     * 
     * @var string
     */
    protected $destination_airport;

    public function __construct(string $departure_time, string $source_airport, string $destination_airport)
    {
        $this->departure_time = $departure_time;
        $this->source_airport = $source_airport;
        $this->destination_airport = $destination_airport;
    }

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $exist = Ticket::where('departure_time', $this->departure_time)
                    ->where('source_airport', $this->source_airport)
                    ->where('destination_airport', $this->destination_airport)
                    ->where('seat', $value)
                    ->exists();

        if($exist) {
            $fail('The :attribute has already been taken.');
        }
    }
}
