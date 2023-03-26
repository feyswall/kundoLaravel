<?php

namespace App\Rules;

use App\Models\MotorModel;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\DB;

class UniqueMotorModel implements Rule
{
    private $motorType_id;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($motorType_id)
    {
        $this->motorType_id = $motorType_id;
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
        return !DB::table('motor_models')
            ->where('motor_type_id', $this->motorType_id)
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
        $model = MotorModel::find($this->motorType_id);
        if ( $model ){
            return 'Aina ya '.$model->name.' Imeshasajiriwa';
        }
        return 'Aina ya Model ya Chombo Imeshasajiriwa Imeshasajiriwa';
    }
}
