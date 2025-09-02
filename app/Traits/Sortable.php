<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

trait Sortable
{
    public function applySort(Builder $query, ?string $sort): Builder
    {
        // Map các key sort => [column, direction]
        $sortOptions = [
            'price_asc'  => ['price', 'asc'],
            'price_desc' => ['price', 'desc'],
            'name_asc'   => ['name', 'asc'],
            'name_desc'  => ['name', 'desc'],
        ];

        if (isset($sortOptions[$sort])) {
            [$column, $direction] = $sortOptions[$sort];
            return $query->orderBy($column, $direction);
        }

        // Mặc định: mới nhất trước
        return $query->latest();
    }
}
