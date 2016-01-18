<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ActivationCodes extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'activation_codes';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['code','is_used'];

    /**
     * @return int of codes
     */
    public function getNumCodes() {
        return $this->all()->count();
    }

    /**
     * @return int of used codes
     */
    public function getNumUsedCodes() {
        return $this->where('is_used', true)->count();
    }
}