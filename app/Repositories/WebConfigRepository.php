<?php

namespace App\Repositories;

use App\Models\WebConfig;
use App\Repositories\BaseRepository;

/**
 * Class WebConfigRepository
 * @package App\Repositories
 * @version November 17, 2021, 5:53 pm UTC
*/

class WebConfigRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'logo',
        'address',
        'header-image-bg',
        'footer-image-bg'
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
        return WebConfig::class;
    }
}
