<?php

namespace AppBundle\Tool;

class Text
{
    public static function getStringAsOneLine($string)
    {
        $string = str_replace("\r\n", " ", $string);
        $string = str_replace("\n", " ", $string);
        $string = str_replace("\r", " ", $string);
        $string = str_replace("\t", "", $string);
        $string = preg_replace('#[ ]+#', ' ', $string);

        return $string;
    }

    static function cleanNonUnicodeSupport($pattern)
    {
        if (!defined('PREG_BAD_UTF8_OFFSET')) {
            return $pattern;
        }
        return preg_replace('/\[px]\{[a-z]{1,2}\}|(\/[a-z]*)u([a-z]*)$/i', '$1$2', $pattern);
    }

    public static function cutStringRespectingWhitespace($string, $length, $suffix = "...")
    {
        if ($length < strlen($string)) {
            $text = substr($string, 0, $length);
            if (false !== ($length = strrpos($text, ' '))) {
                $text = substr($text, 0, $length);
            }
            $string = $text . $suffix;
        }

        return $string;
    }


    public static function toUrl($text)
    {
        $text = \Pimcore\Tool\Transliteration::toASCII($text);

        $search = [
            '?',
            '\'',
            '"',
            '/',
            '-',
            '+',
            '.',
            ',',
            ';',
            '(',
            ')',
            ' ',
            '&',
            'ä',
            'ö',
            'ü',
            'Ä',
            'Ö',
            'Ü',
            'ß',
            'É',
            'é',
            'È',
            'è',
            'Ê',
            'ê',
            'E',
            'e',
            'Ë',
            'ë',
            'À',
            'à',
            'Á',
            'á',
            'Å',
            'å',
            'a',
            'Â',
            'â',
            'Ã',
            'ã',
            'ª',
            'Æ',
            'æ',
            'C',
            'c',
            'Ç',
            'ç',
            'C',
            'c',
            'Í',
            'í',
            'Ì',
            'ì',
            'Î',
            'î',
            'Ï',
            'ï',
            'Ó',
            'ó',
            'Ò',
            'ò',
            'Ô',
            'ô',
            'º',
            'Õ',
            'õ',
            'Œ',
            'O',
            'o',
            'Ø',
            'ø',
            'Ú',
            'ú',
            'Ù',
            'ù',
            'Û',
            'û',
            'U',
            'u',
            'U',
            'u',
            'Š',
            'š',
            'S',
            's',
            'Ž',
            'ž',
            'Z',
            'z',
            'Z',
            'z',
            'L',
            'l',
            'N',
            'n',
            'Ñ',
            'ñ',
            '¡',
            '¿',
            'Ÿ',
            'ÿ',
            "_",
            ":"
        ];
        $replace = [
            '',
            '',
            '',
            '',
            '-',
            '',
            '',
            '-',
            '-',
            '',
            '',
            '-',
            '',
            'ae',
            'oe',
            'ue',
            'Ae',
            'Oe',
            'Ue',
            'ss',
            'E',
            'e',
            'E',
            'e',
            'E',
            'e',
            'E',
            'e',
            'E',
            'e',
            'A',
            'a',
            'A',
            'a',
            'A',
            'a',
            'a',
            'A',
            'a',
            'A',
            'a',
            'a',
            'AE',
            'ae',
            'C',
            'c',
            'C',
            'c',
            'C',
            'c',
            'I',
            'i',
            'I',
            'i',
            'I',
            'i',
            'I',
            'i',
            'O',
            'o',
            'O',
            'o',
            'O',
            'o',
            'o',
            'O',
            'o',
            'OE',
            'O',
            'o',
            'O',
            'o',
            'U',
            'u',
            'U',
            'u',
            'U',
            'u',
            'U',
            'u',
            'U',
            'u',
            'S',
            's',
            'S',
            's',
            'Z',
            'z',
            'Z',
            'z',
            'Z',
            'z',
            'L',
            'l',
            'N',
            'n',
            'N',
            'n',
            '',
            '',
            'Y',
            'y',
            "-",
            "-"
        ];

        $value = urlencode(str_replace($search, $replace, $text));

        return $value;
    }

    public static function base64_decodeText($text, $concatStr = '')
    {
        if (empty($concatStr)) {
            $concatStr = Generate::$passwordSalt;
        }
        return str_replace($concatStr, '', base64_decode(base64_decode($text)));
    }

    public static function base64_encodeText($text, $concatStr = '')
    {
        if (empty($concatStr)) {
            $concatStr = Generate::$passwordSalt;
        }
        return base64_encode(base64_encode($concatStr . $text));
    }

    static function trim_words($text, $num_words = 55, $more = null)
    {
        if (null === $more) {
            $more = '&hellip;';
        }
        $original_text = $text;
        /*
         * translators: If your word count is based on single characters (e.g. East Asian characters),
         * enter 'characters_excluding_spaces' or 'characters_including_spaces'. Otherwise, enter 'words'.
         * Do not translate into your own language.
         */
        if (strpos($text, 'characters') === 0 && preg_match('/^utf\-?8$/i', 'utf-8')) {
            $text = trim(preg_replace("/[\n\r\t ]+/", ' ', $text), ' ');
            preg_match_all('/./u', $text, $words_array);
            $words_array = array_slice($words_array[0], 0, $num_words + 1);
            $sep = '';
        } else {
            $words_array = preg_split("/[\n\r\t ]+/", $text, $num_words + 1, PREG_SPLIT_NO_EMPTY);
            $sep = ' ';
        }
        if (count($words_array) > $num_words) {
            array_pop($words_array);
            $text = implode($sep, $words_array);
            $text = $text . $more;
        } else {
            $text = implode($sep, $words_array);
        }
        /**
         * Filters the text content after words have been trimmed.
         *
         * @since 3.3.0
         *
         * @param string $text The trimmed text.
         * @param int $num_words The number of words to trim the text to. Default 55.
         * @param string $more An optional string to append to the end of the trimmed text, e.g. &hellip;.
         * @param string $original_text The text before it was trimmed.
         */
        return $text;
    }

    static function array2string($array, $glue = '|')
    {
        $ret = '';

        foreach ($array as $item) {
            if (is_array($item)) {
                $ret .= self::array2string($item, $glue) . $glue;
            } else {
                $ret .= $item . $glue;
            }
        }

        $ret = substr($ret, 0, 0 - strlen($glue));

        return $ret;
    }

    static function filterString($str, $isBackend = false)
    {
        //$str = strtolower($str);
        $str = addslashes($str);
        $str = htmlspecialchars(trim($str));
        if (!$isBackend) {
            $str = str_replace(array('<', '>', "'", '"', ')', '('),
                array('&lt;', '&gt;', '&apos;', '&#x22;', '&#x29;', '&#x28;'), $str);
            $str = str_ireplace('%3Cscript', '', $str);
            $str = htmlentities($str, ENT_QUOTES | ENT_HTML5, 'UTF-8');
        }
        return $str;
    }

    static function dec_enc($action, $string)
    {
        $output = false;

        $encrypt_method = "AES-256-CBC";
        $secret_key = Generate::$passwordSalt;
        $secret_iv = Generate::$passwordSalt . 'iv';

        // hash
        $key = hash('sha256', $secret_key);

        // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
        $iv = substr(hash('sha256', $secret_iv), 0, 16);

        if ($action == 'encrypt') {
            $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
            $output = base64_encode($output);
        } else {
            if ($action == 'decrypt') {
                $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
            }
        }

        return $output;
    }

    static function boldText($kword, $text)
    {
        return preg_replace('/(' . $kword . ')/i', "<strong>$1</strong>", $text);
    }
}
