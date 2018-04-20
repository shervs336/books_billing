<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Book
 * @package App\Models
 * @version April 20, 2018, 6:26 am UTC
 *
 * @property string author_name
 * @property string title
 * @property string published_by
 * @property date published_date
 * @property integer stocks
 * @property decimal price
 */
class Book extends Model
{
    use SoftDeletes;

    public $table = 'books';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'author_name',
        'title',
        'published_by',
        'published_date',
        'stocks',
        'price'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'author_name' => 'string',
        'title' => 'string',
        'published_by' => 'string',
        'published_date' => 'date',
        'stocks' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'author_name' => 'required|string',
        'title' => 'required|string',
        'published_by' => 'string|nullable',
        'published_date' => 'date|nullable',
        'stocks' => 'numeric|min:0',
        'price' => 'numeric|min:0'
    ];


}
