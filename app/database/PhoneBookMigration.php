<?php
require __DIR__ . '/../bootstrap-database.php';

use Illuminate\Database\Capsule\Manager as Capsule;

Capsule::schema()->dropIfExists('phonebooks');
Capsule::schema()->create('phonebooks', function ($table) {
       $table->increments('id');
       $table->string('firstName');
       $table->string('lastName')->nullable();
       $table->string('phoneNumber');
       $table->string('countryCode');
       $table->string('timeZoneName');
       $table->dateTime('insertedOn');
       $table->dateTime('updatedOn');
       $table->timestamps();
   });