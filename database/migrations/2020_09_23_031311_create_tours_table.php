<?php

use App\Enums\TourStatus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateToursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tours', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->text('description')->nullable();
            $table->unsignedBigInteger('guide_id');
            // $table->unsignedBigInteger('tourist_id');
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->integer('max_seats')->default(10);
            $table->integer('booked_seats')->default(0);
            $table->decimal('price', 10, 2)->default(0);
            $table->enum('status', array_column(TourStatus::cases(), 'value'))
                ->default(TourStatus::Available->value);
            $table->timestamps();

            $table->foreign('guide_id')->references('id')->on('users')->onDelete('cascade');
            // $table->foreign('tourist_id')->references('id')->on('users')->noActionOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tours');
    }
}
