<?php

namespace Seftomsk\Acl\Repositories;

use Seftomsk\Acl\Exceptions\PermissionRepositoryException;
use Seftomsk\Acl\Permission;

class MemoryPermissionRepository implements PermissionRepositoryInterface
{
    /**
     * @var Permission[]
     */
    private $permissions = [];

    /**
     * @inheritdoc
     */
    public function save(Permission $permission): void
    {
        $this->permissions[$permission->getName()] = $permission;
    }

    /**
     * @inheritdoc
     */
    public function getByName(string $name): Permission
    {
        if (!$this->hasByName($name)) {
            throw new PermissionRepositoryException('Permission not found');
        }
        return $this->permissions[$name];
    }

    /**
     * @inheritdoc
     */
    public function removeByName(string $name): void
    {
        if (!$this->hasByName($name)) {
            throw new PermissionRepositoryException('Permission not found');
        }
    }

    /**
     * @param string $name
     * @return bool
     */
    private function hasByName(string $name): bool
    {
        return isset($this->permissions[$name]);
    }
}
