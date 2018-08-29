<?php

namespace Seftomsk\Acl\Repositories;

use Seftomsk\Acl\Exceptions\PermissionRepositoryException;
use Seftomsk\Acl\Permission;

interface PermissionRepositoryInterface
{
    /**
     * @param Permission $permission
     */
    public function save(Permission $permission): void;

    /**
     * @param string $name
     * @return Permission
     * @throws PermissionRepositoryException
     */
    public function getByName(string $name): Permission;

    /**
     * @param string $name
     * @throws \Exception
     */
    public function removeByName(string $name): void;
}
