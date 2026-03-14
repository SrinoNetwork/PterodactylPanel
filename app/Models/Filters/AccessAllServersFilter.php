<?php

namespace Pterodactyl\Models\Filters;

use Spatie\QueryBuilder\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class AccessAllServersFilter implements Filter
{
    /**
     * Filtert die Serverliste basierend auf der User-Berechtigung.
     *
     * @param Builder $query
     * @param mixed $value
     * @param string $property
     */
    public function __invoke(Builder $query, $value, string $property)
    {
        $user = Auth::user();

        if ($user->access_all_servers) {
            return;
        }

        $query->where('owner_id', $user->id)
              ->orWhereHas('subusers', function (Builder $q) use ($user) {
                  $q->where('user_id', $user->id);
              });
    }
}