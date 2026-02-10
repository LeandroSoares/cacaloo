<?php

namespace App\Utils;

use DateTime;
use DateTimeZone;
use Exception;

class DateHelper
{
    /**
     * Formata uma data para o formato brasileiro.
     */
    public static function format(string|DateTime $date, string $format = 'd/m/Y'): string
    {
        if (is_string($date)) {
            try {
                $date = new DateTime($date);
            } catch (Exception $e) {
                return '';
            }
        }

        return $date->format($format);
    }

    /**
     * Calcula a diferença entre duas datas em dias.
     */
    public static function diffInDays(string|DateTime $date1, string|DateTime $date2): int
    {
        if (is_string($date1)) {
            try {
                $date1 = new DateTime($date1);
            } catch (Exception $e) {
                return 0;
            }
        }

        if (is_string($date2)) {
            try {
                $date2 = new DateTime($date2);
            } catch (Exception $e) {
                return 0;
            }
        }

        $diff = $date1->diff($date2);

        return abs($diff->days);
    }

    /**
     * Verifica se uma data é maior que outra.
     */
    public static function isAfter(string|DateTime $date1, string|DateTime $date2): bool
    {
        if (is_string($date1)) {
            try {
                $date1 = new DateTime($date1);
            } catch (Exception $e) {
                return false;
            }
        }

        if (is_string($date2)) {
            try {
                $date2 = new DateTime($date2);
            } catch (Exception $e) {
                return false;
            }
        }

        return $date1 > $date2;
    }

    /**
     * Adiciona dias a uma data.
     */
    public static function addDays(string|DateTime $date, int $days): DateTime
    {
        if (is_string($date)) {
            try {
                $date = new DateTime($date);
            } catch (Exception $e) {
                return new DateTime;
            }
        }

        return $date->modify("+{$days} days");
    }

    /**
     * Converte uma data de um fuso horário para outro.
     */
    public static function convertTimezone(string|DateTime $date, string $fromTimezone, string $toTimezone): DateTime
    {
        if (is_string($date)) {
            try {
                $date = new DateTime($date, new DateTimeZone($fromTimezone));
            } catch (Exception $e) {
                return new DateTime;
            }
        } else {
            $date = clone $date;
            $date->setTimezone(new DateTimeZone($fromTimezone));
        }

        $date->setTimezone(new DateTimeZone($toTimezone));

        return $date;
    }
}
