<?php

namespace App\Domain\_ROUTE_\Service;

use App\Domain\_ROUTE_\Data\_ROUTE_Data;
use App\Domain\_ROUTE_\Repository\_ROUTE_FinderRepository;

/**
 * Service.
 */
final class _ROUTE_Finder
{
    private _ROUTE_FinderRepository $repository;

    /**
     * The constructor.
     *
     * @param _ROUTE_FinderRepository $repository The repository
     */
    public function __construct(_ROUTE_FinderRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Find items.
     *
     * @return _ROUTE_Data[] A list of items
     */
    public function find(): array
    {
        // Input validation
        // ...

        return $this->repository->find();
    }
}
