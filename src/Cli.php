<?php

declare(strict_types=1);

namespace cbenco\TimestampGenerator;

use DateTimeImmutable;
use Exception;

final class Cli
{
    private function readline(string $message): string
    {
        fputs(STDOUT, $message . PHP_EOL);
        return trim(fgets(STDIN));
    }

    /**
     * Generators CLI-Part
     *
     * @return TimeStampGenerator
     * @throws Exception
     */
    public function generator(): TimeStampGenerator
    {
        $input = (int) ($this->readline('how many do you want to generate (int): ') ?: 10);
        $d1 = null;
        $date = $this->readline('start year format: mm\\dd\\yyyy: ');
        if ($date) {
            $d1 = new DateTimeImmutable($date);
        }
        $d2 = null;
        $date = $this->readline('end year format: mm\\dd\\yyyy: ');
        if ($date) {
            $d2 = new DateTimeImmutable($date);
        }
        $generator = new TimeStampGenerator($d1, $d2);
        $result = $generator->generateRange($input);
        foreach ($result as $timestamp) {
            $date = new \DateTime();
            $date->setTimestamp($timestamp);
            fwrite(STDOUT, $timestamp . PHP_EOL);
        }
        return $generator;
    }
}
