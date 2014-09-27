<?php

namespace Brick\Geo\Tests\IO;

use Brick\Geo\Tests\AbstractTestCase;

/**
 * Base class for WKB reader/writer tests.
 */
abstract class WKBAbstractTest extends AbstractTestCase
{
    /**
     * @return array
     */
    public function providerBigEndianWKB()
    {
        return [
            // Point
            ['POINT (1 2)', '00000000013ff00000000000004000000000000000'],
            ['POINT Z (2 3 4)', '00000003e9400000000000000040080000000000004010000000000000'],
            ['POINT M (3 4 5)', '00000007d1400800000000000040100000000000004014000000000000'],
            ['POINT ZM (4 5 6 7)', '0000000bb9401000000000000040140000000000004018000000000000401c000000000000'],

            // LineString
            ['LINESTRING (0 0, 1 2, 3 4)', '000000000200000003000000000000000000000000000000003ff0000000000000400000000000000040080000000000004010000000000000'],
            ['LINESTRING Z (0 1 2, 1 2 3, 2 3 4)', '00000003ea0000000300000000000000003ff000000000000040000000000000003ff000000000000040000000000000004008000000000000400000000000000040080000000000004010000000000000'],
            ['LINESTRING M (1 2 3, 2 3 4, 3 4 5)', '00000007d2000000033ff000000000000040000000000000004008000000000000400000000000000040080000000000004010000000000000400800000000000040100000000000004014000000000000'],
            ['LINESTRING ZM (2 3 4 5, 3 4 5 6, 4 5 6 7)', '0000000bba0000000340000000000000004008000000000000401000000000000040140000000000004008000000000000401000000000000040140000000000004018000000000000401000000000000040140000000000004018000000000000401c000000000000'],

            // Polygon
            ['POLYGON ((0 0, 1 2, 3 4, 0 0))', '00000000030000000100000004000000000000000000000000000000003ff000000000000040000000000000004008000000000000401000000000000000000000000000000000000000000000'],
            ['POLYGON Z ((0 1 2, 1 2 3, 2 3 4, 0 1 2))', '00000003eb000000010000000400000000000000003ff000000000000040000000000000003ff00000000000004000000000000000400800000000000040000000000000004008000000000000401000000000000000000000000000003ff00000000000004000000000000000'],
            ['POLYGON M ((1 2 3, 2 3 4, 3 4 5, 1 2 3))', '00000007d300000001000000043ff0000000000000400000000000000040080000000000004000000000000000400800000000000040100000000000004008000000000000401000000000000040140000000000003ff000000000000040000000000000004008000000000000'],
            ['POLYGON ZM ((2 3 4 5, 3 4 5 6, 4 5 6 7, 2 3 4 5))', '0000000bbb000000010000000440000000000000004008000000000000401000000000000040140000000000004008000000000000401000000000000040140000000000004018000000000000401000000000000040140000000000004018000000000000401c0000000000004000000000000000400800000000000040100000000000004014000000000000'],
            ['POLYGON ((0 0, 2 0, 0 2, 0 0), (0 0, 1 0, 0 1, 0 0))', '000000000300000002000000040000000000000000000000000000000040000000000000000000000000000000000000000000000040000000000000000000000000000000000000000000000000000004000000000000000000000000000000003ff0000000000000000000000000000000000000000000003ff000000000000000000000000000000000000000000000'],
            ['POLYGON Z ((0 0 1, 2 0 1, 0 2 1, 0 0 1), (0 0 2, 1 0 2, 0 1 2, 0 0 2))', '00000003eb0000000200000004000000000000000000000000000000003ff0000000000000400000000000000000000000000000003ff0000000000000000000000000000040000000000000003ff0000000000000000000000000000000000000000000003ff0000000000000000000040000000000000000000000000000000040000000000000003ff00000000000000000000000000000400000000000000000000000000000003ff00000000000004000000000000000000000000000000000000000000000004000000000000000'],
            ['POLYGON M ((0 0 1, 2 0 1, 0 2 1, 0 0 1), (0 0 2, 1 0 2, 0 1 2, 0 0 2))', '00000007d30000000200000004000000000000000000000000000000003ff0000000000000400000000000000000000000000000003ff0000000000000000000000000000040000000000000003ff0000000000000000000000000000000000000000000003ff0000000000000000000040000000000000000000000000000000040000000000000003ff00000000000000000000000000000400000000000000000000000000000003ff00000000000004000000000000000000000000000000000000000000000004000000000000000'],
            ['POLYGON ZM ((0 0 1 2, 2 0 1 2, 0 2 1 2, 0 0 1 2), (0 0 1 2, 1 0 1 2, 0 1 1 2, 0 0 1 2))', '0000000bbb0000000200000004000000000000000000000000000000003ff00000000000004000000000000000400000000000000000000000000000003ff00000000000004000000000000000000000000000000040000000000000003ff00000000000004000000000000000000000000000000000000000000000003ff0000000000000400000000000000000000004000000000000000000000000000000003ff000000000000040000000000000003ff000000000000000000000000000003ff0000000000000400000000000000000000000000000003ff00000000000003ff00000000000004000000000000000000000000000000000000000000000003ff00000000000004000000000000000'],

            // MultiPoint
            ['MULTIPOINT (0 0, 1 2, 3 4)', '00000000040000000300000000010000000000000000000000000000000000000000013ff00000000000004000000000000000000000000140080000000000004010000000000000'],
            ['MULTIPOINT Z (0 1 2, 1 2 3, 2 3 4)', '00000003ec0000000300000003e900000000000000003ff0000000000000400000000000000000000003e93ff00000000000004000000000000000400800000000000000000003e9400000000000000040080000000000004010000000000000'],
            ['MULTIPOINT M (1 2 3, 2 3 4, 3 4 5)', '00000007d40000000300000007d13ff00000000000004000000000000000400800000000000000000007d140000000000000004008000000000000401000000000000000000007d1400800000000000040100000000000004014000000000000'],
            ['MULTIPOINT ZM (2 3 4 5, 3 4 5 6, 4 5 6 7)', '0000000bbc000000030000000bb940000000000000004008000000000000401000000000000040140000000000000000000bb940080000000000004010000000000000401400000000000040180000000000000000000bb9401000000000000040140000000000004018000000000000401c000000000000'],

            // MultiLineString
            ['MULTILINESTRING ((0 0, 1 2, 3 4, 0 0))', '000000000500000001000000000200000004000000000000000000000000000000003ff000000000000040000000000000004008000000000000401000000000000000000000000000000000000000000000'],
            ['MULTILINESTRING Z ((0 1 2, 1 2 3, 2 3 4, 0 1 2))', '00000003ed0000000100000003ea0000000400000000000000003ff000000000000040000000000000003ff00000000000004000000000000000400800000000000040000000000000004008000000000000401000000000000000000000000000003ff00000000000004000000000000000'],
            ['MULTILINESTRING M ((1 2 3, 2 3 4, 3 4 5, 1 2 3))', '00000007d50000000100000007d2000000043ff0000000000000400000000000000040080000000000004000000000000000400800000000000040100000000000004008000000000000401000000000000040140000000000003ff000000000000040000000000000004008000000000000'],
            ['MULTILINESTRING ZM ((2 3 4 5, 3 4 5 6, 4 5 6 7, 2 3 4 5))', '0000000bbd000000010000000bba0000000440000000000000004008000000000000401000000000000040140000000000004008000000000000401000000000000040140000000000004018000000000000401000000000000040140000000000004018000000000000401c0000000000004000000000000000400800000000000040100000000000004014000000000000'],
            ['MULTILINESTRING ((0 0, 2 0, 0 2, 0 0), (0 0, 1 0, 0 1, 0 0))', '00000000050000000200000000020000000400000000000000000000000000000000400000000000000000000000000000000000000000000000400000000000000000000000000000000000000000000000000000000200000004000000000000000000000000000000003ff0000000000000000000000000000000000000000000003ff000000000000000000000000000000000000000000000'],
            ['MULTILINESTRING Z ((0 0 1, 2 0 1, 0 2 1, 0 0 1), (0 0 2, 1 0 2, 0 1 2, 0 0 2))', '00000003ed0000000200000003ea00000004000000000000000000000000000000003ff0000000000000400000000000000000000000000000003ff0000000000000000000000000000040000000000000003ff0000000000000000000000000000000000000000000003ff000000000000000000003ea000000040000000000000000000000000000000040000000000000003ff00000000000000000000000000000400000000000000000000000000000003ff00000000000004000000000000000000000000000000000000000000000004000000000000000'],
            ['MULTILINESTRING M ((0 0 1, 2 0 1, 0 2 1, 0 0 1), (0 0 2, 1 0 2, 0 1 2, 0 0 2))', '00000007d50000000200000007d200000004000000000000000000000000000000003ff0000000000000400000000000000000000000000000003ff0000000000000000000000000000040000000000000003ff0000000000000000000000000000000000000000000003ff000000000000000000007d2000000040000000000000000000000000000000040000000000000003ff00000000000000000000000000000400000000000000000000000000000003ff00000000000004000000000000000000000000000000000000000000000004000000000000000'],
            ['MULTILINESTRING ZM ((0 0 1 2, 2 0 1 2, 0 2 1 2, 0 0 1 2), (0 0 1 2, 1 0 1 2, 0 1 1 2, 0 0 1 2))', '0000000bbd000000020000000bba00000004000000000000000000000000000000003ff00000000000004000000000000000400000000000000000000000000000003ff00000000000004000000000000000000000000000000040000000000000003ff00000000000004000000000000000000000000000000000000000000000003ff000000000000040000000000000000000000bba00000004000000000000000000000000000000003ff000000000000040000000000000003ff000000000000000000000000000003ff0000000000000400000000000000000000000000000003ff00000000000003ff00000000000004000000000000000000000000000000000000000000000003ff00000000000004000000000000000'],

            // MultiPolygon
            ['MULTIPOLYGON (((0 0, 1 2, 3 4, 0 0)))', '00000000060000000100000000030000000100000004000000000000000000000000000000003ff000000000000040000000000000004008000000000000401000000000000000000000000000000000000000000000'],
            ['MULTIPOLYGON Z (((0 1 2, 1 2 3, 2 3 4, 0 1 2)))', '00000003ee0000000100000003eb000000010000000400000000000000003ff000000000000040000000000000003ff00000000000004000000000000000400800000000000040000000000000004008000000000000401000000000000000000000000000003ff00000000000004000000000000000'],
            ['MULTIPOLYGON M (((1 2 3, 2 3 4, 3 4 5, 1 2 3)))', '00000007d60000000100000007d300000001000000043ff0000000000000400000000000000040080000000000004000000000000000400800000000000040100000000000004008000000000000401000000000000040140000000000003ff000000000000040000000000000004008000000000000'],
            ['MULTIPOLYGON ZM (((2 3 4 5, 3 4 5 6, 4 5 6 7, 2 3 4 5)))', '0000000bbe000000010000000bbb000000010000000440000000000000004008000000000000401000000000000040140000000000004008000000000000401000000000000040140000000000004018000000000000401000000000000040140000000000004018000000000000401c0000000000004000000000000000400800000000000040100000000000004014000000000000'],
            ['MULTIPOLYGON (((0 0, 2 0, 0 2, 0 0)), ((0 0, 1 0, 0 1, 0 0)))', '000000000600000002000000000300000001000000040000000000000000000000000000000040000000000000000000000000000000000000000000000040000000000000000000000000000000000000000000000000000000030000000100000004000000000000000000000000000000003ff0000000000000000000000000000000000000000000003ff000000000000000000000000000000000000000000000'],
            ['MULTIPOLYGON Z (((0 0 1, 2 0 1, 0 2 1, 0 0 1)), ((0 0 2, 1 0 2, 0 1 2, 0 0 2)))', '00000003ee0000000200000003eb0000000100000004000000000000000000000000000000003ff0000000000000400000000000000000000000000000003ff0000000000000000000000000000040000000000000003ff0000000000000000000000000000000000000000000003ff000000000000000000003eb00000001000000040000000000000000000000000000000040000000000000003ff00000000000000000000000000000400000000000000000000000000000003ff00000000000004000000000000000000000000000000000000000000000004000000000000000'],
            ['MULTIPOLYGON M (((0 0 1, 2 0 1, 0 2 1, 0 0 1)), ((0 0 2, 1 0 2, 0 1 2, 0 0 2)))', '00000007d60000000200000007d30000000100000004000000000000000000000000000000003ff0000000000000400000000000000000000000000000003ff0000000000000000000000000000040000000000000003ff0000000000000000000000000000000000000000000003ff000000000000000000007d300000001000000040000000000000000000000000000000040000000000000003ff00000000000000000000000000000400000000000000000000000000000003ff00000000000004000000000000000000000000000000000000000000000004000000000000000'],
            ['MULTIPOLYGON ZM (((0 0 1 2, 2 0 1 2, 0 2 1 2, 0 0 1 2)), ((0 0 1 2, 1 0 1 2, 0 1 1 2, 0 0 1 2)))', '0000000bbe000000020000000bbb0000000100000004000000000000000000000000000000003ff00000000000004000000000000000400000000000000000000000000000003ff00000000000004000000000000000000000000000000040000000000000003ff00000000000004000000000000000000000000000000000000000000000003ff000000000000040000000000000000000000bbb0000000100000004000000000000000000000000000000003ff000000000000040000000000000003ff000000000000000000000000000003ff0000000000000400000000000000000000000000000003ff00000000000003ff00000000000004000000000000000000000000000000000000000000000003ff00000000000004000000000000000'],

            // GeometryCollection
            ['GEOMETRYCOLLECTION (POINT (1 2), LINESTRING (2 3, 3 4))', '00000000070000000200000000013ff000000000000040000000000000000000000002000000024000000000000000400800000000000040080000000000004010000000000000'],
            ['GEOMETRYCOLLECTION Z (POINT Z (1 2 3), LINESTRING Z (2 3 4, 3 4 5))', '00000003ef0000000200000003e93ff00000000000004000000000000000400800000000000000000003ea00000002400000000000000040080000000000004010000000000000400800000000000040100000000000004014000000000000'],
            ['GEOMETRYCOLLECTION M (POINT M (1 2 4), LINESTRING M (2 3 5, 3 4 6))', '00000007d70000000200000007d13ff00000000000004000000000000000401000000000000000000007d200000002400000000000000040080000000000004014000000000000400800000000000040100000000000004018000000000000'],
            ['GEOMETRYCOLLECTION ZM (POINT ZM (1 2 3 4), LINESTRING ZM (2 3 4 5, 3 4 5 6))', '0000000bbf000000020000000bb93ff00000000000004000000000000000400800000000000040100000000000000000000bba0000000240000000000000004008000000000000401000000000000040140000000000004008000000000000401000000000000040140000000000004018000000000000'],
        ];
    }

    /**
     * @return array
     */
    public function providerLittleEndianWKB()
    {
        return [
            // Point
            ['POINT (1 2)', '0101000000000000000000f03f0000000000000040'],
            ['POINT Z (2 3 4)', '01e9030000000000000000004000000000000008400000000000001040'],
            ['POINT M (3 4 5)', '01d1070000000000000000084000000000000010400000000000001440'],
            ['POINT ZM (4 5 6 7)', '01b90b00000000000000001040000000000000144000000000000018400000000000001c40'],

            // LineString
            ['LINESTRING (0 0, 1 2, 3 4)', '01020000000300000000000000000000000000000000000000000000000000f03f000000000000004000000000000008400000000000001040'],
            ['LINESTRING Z (0 1 2, 1 2 3, 2 3 4)', '01ea030000030000000000000000000000000000000000f03f0000000000000040000000000000f03f00000000000000400000000000000840000000000000004000000000000008400000000000001040'],
            ['LINESTRING M (1 2 3, 2 3 4, 3 4 5)', '01d207000003000000000000000000f03f00000000000000400000000000000840000000000000004000000000000008400000000000001040000000000000084000000000000010400000000000001440'],
            ['LINESTRING ZM (2 3 4 5, 3 4 5 6, 4 5 6 7)', '01ba0b000003000000000000000000004000000000000008400000000000001040000000000000144000000000000008400000000000001040000000000000144000000000000018400000000000001040000000000000144000000000000018400000000000001c40'],

            // Polygon
            ['POLYGON ((0 0, 1 2, 3 4, 0 0))', '0103000000010000000400000000000000000000000000000000000000000000000000f03f00000000000000400000000000000840000000000000104000000000000000000000000000000000'],
            ['POLYGON Z ((0 1 2, 1 2 3, 2 3 4, 0 1 2))', '01eb03000001000000040000000000000000000000000000000000f03f0000000000000040000000000000f03f000000000000004000000000000008400000000000000040000000000000084000000000000010400000000000000000000000000000f03f0000000000000040'],
            ['POLYGON M ((1 2 3, 2 3 4, 3 4 5, 1 2 3))', '01d30700000100000004000000000000000000f03f00000000000000400000000000000840000000000000004000000000000008400000000000001040000000000000084000000000000010400000000000001440000000000000f03f00000000000000400000000000000840'],
            ['POLYGON ZM ((2 3 4 5, 3 4 5 6, 4 5 6 7, 2 3 4 5))', '01bb0b00000100000004000000000000000000004000000000000008400000000000001040000000000000144000000000000008400000000000001040000000000000144000000000000018400000000000001040000000000000144000000000000018400000000000001c400000000000000040000000000000084000000000000010400000000000001440'],
            ['POLYGON ((0 0, 2 0, 0 2, 0 0), (0 0, 1 0, 0 1, 0 0))', '01030000000200000004000000000000000000000000000000000000000000000000000040000000000000000000000000000000000000000000000040000000000000000000000000000000000400000000000000000000000000000000000000000000000000f03f00000000000000000000000000000000000000000000f03f00000000000000000000000000000000'],
            ['POLYGON Z ((0 0 1, 2 0 1, 0 2 1, 0 0 1), (0 0 2, 1 0 2, 0 1 2, 0 0 2))', '01eb030000020000000400000000000000000000000000000000000000000000000000f03f00000000000000400000000000000000000000000000f03f00000000000000000000000000000040000000000000f03f00000000000000000000000000000000000000000000f03f04000000000000000000000000000000000000000000000000000040000000000000f03f000000000000000000000000000000400000000000000000000000000000f03f0000000000000040000000000000000000000000000000000000000000000040'],
            ['POLYGON M ((0 0 1, 2 0 1, 0 2 1, 0 0 1), (0 0 2, 1 0 2, 0 1 2, 0 0 2))', '01d3070000020000000400000000000000000000000000000000000000000000000000f03f00000000000000400000000000000000000000000000f03f00000000000000000000000000000040000000000000f03f00000000000000000000000000000000000000000000f03f04000000000000000000000000000000000000000000000000000040000000000000f03f000000000000000000000000000000400000000000000000000000000000f03f0000000000000040000000000000000000000000000000000000000000000040'],
            ['POLYGON ZM ((0 0 1 2, 2 0 1 2, 0 2 1 2, 0 0 1 2), (0 0 1 2, 1 0 1 2, 0 1 1 2, 0 0 1 2))', '01bb0b0000020000000400000000000000000000000000000000000000000000000000f03f000000000000004000000000000000400000000000000000000000000000f03f000000000000004000000000000000000000000000000040000000000000f03f000000000000004000000000000000000000000000000000000000000000f03f00000000000000400400000000000000000000000000000000000000000000000000f03f0000000000000040000000000000f03f0000000000000000000000000000f03f00000000000000400000000000000000000000000000f03f000000000000f03f000000000000004000000000000000000000000000000000000000000000f03f0000000000000040'],

            // MultiPoint
            ['MULTIPOINT (0 0, 1 2, 3 4)', '0104000000030000000101000000000000000000000000000000000000000101000000000000000000f03f0000000000000040010100000000000000000008400000000000001040'],
            ['MULTIPOINT Z (0 1 2, 1 2 3, 2 3 4)', '01ec0300000300000001e90300000000000000000000000000000000f03f000000000000004001e9030000000000000000f03f0000000000000040000000000000084001e9030000000000000000004000000000000008400000000000001040'],
            ['MULTIPOINT M (1 2 3, 2 3 4, 3 4 5)', '01d40700000300000001d1070000000000000000f03f0000000000000040000000000000084001d107000000000000000000400000000000000840000000000000104001d1070000000000000000084000000000000010400000000000001440'],
            ['MULTIPOINT ZM (2 3 4 5, 3 4 5 6, 4 5 6 7)', '01bc0b00000300000001b90b0000000000000000004000000000000008400000000000001040000000000000144001b90b0000000000000000084000000000000010400000000000001440000000000000184001b90b00000000000000001040000000000000144000000000000018400000000000001c40'],

            // MultiLineString
            ['MULTILINESTRING ((0 0, 1 2, 3 4, 0 0))', '01050000000100000001020000000400000000000000000000000000000000000000000000000000f03f00000000000000400000000000000840000000000000104000000000000000000000000000000000'],
            ['MULTILINESTRING Z ((0 1 2, 1 2 3, 2 3 4, 0 1 2))', '01ed0300000100000001ea030000040000000000000000000000000000000000f03f0000000000000040000000000000f03f000000000000004000000000000008400000000000000040000000000000084000000000000010400000000000000000000000000000f03f0000000000000040'],
            ['MULTILINESTRING M ((1 2 3, 2 3 4, 3 4 5, 1 2 3))', '01d50700000100000001d207000004000000000000000000f03f00000000000000400000000000000840000000000000004000000000000008400000000000001040000000000000084000000000000010400000000000001440000000000000f03f00000000000000400000000000000840'],
            ['MULTILINESTRING ZM ((2 3 4 5, 3 4 5 6, 4 5 6 7, 2 3 4 5))', '01bd0b00000100000001ba0b000004000000000000000000004000000000000008400000000000001040000000000000144000000000000008400000000000001040000000000000144000000000000018400000000000001040000000000000144000000000000018400000000000001c400000000000000040000000000000084000000000000010400000000000001440'],
            ['MULTILINESTRING ((0 0, 2 0, 0 2, 0 0), (0 0, 1 0, 0 1, 0 0))', '0105000000020000000102000000040000000000000000000000000000000000000000000000000000400000000000000000000000000000000000000000000000400000000000000000000000000000000001020000000400000000000000000000000000000000000000000000000000f03f00000000000000000000000000000000000000000000f03f00000000000000000000000000000000'],
            ['MULTILINESTRING Z ((0 0 1, 2 0 1, 0 2 1, 0 0 1), (0 0 2, 1 0 2, 0 1 2, 0 0 2))', '01ed0300000200000001ea0300000400000000000000000000000000000000000000000000000000f03f00000000000000400000000000000000000000000000f03f00000000000000000000000000000040000000000000f03f00000000000000000000000000000000000000000000f03f01ea03000004000000000000000000000000000000000000000000000000000040000000000000f03f000000000000000000000000000000400000000000000000000000000000f03f0000000000000040000000000000000000000000000000000000000000000040'],
            ['MULTILINESTRING M ((0 0 1, 2 0 1, 0 2 1, 0 0 1), (0 0 2, 1 0 2, 0 1 2, 0 0 2))', '01d50700000200000001d20700000400000000000000000000000000000000000000000000000000f03f00000000000000400000000000000000000000000000f03f00000000000000000000000000000040000000000000f03f00000000000000000000000000000000000000000000f03f01d207000004000000000000000000000000000000000000000000000000000040000000000000f03f000000000000000000000000000000400000000000000000000000000000f03f0000000000000040000000000000000000000000000000000000000000000040'],
            ['MULTILINESTRING ZM ((0 0 1 2, 2 0 1 2, 0 2 1 2, 0 0 1 2), (0 0 1 2, 1 0 1 2, 0 1 1 2, 0 0 1 2))', '01bd0b00000200000001ba0b00000400000000000000000000000000000000000000000000000000f03f000000000000004000000000000000400000000000000000000000000000f03f000000000000004000000000000000000000000000000040000000000000f03f000000000000004000000000000000000000000000000000000000000000f03f000000000000004001ba0b00000400000000000000000000000000000000000000000000000000f03f0000000000000040000000000000f03f0000000000000000000000000000f03f00000000000000400000000000000000000000000000f03f000000000000f03f000000000000004000000000000000000000000000000000000000000000f03f0000000000000040'],

            // MultiPolygon
            ['MULTIPOLYGON (((0 0, 1 2, 3 4, 0 0)))', '0106000000010000000103000000010000000400000000000000000000000000000000000000000000000000f03f00000000000000400000000000000840000000000000104000000000000000000000000000000000'],
            ['MULTIPOLYGON Z (((0 1 2, 1 2 3, 2 3 4, 0 1 2)))', '01ee0300000100000001eb03000001000000040000000000000000000000000000000000f03f0000000000000040000000000000f03f000000000000004000000000000008400000000000000040000000000000084000000000000010400000000000000000000000000000f03f0000000000000040'],
            ['MULTIPOLYGON M (((1 2 3, 2 3 4, 3 4 5, 1 2 3)))', '01d60700000100000001d30700000100000004000000000000000000f03f00000000000000400000000000000840000000000000004000000000000008400000000000001040000000000000084000000000000010400000000000001440000000000000f03f00000000000000400000000000000840'],
            ['MULTIPOLYGON ZM (((2 3 4 5, 3 4 5 6, 4 5 6 7, 2 3 4 5)))', '01be0b00000100000001bb0b00000100000004000000000000000000004000000000000008400000000000001040000000000000144000000000000008400000000000001040000000000000144000000000000018400000000000001040000000000000144000000000000018400000000000001c400000000000000040000000000000084000000000000010400000000000001440'],
            ['MULTIPOLYGON (((0 0, 2 0, 0 2, 0 0)), ((0 0, 1 0, 0 1, 0 0)))', '01060000000200000001030000000100000004000000000000000000000000000000000000000000000000000040000000000000000000000000000000000000000000000040000000000000000000000000000000000103000000010000000400000000000000000000000000000000000000000000000000f03f00000000000000000000000000000000000000000000f03f00000000000000000000000000000000'],
            ['MULTIPOLYGON Z (((0 0 1, 2 0 1, 0 2 1, 0 0 1)), ((0 0 2, 1 0 2, 0 1 2, 0 0 2)))', '01ee0300000200000001eb030000010000000400000000000000000000000000000000000000000000000000f03f00000000000000400000000000000000000000000000f03f00000000000000000000000000000040000000000000f03f00000000000000000000000000000000000000000000f03f01eb0300000100000004000000000000000000000000000000000000000000000000000040000000000000f03f000000000000000000000000000000400000000000000000000000000000f03f0000000000000040000000000000000000000000000000000000000000000040'],
            ['MULTIPOLYGON M (((0 0 1, 2 0 1, 0 2 1, 0 0 1)), ((0 0 2, 1 0 2, 0 1 2, 0 0 2)))', '01d60700000200000001d3070000010000000400000000000000000000000000000000000000000000000000f03f00000000000000400000000000000000000000000000f03f00000000000000000000000000000040000000000000f03f00000000000000000000000000000000000000000000f03f01d30700000100000004000000000000000000000000000000000000000000000000000040000000000000f03f000000000000000000000000000000400000000000000000000000000000f03f0000000000000040000000000000000000000000000000000000000000000040'],
            ['MULTIPOLYGON ZM (((0 0 1 2, 2 0 1 2, 0 2 1 2, 0 0 1 2)), ((0 0 1 2, 1 0 1 2, 0 1 1 2, 0 0 1 2)))', '01be0b00000200000001bb0b0000010000000400000000000000000000000000000000000000000000000000f03f000000000000004000000000000000400000000000000000000000000000f03f000000000000004000000000000000000000000000000040000000000000f03f000000000000004000000000000000000000000000000000000000000000f03f000000000000004001bb0b0000010000000400000000000000000000000000000000000000000000000000f03f0000000000000040000000000000f03f0000000000000000000000000000f03f00000000000000400000000000000000000000000000f03f000000000000f03f000000000000004000000000000000000000000000000000000000000000f03f0000000000000040'],

            // GeometryCollection
            ['GEOMETRYCOLLECTION (POINT (1 2), LINESTRING (2 3, 3 4))', '0107000000020000000101000000000000000000f03f00000000000000400102000000020000000000000000000040000000000000084000000000000008400000000000001040'],
            ['GEOMETRYCOLLECTION Z (POINT Z (1 2 3), LINESTRING Z (2 3 4, 3 4 5))', '01ef0300000200000001e9030000000000000000f03f0000000000000040000000000000084001ea03000002000000000000000000004000000000000008400000000000001040000000000000084000000000000010400000000000001440'],
            ['GEOMETRYCOLLECTION M (POINT M (1 2 4), LINESTRING M (2 3 5, 3 4 6))', '01d70700000200000001d1070000000000000000f03f0000000000000040000000000000104001d207000002000000000000000000004000000000000008400000000000001440000000000000084000000000000010400000000000001840'],
            ['GEOMETRYCOLLECTION ZM (POINT ZM (1 2 3 4), LINESTRING ZM (2 3 4 5, 3 4 5 6))', '01bf0b00000200000001b90b0000000000000000f03f00000000000000400000000000000840000000000000104001ba0b00000200000000000000000000400000000000000840000000000000104000000000000014400000000000000840000000000000104000000000000014400000000000001840'],
        ];
    }
}
