<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class PhoneBookModel extends Eloquent
{
    protected $table = 'phonebooks';

    /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
   protected $fillable = [
       'firstName', 'lastName', 'phoneNumber','countryCode', 'timeZoneName', 'insertedOn', 'updatedOn'
   ];

}