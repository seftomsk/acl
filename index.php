<?php

use Seftomsk\Acl\Acl;
use Seftomsk\Acl\Permission;
use Seftomsk\Acl\Repositories\MemoryPermissionRepository;
use Seftomsk\Acl\Role;
use Seftomsk\App\Http\Controllers\PostController;
use Seftomsk\App\Entities\User;

require_once 'vendor/autoload.php';

$permissions = [
    new Permission('Show Posts', PostController::class, 'index'),
    new Permission('Create Post', PostController::class, 'create'),
    new Permission('Show Post', PostController::class, 'show', function (int $postId) {
        if ($postId === 20) {
            return true;
        }
        return false;
    }),
    new Permission('Update Post', PostController::class, 'update'),
    new Permission('Delete Post', PostController::class, 'delete')
];

$permissionRepository = new MemoryPermissionRepository();

foreach ($permissions as $permission) {
    $permissionRepository->save($permission);
}

$defaultRole = new Role('Default');

$adminRole = new Role('Admin');

$inputAdminPermissions = [
    'Show Posts',
    'Create Post',
    'Show Post',
    'Update Post',
    'Delete Post'
];

$managerRole = new Role('Manager');

$inputManagerPermissions = [
    'Show Posts',
    'Show Post',
    'Create Post'
];

// check exists

try {
    foreach ($inputAdminPermissions as $inputAdminPermission) {
        $adminRole->addPermission($permissionRepository->getByName($inputAdminPermission));
    }

    foreach ($inputManagerPermissions as $inputManagerPermission) {
        $managerRole->addPermission($permissionRepository->getByName($inputManagerPermission));
    }
} catch (Exception $e) {
    print_r($e); exit;
}

$acl = new Acl();
$adminUser = new User('Alexey', $defaultRole);
$managerUser = new User('Manager', $defaultRole);
$adminUser->setRole($adminRole);
$managerUser->setRole($managerRole);

$controller = new PostController($acl);

try {
    echo $controller->index($adminUser);
    echo $controller->show($managerUser, 21);
} catch (Exception $e) {
    echo $e->getMessage() . PHP_EOL;
    echo $e->getCode() . PHP_EOL;
    exit;
}

