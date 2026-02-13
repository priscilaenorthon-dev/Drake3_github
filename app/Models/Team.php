<?php
namespace App\Models;
use App\Traits\BelongsToTenant;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Team extends Model {
    use HasFactory, SoftDeletes, BelongsToTenant;
    protected $fillable = ['tenant_id', 'unit_id', 'name', 'code', 'description', 'leader_id', 'active'];
    protected $casts = ['active' => 'boolean'];
    public function unit() { return $this->belongsTo(Unit::class); }
    public function leader() { return $this->belongsTo(User::class, 'leader_id'); }
    public function collaborators() { return $this->hasMany(Collaborator::class); }
}
