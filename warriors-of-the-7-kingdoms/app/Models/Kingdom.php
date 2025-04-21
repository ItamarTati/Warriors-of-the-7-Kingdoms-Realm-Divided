<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Kingdom extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'ruler',
        'capital',
        'gold',
        'influence',
        'food',
        'population',
        'tax_rate',
        'stability',
        'religion',
        'government_type',
        'banner_color',
        'banner_symbol',
        'founded_at',
        'is_playable',
        'ai_personality',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'gold' => 'integer',
        'influence' => 'integer',
        'food' => 'integer',
        'population' => 'integer',
        'tax_rate' => 'float',
        'stability' => 'integer',
        'founded_at' => 'datetime',
        'is_playable' => 'boolean',
    ];

    /**
     * Get the regions that belong to the kingdom.
     */
    public function regions(): HasMany
    {
        return $this->hasMany(Region::class);
    }

    /**
     * Get the armies that belong to the kingdom.
     */
    public function armies(): HasMany
    {
        return $this->hasMany(Army::class);
    }

    /**
     * Get the cities that belong to the kingdom.
     */
    public function cities(): HasMany
    {
        return $this->hasMany(City::class);
    }

    /**
     * Get the buildings that belong to the kingdom.
     */
    public function buildings(): HasMany
    {
        return $this->hasMany(Building::class);
    }

    /**
     * Get the technologies that the kingdom has researched.
     */
    public function technologies(): BelongsToMany
    {
        return $this->belongsToMany(Technology::class, 'kingdom_technologies')
                    ->withPivot('researched_at')
                    ->withTimestamps();
    }

    /**
     * Get the kingdoms that this kingdom has diplomatic relations with.
     */
    public function diplomaticRelations(): BelongsToMany
    {
        return $this->belongsToMany(Kingdom::class, 'diplomatic_relations', 'kingdom_id', 'related_kingdom_id')
                    ->withPivot('relation_type', 'relation_value', 'started_at')
                    ->withTimestamps();
    }

    /**
     * Calculate the kingdom's total military strength.
     *
     * @return int
     */
    public function calculateMilitaryStrength(): int
    {
        return $this->armies->sum(function ($army) {
            return $army->units->sum('strength');
        });
    }

    /**
     * Calculate the kingdom's total income per turn.
     *
     * @return int
     */
    public function calculateIncome(): int
    {
        $baseIncome = $this->cities->sum('income');
        $taxModifier = $this->tax_rate / 100;
        
        return (int) ($baseIncome * $taxModifier);
    }

    /**
     * Calculate the kingdom's total expenses per turn.
     *
     * @return int
     */
    public function calculateExpenses(): int
    {
        $armyUpkeep = $this->armies->sum('upkeep_cost');
        $buildingUpkeep = $this->buildings->sum('maintenance_cost');
        
        return $armyUpkeep + $buildingUpkeep;
    }

    /**
     * Get the kingdom's net income per turn.
     *
     * @return int
     */
    public function getNetIncome(): int
    {
        return $this->calculateIncome() - $this->calculateExpenses();
    }
}