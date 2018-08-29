<?php

namespace Seftomsk\Acl;

class Permission
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
     * @var string
     */
    private $resource;

    /**
     * @var string
     */
    private $ability;

    /**
     * @var callable
     */
    private $action;

    /**
     * Permission constructor.
     * @param string $name
     * @param string $resource
     * @param string $ability
     * @param callable|null $action
     */
    public function __construct(string $name, string $resource, string $ability, callable $action = null)
    {
        $this->name = $name;
        $this->resource = $resource;
        $this->ability = $ability;
        $this->action = $action;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getResource(): string
    {
        return $this->resource;
    }

    /**
     * @return string
     */
    public function getAbility(): string
    {
        return $this->ability;
    }

    /**
     * @param array $args
     * @return bool
     */
    public function doAction(array $args): bool
    {
        return call_user_func_array($this->action, $args);
    }

    /**
     * @return bool
     */
    public function hasAction(): bool
    {
        return (bool) $this->action;
    }
}