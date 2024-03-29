<?php

namespace App\Policies;
use App\Facades\UserPermissions;
use App\Models\Professor;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProfessorPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        return UserPermissions::isAuthorized('professores.index');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Professor  $professor
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Professor $professor)
    {
        return UserPermissions::isAuthorized('professores.show');

    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return UserPermissions::isAuthorized('professores.create');

    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Professor  $professor
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Professor $professor)
    {
        return UserPermissions::isAuthorized('professores.edit');

    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Professor  $professor
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Professor $professor)
    {
        return UserPermissions::isAuthorized('professores.destroy');

    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Professor  $professor
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Professor $professor)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Professor  $professor
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Professor $professor)
    {
        //
    }
}
