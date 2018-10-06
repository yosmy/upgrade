<?php

namespace Yosmy;

use Yosmy\Mongo;

class BaseManageUpgradeCollection extends Mongo\BaseManageCollection implements ManageUpgradeCollection
{
    /**
     * @param string $uri
     * @param string $db
     * @param string $collection
     */
    public function __construct(
        string $uri,
        string $db,
        string $collection
    ) {
        parent::__construct(
            $uri,
            $db,
            $collection,
            []
        );
    }
}
