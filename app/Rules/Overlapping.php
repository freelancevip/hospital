<?php

namespace App\Rules;

use App\Models\Record;
use Illuminate\Contracts\Validation\Rule;

class Overlapping implements Rule
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
        $startTime = $value;
        $endTime = date('Y-m-d H:i:s', strtotime($startTime . ' +1hour'));
        $eventsCount = Record::where(function ($query) use ($startTime, $endTime) {
            $query->where(function ($query) use ($startTime, $endTime) {
                $query->where('datetime', '>=', $startTime)
                    ->where('datetime', '<', $startTime);
            })
                ->orWhere(function ($query) use ($startTime, $endTime) {
                    $query->where('datetime', '<', $endTime)
                        ->where('datetime', '>=', $endTime);
                });
        })->count();

        return (bool)$eventsCount;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'This date is already taken';
    }
}
