<?php

    namespace App\Calendar\Ics;

    use App\Calendar\Calendar;

    class Ics extends Calendar {
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

        function generateICS(bool $isUrl = false): string {
            $params = [];
            $params[] = "BEGIN:VCALENDAR";
            $params[] = "PRODID:-// Kaique Correia Create //PT";
            $params[] = "VERSION:2.0";
            $params[] = "BEGIN:VTIMEZONE";
            $params[] = "TZID:" . self::$timezone;
            $params[] = "BEGIN:STANDARD";
            $params[] = "DTSTART:" . date("Ymd\THis");
            $params[] = "TZOFFSETFROM:-0300";
            $params[] = "TZOFFSETTO:-0300";
            $params[] = "TZNAME:-03";
            $params[] = "END:STANDARD";
            $params[] = "END:VTIMEZONE";
            $params[] = "BEGIN:VEVENT";
            $params[] = "DTSTAMP:" . date("YmdTHisZ");
            $params[] = "STATUS:CONFIRMED";
            $params[] = "UID:" . self::$uid;
            $params[] = "SEQUENCE:0";

            if (self::$allDay) {
                $params[] = "DTSTART;TZID=" . self::$timezone . ":" . date("Ymd\THis", strtotime(self::$dtStart));
                $params[] = "DTEND;TZID=" . self::$timezone . ":" . date("Ymd\THis", strtotime(self::$dtEnd));
            } else {
                $params[] = "DTSTART;VALUE=DATE:" . date("Ymd", strtotime(self::$dtStart));
                $params[] = "DTEND;VALUE=DATE:" . date("Ymd", strtotime(self::$dtEnd));
            }

            $params[] = "SUMMARY:" . self::$title;
            $params[] = "DESCRIPTION:" . self::$details;
            $params[] = "LOCATION:" . self::$location;
            $params[] = "BEGIN:VALARM";
            $params[] = "TRIGGER:-PT30M";
            $params[] = "ACTION:DISPLAY";
            $params[] = "DESCRIPTION:Reminder";
            $params[] = "END:VALARM";
            $params[] = "TRANSP:OPAQUE";
            $params[] = "END:VEVENT";
            $params[] = "END:VCALENDAR";
            return $isUrl ? 'data:text/calendar;charset=utf8;base64,' . base64_encode(implode("\r\n", $params)) :
                implode("\r\n", $params);
        }
    }