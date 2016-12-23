<?php
namespace MathPHP\InformationTheory;

class EntropyTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider dataProviderForShannonEntropy
     */
    public function testShannonEntropy(array $p, $expected)
    {
        $H = Entropy::shannonEntropy($p);

        $this->assertEquals($expected, $H, '', 0.001);
    }

    public function dataProviderForShannonEntropy()
    {
        return [
            // Test data created from: http://www.shannonentropy.netmark.pl/
            [
                [1],
                0
            ],
            [
                [0.6, 0.4],
                0.97095,
            ],
            [
                [0.514, 0.486],
                0.99941,
            ],
            [
                [0.231, 0.385, 0.308, 0.077],
                1.82625,
            ],
            // Test data from: http://www.csun.edu/~twang/595DM/Slides/Information%20&%20Entropy.pdf
            [
                [4/9, 3/9, 2/9],
                1.5304755,
            ],
            // Test data from: http://www.cs.rochester.edu/u/james/CSC248/Lec6.pdf
            [
                [0.4, 0.1, 0.25, 0.25],
                1.86,
            ],
            // Other
            [
                [1/2, 1/4, 1/4, 0],
                3/2,
            ],
        ];
    }

    public function testShannonEntropyExceptionNotProbabilityDistributionThatAddsUpToOne()
    {
        $p = [0.2, 0.2, 0.1];

        $this->setExpectedException('MathPHP\Exception\BadDataException');
        Entropy::shannonEntropy($p);
    }

    /**
     * @dataProvider dataProviderForShannonNatEntropy
     */
    public function testShannonNatEntropy(array $p, $expected)
    {
        $H = Entropy::shannonNatEntropy($p);

        $this->assertEquals($expected, $H, '', 0.000001);
    }

    public function dataProviderForShannonNatEntropy()
    {
        return [
            [
                [1],
                0
            ],
            [
                [0.6, 0.4],
                0.67301166700925,
            ],
            [
                [0.514, 0.486],
                0.69275512932254,
            ],
            [
                [0.231, 0.385, 0.308, 0.077],
                1.2661221087912,
            ],
            [
                [4/9, 3/9, 2/9],
                1.06085694715802,
            ],
        ];
    }

    public function testShannonNatEntropyExceptionNotProbabilityDistributionThatAddsUpToOne()
    {
        $p = [0.2, 0.2, 0.1];

        $this->setExpectedException('MathPHP\Exception\BadDataException');
        Entropy::shannonNatEntropy($p);
    }

    /**
     * @dataProvider dataProviderForShannonHartleyEntropy
     */
    public function testShannonHartleyEntropy(array $p, $expected)
    {
        $H = Entropy::shannonHartleyEntropy($p);

        $this->assertEquals($expected, $H, '', 0.000001);
    }

    public function dataProviderForShannonHartleyEntropy()
    {
        return [
            [
                [1],
                0
            ],
            [
                [0.6, 0.4],
                0.29228525323863,
            ],
            [
                [0.514, 0.486],
                0.30085972997496,
            ],
            [
                [0.231, 0.385, 0.308, 0.077],
                0.54986984526372,
            ],
            [
                [4/9, 3/9, 2/9],
                0.46072431823946,
            ],
        ];
    }

    public function testShannonHartleyEntropyExceptionNotProbabilityDistributionThatAddsUpToOne()
    {
        $p = [0.2, 0.2, 0.1];

        $this->setExpectedException('MathPHP\Exception\BadDataException');
        Entropy::shannonHartleyEntropy($p);
    }

    /**
     * @dataProvider dataProviderForCrossEntropy
     */
    public function testCrossEntropy(array $p, array $q, $expected)
    {
        $BD = Entropy::crossEntropy($p, $q);

        $this->assertEquals($expected, $BD, '', 0.01);
    }

    public function dataProviderForCrossEntropy()
    {
        return [
            // Test data from: http://www.cs.rochester.edu/u/james/CSC248/Lec6.pdf
            [
                [0.4, 0.1, 0.25, 0.25],
                [0.25, 0.25, 0.25, 0.25],
                2,
            ],
            [
                [0.4, 0.1, 0.25, 0.25],
                [0.4, 0.1, 0.1, 0.4],
                2.02,
            ],
        ];
    }

    public function testCrossEntropyExceptionArraysDifferentLength()
    {
        $p = [0.4, 0.5, 0.1];
        $q = [0.2, 0.8];

        $this->setExpectedException('MathPHP\Exception\BadDataException');
        Entropy::crossEntropy($p, $q);
    }

    public function testCrossEntropyExceptionNotProbabilityDistributionThatAddsUpToOne()
    {
        $p = [0.2, 0.2, 0.1];
        $q = [0.2, 0.4, 0.6];

        $this->setExpectedException('MathPHP\Exception\BadDataException');
        Entropy::crossEntropy($p, $q);
    }

    /**
     * @dataProvider dataProviderForShannonEntropy
     */
    public function testJointEntropy(array $p, $expected)
    {
        $H = Entropy::jointEntropy($p);

        $this->assertEquals($expected, $H, '', 0.001);
    }

    public function testJointEntropyExceptionNotProbabilityDistributionThatAddsUpToOne()
    {
        $p = [0.2, 0.2, 0.1];

        $this->setExpectedException('MathPHP\Exception\BadDataException');
        Entropy::jointEntropy($p);
    }

    /**
     * @dataProvider dataProviderForRenyiEntropy
     */
    public function testRenyiEntropy(array $p, $α, $expected)
    {
        $H = Entropy::renyiEntropy($p, $α);

        $this->assertEquals($expected, $H, '', 0.001);
    }

    public function dataProviderForRenyiEntropy()
    {
        return [
            [
                [0.4, 0.6], 0.5, 0.985352,
                [0.2, 0.3, 0.5], 0.8, 1.504855,
            ],
        ];
    }

    public function testRenyiEntropyExceptionNotProbabilityDistributionThatAddsUpToOne()
    {
        $p = [0.2, 0.2, 0.1];
        $α = 0.5;

        $this->setExpectedException('MathPHP\Exception\BadDataException');
        Entropy::renyiEntropy($p, $α);
    }


    public function testRenyiEntropyExceptionAlphaOutOfBounds()
    {
        $p = [0.4, 0.4, 0.2];
        $α = -3;

        $this->setExpectedException('MathPHP\Exception\OutOfBoundsException');
        Entropy::renyiEntropy($p, $α);
    }

    public function testRenyiEntropyExceptionAlphaEqualsOne()
    {
        $p = [0.4, 0.4, 0.2];
        $α = 1;

        $this->setExpectedException('MathPHP\Exception\OutOfBoundsException');
        Entropy::renyiEntropy($p, $α);
    }
}
