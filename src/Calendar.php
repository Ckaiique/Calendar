<?php

    namespace App\Calendar;

    class Calendar {

        public static ?string $uid;
        public static string $title;
        public static string $dtStart;
        public static string $dtEnd;
        public static string $details;
        public static string $location;
        public static string $timezone;
        public static string $remind;
        public static bool $allDay;
        public static bool $eventPrivate;

        /**
         * @param string $title Título do evento
         * @param string $dtStart Data Ini
         * @param string $dtEnd Data fim
         * @param string $details Descrição detalhada do evento
         * @param string $location Localização do evento
         * @param string $timezone Fuso horário do evento
         * @param string $remind Lembrete 15 minutos antes do evento (opcional, se suportado)
         * @param bool $allDay Indica que o evento não é de dia inteiro; pode ser "true" para eventos de dia inteiro
         * @param bool $eventPrivate Indica se o evento é privado (opcional, se suportado)
         */

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
            self::$title = $title;
            self::$dtStart = $dtStart;
            self::$dtEnd = $dtEnd;
            self::$details = $details;
            self::$location = $location;
            self::$timezone = $timezone;
            self::$remind = $remind;
            self::$allDay = $allDay;
            self::$eventPrivate = $eventPrivate;
            self::$uid = self::generateEventUid();
        }

        private static function generateEventUid(): string {
            return md5(
                sprintf(
                    '%s%s%s%s',
                    date("Ymd\THis", strtotime(self::$dtStart)),
                    date("Ymd\THis", strtotime(self::$dtEnd)),
                    self::$title,
                    self::$location
                )
            );
        }

    }