<?php

namespace Database\Factories;

use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Order::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => $this->faker->word,
        'invoice' => $this->faker->randomDigitNotNull,
        'order_date' => $this->faker->word,
        'installed_date' => $this->faker->word,
        'status' => $this->faker->word,
        'dealer' => $this->faker->word,
        'dealer_country' => $this->faker->word,
        'dealer_phone' => $this->faker->randomDigitNotNull,
        'buyer_name' => $this->faker->word,
        'buyer_address' => $this->faker->word,
        'city' => $this->faker->word,
        'state' => $this->faker->word,
        'zip' => $this->faker->randomDigitNotNull,
        'phone_day' => $this->faker->randomDigitNotNull,
        'phone_evening' => $this->faker->randomDigitNotNull,
        'phone_cell' => $this->faker->randomDigitNotNull,
        'installation_site' => $this->faker->word,
        'email' => $this->faker->word,
        'description' => $this->faker->word,
        'width' => $this->faker->word,
        'roof_length' => $this->faker->word,
        'frame_length' => $this->faker->word,
        'leg_height' => $this->faker->word,
        'gauge' => $this->faker->randomDigitNotNull,
        'price' => $this->faker->word,
        'regular_frame' => $this->faker->word,
        'a_frame' => $this->faker->word,
        'vertical_roof' => $this->faker->word,
        'all_vertical' => $this->faker->word,
        'color_roof' => $this->faker->word,
        'color_ends' => $this->faker->word,
        'color_sides' => $this->faker->word,
        'color_trim' => $this->faker->word,
        'installation' => $this->faker->word,
        'installation_other' => $this->faker->word,
        'land_level' => $this->faker->word,
        'electricity' => $this->faker->word,
        'payment' => $this->faker->word,
        'total_sale' => $this->faker->word,
        'tax' => $this->faker->word,
        'tax_exempt' => $this->faker->word,
        'non_tax_contractor_fee' => $this->faker->word,
        'total' => $this->faker->word,
        'dealer_deposit' => $this->faker->word,
        'amount_paid' => $this->faker->word,
        'balance_due' => $this->faker->word,
        'buyer_signature' => $this->faker->word,
        'buyer_signature_date' => $this->faker->word,
        'contractor_signature' => $this->faker->word,
        'contractor_signature_date' => $this->faker->word,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s'),
        'deleted_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
