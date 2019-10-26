<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Transactions extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'type', 'user_id', 'description', 'amount', 'category_id', 'channel', 'account_id'
    ];
}