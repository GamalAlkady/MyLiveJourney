<?php

use App\Enums\BookingStatus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->integer('tour_id');
            // $table->integer('guide_id');
            $table->integer('tourist_id');
            $table->integer('total_price');
            $table->integer('seats');
            $table->enum('status', array_column(BookingStatus::cases(), 'value'))
                ->default(BookingStatus::Pending->value);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bookings');
    }
}
