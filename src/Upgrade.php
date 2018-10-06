<?php

namespace Yosmy;

interface Upgrade
{
    /**
     * @param string|null $last
     *
     * @return bool
     */
    public function upgrade(
        ?string $last
    ): bool;
}