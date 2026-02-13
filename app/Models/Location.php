<?php
namespace App\Models;
use App\Traits\BelongsToTenant;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Location extends Model {
    use HasFactory, SoftDeletes, BelongsToTenant;
    protected $fillable = ['tenant_id', 'unit_id', 'name', 'type', 'address', 'latitude', 'longitude', 'active'];
    protected $casts = ['active' => 'boolean'];
    public function unit() { return $this->belongsTo(Unit::class); }
}
