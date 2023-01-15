<?php

namespace App\Rules;

use App\Models\Post;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\DB;

class WardLeadersRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public $side_id;

    public $post_id;

    public  $table;

    public  $side_column;

    public function __construct($side_id, $post_id, $table, $side_column)
    {
        $this->table = $table;
        $this->side_id = $side_id;
        $this->post_id = $post_id;
        $this->side_column = $side_column;
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
        $wajumbe = Post::where('deep', 'mj_mkutano_mkuu_W')->first();
        return !DB::table($this->table)
            ->where('isActive', true )
            ->where('post_id', $this->post_id )
            ->where('post_id', '!=', $wajumbe->id )
            ->where( $this->side_column, $this->side_id)
            ->exists();
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Amesha sajiriwa katika mfumo.';
    }
}
