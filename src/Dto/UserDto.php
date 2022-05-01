<?php
declare(strict_types=1);

namespace App\Dto;


class UserDto
{
    /** @var int */
    private $id;

    /** @var string */
    private $lastName;

    /** @var string */
    private $firstName;

    /** @var bool */
    private $active;

    public function __construct(int $id, string $firstName, string $lastName, bool $active)
    {
        $this->id = $id;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->active = $active;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function isActive(): bool
    {
        return $this->active;
    }
}