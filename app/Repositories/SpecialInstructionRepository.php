<?php

namespace App\Repositories;

use App\Models\SpecialInstruction;
use App\Repositories\BaseRepository;

/**
 * Class SpecialInstructionRepository
 * @package App\Repositories
 * @version November 17, 2021, 5:53 pm UTC
*/

class SpecialInstructionRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'order_id',
        'instruction'
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
        return SpecialInstruction::class;
    }
}
