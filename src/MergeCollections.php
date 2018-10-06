<?php

namespace Yosmy;

use MongoDB\Client;

/**
 * @di\service()
 */
class MergeCollections
{
    /**
     * @param string $uri
     * @param string $fromDb
     * @param string $fromCollection
     * @param string $toDb
     * @param string $toCollection
     */
    public function merge(
        string $uri,
        string $fromDb,
        string $fromCollection,
        string $toDb,
        string $toCollection
    ) {
        $fromCollection = (new Client($uri))
            ->selectCollection(
                $fromDb,
                $fromCollection,
                [
                    'typeMap' => [
                        'root' => 'array',
                        'document' => 'array'
                    ],
                ]
            );

        $toCollection = (new Client($uri))
            ->selectCollection(
                $toDb,
                $toCollection,
                [
                    'typeMap' => [
                        'root' => 'array',
                        'document' => 'array'
                    ],
                ]
            );

        $items = $fromCollection->find();

        foreach ($items as $item) {
            $toCollection->insertOne($item);
        }

        $fromCollection->drop();
    }
}