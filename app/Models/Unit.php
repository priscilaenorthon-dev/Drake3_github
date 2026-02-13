<?php

namespace App\Models;

use App\Traits\BelongsToTenant;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Unit extends Model
{
    use HasFactory, SoftDeletes, BelongsToTenant;

    protected $fillable = ['tenant_id', 'company_id', 'name', 'code', 'description', 'active'];
    protected $casts = ['active' => 'boolean'];

    public function company() { return $this->belongsTo(Company::class); }
    public function locations() { return $this->hasMany(Location::class); }
    public function teams() { return $this->hasMany(Team::class); }
}
