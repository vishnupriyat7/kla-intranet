<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Notifications\Notifiable;

class GovernmentOrder extends Model
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'go_type_id',
        'go_number',
        'go_date',
        'go_title',
        'go_keywords',
        'path',
        'status',

    ];
    //Define Relationship with GovernmentOrderType
    public function governmentOrderType()
    {
        return $this->belongsTo(GovernmentOrderType::class);
    }
}
