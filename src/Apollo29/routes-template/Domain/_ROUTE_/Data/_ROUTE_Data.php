<?php

namespace App\Domain\_ROUTE_\Data;

use Delight\Random\Random;
use Selective\ArrayReader\ArrayReader;

/**
 * Data Model.
 * todo implement data model
 */
final class _ROUTE_Data
{
    public ?int $id = null;

    public ?string $text = null;

    /**
     * The constructor.
     *
     * @param array $data The data
     */
    public function __construct(array $data = [])
    {
        $reader = new ArrayReader($data);

        $this->id = $reader->findInt('id');
        $this->text = $reader->findString('text');
    }
}
