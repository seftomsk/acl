<?php

namespace Seftomsk\Acl;

interface AclInterface
{
    /**
     * @param UserInterface $user
     * @param string $permissionName
     * @param string $resource
     * @param string $ability
     * @param array|null $callableOptions
     * @return bool
     */
    public function allow(UserInterface $user, string $permissionName, string $resource, string $ability, array $callableOptions = null): bool;
}
