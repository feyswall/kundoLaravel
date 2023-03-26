<?php

namespace App\Rules;

use App\Models\MotorCategory;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\DB;

class UniqueMotorType implements Rule
{
    private $motorCategory_id;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($motorCategory_id)
    {
        $this->motorCategory_id = $motorCategory_id;
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
        return !DB::table('motor_types')
            ->where('motor_category_id', $this->motorCategory_id)
            ->where('name', $value)
            ->exists();
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        $category = MotorCategory::find($this->motorCategory_id);
        if ( $category ){
            return 'Aina ya '.$category->name.' Imeshasajiriwa';
        }
        return 'Aina ya Chombo Imeshasajiriwa Imeshasajiriwa';
    }


}
