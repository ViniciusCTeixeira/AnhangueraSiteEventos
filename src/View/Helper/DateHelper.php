<?php

    namespace App\View\Helper;

    use Cake\Chronos\Date;
    use Cake\View\Helper;
    use Cake\View\Helper\HtmlHelper;
    use Cake\View\View;
    use Cake\I18n\Time;

    class DateHelper extends HtmlHelper
    {
        public function __construct(View $view, $config = [])
        {
            parent::__construct($view, $config);
        }

        public function longDate($date = FALSE, $day_week = TRUE, $day_week_full = TRUE, $year = TRUE, $month = FALSE)
        {
            if ($date) {
                $month = date('m', strtotime($date));
            } else {
                $month = date('m');
                $date = date('Y-m-d');
            }

            $monthes = array(
                '01' => 'Janeiro',
                '02' => 'Fevereiro',
                '03' => 'Março',
                '04' => 'Abril',
                '05' => 'Maio',
                '06' => 'Junho',
                '07' => 'Julho',
                '08' => 'Agosto',
                '09' => 'Setembro',
                '10' => 'Outubro',
                '11' => 'Novembro',
                '12' => 'Dezembro'
            );
            $dias = array
            (
                0 => 'Domingo',
                1 => 'Segunda-feira',
                2 => 'Terça-feira',
                3 => 'Quarta-feira',
                4 => 'Quinta-feira',
                5 => 'Sexta-feira',
                6 => 'Sábado'
            );

            return ($month ? $monthes[$month] : '') . ($day_week ? $dias[date('w', strtotime($date))] : '') . (($day_week and $day_week_full) ? ', ' : '') . ($day_week_full ? date('d', strtotime($date)) . ' de ' . $monthes[$month] : '') . ($year ? ' de ' . date('Y', strtotime($date)) : '');
        }

        public function humanizeDate($date, $perDay = FALSE)
        {
            if (!empty($date) and !in_array($date, array('00-00-0000', '0000-00-00', '0000-00-00 00:00:00', '00-00-0000 00:00:00'))) {
                $timestamp = strtotime($date);
                $date = date("Y-m-d", strtotime($date));

                //type cast, current time, difference in timestamps
                $timestamp = (int)$timestamp;
                $current_time = time();
                $diff = $current_time - $timestamp;

                //intervals in seconds
                $intervals = array(
                    'year' => 31556926, 'month' => 2629744, 'week' => 604800, 'day' => 86400, 'hour' => 3600, 'minute' => 60
                );

                $day = [
                    0 => 'Domingo',
                    1 => 'Segunda-feira',
                    2 => 'Terça-feira',
                    3 => 'Quarta-feira',
                    4 => 'Quinta-feira',
                    5 => 'Sexta-feira',
                    6 => 'Sábado'
                ];

                if ($perDay === FALSE) {
                    if ($timestamp > strtotime(date('Y-m-d H:i:s'))) {
                        return date('d/m/Y', $timestamp) . ' às ' . date('H:i', $timestamp);
                    }

                    if ($diff < 60) {
                        return $diff == 1 ? $diff . ' segundo atrás' : $diff . ' segundos atrás';
                    }

                    //- Minutos
                    if ($diff <= $intervals['hour']) {
                        $diff = floor($diff / $intervals['minute']);

                        return $diff . ' minutos atrás';
                    }
                }

                //- Data para o futuro
                if (strtotime($date) > strtotime(date('Y-m-d'))) {
                    return date('d/m/Y', $timestamp) . ' às ' . date('H:i', $timestamp);
                }

                //- Hoje
                if (strtotime($date) == strtotime(date('Y-m-d'))) {
                    return date('H:i', $timestamp);
                }

                //- Ontem
                if (strtotime($date) == strtotime(date('Y-m-d', strtotime("-1 days")))) {
                    return 'Ontem às ' . date('H:i', $timestamp);
                }

                //- Semana
                if ($diff >= $intervals['day'] && $diff < $intervals['week']) {
                    return $day[date('w', strtotime($date))] . ' às ' . date('H:i', $timestamp);
                }

                //- Depois de 1 semana até o inio do ano anterior
                if ($diff > $intervals['week'] && date('Y', $timestamp) == date('Y')) {
                    return date('d/m', $timestamp) . ' às ' . date('H:i', $timestamp);
                }

                //- Se for menor que o ano atual
                if (date('Y', $timestamp) < date('Y')) {
                    return date('d/m/Y', $timestamp) . ' às ' . date('H:i', $timestamp);
                }
            } else {
                return 'não informado';
            }
        }

        public function humanizeDateDay($date)
        {
            if (!empty($date) and !in_array($date, array('00-00-0000', '0000-00-00', '0000-00-00 00:00:00', '00-00-0000 00:00:00'))) {
                $timestamp = strtotime($date);
                $date = date("Y-m-d", strtotime($date));

                //type cast, current time, difference in timestamps
                $timestamp = (int)$timestamp;
                $current_time = time();
                $diff = $current_time - $timestamp;

                //intervals in seconds
                $intervals = array(
                    'year' => 31556926, 'month' => 2629744, 'week' => 604800, 'day' => 86400, 'hour' => 3600, 'minute' => 60
                );

                $day = [
                    0 => 'Domingo',
                    1 => 'Segunda-feira',
                    2 => 'Terça-feira',
                    3 => 'Quarta-feira',
                    4 => 'Quinta-feira',
                    5 => 'Sexta-feira',
                    6 => 'Sábado'
                ];

                //- Hoje
                if (strtotime($date) == strtotime(date('Y-m-d'))) {
                    return 'Hoje';
                }

                //- Ontem
                if (strtotime($date) == strtotime(date('Y-m-d', strtotime("-1 days")))) {
                    return 'Ontem';
                }

                //- Semana
                if ($diff >= $intervals['day'] && $diff <= (8 * $intervals['day'])) {
                    return $day[date('w', strtotime($date))];
                }

                //- Depois de 1 semana até o inio do ano anterior
                if ($diff > $intervals['week'] && date('Y', $timestamp) == date('Y')) {
                    return date('d/m', $timestamp);
                }

                //- Se for menor que o ano atual
                if (date('Y', $timestamp) < date('Y')) {
                    return date('d/m/Y', $timestamp);
                }
            } else {
                return '';
            }
        }

        public function formatDate($date, $lang = 'br', $hour = FALSE, $separator = '/')
        {
            try {
                if (empty($date) || in_array($date, array('00-00-0000', '0000-00-00', '0000-00-00 00:00:00', '00-00-0000 00:00:00', '00/00/0000', '0000/00/00', '0000/00/00 00:00:00', '00/00/0000 00:00:00'))) {
                    return '';
                }

                if ($lang == 'us-year-month') {
                    $date = explode('-', $date);
                    $date = $date[1] . '-' . $date[0];
                }

                if (!is_object($date)) {
                    $date = str_replace('/', '-', $date);
                }

                $date = new Time($date);

                if ($lang == 'us') {
                    return $date->format('Y' . $separator . 'm' . $separator . 'd' . ($hour ? ' H:i:s' : ''));
                } elseif ($lang == 'us-year-month') {
                    return $date->format('Y' . $separator . 'm');
                } elseif ($lang == 'ymd') {
                    return $date->format('Y' . 'm' . 'd');
                } elseif ($lang == 'YmdHi') {
                    return $date->format('Y' . 'm' . 'd' . ($hour ? 'Hi' : ''));
                } elseif ($lang == 'br') {
                    return $date->format('d' . $separator . 'm' . $separator . 'Y' . ($hour ? ' H:i:s.u' : ''));
                } elseif ($lang == 'br-year-month') {
                    return $date->format('m' . $separator . 'Y');
                } elseif ($lang == 'day-month') {
                    return $date->format('d' . $separator . 'm');
                } elseif ($lang == 'microtime') {
                    return strtotime($date->format('Y-m-d H:i:s')) . '.' . $date->format('u');
                } elseif ($lang == 'us-calendar') {
                    return $date->format('Y' . $separator . 'm' . $separator . 'd') . 'T' . $date->format('H:i:s');
                } else {
                    return FALSE;
                }
            } catch (Exception $e) {
                return FALSE;
            }
        }

        public function convertDate($date, $separator = '/', $hour = FALSE)
        {
            try {
                if (empty($date) or in_array($date, array('00-00-0000', '0000-00-00', '0000-00-00 00:00:00', '00-00-0000 00:00:00', '00/00/0000', '0000/00/00', '0000/00/00 00:00:00', '00/00/0000 00:00:00')))
                    return FALSE;

                if ($separator == '/') {
                    $date = str_replace('/', '-', $date);
                } elseif ($separator == '-') {
                    $date = str_replace('-', '/', $date);
                } elseif (!$this->validDate($date)) {
                    return FALSE;
                } else {
                    return FALSE;
                }

                $date = new Time($date);

                if ($hour) {
                    return new \DateTime($date->format('Y' . $separator . 'm' . $separator . 'd H:i:s.u'));
                } else {
                    return new Date($date->format('Y' . $separator . 'm' . $separator . 'd'));
                }

            } catch (\Exception $e) {
                return '';
            }
        }

        function multiExplode($delimiters, $string)
        {
            $ready = str_replace($delimiters, $delimiters[0], $string);
            $launch = explode($delimiters[0], $ready);

            return $launch;
        }

        public function validDate($date)
        {
            $date_explode = $this->multiExplode(['/', '-'], $date);

            if (strlen($date_explode[0]) == 2) {
                $date = \DateTime::createFromFormat('d/m/Y', $date);
                $date_errors = \DateTime::getLastErrors();
            } else {
                $date = \DateTime::createFromFormat('Y/m/d', $date);
                $date_errors = \DateTime::getLastErrors();
            }

            if ($date_errors['warning_count'] > 0) {
                return FALSE;
            } else {
                return TRUE;
            }
        }

        public function dateDiff($start, $end, $inYears = FALSE, $inMonths = FALSE, $inWeeks = FALSE, $inDays = FALSE, $inHours = FALSE, $inMinutes = FALSE, $inSeconds = FALSE)
        {
            try {
                $intervals = [
                    'year' => 31556926, 'month' => 2629744, 'week' => 604800, 'day' => 86400, 'hour' => 3600, 'minute' => 60
                ];

                $start = new Time($start);
                $end = new Time($end);

                $start_timestamp = (int)strtotime($start->format('Y-m-d H:i:s'));
                $end_timestamp = (int)strtotime($end->format('Y-m-d H:i:s'));
                $diff = $end_timestamp - $start_timestamp;

                $return = [
                    'year' => floor($diff / $intervals['year']),
                    'month' => floor($diff / $intervals['month']),
                    'week' => floor($diff / $intervals['week']),
                    'day' => floor($diff / $intervals['day']),
                    'hour' => floor($diff / $intervals['hour']),
                    'minute' => floor($diff / $intervals['minute']),
                    'second' => $diff,
                ];

                if ($inYears) {
                    return $return['year'];
                } elseif ($inMonths) {
                    return $return['month'];
                } elseif ($inWeeks) {
                    return $return['week'];
                } elseif ($inDays) {
                    return $return['day'];
                } elseif ($inHours) {
                    return $return['hour'];
                } elseif ($inMinutes) {
                    return $return['minute'];
                } elseif ($inSeconds) {
                    return $return['second'];
                } else {
                    return $return;
                }
            } catch (Exception $e) {
                return FALSE;
            }
        }

        public function daysBetweenDate($date_int, $date_end)
        {
            try {

                $days = array();

                for ($date = strtotime($date_int); $date <= strtotime($date_end); $date = strtotime("+1 day", $date)) {
                    $days[] = date("Y-m-d", $date);
                }

                return $days;
            } catch (Exception $e) {
                return FALSE;
            }
        }

        public function monthsBetweenDate($date_int, $date_end, $year = TRUE)
        {
            try {

                $months = array();

                for ($date = strtotime($date_int); $date < strtotime($date_end); $date = strtotime("+1 MONTH", $date)) {
                    $months[] = (($year) ? date("Y-m", $date) : date("m", $date));
                }

                return $months;
            } catch (Exception $e) {
                return FALSE;
            }
        }

        public function generateYears($range, $up = FALSE)
        {
            try {
                $year_down = date("Y-m-d", strtotime('-' . (($up) ? ($range / 2) : $range) . ' YEAR', strtotime(date('Y-m-d'))));

                $years = array();
                while ($range >= 0) {
                    $diff = strtotime('+' . $range . 'YEAR', strtotime($year_down));
                    $years[date("Y", $diff)] = date("Y", $diff);
                    $range--;
                }

                return $years;
            } catch (Exception $e) {
                return FALSE;
            }
        }

        public function generateMonthsInstallments($date, $number_installments)
        {
            try {

                $installments = array();
                $number_installments = (($number_installments == NULL or $number_installments == '') ? 1 : $number_installments);

                for ($i = 0; $i < $number_installments; ++$i) {
                    $installments[] = array('month' => date("Y-m-d", strtotime("+" . $i . " MONTH", strtotime($date))), 'installment' => $i + 1);
                }

                return $installments;
            } catch (Exception $e) {
                return FALSE;
            }
        }

        public function getDayOfWeek($timestamp)
        {
            $date = getdate($timestamp);
            $diaSemana = $date['weekday'];

            if (preg_match('/(sunday|domingo)/mi', $diaSemana))
                $diaSemana = 'Domingo';
            else if (preg_match('/(monday|segunda)/mi', $diaSemana))
                $diaSemana = 'Segunda';
            else if (preg_match('/(tuesday|terça)/mi', $diaSemana))
                $diaSemana = 'Terça';
            else if (preg_match('/(wednesday|quarta)/mi', $diaSemana))
                $diaSemana = 'Quarta';
            else if (preg_match('/(thursday|quinta)/mi', $diaSemana))
                $diaSemana = 'Quinta';
            else if (preg_match('/(friday|sexta)/mi', $diaSemana))
                $diaSemana = 'Sexta';
            else if (preg_match('/(saturday|sábado)/mi', $diaSemana))
                $diaSemana = 'Sábado';

            return $diaSemana;
        }

        public function businessDay($date, $day = TRUE)
        {
            $new_date = explode('-', $date);
            $data = mktime(0, 0, 0, $new_date[1], $new_date[2], $new_date[0]);
            $dia_semana = date("w", $data);

            if ($day) {
                if (($dia_semana != 0) && ($dia_semana != 6)) {
                    return $date;
                } else {
                    if ($dia_semana == 0) {
                        return date("Y-m-d", strtotime("-2 DAY", strtotime($date)));
                    }

                    if ($dia_semana == 6) {
                        return date("Y-m-d", strtotime("-1 DAY", strtotime($date)));
                    }
                }
            } else {
                if (($dia_semana != 0) && ($dia_semana != 6)) {
                    return TRUE;
                } else {
                    return FALSE;
                }
            }
        }

        public function lastBusinessDayMonth($month, $year)
        {
            $dias = cal_days_in_month(CAL_GREGORIAN, $month, $year);
            $ultimo = mktime(0, 0, 0, $month, $dias, $year);
            $dia = date("j", $ultimo);
            $dia_semana = date("w", $ultimo);

            if ($dia_semana == 0) {
                $dia--;
                $dia--;
            }
            if ($dia_semana == 6)
                $dia--;
            $ultimo = mktime(0, 0, 0, $month, $dia, $year);

            return date("Y-m-d", $ultimo);
        }

        public function hoursRange($lower = 0, $upper = 86400, $step = 3600, $format = '')
        {
            $times = array();

            if (empty($format)) {
                $format = 'g:i a';
            }

            foreach (range($lower, $upper, $step) as $increment) {
                $increment = gmdate('H:i', $increment);

                list($hour, $minutes) = explode(':', $increment);

                $date = new Time($hour . ':' . $minutes);

                $times[(string)$increment] = $date->format($format);
            }

            return $times;
        }

        public function minutesRange()
        {
            $options = array();
            $min = array('00', '30');
            foreach (range(0, 23) as $fullhour) {
                foreach ($min as $int) {
                    $options[(($fullhour < 10) ? '0' . $fullhour : $fullhour) . ":" . $int] = (($fullhour < 10) ? '0' . $fullhour : $fullhour) . ":" . $int;
                }
            }

            return $options;
        }

        public function convertIntInhours($input, $humanized = FALSE)
        {
            $seconds = intval($input); //Converte para inteiro

            $negative = $seconds < 0; //Verifica se é um valor negativo

            if ($negative) {
                $seconds = -$seconds; //Converte o negativo para positivo para poder fazer os calculos
            }

            //intervals in seconds
            $intervals = array(
                'year' => 31556926, 'month' => 2629744, 'week' => 604800, 'day' => 86400, 'hour' => 3600, 'minute' => 60
            );

            $hours = floor($seconds / $intervals['hour']);
            $mins = floor(($seconds - ($hours * $intervals['hour'])) / $intervals['minute']);
            $secs = floor($seconds % $intervals['minute']);

            $sign = $negative ? '-' : ''; //Adiciona o sinal de negativo se necessário

            if ($humanized) {
                return (($hours) ? $hours . ' ' . (($hours > 1) ? 'horas' : 'hora') : '') . (($mins) ? (($hours > 1) ? ',' : '') . $mins . ' ' . (($mins > 1) ? ' minutos' : ' minuto') : '') . (($secs) ? (($mins > 1) ? ' e ' : '') . $secs . (($secs > 1) ? ' segundos ' : ' segundo ') : '');
            } else {
                return $sign . sprintf('%02d:%02d:%02d', $hours, $mins, $secs);
            }
        }
    }
