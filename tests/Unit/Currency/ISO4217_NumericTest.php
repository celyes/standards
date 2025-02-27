<?php
declare(strict_types=1);

namespace PrinsFrank\Standards\Tests\Unit\Currency;

use PHPUnit\Framework\TestCase;
use PrinsFrank\Standards\Currency\ISO4217_Numeric;
use ValueError;

/**
 * @coversDefaultClass \PrinsFrank\Standards\Currency\ISO4217_Numeric
 */
class ISO4217_NumericTest extends TestCase
{
    /**
     * @covers ::toISO4217_Alpha3
     */
    public function testAllCasesCanBeConvertedToISO4217Numeric(): void
    {
        $cases = ISO4217_Numeric::cases();
        static::assertNotEmpty($cases);
        foreach ($cases as $case) {
            static::assertNotNull($case->toISO4217_Alpha3());
        }
    }

    /**
     * @covers ::fromInt
     */
    public function testFromInt(): void
    {
        static::assertEquals(ISO4217_Numeric::Albanian_lek, ISO4217_Numeric::fromInt(8));
    }

    /**
     * @covers ::fromInt
     */
    public function testFromIntThrowsExceptionOnNonExistingValue(): void
    {
        $this->expectException(ValueError::class);
        $this->expectExceptionMessage('"001" is not a valid backing value for enum "' . ISO4217_Numeric::class . '"');
        static::assertNull(ISO4217_Numeric::fromInt(1));
    }

    /**
     * @covers ::tryFromInt
     */
    public function testTryFromInt(): void
    {
        static::assertEquals(ISO4217_Numeric::Albanian_lek, ISO4217_Numeric::tryFromInt(8));
        static::assertNull(ISO4217_Numeric::tryFromInt(1));
    }
}
