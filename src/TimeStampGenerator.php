<?php

declare(strict_types=1);

namespace cbenco\TimestampGenerator;

use DateTimeImmutable;
use Exception;

final class TimeStampGenerator
{
    private DateTimeImmutable $from;
    private DateTimeImmutable $to;

    /**
     * Setup with two datetimes. if you don't provide any, the defaults are 01\01\1970 and now
     *
     * @param DateTimeImmutable|null $from
     * @param DateTimeImmutable|null $to
     */
    public function __construct(?DateTimeImmutable $from = null, ?DateTimeImmutable $to = null)
    {
        $this->from = $from ?? new DateTimeImmutable('01/01/1970');
        $this->to = $to ?? new DateTimeImmutable('now');
    }

    /**
     * Provide a number to generate that many timestamps
     *
     * @param int $number
     * @return int[]
     * @throws Exception
     */
    public function generateRange(int $number = 10): array
    {
        if ($number < 1) {
            throw new Exception('Number has to be greater than or equal to 1');
        }
        return array_map(fn () => $this->generateTimestamp(), range(1, $number));
    }

    /**
     * Generates a timestamp between two dates
     *
     * @return int
     * @throws Exception
     */
    private function generateTimestamp(): int
    {
        $timestamp1 = $this->from->getTimestamp();
        $timestamp2 = $this->to->getTimestamp();
        return random_int($timestamp1, $timestamp2);
    }
}
