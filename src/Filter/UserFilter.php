<?php
declare(strict_types=1);

namespace App\Filter;


class UserFilter
{
    /** @var bool|null  */
    private $active = null;

    public function isActive(): ?bool
    {
        return $this->active;
    }

    public function setActive(?bool $active): self
    {
        $this->active = $active;
        return $this;
    }

}