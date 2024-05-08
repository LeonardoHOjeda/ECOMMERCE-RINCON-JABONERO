<?php

namespace App\Policies;

use App\Models\Category;
use App\Models\Role;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class CategoryPolicy
{
    
    public function before (User $user)
    {
      if ($user->hasRole(Role::ADMIN)) {
        return true;
      }
    }
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Category $category): bool
    {
        //
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
      return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Category $category): bool
    {
      return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Category $category): bool
    {
      return false;
    }
}
