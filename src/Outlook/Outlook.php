<?php

    namespace App\Calendar\Outlook;

    use App\Calendar\Calendar;

    class Outlook extends Calendar {
        private static string $url;

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

        private function link(): string {
            $dtIni = date(self::$allDay ? "Y-m-d" : "Y-m-d\TH:i:s\Z", strtotime(self::$dtStart));
            $dtEnd = date(self::$allDay ? "Y-m-d" : "Y-m-d\TH:i:s\Z", strtotime(self::$dtEnd));

            $params = array(
                "path" => "/calendar/action/compose",
                "rru" => "addevent",
                "startdt" => $dtIni,
                "enddt" => $dtEnd,
                "subject" => self::$title,
                "location" => self::$location,
                "body" => self::$details,
                "allday" => self::$allDay ? "true" : "false",
                "uid" => self::$uid
            );

            if (self::$eventPrivate) {
                $params['private'] = self::$eventPrivate;
            }

            return self::$url . '?' . http_build_query($params);
        }

        public function linkDownloadOutlook($url): void {
        }

        public function webOutlook(): string {
            self::$url = "https://outlook.live.com/calendar/action/compose";
            return $this->link();
        }

        public function webOffice(): string {
            self::$url = "https://outlook.office.com/calendar/action/compose";
            return $this->link();
        }

    }