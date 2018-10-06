<?php

namespace Yosmy;

use MongoDB\Client;

/**
 * @di\service()
 */
class RenameCollection
{
    /**
     * @param string $uri
     * @param string $oldDb
     * @param string $oldCollection
     * @param string $newDb
     * @param string $newCollection
     */
    public function rename(
        string $uri,
        string $oldDb,
        string $oldCollection,
        string $newDb,
        string $newCollection
    ) {
        (new Client($uri))
            ->selectDatabase(
                'admin'
            )
            ->command([
                'renameCollection' => sprintf('%s.%s', $oldDb, $oldCollection),
                'to' => sprintf('%s.%s', $newDb, $newCollection),
            ]);
    }
}