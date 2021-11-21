<?php

namespace App\Domain\_ROUTE_\Service;

use App\Domain\_ROUTE_\Data\_ROUTE_Data;
use App\Domain\_ROUTE_\Repository\_ROUTE_Repository;
use App\Factory\LoggerFactory;
use Psr\Log\LoggerInterface;

/**
 * Service.
 */
final class _ROUTE_Creator
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
            ->addFileHandler('_ROUTENAME__creator.log')
            ->createLogger();
    }

    /**
     * Create a new item.
     *
     * @param array $data The form data
     *
     * @return int The new item ID
     */
    public function create(array $data): int
    {
        // Input validation
        $this->validator->validate($data);

        // Convert Date

        // Map form data to user DTO (model)
        $item = new _ROUTE_Data($data);

        // Insert user and get new item ID
        $itemId = $this->repository->insert($item);

        // Logging
        $this->logger->info(sprintf('_ROUTE_ created successfully: %s', $itemId));

        return $itemId;
    }
}
