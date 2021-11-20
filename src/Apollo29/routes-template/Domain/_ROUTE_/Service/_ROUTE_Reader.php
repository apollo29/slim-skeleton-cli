<?php

namespace App\Domain\_ROUTE_\Service;

use App\Domain\_ROUTE_\Data\_ROUTE_Data;
use App\Domain\_ROUTE_\Repository\_ROUTE_Repository;

/**
 * Service.
 */
final class _ROUTE_Reader
{
    private _ROUTE_Repository $repository;

    /**
     * The constructor.
     *
     * @param _ROUTE_Repository $repository The repository
     */
    public function __construct(_ROUTE_Repository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Read an item.
     *
     * @param int $itemId The item id
     *
     * @return _ROUTE_Data The item data
     */
    public function getById(int $itemId): _ROUTE_Data
    {
        // Input validation
        // ...

        // Fetch data from the database
        $item = $this->repository->getById($itemId);

        // Optional: Add or invoke your complex business logic here
        // ...

        // Optional: Map result
        // ...

        return $item;
    }
}
