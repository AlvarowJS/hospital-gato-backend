<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Hospital extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'age',
        'name',
        'area',
        'date_register',
        'distrito_id',
        'gerente_id',
        'condicion_id',
        'sede_id',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'distrito_id' => 'integer',
        'gerente_id' => 'integer',
        'condicion_id' => 'integer',
        'sede_id' => 'integer',
        'distrito_gerente_condicion_sede_id' => 'integer',
    ];



    public function distrito(): BelongsTo
    {
        return $this->belongsTo(Distrito::class);
    }

    public function gerente(): BelongsTo
    {
        return $this->belongsTo(Gerente::class);
    }

    public function condicion(): BelongsTo
    {
        return $this->belongsTo(Condicion::class);
    }

    public function sede(): BelongsTo
    {
        return $this->belongsTo(Sede::class);
    }
}
