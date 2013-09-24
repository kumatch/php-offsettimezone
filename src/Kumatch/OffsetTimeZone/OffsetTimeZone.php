<?php

namespace Kumatch\OffsetTimeZone;

use DateTimeZone;
use DateTime;

class OffsetTimeZone
{
    /** @var array  */
    protected $offsetZones = array();

    /**
     *  constructor
     */
    public function __construct()
    {
        $this->offsetZones = $this->createOffsetZones();
    }

    /**
     * @param int $offset
     * @param bool $searchNear
     * @return DateTimeZone|null
     */
    public function createTimeZone($offset = 0, $searchNear = true)
    {
        if ($offset === 0) {
            return $this->createUtcTimeZone();
        }

        if (isset($this->offsetZones[$offset])) {
            return new DateTimeZone($this->offsetZones[$offset][0]);
        }

        if (!$searchNear) {
            return null;
        }

        $nearDiff = PHP_INT_MAX;
        $nearOffset = null;

        foreach ($this->offsetZones as $zoneOffset => $zoneList) {
            if ($offset < 0 && $zoneOffset > 0) continue;
            if ($offset > 0 && $zoneOffset < 0) continue;

            $diff = abs( abs($offset) - abs($zoneOffset) );
            if ($diff < $nearDiff) {
                $nearDiff = $diff;
                $nearOffset = $zoneOffset;
            }
        }

        if ($nearOffset) {
            return new DateTimeZone($this->offsetZones[$nearOffset][0]);
        } else if ($nearOffset === 0) {
            return $this->createUtcTimeZone();
        } else {
            return null;
        }
    }

    /**
     * @return DateTimeZone
     */
    protected function createUtcTimeZone()
    {
        return new DateTimeZone('UTC');
    }

    /**
     * @return array
     */
    protected function createOffsetZones()
    {
        $timezoneIdentifiers = DateTimeZone::listIdentifiers();
        $utc = new DateTime('now', $this->createUtcTimeZone());

        $offsetZones = array();

        foreach ($timezoneIdentifiers as $timezoneIdentifier) {
            $timezone = new DateTimeZone($timezoneIdentifier);
            $offset = $timezone->getOffset($utc);

            if (!isset($offsetZones[$offset])) {
                $offsetZones[$offset] = array();
            }

            array_push($offsetZones[$offset], $timezoneIdentifier);
        }

        ksort($offsetZones);

        return $offsetZones;
    }
}