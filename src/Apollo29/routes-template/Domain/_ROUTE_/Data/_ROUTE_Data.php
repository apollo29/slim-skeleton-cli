<?php

namespace App\Domain\_ROUTE_\Data;

use DateTime;
use Delight\Random\Random;
use Selective\ArrayReader\ArrayReader;

/**
 * Data Model.
 */
final class _ROUTE_Data
{
    public ?int $id = null;

    public ?string $event = null;

    public ?string $location = null;

    public ?string $title = null;

    public ?int $date = null;

    public ?string $description = null;

    public ?string $email = null;

    /**
     * The constructor.
     *
     * @param array $data The data
     */
    public function __construct(array $data = [])
    {
        $reader = new ArrayReader($data);

        $this->id = $reader->findInt('id');
        $this->event = $this->checkForEvent($reader->findString('event'));
        $this->location = $reader->findString('location');
        $this->title = $reader->findString('title');
        $this->date = $this->convertDateString($reader->findString('date'));
        $this->description = $reader->findString('description');
        $this->email = $reader->findString('email');
    }

    /**
     * Generate new event string
     */
    public function generateEvent()
    {
        if (empty($this->event)) {
            $this->event = Random::alphanumericLowercaseString(12);
        }
    }

    /**
     * Check for event or create new
     *
     * @param ?string $event The event string
     *
     * @return string The event string
     */
    private function checkForEvent(?string $event): string
    {
        if (empty($event)) {
            return Random::alphanumericLowercaseString(12);
        }
        return $event;
    }

    /**
     * Convert Date String to timestamp
     *
     * @param string $date The date
     *
     * @return int The timestamp
     */
    private function convertDateString(string $date): int
    {
        if ($this->isTimestamp($date)) {
            return (int) $date;
        }
        return strtotime($date);
    }

    /**
     * Check is String is already a timestamp
     *
     * @param string $string The timestamp string
     * @return bool
     */
    private function isTimestamp(string $string): bool
    {
        try {
            new DateTime('@' . $string);
        } catch (\Exception $e) {
            return false;
        }
        return true;
    }
}
