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
    <title></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style>
        * {
            font-size: 0.98em;
            font-family: 'Times New Roman',
        }

        @page {
            size: letter;
            margin: 20mm;
        }

        /**
  * Define the width, height, margins and position of the watermark.
  **/
        #watermark {
            position: fixed;

            /**
                Set a position in the page for your image
                This should center it vertically
            **/
            bottom: 8cm;
            left: 6.2cm;

            /** Change image dimensions**/
            width: 8cm;
            height: 8cm;

            /** Your watermark should be behind every content**/
            z-index: -1000;

            opacity: 0.05;
        }

        #adrSide p{
            margin: 0;
            font-size: 1em;
        }
        #copyDiv p{
            margin: 0;
            font-size: 1em;
        }
        td p {
            margin: 0;
        }
        #main-section ul, ol{
            margin-top: 2px;
        }
        #main-section p{
            margin-bottom: 0;
            padding-bottom: 0;
        }
    </style>
</head>

<body>

<div id="watermark">
    <img src="{{ public_path('assets/images/kLogo2.jpeg') }}" height="90%" width="90%" />
</div>

<div style="text-align: center; margin: 0px auto;">
    <h5 style="padding: 0px; margin: 0px;"><b>JAMHURI YA MUUNGANO WA TANZANIA</b></h5>
    <hr style="width: 50%; margin: 3px auto; border: 1px solid gray;">
    <h6 style="padding: 0px; margin: 0px;"><?php echo strtoupper('Ofisi Ya Mbunge wa Jimbo la Bariadi'); ?></h6>
</div>
<div>
    <img src="{{ public_path('assets/images/bunge.png') }}" style="margin-left: 280px;margin-top: 5px;width: 100px;">
</div>

<div id="main-section">
    {!! $changamoto !!}
</div>

<div style="text-align: center; margin-top: 10px;">
    <div style="text-align: center">
        .....................
    </div>
    <div>
        <span style="font-family: "Lucida Console", monospace, sans-serif"><i>
            Mhe. {{ $firstName }} {{ $lastName }}</i></span>
    </div>
</div>

</body>

</html>
