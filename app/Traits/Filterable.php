<?php

namespace App\Traits;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;

trait Filterable
{
    public function scopeFilters(Builder $query, array $data): Builder
    {
        $filters = self::getFiltersArray();

        foreach ($data as $key => $value) {
            if (method_exists(static::class, 'scope' . ucfirst($key))) {
                $query->$key($value);
            } elseif (array_key_exists($key, $filters)) {
                self::{$filters[$key]}($query, $key, $value);
            }
        }

        return $query;
    }

    public static function getFiltersArray(): array
    {
        if (property_exists(self::class, 'filtersArray')) {
            return self::$filtersArray;
        }

        return [];
    }

    private static function equal(Builder $query, $key, $value): Builder
    {
        return $query->where($key, $value);
    }

    private static function not_equal(Builder $query, $key, $value): Builder
    {
        return $query->where($key, '!=', $value);
    }

    private static function like(Builder $query, $key, $value): Builder
    {
        return $query->where($key, 'like', '%' . $value . '%');
    }

    private static function startWith(Builder $query, $key, $value): Builder
    {
        return $query->where($key, 'like', $value . '%');
    }

    private static function endWith(Builder $query, $key, $value): Builder
    {
        return $query->where($key, 'like', '%' . $value);
    }

    private static function date(Builder $query, $key, $value): Builder
    {
        $date = null;
        $operator = '=';

        if (is_array($value)) {
            $date = $value['date'] ?? Carbon::now();
            $operator = $value['operator'] ?? '=';
        } elseif (is_string($value)) {
            $date = $value;
        }

        if ($date) {
            return $query->whereDate($key, $operator, Carbon::parse($date));
        }

        return $query;
    }

    private static function between(Builder $query, $key, $value): Builder
    {
        if (is_array($value) && count($value) === 2) {
            return $query->whereBetween($key, $value);
        }

        return $query;
    }

    private static function in(Builder $query, $key, $value): Builder
    {
        if (is_array($value)) {
            return $query->whereIn($key, $value);
        }

        return $query;
    }
}