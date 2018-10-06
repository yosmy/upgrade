# Rename collection

```
(new Client($this->uri))
    ->selectDatabase(
        'admin'
    )
    ->command([
        'renameCollection' => $this->db . '.' . 'old_name',
        'to' => $this->db . '.' . 'new_name',
    ]);
```

# Add index

```
$this->manageCollection->createIndex([
    'country' => 1,
    'prefix' => 1,
    'number' => 1
]);
```

# Get elements as array

```
$this->manageCardCollection->find(
    [],
    [
        'typeMap' => [
            'root' => 'array',
            'document' => 'array'
        ],
    ]
);
```


# Remove column

```
$this->manageCollection->updateOne(
    [
        '_id' => $item['_id']
    ],
    [
        '$unset' => [
            'field-1' => ""
        ]
    ]
);
```