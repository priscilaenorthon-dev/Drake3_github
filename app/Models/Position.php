<?php
namespace App\Models;
use App\Traits\BelongsToTenant;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Position extends Model {
    use HasFactory, SoftDeletes, BelongsToTenant;
    protected $fillable = ['tenant_id', 'name', 'code', 'description', 'level', 'active'];
    protected $casts = ['active' => 'boolean'];
    public function collaborators() { return $this->hasMany(Collaborator::class); }
}
