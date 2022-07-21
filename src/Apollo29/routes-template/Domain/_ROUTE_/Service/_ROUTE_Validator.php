<?php

namespace App\Domain\_ROUTE_\Service;

use App\Domain\_ROUTE_\Repository\_ROUTE_Repository;
use App\Support\Validation;
use Cake\Validation\Validator;
use Selective\Validation\Exception\ValidationException;

/**
 * Service.
 */
final class _ROUTE_Validator
{
    private _ROUTE_Repository $repository;

    private Validation $validation;

    /**
     * The constructor.
     *
     * @param _ROUTE_Repository $repository The repository
     * @param Validation $validation The validation
     */
    public function __construct(_ROUTE_Repository $repository, Validation $validation)
    {
        $this->repository = $repository;
        $this->validation = $validation;
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
     * @return void
     * @throws ValidationException
     *
     */
    public function validate(array $data): void
    {
        $validator = $this->createValidator();
        $validationResult = $this->validation->validate($validator, $data);

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
        $validator = $this->validation->createValidator();

        // todo implement your validator
        return $validator
            ->notEmptyString('text', 'Input required');
    }
}
