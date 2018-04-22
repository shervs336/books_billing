<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Sale
 * @package App\Models
 * @version April 20, 2018, 6:51 am UTC
 *
 * @property string code
 */
class Sale extends Model
{
    use SoftDeletes;

    public $table = 'sales';


    protected $dates = ['deleted_at'];


    public $guarded = [

    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'code' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'code' => ''
    ];

    public function books()
    {
      return $this->belongsToMany('App\Models\Book')->withPivot(['price', 'quantity', 'total_price']);
    }


}
