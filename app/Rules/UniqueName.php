<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\DB;

class UniqueName implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    protected $data;
    protected  $table;

    public function __construct($data, $table)
    {
        $this->data = $data;
        $this->table = $table;
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
        return !DB::table($this->table)->where('id', $this->data)->exists();
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Jina Hili Limeshasajiriwa Katika Mfumo.';
    }
}
