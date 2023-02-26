<?php
/**
 * Created by feyswal on 2/10/2023.
 * Time 11:11 AM.
 * EastCoders & G3NET.
 * contacts: +255 628 960 877
 */

?>


        <!DOCTYPE html>
<html>
<head>
    <title>Laravel 9 Generate PDF Example - ItSolutionStuff.com</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style>
        @page {
            size: letter;
            margin: 20mm;
        }
    </style>
</head>

<body>
<div style="text-align: center; margin: 0 auto;">
    <h5><b>JAMHURI YA MUUNGANO WA TANZANIA</b></h5>
    <hr style="width: 70%; margin: auto; ">
    <div style="width: 70%; text-align: center; margin: 10px auto;">
        <h6><?php echo strtoupper("Ofisi Ya Mbunge wa Jimbo la Bariadi") ;?></h6>
    </div>
</div>
<div>
    <img src="{{ public_path('assets/images/bunge.png') }}"  style="margin-left: 250px; width: 150px;">
</div>

<div style="text-align: right;">
    <strong>Tarehe:</strong> {{ date(' d, m/Y') }}
</div>

<div style="margin-top: 10px;">
    <strong>Eng. Kundo Andrea Mathew:</strong><br>
    Naibu Waziri,<br>
    Wizara Habari, Mawasiliano na Teknolojia ya Habari ,<br>
    Dodoma- Magufuli City <br>
</div>

<div style="margin-top: 20px; text-align: center; width: 80%; margin-left: 50px;">
    <h5 style="margin: 0px; padding: 0px;"> <span style="font-family: sans-serif;">YAH :</span> {{ $yahusu }}</h5>.
</div>

@foreach( $sials as $sial )
    <div style="margin-top: 10px;">
        {{ $sial }}
    </div>
@endforeach

<div style="margin-top: 30px;">
    *Wako mtiifu katika ujenzi wa mawasiliano Bora katika Taifa.
</div>

<div style="text-align: center; margin-top: 10px;">
    <img src="{{ public_path('assets/images/sign.jpeg') }}"  style="width: 120px;">
    <div>
        <span style="font-family: "Lucida Console", monospace, sans-serif"><i>Eng: Nkundo Mathew</i></span>
    </div>
</div>

<div>
    <div style="display: flex;">
        <b>Nakala : </b>
        <div style="margin-left: 70px; margin-top: 10px;">
            <span style="display: block;">Wajumbe wa Mkutano Mkuu Tarafa</span>
            <span style="display: block;">Diwani</span>
            <span style="display: block;">Wenyeviti Umoja wa Wazazi Kata</span>

        </div>
    </div>
</div>
</body>

</html>
