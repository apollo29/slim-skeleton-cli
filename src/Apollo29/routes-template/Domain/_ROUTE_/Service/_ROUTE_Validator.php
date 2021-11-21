<?php

namespace App\Domain\_ROUTE_\Service;

use App\Domain\_ROUTE_\Repository\_ROUTE_Repository;
use App\Factory\ValidationFactory;
use Cake\Validation\Validator;
use Selective\Validation\Exception\ValidationException;

/**
 * Service.
 */
final class _ROUTE_Validator
{
    private _ROUTE_Repository $repository;

    private ValidationFactory $validationFactory;

    /**
     * The constructor.
     *
     * @param _ROUTE_Repository $repository The repository
     * @param ValidationFactory $validationFactory The validation
     */
    public function __construct(_ROUTE_Repository $repository, ValidationFactory $validationFactory)
    {
        $this->repository = $repository;
        $this->validationFactory = $validationFactory;
    }

    /**
     * Validate update.
     *
     * @param int $itemId The item id
     * @param array $data The data
     *
     * @return void
     */
    public function validateUpdate(int $itemId, array $data): void
    {
        if (!$this->repository->existsId($itemId)) {
            throw new ValidationException(sprintf('_ROUTE_ not found: %s', $itemId));
        }

        $this->validate($data);
    }

    /**
     * Validate new item.
     *
     * @param array $data The data
     *
     * @throws ValidationException
     *
     * @return void
     */
    public function validate(array $data): void
    {
        $validator = $this->createValidator();

        $validationResult = $this->validationFactory->createValidationResult(
            $validator->validate($data)
        );

        if ($validationResult->fails()) {
            throw new ValidationException('Please check your input', $validationResult);
        }
    }

    /**
     * Create validator.
     *
     * @return Validator The validator
     */
    private function createValidator(): Validator
    {
        $validator = $this->validationFactory->createValidator();

        // todo implement your validator
        return $validator
            ->notEmptyString('text', 'Input required');
    }
}
