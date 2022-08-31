<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanyDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_details', function (Blueprint $table) {
            $table->id();
            $table->integer('owner_id');
            $table->longText('address')->nullable();
            $table->string('phone')->nullable();
            $table->string('fax')->nullable();
            $table->date('start_subscription')->default(\Carbon\Carbon::now());
            $table->date('end_subscription')->nullable();
            $table->string('grace_preiod')->nullable();
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
        Schema::dropIfExists('company_details');
    }
}
