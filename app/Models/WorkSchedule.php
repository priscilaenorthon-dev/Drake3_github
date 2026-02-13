<?php
namespace App\Models;
use App\Traits\BelongsToTenant;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class WorkSchedule extends Model {
    use HasFactory, SoftDeletes, BelongsToTenant;
    protected $fillable = ['tenant_id', 'collaborator_id', 'shift_id', 'location_id', 'schedule_date', 'start_time', 'end_time', 'status', 'notes', 'approved_by', 'approved_at'];
    protected $casts = ['schedule_date' => 'date', 'approved_at' => 'datetime'];
    public function collaborator() { return $this->belongsTo(Collaborator::class); }
    public function shift() { return $this->belongsTo(Shift::class); }
    public function location() { return $this->belongsTo(Location::class); }
}
