<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class GovernmentOrderType extends Model
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'go_type',
    ];
    //Relation with GovernmentOrder
    public function governmentOrder()
    {
        return $this->hasMany(GovernmentOrder::class);
    }

}
