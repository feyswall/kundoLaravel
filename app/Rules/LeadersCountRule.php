<?php

namespace App\Rules;

use App\Models\Post;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\DB;

class LeadersCountRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */

    public  $count;

    public  $table;

    public  $post;

    public  $sideValue;

    public $sideName;

    public function __construct($count, $table, $post, $sideName, $sideValue)
    {
        $this->count = $count;
        $this->table = $table;
        $this->post = $post;
        $this->sideValue = $sideValue;
        $this->sideName = $sideName;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
//    public function passes($attribute, $value){
//        return true;
//    }


    public function passes($attribute, $value)
    {
        $wajumbe = Post::where('deep', "$this->post")->first();
        if ( $value == $wajumbe->id ) {
            $counter = DB::table("$this->table")
                ->where('isActive', true)
                ->where("$this->sideName", $this->sideValue)
                ->where('post_id', $wajumbe->id)
                ->count();
            if ($counter >= $this->count) {
                return false;
            }else{
                return true;
            }
        }else{
            return true;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Idaddi  ya Wajumbeui Imekamilika.';
    }
}
