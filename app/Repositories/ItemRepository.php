<?php

namespace App\Repositories;

use App\Models\Item;
use App\Repositories\BaseRepository;
use Illuminate\Container\Container as Application;

/**
 * Class ItemRepository
 * @package App\Repositories
 * @version November 17, 2021, 5:53 pm UTC
*/

class ItemRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'order_id',
        'item',
        'description',
        'measure',
        'amount',
        'price'
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Item::class;
    }

    public function detalle($id)
    {
        return Item::where('order_id', $id)->get();
    }
}
