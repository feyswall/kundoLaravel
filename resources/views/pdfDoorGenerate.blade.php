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
        <img src="{{ public_path('assets/images/bunge.png') }}" style="margin-left: 280px;margin-top: 5px;width: 120px;">
    </div>

    <div style="display: block;">
        <table style="width: 100%; margin-bottom: 20px;">
            <tbody>
                <tr>
                    <td id="adrSide">
                        {!! $address !!}
                    </td>
                    <td></td>
                    <td>
                        <span style="float: right;">
                            <strong>Tarehe:</strong> {{ date(' d/m/Y') }}
                            <p>{{ $name }}</p>
                        </span>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <div id="main-section">
        {!! $content !!}
    </div>

    <div style="text-align: center; margin-top: 10px;">
        <img src="{{ public_path('assets/images/true_sign.png') }}" style="width: 100px;">
        <div>
            <span style="font-family: Lucida Console, monospace, sans-serif"><i>Mhe.Eng. Kundo Andrea
                    Mathew(Mb)</i></span>
        </div>
        <div id="lowerEnd" style="margin-top: 3px; margin-bottom: 3px; text-align: center;">
            <span style="margin-bottom: 1px; padding: 0px;"><b>MBUNGE JIMBO LA BARIADI</b></span><br>
            <span style="margin-bottom: 1px; padding: 0px;"><b>NA</b></span><br>
            <span><b>NEMBO YA MAENDELEO JIMBO LA BARIADI</b></span><br>
        </div>
    </div>

    <div>
        <div id="copyDiv" style="display: flex;">
            @if( $copy != 'null')
                {!! $copy !!}
            @endif
        </div>
    </div>
</body>

</html>
