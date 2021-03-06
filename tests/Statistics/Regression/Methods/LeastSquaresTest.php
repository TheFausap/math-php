<?php
namespace MathPHP\Statistics\Regression;

use MathPHP\Exception;

class LeadSquaresTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @testCase     LeastSquares trait leastSquares method throws a BadDataException if degrees of freedom is ≤ 0
     *               That will happen if there are only one or two points being used to fit a regression line.
     * @dataProvider dataProviderForLeastSquaresDegreesOfFreedomBadDataException
     * @param        array  $points
     */
    public function testLeastSquaresDegreesOfFreedomBadDataException(array $points)
    {
        $this->setExpectedException(Exception\BadDataException::class);
        $regression = new Linear($points);
    }

    public function dataProviderForLeastSquaresDegreesOfFreedomBadDataException(): array
    {
        return [
            'zero_points' => [
                [],
            ],
            'one_point' => [
                [[1, 2]],
            ],
            'two_points' => [
                [[1, 2], [2, 3]],
            ]
        ];
    }
}
