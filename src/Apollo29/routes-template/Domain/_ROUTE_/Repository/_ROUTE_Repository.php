<?php

namespace App\Domain\_ROUTE_\Repository;

use App\Domain\_ROUTE_\Data\_ROUTE_Data;
use App\Factory\QueryFactory;
use DomainException;

/**
 * Repository.
 */
final class _ROUTE_Repository
{
    private QueryFactory $queryFactory;

    /**
     * The constructor.
     *
     * @param QueryFactory $queryFactory The query factory
     */
    public function __construct(QueryFactory $queryFactory)
    {
        $this->queryFactory = $queryFactory;
    }

    /**
     * Insert row.
     *
     * @param _ROUTE_Data $item The item data
     *
     * @return int The new ID
     */
    public function insert(_ROUTE_Data $item): int
    {
        return (int)$this->queryFactory->newInsert('events', $this->toRow($item))
            ->execute()
            ->lastInsertId();
    }

    /**
     * Get item by id.
     *
     * @param int $id The item id
     *
     * @throws DomainException
     *
     * @return _ROUTE_Data The item
     */
    public function getById(int $id): _ROUTE_Data
    {
        // todo
        $query = $this->queryFactory->newSelect('events');
        $query->select(
            [
                'id',
                'event',
                'location',
                'title',
                'date',
                'description',
                'email',
            ]
        );

        $query->andWhere(['id' => $id]);

        $row = $query->execute()->fetch('assoc');

        if (!$row) {
            throw new DomainException(sprintf('Event not found: %s', $id));
        }

        return new _ROUTE_Data($row);
    }

    /**
     * Update item row.
     *
     * @param _ROUTE_Data $item The item
     *
     * @return void
     */
    public function update(_ROUTE_Data $item): void
    {
        $row = $this->toRow($item);

        // todo
        $this->queryFactory->newUpdate('events', $row)
            ->andWhere(['id' => $item->id])
            ->execute();
    }

    /**
     * Check item id.
     *
     * @param int $id The item id
     *
     * @return bool True if exists
     */
    public function existsId(int $id): bool
    {
        // todo
        $query = $this->queryFactory->newSelect('events');
        $query->select('id')->andWhere(['id' => $id]);

        return (bool)$query->execute()->fetch('assoc');
    }

    /**
     * Delete item row.
     *
     * @param int $id The item id
     *
     * @return void
     */
    public function deleteById(int $id): void
    {
        // todo
        $this->queryFactory->newDelete('events')
            ->andWhere(['id' => $id])
            ->execute();
    }

    /**
     * Convert to array.
     *
     * @param _ROUTE_Data $item The item data
     *
     * @return array The array
     */
    private function toRow(_ROUTE_Data $item): array
    {
        return (array) $item;
    }
}
