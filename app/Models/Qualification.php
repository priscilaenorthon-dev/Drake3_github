<?php
namespace App\Models;
use App\Traits\BelongsToTenant;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Qualification extends Model {
    use HasFactory, SoftDeletes, BelongsToTenant;
    protected $fillable = ['tenant_id', 'name', 'code', 'description', 'category', 'requires_certification', 'validity_days', 'active'];
    protected $casts = ['active' => 'boolean', 'requires_certification' => 'boolean'];
    public function trainings() { return $this->hasMany(Training::class); }
}
