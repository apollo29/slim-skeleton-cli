<?php

namespace App\Domain\_ROUTE_\Repository;

use App\Domain\_ROUTE_\Data\_ROUTE_Data;
use App\Factory\QueryFactory;
use App\Support\Hydrator;

/**
 * Repository.
 */
final class _ROUTE_FinderRepository
{
    private QueryFactory $queryFactory;

    private Hydrator $hydrator;

    /**
     * The constructor.
     *
     * @param QueryFactory $queryFactory The query factory
     * @param Hydrator $hydrator The hydrator
     */
    public function __construct(QueryFactory $queryFactory, Hydrator $hydrator)
    {
        $this->queryFactory = $queryFactory;
        $this->hydrator = $hydrator;
    }

    /**
     * Find items.
     *
     * @return _ROUTE_Data[] A list of items
     */
    public function find(): array
    {
        $query = $this->queryFactory->newSelect('_ROUTENAME_');

        // todo implement your data model
        $query->select(
            [
                'id',
                'text',
            ]
        );

        // Add more "use case specific" conditions to the query
        // ...

        $rows = $query->execute()->fetchAll('assoc') ?: [];

        // Convert to list of objects
        return $this->hydrator->hydrate($rows, _ROUTE_Data::class);
    }
}
