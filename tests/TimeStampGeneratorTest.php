<?php

declare(strict_types=1);

use cbenco\TimestampGenerator\TimeStampGenerator;
use PHPUnit\Framework\TestCase;

final class TimeStampGeneratorTest extends TestCase
{
    public function testCanGenerateNumberOfTimestampsWithoutConstructorArguments(): void
    {
        $generator = new TimeStampGenerator();
        $result = $generator->generateRange(10);
        $this->assertCount(10, $result);
        foreach ($result as $item) {
            $this->assertGreaterThan(0, $item);
            $this->assertLessThan(time(), $item);
        }
    }

    public function testCanGenerateTooLittleNumbers(): void
    {
        $generator = new TimeStampGenerator();
        $this->expectExceptionMessage('Number has to be greater than or equal to 1');
        $generator->generateRange(0);
    }

    public function testCanGenerateNumberOfTimestampsWithConstructorArguments(): void
    {
        $time1 = new \DateTime('now');
        $time1->modify('-10 days');
        $time2 = new \DateTimeImmutable('now');
        $generator = new TimeStampGenerator(DateTimeImmutable::createFromMutable($time1), $time2);
        $result = $generator->generateRange(10);
        $this->assertCount(10, $result);
        foreach ($result as $item) {
            $this->assertGreaterThan(0, $item);
            $this->assertLessThan(time(), $item);
        }
    }
}
