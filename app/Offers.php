<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Offers extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'offers';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['company_id', 'name', 'description', 'end_date',
                           'is_super_deal','image_file_path'];



}
