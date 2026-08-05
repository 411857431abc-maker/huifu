<?php
namespace BsPaySdk\guomi;
/**
 * SM3 纯 GMP 实现 - GB/T 32905-2016
 * 已通过国标向量验证: SM3('abc') = 66c7f0f462eeedd9d1f2d46bdc10e4e24167c4875cf2f7a2297da02b8f4ba8e0
 */
class Sm3
{
    private static $IV = [
        '7380166f', '4914b2b9', '172442d7', 'da8a0600',
        'a96f30bc', '163138aa', 'e38dee4d', 'b0fb0e4e'
    ];

    private static function g($h) { return gmp_init($h, 16); }
    private static function u32($g) { return gmp_and($g, self::g('ffffffff')); }

    private static function rol($g, $n)
    {
        $n = $n % 32;
        $left = self::u32(gmp_mul($g, gmp_pow(2, $n)));
        $right = gmp_div($g, gmp_pow(2, 32 - $n));
        return self::u32(gmp_or($left, $right));
    }

    private static function T($j)
    {
        return $j < 16 ? self::g('79cc4519') : self::g('7a879d8a');
    }

    private static function FF($x, $y, $z, $j)
    {
        if ($j < 16) return self::u32(gmp_xor(gmp_xor($x, $y), $z));
        return self::u32(gmp_or(gmp_or(gmp_and($x, $y), gmp_and($x, $z)), gmp_and($y, $z)));
    }

    private static function GG($x, $y, $z, $j)
    {
        if ($j < 16) return self::u32(gmp_xor(gmp_xor($x, $y), $z));
        return self::u32(gmp_or(gmp_and($x, $y), gmp_and(gmp_com($x), $z)));
    }

    private static function P0($x)
    {
        return self::u32(gmp_xor(gmp_xor($x, self::rol($x, 9)), self::rol($x, 17)));
    }

    private static function P1($x)
    {
        return self::u32(gmp_xor(gmp_xor($x, self::rol($x, 15)), self::rol($x, 23)));
    }

    public static function hash($msg)
    {
        $bytes = array_values(unpack('C*', $msg));
        $bitLen = count($bytes) * 8;

        $bytes[] = 0x80;
        while (count($bytes) % 64 != 56) $bytes[] = 0x00;
        for ($i = 7; $i >= 0; $i--) $bytes[] = ($bitLen >> ($i * 8)) & 0xff;

        $V = array_map(fn($h) => self::g($h), self::$IV);

        for ($off = 0; $off < count($bytes); $off += 64) {
            $W = [];
            for ($j = 0; $j < 16; $j++) {
                $p = $off + $j * 4;
                $val = ($bytes[$p] << 24) | ($bytes[$p+1] << 16) | ($bytes[$p+2] << 8) | $bytes[$p+3];
                $W[$j] = self::g($val);
            }
            for ($j = 16; $j < 68; $j++) {
                $W[$j] = self::P1(gmp_xor(gmp_xor($W[$j-16], $W[$j-9]), self::rol($W[$j-3], 15)));
                $W[$j] = self::u32(gmp_xor(gmp_xor($W[$j], self::rol($W[$j-13], 7)), $W[$j-6]));
            }
            $WW = [];
            for ($j = 0; $j < 64; $j++) $WW[$j] = self::u32(gmp_xor($W[$j], $W[$j+4]));

            $A = $V[0]; $B = $V[1]; $C = $V[2]; $D = $V[3];
            $E = $V[4]; $F = $V[5]; $G = $V[6]; $H = $V[7];

            for ($j = 0; $j < 64; $j++) {
                $SS1 = self::rol(
                    self::u32(gmp_add(gmp_add(self::rol($A, 12), $E), self::rol(self::T($j), $j % 32))),
                    7
                );
                $SS2 = gmp_xor($SS1, self::rol($A, 12));
                $TT1 = self::u32(gmp_add(gmp_add(gmp_add(self::FF($A, $B, $C, $j), $D), $SS2), $WW[$j]));
                $TT2 = self::u32(gmp_add(gmp_add(gmp_add(self::GG($E, $F, $G, $j), $H), $SS1), $W[$j]));

                $D = $C;
                $C = self::rol($B, 9);
                $B = $A;
                $A = $TT1;
                $H = $G;
                $G = self::rol($F, 19);
                $F = $E;
                $E = self::P0($TT2);
            }

            $V[0] = self::u32(gmp_xor($V[0], $A));
            $V[1] = self::u32(gmp_xor($V[1], $B));
            $V[2] = self::u32(gmp_xor($V[2], $C));
            $V[3] = self::u32(gmp_xor($V[3], $D));
            $V[4] = self::u32(gmp_xor($V[4], $E));
            $V[5] = self::u32(gmp_xor($V[5], $F));
            $V[6] = self::u32(gmp_xor($V[6], $G));
            $V[7] = self::u32(gmp_xor($V[7], $H));
        }

        $out = '';
        foreach ($V as $v) $out .= str_pad(gmp_strval($v, 16), 8, '0', STR_PAD_LEFT);
        return $out;
    }
}