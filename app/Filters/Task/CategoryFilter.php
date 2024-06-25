<?php
namespace App\Filters\Task;

use App\Filters\FilterAbstract;
use Illuminate\Database\Eloquent\Builder;

class CategoryFilter extends FilterAbstract
{
    
    public function filter(Builder $builder, $value)
    {
        return $builder->whereHas('category', function ($query) use ($value) {
            $query->where('name', $value);
        });
    }
}