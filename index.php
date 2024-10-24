<?php
    include './vendor/autoload.php';

    $true = [
        "title" => "teste com php",
        "dtStart" => "2024-10-23",
        "dtEnd" => "2024-10-23",
        "details" => "detahles",
        "location" => "jose moreira 429",
        "timezone" => "America/Sao_Paulo",
        "remind" => "15",
        "allDay" => true,
        "eventPrivate" => false
    ];

    $false = [
        "title" => "teste com php",
        "dtStart" => "2024-10-23 07:00:00",
        "dtEnd" => "2024-10-24 22:00:00",
        "details" => "detahles",
        "location" => "jose moreira 429",
        "timezone" => "America/Sao_Paulo",
        "remind" => "15",
        "allDay" => false,
        "eventPrivate" => false
    ];

    $link = (new \App\Calendar\Google\Google(...$true))->link();
    $link2 = (new \App\Calendar\Google\Google(...$false))->link();
    $link3 = (new \App\Calendar\Yahoo\Yahoo(...$true))->link();
    $link4 = (new \App\Calendar\Yahoo\Yahoo(...$false))->link();

    $link5 = (new \App\Calendar\Outlook\Outlook(...$true))->webOutlook();
    $link6 = (new \App\Calendar\Outlook\Outlook(...$false))->webOutlook();

    $link7 = (new \App\Calendar\Outlook\Outlook(...$true))->webOffice();
    $link8 = (new \App\Calendar\Outlook\Outlook(...$false))->webOffice();

   $link9 = (new \App\Calendar\ICS\Ics(...$false))->generateICS();

    echo <<<HTML
<p><a href="$link" target="_blank"> <p>$link</p></a></p>
<p><a href="$link2" target="_blank"><p>$link2</p></a></p>

<p><a href="$link3" target="_blank"><p>$link3</p></a></p>
<p><a href="$link4" target="_blank"><p>$link4</p></a></p>

<p><a href="$link5" target="_blank"><p>$link5</p></a></p>
<p><a href="$link6" target="_blank"><p>$link6</p></a></p>


<p><a href="$link7" target="_blank"><p>$link7</p></a></p>
<p><a href="$link8" target="_blank"><p>$link8</p></a></p>
<p><a href="$link9" download="evento.ics">$link9</a></p>
HTML;

