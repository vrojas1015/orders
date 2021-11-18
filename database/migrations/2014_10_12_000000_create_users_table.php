<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('orders', function (Blueprint $table){
            $table->id();
            $table->foreignId('user_id')
                ->constrained('users')
                ->onDelete('cascade');
            $table->integer('invoice');
            $table->date('order_date');
            $table->date('installed_date');
            $table->set('status',['Quote', 'In Shop', 'Installation', 'Installed']);
            $table->string('dealer');
            $table->string('dealer_country');
            $table->integer('dealer_phone');
            $table->string('buyer_name');
            $table->string('buyer_address');
            $table->string('city');
            $table->string('state');
            $table->integer('zip');
            $table->integer('phone_day');
            $table->integer('phone_evening');
            $table->integer('phone_cell');
            $table->string('installation_site');
            $table->string('email');
            $table->string('description');
            $table->decimal('width');
            $table->decimal('roof_length');
            $table->decimal('frame_length');
            $table->decimal('leg_height');
            $table->integer('gauge');
            $table->decimal('price');
            $table->boolean('regular_frame');
            $table->boolean('a_frame');
            $table->boolean('vertical_roof');
            $table->boolean('all_vertical');
            $table->string('color_roof');
            $table->string('color_ends');
            $table->string('color_sides');
            $table->string('color_trim');
            $table->set('installation',['Ground', 'Cement', 'Asphalt', 'Other']);
            $table->string('installation_other');
            $table->boolean('land_level');
            $table->boolean('electricity');
            $table->set('payment',['Cash', 'Check', 'CC', 'P.O.']);
            $table->decimal('total_sale');
            $table->decimal('tax');
            $table->decimal('tax_exempt');
            $table->decimal('non_tax_contractor_fee');
            $table->decimal('total');
            $table->decimal('dealer_deposit');
            $table->decimal('amount_paid');
            $table->decimal('balance_due');
            $table->string('buyer_signature');
            $table->date('buyer_signature_date');
            $table->string('contractor_signature');
            $table->date('contractor_signature_date');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')
                ->constrained('orders')
                ->onDelete('cascade');
            $table->string('item');
            $table->decimal('price');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('special_instructions', function(Blueprint $table){
            $table->id();
            $table->foreignId('order_id')
                ->constrained('orders')
                ->onDelete('cascade');
            $table->text('instruction');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('configs', function (Blueprint $table) {
            $table->id();
            $table->string('logo');
            $table->string('address');
            $table->string('header-image-bg')->nullable();
            $table->string('footer-image-bg')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::dropIfExists('special_instructions');
        Schema::dropIfExists('items');
        Schema::dropIfExists('orders');
        Schema::dropIfExists('users');
        Schema::dropIfExists('configs');
    }
}
