<?php
namespace App\Models;
use App\Traits\BelongsToTenant;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Shift extends Model {
    use HasFactory, SoftDeletes, BelongsToTenant;
    protected $fillable = ['tenant_id', 'name', 'code', 'start_time', 'end_time', 'duration_hours', 'type', 'active'];
    protected $casts = ['active' => 'boolean'];
    public function workSchedules() { return $this->hasMany(WorkSchedule::class); }
}
