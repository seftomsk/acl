<?php

namespace Seftomsk\Acl;

class Acl implements AclInterface
{
    /**
     * @inheritdoc
     */
    public function allow(UserInterface $user, string $permissionName, string $resource, string $ability, array $callableArgs = null): bool
    {
        $role = $user->getRole();
        $permissions = $role->getPermissions();

        foreach ($permissions as $permission) {
            if ($this->hasPermission($permission, $permissionName, $resource, $ability)) {
                if ($permission->hasAction()) {
                    return $permission->doAction($callableArgs);
                }
                return true;
            }
        }

        return false;
    }

    /**
     * @param Permission $permission
     * @param string $permissionName
     * @param string $resource
     * @param string $ability
     * @return bool
     */
    private function hasPermission(Permission $permission, string $permissionName, string $resource, string $ability): bool
    {
        if ($permission->getName() === $permissionName && $permission->getResource() === $resource && $permission->getAbility() === $ability) {
            return true;
        }
        return false;
    }
}
