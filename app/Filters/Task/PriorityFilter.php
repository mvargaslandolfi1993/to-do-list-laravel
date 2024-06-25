<?php
namespace App\Filters\Task;

use App\Filters\FilterAbstract;
use Illuminate\Database\Eloquent\Builder;

class PriorityFilter extends FilterAbstract
{
    
    public function filter(Builder $builder, $value)
    {
        return $builder->where('priority', $value === 'true' ? 1 : 0);
    }
}