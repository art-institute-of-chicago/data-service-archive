<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Scopes\SortByLastUpdatedScope;

class BaseModel extends Model
{

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var boolean
     */
    public $incrementing = false;

    /**
     * The smallest number that fake IDs start at for this model
     *
     * @var integer
     */
    protected $fakeIdsStartAt = 999000;

    /**
     * The attributes that aren't mass assignable. Generally,
     * we want all attributes to be mass assignable. Laravel
     * defaults to guarding all attributes.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {

        parent::boot();
        static::addGlobalScope(new SortByLastUpdatedScope());

    }

    /**
     * Scope a query to only include fake records.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeFake($query)
    {

        return $query->where($this->getKeyName(), '>=', $this->fakeIdsStartAt);

    }

}
