<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OffersUsed extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'offers_used';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['offer_id','user_id', 'type'];


}
