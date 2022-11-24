<?php

namespace App\Models;

use App\Http\Joseph\Traits\updatableAndCreatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;
    use updatableAndCreatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'room_no',
        'name',
        'price',
        'capacity',
        'status',
        'image',
        'ward_id',
        'room_type_id',
        'created_by_id',
        'updated_by_id',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'ward_id' => 'integer',
        'room_type_id' => 'integer',
        'created_by_id' => 'integer',
        'updated_by_id' => 'integer',
    ];

    public function ward()
    {
        return $this->belongsTo(Ward::class);
    }

    public function roomType()
    {
        return $this->belongsTo(RoomType::class);
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class);
    }

    public function updatedBy()
    {
        return $this->belongsTo(User::class);
    }
}
