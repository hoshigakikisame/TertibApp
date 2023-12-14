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

    public static function dateToHumanReadable(string $date): string {
        return date("F jS, Y", strtotime($date));
    }

    public static function textRedact(string $text): string {
        return str_repeat('█', strlen($text));
    }

    public static function optionalTextRedaction(string $text, bool $shouldRedact): string {
        return $shouldRedact ? self::textRedact($text) : $text;
    }

    public static function getRedactionImageUrl()
    {
        $baseUrl = MediaStorageService::getInstance()->getAccessUrl();
        return $baseUrl . 'user_profile/redacted.png';
    }

    public static function optionalImageRedaction(string $imgUrl, bool $shouldRedact): string {
        return $shouldRedact ? self::getRedactionImageUrl() : $imgUrl;
    }
}