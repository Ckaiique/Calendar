<?php

    namespace App\Calendar\Yahoo;

    use App\Calendar\Calendar;

    class Yahoo extends Calendar {
        private static string $url = "https://calendar.yahoo.com";

        public function __construct(
            string $title,
            string $dtStart,
            string $dtEnd,
            string $details,
            string $location,
            string $timezone,
            string $remind = "",
            bool $allDay = false,
            bool $eventPrivate = false
        ) {
            parent::__construct(
                $title,
                $dtStart,
                $dtEnd,
                $details,
                $location,
                $timezone,
                $remind,
                $allDay,
                $eventPrivate
            );
        }

        public function link() {
            $dtIni = date(self::$allDay ? "Ymd" : "Ymd\THis", strtotime(self::$dtStart));
            $dtEnd = date(self::$allDay ? "Ymd" : "Ymd\THis", strtotime(self::$dtEnd));

            $params = array(
                "v" => "60", // Versão da API (a versão 60 é usada para eventos)
                "view" => "d", // Visualização do calendário ('d' para dia, 'm' para mês, etc.)
                "type" => "20", // Tipo de evento (20 representa um evento de dia inteiro)
                "TITLE" => self::$title,
                "ST" => $dtIni,
                "ET" => $dtEnd,
                "DESC" => self::$details,
                "in_loc" => self::$location,
                "UID" => self::$uid,
                "remind" => self::$remind ?? "15",
                "repeat" => "daily",
                "cat" => "Meetings",
            );

            if (self::$eventPrivate) {
                $params['private'] = self::$eventPrivate;
            }

             if (self::$allDay) {
                 $params['DUR'] = "allday";
             }

            return self::$url . '?' . http_build_query($params);
        }


    }