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

        p {
            margin-bottom: 6px;
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
    </style>
</head>

<body>

    <div id="watermark">
        <img src="{{ public_path('assets/images/kLogo2.jpeg') }}" height="90%" width="90%" />
    </div>

    <div style="text-align: center; margin: 0px auto;">
        <h5 style="padding: 0px; margin: 0px;"><b>JAMHURI YA MUUNGANO WA TANZANIA</b></h5>
        <hr style="width: 50%; margin-left: auto;">
        <h6 style="padding: 0px; margin: 0px;"><?php echo strtoupper('Ofisi Ya Mbunge wa Jimbo la Bariadi'); ?></h6>
    </div>
    <div>
        <img src="{{ public_path('assets/images/bunge.png') }}" style="margin-left: 280px; width: 120px;">
    </div>

    <div style="display: block;">
        <table style="width: 100%">
            <tbody>
                <tr>
                    <td>
                        <span style="float: left;">
                            @foreach( $sendTo as $to )
                                <strong>{{ ucfirst($to->posts->first()->name) }}</strong><br>
                            @endforeach
                            S.L.P.54,<br>
                            BARIADI,<br>
                        </span>
                    </td>
                    <td></td>
                    <td>
                        <span style="float: right;">
                            <strong>Tarehe:</strong> {{ date(' d/m/Y') }}
                            @php
                            $number = \App\Models\PdfDoor::all()->count();
                            $year = \Carbon\Carbon::now()->format("Y");
                            $number = $number + 1;
                            $name = 'SMY-BRD/EKAM40/' . $year . '-000' . $number;
                            @endphp
                            <p>{{ $name }}</p>
                        </span>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <div style="margin-top: 0px; margin-bottom: 0px;">
        <p style="font-size: 0.97em">{!! $sials !!}</p>
    </div>

    <div style="margin-top: 10px;">
        <p><b>Wako mtiifu katika ujenzi wa chama na Taifa letu</b></p>
    </div>

    <div style="text-align: center; margin-top: 10px;">
        <img src="{{ public_path('assets/images/true_sign.png') }}" style="width: 100px;">
        <div>
            <span style="font-family: "Lucida Console", monospace, sans-serif"><i>Mhe.Eng. Kundo Andrea
                    Mathew(Mb)</i></span>
        </div>
        <div id="lowerEnd" style="margin-top: 3px; margin-bottom: 3px; text-align: center;">
            <span style="margin-bottom: 1px; padding: 0px;"><b>MBUNGE JIMBO LA BARIADI</b></span><br>
            <span style="margin-bottom: 1px; padding: 0px;"><b>NA</b></span><br>
            <span><b>NEMBO YA MAENDELEO JIMBO LA BARIADI</b></span><br>
        </div>
    </div>

    <div>
        <div style="display: flex;">
            <b>Nakala :- </b>
            <div style="margin-left: 40px; margin-top: 5px;">
                @foreach ($copyTo as $leader)
                    <span style="display: block;">{{ ucfirst($leader->posts->first()->name) }}</span>
                @endforeach
            </div>
        </div>
    </div>
</body>

</html>
