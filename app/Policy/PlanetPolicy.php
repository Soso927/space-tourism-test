<?php

namespace App\Policy;

use App\Models\Planet;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class PlanetPolicy
{
       // Peut créer si permission
    public function create(User $user): bool
    {
        return $user->can('planets.create');
    }

    // Peut mettre à jour s'il a la permission ET (est auteur OU est editor/admin)
    public function update(User $user, planet $planet): bool
    {
        return $user->can('planets.edit') && (
            $planet->user_id === $user->id || $user->hasRole(['editor', 'admin'])
        );
    }

    // Peut supprimer s'il a la permission ET (est auteur OU editor/admin)
    public function delete(User $user, planet $planet): bool
    {
        return $user->can('planets.delete') && (
            $planet->user_id === $user->id || $user->hasRole(['editor', 'admin'])
        );
    }

    // Publier / dépublier : permission dédiée
    public function publish(User $user, planet $planet): bool
    {
        return $user->can('planets.show');
    }
}