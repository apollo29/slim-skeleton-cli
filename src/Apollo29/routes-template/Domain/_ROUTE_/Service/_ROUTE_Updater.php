<?php

namespace App\Domain\_ROUTE_\Service;

use App\Domain\_ROUTE_\Data\_ROUTE_Data;
use App\Domain\_ROUTE_\Repository\_ROUTE_Repository;
use App\Factory\LoggerFactory;
use Psr\Log\LoggerInterface;

/**
 * Service.
 */
final class _ROUTE_Updater
{
    private _ROUTE_Repository $repository;

    private _ROUTE_Validator $validator;

    private LoggerInterface $logger;

    /**
     * The constructor.
     *
     * @param _ROUTE_Repository $repository The repository
     * @param _ROUTE_Validator $validator The validator
     * @param LoggerFactory $loggerFactory The logger factory
     */
    public function __construct(
        _ROUTE_Repository $repository,
        _ROUTE_Validator $validator,
        LoggerFactory $loggerFactory
    ) {
        $this->repository = $repository;
        $this->validator = $validator;
        $this->logger = $loggerFactory
            ->addFileHandler('_ROUTENAME__updater.log')
            ->createLogger();
    }

    /**
     * Update item.
     *
     * @param int $itemId The item id
     * @param array $data The request data
     *
     * @return void
     */
    public function update(int $itemId, array $data): void
    {
        // Input validation
        $this->validator->validateUpdate($itemId, $data);

        // Validation was successfully
        $item = new _ROUTE_Data($data);
        $item->id = $itemId;

        // Update the user
        $this->repository->update($item);

        // Logging
        $this->logger->info(sprintf('_ROUTE_ updated successfully: %s', $itemId));
    }
}
