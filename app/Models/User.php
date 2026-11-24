<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable(['name', 'email', 'password'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable implements MustVerifyEmail
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class)
            ->withTimestamps();
    }

    /**
     * Check if user has a specific role.
     */
  public function hasRole(string $role): bool
{
    return $this->roles()
        ->where('slug', strtolower($role))
        ->exists();
}

    /**
     * Check if user has a specific permission.
     */
    public function hasPermission(string $permission): bool
    {
        return $this->roles()
            ->whereHas('permissions', function ($query) use ($permission) {
                $query->where('slug', $permission);
            })
            ->exists();
    }

    /**
     * Assign a role to user.
     */
    public function assignRole(string $role): void
    {
        $roleModel = Role::where('slug', $role)->firstOrFail();

        $this->roles()->syncWithoutDetaching([$roleModel->id]);
    }

    /**
     * Remove a role from user.
     */
    public function removeRole(string $role): void
    {
        $roleModel = Role::where('slug', $role)->firstOrFail();

        $this->roles()->detach($roleModel->id);
    }

    /**
     * Give permission directly through a role.
     */
    public function givePermissionTo(string $permission): void
    {
        $adminRole = Role::where('slug', 'admin')->firstOrFail();

        $permissionModel = Permission::where('slug', $permission)->firstOrFail();

        $adminRole->permissions()->syncWithoutDetaching([$permissionModel->id]);
    }

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
