<?php

namespace App;

use Aic\Hub\Foundation\AbstractModel;

class BaseModel extends AbstractModel
{

    /**
     * The smallest number that fake IDs start at for this model
     *
     * @var integer
     */
    protected $fakeIdsStartAt = 999000;

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
