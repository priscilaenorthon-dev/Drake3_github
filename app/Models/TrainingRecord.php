<?php
namespace App\Models;
use App\Traits\BelongsToTenant;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class TrainingRecord extends Model {
    use HasFactory, SoftDeletes, BelongsToTenant;
    protected $fillable = ['tenant_id', 'collaborator_id', 'training_id', 'completion_date', 'expiration_date', 'score', 'status', 'instructor', 'notes', 'certificate_path'];
    protected $casts = ['completion_date' => 'date', 'expiration_date' => 'date', 'score' => 'decimal:2'];
    public function collaborator() { return $this->belongsTo(Collaborator::class); }
    public function training() { return $this->belongsTo(Training::class); }
}
