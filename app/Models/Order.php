<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Order
 * @package App\Models
 * @version November 17, 2021, 5:53 pm UTC
 *
 * @property \App\Models\User $user
 * @property \Illuminate\Database\Eloquent\Collection $items
 * @property \Illuminate\Database\Eloquent\Collection $specialInstructions
 * @property integer $user_id
 * @property integer $invoice
 * @property string $order_date
 * @property string $installed_date
 * @property string $status
 * @property string $dealer
 * @property string $dealer_country
 * @property integer $dealer_phone
 * @property string $buyer_name
 * @property string $buyer_address
 * @property string $city
 * @property string $state
 * @property integer $zip
 * @property integer $phone_day
 * @property integer $phone_evening
 * @property integer $phone_cell
 * @property string $installation_site
 * @property string $email
 * @property string $description
 * @property number $width
 * @property number $roof_length
 * @property number $frame_length
 * @property number $leg_height
 * @property integer $gauge
 * @property number $price
 * @property boolean $regular_frame
 * @property boolean $a_frame
 * @property boolean $vertical_roof
 * @property boolean $all_vertical
 * @property string $color_roof
 * @property string $color_ends
 * @property string $color_sides
 * @property string $color_trim
 * @property string $installation
 * @property string $installation_other
 * @property boolean $land_level
 * @property boolean $electricity
 * @property string $payment
 * @property number $total_sale
 * @property number $tax
 * @property number $tax_exempt
 * @property number $non_tax_contractor_fee
 * @property number $total
 * @property number $dealer_deposit
 * @property number $amount_paid
 * @property number $balance_due
 * @property string $buyer_signature
 * @property string $buyer_signature_date
 * @property string $contractor_signature
 * @property string $contractor_signature_date
 */
class Order extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'orders';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
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
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'user_id' => 'integer',
        'invoice' => 'integer',
        'order_date' => 'date',
        'installed_date' => 'date',
        'status' => 'string',
        'dealer' => 'string',
        'dealer_country' => 'string',
        'dealer_phone' => 'integer',
        'buyer_name' => 'string',
        'buyer_address' => 'string',
        'city' => 'string',
        'state' => 'string',
        'zip' => 'integer',
        'phone_day' => 'integer',
        'phone_evening' => 'integer',
        'phone_cell' => 'integer',
        'installation_site' => 'string',
        'email' => 'string',
        'description' => 'string',
        'width' => 'decimal:2',
        'roof_length' => 'decimal:2',
        'frame_length' => 'decimal:2',
        'leg_height' => 'decimal:2',
        'gauge' => 'integer',
        'price' => 'decimal:2',
        'regular_frame' => 'boolean',
        'a_frame' => 'boolean',
        'vertical_roof' => 'boolean',
        'all_vertical' => 'boolean',
        'color_roof' => 'string',
        'color_ends' => 'string',
        'color_sides' => 'string',
        'color_trim' => 'string',
        'installation' => 'string',
        'installation_other' => 'string',
        'land_level' => 'boolean',
        'electricity' => 'boolean',
        'payment' => 'string',
        'total_sale' => 'decimal:2',
        'tax' => 'decimal:2',
        'tax_exempt' => 'decimal:2',
        'non_tax_contractor_fee' => 'decimal:2',
        'total' => 'decimal:2',
        'dealer_deposit' => 'decimal:2',
        'amount_paid' => 'decimal:2',
        'balance_due' => 'decimal:2',
        'buyer_signature' => 'string',
        'buyer_signature_date' => 'date',
        'contractor_signature' => 'string',
        'contractor_signature_date' => 'date'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'user_id' => 'required',
        'invoice' => 'required|integer',
        'order_date' => 'required',
        'installed_date' => 'required',
        'status' => 'required|string',
        'dealer' => 'required|string|max:255',
        'dealer_country' => 'required|string|max:255',
        'dealer_phone' => 'required|integer',
        'buyer_name' => 'required|string|max:255',
        'buyer_address' => 'required|string|max:255',
        'city' => 'required|string|max:255',
        'state' => 'required|string|max:255',
        'zip' => 'required|integer',
        'phone_day' => 'required|integer',
        'phone_evening' => 'required|integer',
        'phone_cell' => 'required|integer',
        'installation_site' => 'required|string|max:255',
        'email' => 'required|string|max:255',
        'description' => 'required|string|max:255',
        'width' => 'required|numeric',
        'roof_length' => 'required|numeric',
        'frame_length' => 'required|numeric',
        'leg_height' => 'required|numeric',
        'gauge' => 'required|integer',
        'price' => 'required|numeric',
        'regular_frame' => 'required|boolean',
        'a_frame' => 'required|boolean',
        'vertical_roof' => 'required|boolean',
        'all_vertical' => 'required|boolean',
        'color_roof' => 'required|string|max:255',
        'color_ends' => 'required|string|max:255',
        'color_sides' => 'required|string|max:255',
        'color_trim' => 'required|string|max:255',
        'installation' => 'required|string',
        'installation_other' => 'required|string|max:255',
        'land_level' => 'required|boolean',
        'electricity' => 'required|boolean',
        'payment' => 'required|string',
        'total_sale' => 'required|numeric',
        'tax' => 'required|numeric',
        'tax_exempt' => 'required|numeric',
        'non_tax_contractor_fee' => 'required|numeric',
        'total' => 'required|numeric',
        'dealer_deposit' => 'required|numeric',
        'amount_paid' => 'required|numeric',
        'balance_due' => 'required|numeric',
        'buyer_signature' => 'required|string|max:255',
        'buyer_signature_date' => 'required',
        'contractor_signature' => 'required|string|max:255',
        'contractor_signature_date' => 'required',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function items()
    {
        return $this->hasMany(\App\Models\Item::class, 'order_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function specialInstructions()
    {
        return $this->hasMany(\App\Models\SpecialInstruction::class, 'order_id');
    }
}
