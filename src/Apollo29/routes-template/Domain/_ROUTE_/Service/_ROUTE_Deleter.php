<?php

namespace App\Domain\_ROUTE_\Service;

use App\Domain\_ROUTE_\Repository\_ROUTE_Repository;

/**
 * Service.
 */
final class _ROUTE_Deleter
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
     * Delete item.
     *
     * @param int $id The item id
     *
     * @return void
     */
    public function delete(int $id): void
    {
        // Input validation
        // ...

        $this->repository->deleteById($id);
    }
}
