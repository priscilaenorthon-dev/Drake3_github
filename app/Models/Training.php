<?php
namespace App\Models;
use App\Traits\BelongsToTenant;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Training extends Model {
    use HasFactory, SoftDeletes, BelongsToTenant;
    protected $fillable = ['tenant_id', 'qualification_id', 'name', 'code', 'description', 'type', 'duration_hours', 'passing_score', 'active'];
    protected $casts = ['active' => 'boolean', 'passing_score' => 'decimal:2'];
    public function qualification() { return $this->belongsTo(Qualification::class); }
    public function trainingRecords() { return $this->hasMany(TrainingRecord::class); }
}
