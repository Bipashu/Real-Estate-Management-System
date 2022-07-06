<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
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
            $table->string('verification_code')->nullable();
            $table->unsignedbiginteger('is_verified')->default(0);
            $table->string('role')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    
        Schema::create('rent_property_models', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('image');
            $table->string('type');
            $table->string('address');
            $table->string('description');
            $table->unsignedBigInteger('price')->nullable();
            $table->string('property_status');
            $table->unsignedBigInteger('owner_id')->nullable();
            $table->foreign('owner_id')->references('id')->on('users');
            $table->timestamps();
        });
        Schema::create('sell_property_models', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('image');
            $table->string('type');
            $table->string('address');
            $table->string('description');
            $table->unsignedBigInteger('price');
            $table->string('property_status');
            $table->unsignedBigInteger('owner_id')->nullable();
            $table->foreign('owner_id')->references('id')->on('users');
            $table->timestamps();
        });
        Schema::create('rent_locations', function (Blueprint $table) {
            $table->id();
            $table->string('latitude');
            $table->string('longitude');
            $table->unsignedBigInteger('property_id')->nullable();
            $table->foreign('property_id')->references('id')->on('rent_property_models')->onDelete('cascade');
            $table->timestamps();
        });
        Schema::create('sell_locations', function (Blueprint $table) {
            $table->id();
            $table->string('latitude');
            $table->string('longitude');
            $table->unsignedBigInteger('property_id')->nullable();
            $table->foreign('property_id')->references('id')->on('sell_property_models')->onDelete('cascade');
            $table->timestamps();
        });
        Schema::create('property_models', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('image');
            $table->string('type');
            $table->string('address');
            $table->string('description');
            $table->unsignedBigInteger('price');
           
            $table->string('property_status');
            $table->unsignedBigInteger('rent_id')->nullable();
            $table->unsignedBigInteger('sell_id')->nullable();
            $table->unsignedBigInteger('owner_Id');
            $table->foreign('rent_id')->references('id')->on('rent_property_models')->onDelete('cascade');
            $table->foreign('sell_id')->references('id')->on('sell_property_models')->onDelete('cascade');
            $table->timestamps();
        });
        Schema::create('rent_comments', function (Blueprint $table) {
            $table->id();
            $table->string('comment');
            $table->string('commenter');
            $table->unsignedBigInteger('property_id')->nullable();
            $table->foreign('property_id')->references('id')->on('rent_property_models')->onDelete('cascade');
            $table->timestamps();
        });
        Schema::create('sell_comments', function (Blueprint $table) {
            $table->id();
            $table->string('comment');
            $table->string('commenter');
            $table->unsignedBigInteger('property_id')->nullable();
            $table->foreign('property_id')->references('id')->on('sell_property_models')->onDelete('cascade');
            $table->timestamps();
        });
        Schema::create('rent_bids', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('bid_amount');
            $table->unsignedBigInteger('property_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('status')->default(0);
            $table->foreign('property_id')->references('id')->on('rent_property_models')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
        Schema::create('sell_bids', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('bid_amount');
            $table->unsignedBigInteger('property_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('status')->default(0);
            $table->foreign('property_id')->references('id')->on('sell_property_models')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
        Schema::create('agents', function (Blueprint $table) {
            $table->id();
            $table->string('email');
            $table->string('fullname');
            $table->string('password');
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
        Schema::dropIfExists('sell_bids');
        Schema::dropIfExists('rent_bids');
        Schema::dropIfExists('sell_comments');
        Schema::dropIfExists('rent_comments');
        Schema::dropIfExists('sell_locations');
        Schema::dropIfExists('rent_locations');
        Schema::dropIfExists('property_models');
        Schema::dropIfExists('sell_property_models');
        Schema::dropIfExists('rent_property_models');
        Schema::dropIfExists('agents');
        Schema::dropIfExists('users');
       
    }
};
