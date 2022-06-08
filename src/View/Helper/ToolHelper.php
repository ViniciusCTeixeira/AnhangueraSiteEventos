<?php

    namespace App\View\Helper;

    use Cake\Cache\Cache;
    use Cake\View\Helper\HtmlHelper;
    use Cake\View\View;
    use Cake\ORM\TableRegistry;
    use Cake\Core\Configure;
    use Cake\Utility\Hash;

    class ToolHelper extends HtmlHelper
    {
        public function __construct(View $view, $config = [])
        {
            parent::__construct($view, $config);
        }

        protected $_defaultConfig = [];

        public function returnOnlyNumbers($string)
        {
            return preg_replace('/[^0-9]/', '', $string);
        }

        public function string_rewrite($str, $utf8_decode = FALSE, $replaceSpace = '-')
        {
            try {
                $str = preg_replace('/[`^~\'"]/', NULL, iconv('UTF-8', 'ASCII//IGNORE', $str));

                $purified = '';
                $length = self::strlen($str);
                if ($utf8_decode)
                    $str = utf8_decode($str);
                for ($i = 0; $i < $length; $i++) {
                    $char = self::substr($str, $i, 1);
                    if (self::strlen(htmlentities($char)) > 1) {
                        $entity = htmlentities($char, ENT_COMPAT, 'UTF-8');
                        $purified .= $entity{1};
                    } elseif (preg_match('|[[:alpha:]]{1}|u', $char))
                        $purified .= $char;
                    elseif (preg_match('<[[:digit:]]|-{1}>', $char))
                        $purified .= $char;
                    elseif ($char == ' ')
                        $purified .= $replaceSpace;
                }

                return trim(self::strtolower($purified));
            } catch (Exception $e) {
                return trim($str);
            }
        }

        static function strlen($str)
        {
            if (is_array($str))
                return FALSE;
            $str = html_entity_decode($str, ENT_COMPAT, 'UTF-8');
            if (function_exists('mb_strlen'))
                return mb_strlen($str, 'utf-8');

            return strlen($str);
        }

        static function substr($str, $start, $length = FALSE, $encoding = 'utf-8')
        {
            if (is_array($str))
                return FALSE;
            if (function_exists('mb_substr'))
                return mb_substr($str, intval($start), ($length === FALSE ? self::strlen($str) : intval($length)), $encoding);

            return substr($str, $start, ($length === FALSE ? strlen($str) : intval($length)));
        }

        static function strtolower($str)
        {
            if (is_array($str))
                return FALSE;
            if (function_exists('mb_strtolower'))
                return mb_strtolower($str, 'utf-8');

            return strtolower($str);
        }

        static function strtoupper($str)
        {
            if (is_array($str))
                return FALSE;
            if (function_exists('mb_strtoupper'))
                return mb_strtoupper($str, 'utf-8');

            return strtoupper($str);
        }

        private function crypto_rand_secure($min, $max)
        {
            $range = $max - $min;
            if ($range < 0)
                return $min; // not so random...
            $log = log($range, 2);
            $bytes = (int)($log / 8) + 1; // length in bytes
            $bits = (int)$log + 1; // length in bits
            $filter = (int)(1 << $bits) - 1; // set all lower bits to 1
            do {
                $rnd = hexdec(bin2hex(openssl_random_pseudo_bytes($bytes)));
                $rnd = $rnd & $filter; // discard irrelevant bits
            } while ($rnd >= $range);

            return $min + $rnd;
        }

        public function getToken($length = 64)
        {
            $length = (($length < 34) ? 34 : $length);
            $length = ($length - 18);

            $token = "";
            $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
            $codeAlphabet .= "abcdefghijklmnopqrstuvwxyz";
            $codeAlphabet .= "0123456789";

            for ($i = 0; $i < ($length / 2); $i++) {
                $token .= $codeAlphabet[$this->crypto_rand_secure(0, strlen($codeAlphabet))];
            }

            $token .= $this->getUniqid(10);

            for ($i = 0; $i < ($length / 2); $i++) {
                $token .= $codeAlphabet[$this->crypto_rand_secure(0, strlen($codeAlphabet))];
            }

            return date('Y') . $token . date('md');
        }

        static public function getUniqid($lenght = 13)
        {
            if (function_exists("openssl_random_pseudo_bytes")) {
                $bytes = openssl_random_pseudo_bytes(ceil($lenght / 2));
            } else {
                $bytes = uniqid(rand(), TRUE);
            }

            return substr(bin2hex($bytes), 0, $lenght);
        }

        function getServerName()
        {
            if (isset($_SERVER['HTTP_X_FORWARDED_SERVER']) and $_SERVER['HTTP_X_FORWARDED_SERVER'])
                return $_SERVER['HTTP_X_FORWARDED_SERVER'];

            return $_SERVER['SERVER_NAME'];
        }

        public static function strpos_array($haystack, $needles)
        {
            $First = strlen($haystack);
            if (!is_array($needles))
                $needles = array($needles);
            foreach ($needles as $what) {
                $pos = strpos($haystack, $what);
                if ($pos !== FALSE) {
                    if ($pos < $First)
                        $First = $pos;
                }
            }

            return $First == strlen($haystack) ? FALSE : TRUE;
        }

        public function isActiveMenu($menu, $action, $controller)
        {
            //$menu = array_change_key_case($menu, CASE_LOWER);

            if (isset($menu[$controller]) && in_array($action, $menu[$controller], TRUE)) {
                return TRUE;
            } else {
                return FALSE;
            }
        }

        static public function passwordGen($length = 8)
        {
            $str = 'abcdefghijkmnopqrstuvwxyz0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
            for ($i = 0, $password = ''; $i < $length; $i++)
                $password .= self::substr($str, mt_rand(0, self::strlen($str) - 1), 1);

            return $password;
        }

        static public function uniqidReal($lenght = 13)
        {
            // uniqid gives 13 chars, but you could adjust it to your needs.
            if (function_exists("openssl_random_pseudo_bytes")) {
                $bytes = openssl_random_pseudo_bytes(ceil($lenght / 2));
            } else {
                $bytes = uniqid(rand(), TRUE);
            }

            return substr(bin2hex($bytes), 0, $lenght);
        }

        function getSalutation()
        {
            date_default_timezone_set('America/Sao_Paulo');
            $hora = date("H");

            if ($hora >= 0 and $hora < 6) {
                $salutation = "Bom dia";
            } elseif ($hora >= 6 and $hora < 12) {
                $salutation = "Bom dia";
            } elseif ($hora >= 12 and $hora < 18) {
                $salutation = "Boa tarde";
            } else {
                $salutation = "Boa noite";
            }

            return $salutation;
        }

        function removeInArray($array, $listRemove)
        {
            foreach ($array as $key => $list) {
                if ($this->strpos_array($list, $listRemove)) {
                    unset($array[$key]);
                }
            }

            return $array;
        }

        public function truncate($text, $chars = 25, $finish = '...')
        {
            if (strlen($text) <= $chars) {
                return $text;
            }
            $text = $text . " ";
            $text = substr($text, 0, $chars);
            $text = substr($text, 0, strrpos($text, ' '));
            $text = $text . $finish;

            return $text;
        }

        static function cleanString($string)
        {
            return trim(preg_replace('/[`^~\'"]/', NULL, iconv('UTF-8', 'ASCII//TRANSLIT', $string)));
        }

        function array_sort($array, $on, $order = SORT_ASC)
        {
            $new_array = array();
            $sortable_array = array();

            if (count($array) > 0) {
                foreach ($array as $k => $v) {
                    if (is_array($v)) {
                        foreach ($v as $k2 => $v2) {
                            if ($k2 == $on) {
                                $sortable_array[$k] = $v2;
                            }
                        }
                    } else {
                        $sortable_array[$k] = $v;
                    }
                }

                switch ($order) {
                    case SORT_ASC:
                        asort($sortable_array);
                        break;
                    case SORT_DESC:
                        arsort($sortable_array);
                        break;
                }

                foreach ($sortable_array as $k => $v) {
                    $new_array[$k] = $array[$k];
                }
            }

            return $new_array;
        }

        public function getColor($start = 0x000000, $end = 0xFFFFFF)
        {
            return sprintf('#%06x', mt_rand($start, $end));
        }
    }
