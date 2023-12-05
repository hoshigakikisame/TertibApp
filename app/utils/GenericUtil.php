<?php
class GenericUtil {
    /**
     * Convert integer to roman numeral
     * In order to use this utility, you need to activate the intl extension in php.ini
     * @param int $n
     * @return string
     */
    public static function intToRoman(int $n): string {
        $formatter = new NumberFormatter('@numbers=roman', NumberFormatter::DECIMAL);
        return $formatter->format($n);
    }   
}