<?php

namespace App\Models;

use App\Http\Joseph\Traits\updatableAndCreatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SampleCollection extends Model
{
    use HasFactory;
    use updatableAndCreatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'sample_code',
        'collect_date',
        'receive_date',
        'dispatch_date',
        'cancel_dispatch_date',
        'status',
        'investigation_id',
        'laboratory_id',
        'approved_by_id',
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
        'collect_date' => 'datetime',
        'receive_date' => 'datetime',
        'dispatch_date' => 'datetime',
        'cancel_dispatch_date' => 'datetime',
        'investigation_id' => 'integer',
        'laboratory_id' => 'integer',
        'approved_by_id' => 'integer',
        'created_by_id' => 'integer',
        'updated_by_id' => 'integer',
    ];

    public function investigation()
    {
        return $this->belongsTo(Investigation::class);
    }

    public function laboratory()
    {
        return $this->belongsTo(Laboratory::class);
    }

    public function approvedBy()
    {
        return $this->belongsTo(User::class);
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
