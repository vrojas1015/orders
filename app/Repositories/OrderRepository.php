<?php

namespace App\Repositories;

use App\Models\Order;
use App\Repositories\BaseRepository;

/**
 * Class OrderRepository
 * @package App\Repositories
 * @version November 17, 2021, 5:53 pm UTC
*/

class OrderRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'user_id',
        'invoice',
        'order_date',
        'installed_date',
        'status',
        'dealer',
        'dealer_country',
        'dealer_phone',
        'buyer_name',
        'buyer_address',
        'city',
        'state',
        'zip',
        'phone_day',
        'phone_evening',
        'phone_cell',
        'installation_site',
        'email',
        'description',
        'width',
        'roof_length',
        'frame_length',
        'leg_height',
        'gauge',
        'price',
        'regular_frame',
        'a_frame',
        'vertical_roof',
        'all_vertical',
        'color_roof',
        'color_ends',
        'color_sides',
        'color_trim',
        'installation',
        'installation_other',
        'land_level',
        'electricity',
        'payment',
        'total_sale',
        'tax',
        'tax_exempt',
        'non_tax_contractor_fee',
        'total',
        'dealer_deposit',
        'amount_paid',
        'balance_due',
        'buyer_signature',
        'buyer_signature_date',
        'contractor_signature',
        'contractor_signature_date'
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
        return Order::class;
    }
}
