<?php

namespace App\Repositories;

use App\Models\Book;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class BookRepository
 * @package App\Repositories
 * @version April 20, 2018, 6:26 am UTC
 *
 * @method Book findWithoutFail($id, $columns = ['*'])
 * @method Book find($id, $columns = ['*'])
 * @method Book first($columns = ['*'])
*/
class BookRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'author_name',
        'title',
        'published_by',
        'published_date',
        'stocks',
        'price'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Book::class;
    }
}
