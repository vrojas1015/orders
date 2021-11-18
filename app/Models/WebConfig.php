<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class WebConfig
 * @package App\Models
 * @version November 17, 2021, 5:53 pm UTC
 *
 * @property string $logo
 * @property string $address
 * @property string $header-image-bg
 * @property string $footer-image-bg
 */
class WebConfig extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'configs';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'logo',
        'address',
        'header-image-bg',
        'footer-image-bg'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'logo' => 'string',
        'address' => 'string',
        'header-image-bg' => 'string',
        'footer-image-bg' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'logo' => 'required|string|max:255',
        'address' => 'required|string|max:255',
        'header-image-bg' => 'nullable|string|max:255',
        'footer-image-bg' => 'nullable|string|max:255',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    
}
