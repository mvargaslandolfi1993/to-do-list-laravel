<?php
namespace App\Filters\Task;

use App\Filters\FilterAbstract;
use Illuminate\Database\Eloquent\Builder;

class StatusFilter extends FilterAbstract
{
    
    public function filter(Builder $builder, $value)
    {
        return $builder->where('status', $value);
    }
}