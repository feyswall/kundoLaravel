<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <!-- include libraries(jQuery, bootstrap) -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <!-- include summernote css/js -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
</head>

<body>
    <div class="container">
        <h5 class="lead mt-3 mb-4">Pdf Generator For KIMS </h5>
        <a href="{{ route('pdf.door.index') }}" class="btn btn-primary btn-md mb-5"><< rudi kwenye orodha</a>
<form method="post" action="{{ route('pdf.door.store') }}" target="_blank">
        @csrf
        <label for="content">Anuani ya mpokeaji</label>
        <textarea class="summernoteOne" name="address" rows="4"></textarea>

        <label for="copy">Andika Barua</label>
        <textarea class="summernoteTwo" name="content" rows="30"></textarea>

        <label for="copy">Nakala</label>
        <textarea class="summernoteThree" name="copy" rows="5"></textarea>

        <div>
            <button class="btn btn-primary btn-md" type="submit" name="btn" value="send">tuma</button>
            <button class="btn btn-warning btn-md" type="submit" name="btn" value="test">jaribu</button>
        </div>
    </form>

    </div>

    <script>
        $(document).ready(function() {
            $('.summernoteOne').summernote({
                height: 100,
                focus: true,
            });

            $('.summernoteTwo').summernote({
                height: 400,
                focus: true,
            });

            $('.summernoteThree').summernote({
                height: 200,
                focus: true,
            });

        });
    </script>
</body>

</html>
