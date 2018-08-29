<?php

namespace Seftomsk\Acl;

interface UserInterface
{
    /**
     * @return int
     */
    public function getId(): int;

    /**
     * @return string
     */
    public function getName(): string;

    /**
     * @param Role $role
     */
    public function setRole(Role $role): void;

    /**
     * @return null|Role
     */
    public function getRole(): ?Role;
}
