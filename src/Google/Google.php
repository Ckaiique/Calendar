<?php

    namespace App\Calendar\Google;

    use App\Calendar\Calendar;

    class Google extends Calendar {

        private static string $url = "https://calendar.google.com/calendar/u/0/r/eventedit";

        public function __construct(
            string $title,
            string $dtStart,
            string $dtEnd,
            string $details,
            string $location,
            string $timezone,
            string $remind = "",
            bool $allDay = false,
            bool $eventPrivate = false,
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

        public function link(): string {
            $dtIni = date(self::$allDay ? "Ymd" : "Ymd\THis", strtotime(self::$dtStart));
            $dtEnd = date(self::$allDay ? "Ymd" : "Ymd\THis", strtotime(self::$dtEnd));

            $params = array(
                "text" => self::$title,
                "dates" => "$dtIni/$dtEnd",
                "ctz" => self::$timezone,
                "details" => self::$details,
                "location" => self::$location,
                "pli" => "1",
                "uid" => self::$uid,
                "sf" => "true",
                "output" => "xml",
                "allday" => self::$allDay,
                "remind" => self::$remind ?? "15"
            );

            if (self::$eventPrivate) {
                $params['private'] = self::$eventPrivate;
            }

            return self::$url . '?' . http_build_query($params);
        }

    }