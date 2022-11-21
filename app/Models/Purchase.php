<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'code',
        'name',
        'type',
        'medicine_generic_name',
        'medicine_unit',
        'medicine_strength',
        'medicine_shelf_life',
        'quantity',
        'quantity_type',
        'price',
        'expiry_date',
        'note',
        'image',
        'status',
        'medicine_type_id',
        'medicine_category_id',
        'supplier_id',
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
        'expiry_date' => 'date',
        'medicine_type_id' => 'integer',
        'medicine_category_id' => 'integer',
        'supplier_id' => 'integer',
        'created_by_id' => 'integer',
        'updated_by_id' => 'integer',
    ];

    public function medicineType()
    {
        return $this->belongsTo(MedicineType::class);
    }

    public function medicineCategory()
    {
        return $this->belongsTo(MedicineCategory::class);
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
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
