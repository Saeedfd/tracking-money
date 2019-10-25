<?php
/**
 * Created by PhpStorm.
 * User: saeed
 * Date: 10/26/19
 * Time: 12:11 AM
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Accounts extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'user_id', 'description'
    ];


}