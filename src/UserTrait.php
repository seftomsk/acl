<?php

namespace Seftomsk\Acl;

trait UserTrait
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var Role
     */
    private $role;

    /**
     * User constructor.
     * @param string $name
     */
    public function __construct(string $name, Role $role)
    {
        $this->name = $name;
        $this->role = $role;
    }

    /**
     * @inheritdoc
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @inheritdoc
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @inheritdoc
     */
    public function getRole(): ?Role
    {
        return $this->role;
    }

    /**
     * @inheritdoc
     */
    public function setRole(Role $role): void
    {
        $this->role = $role;
    }
}
