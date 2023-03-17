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
    <div class="container-fluid">
<form method="post" action="{{ route('pdf.door.store') }}">
        @csrf
        <label for="content">Anuani ya mpokeaji</label>
        <textarea class="summernote" name="address" rows="4"></textarea>

        <label for="copy">Andika Barua</label>
        <textarea class="summernote" name="content" rows="30"></textarea>

        <label for="copy">Nakala</label>
        <textarea class="summernote" name="copy" rows="5"></textarea>

        <div>
            <button class="btn btn-primary btn-md" type="submit">tuma</button>
        </div>
    </form>
    </div>

    <script>
        $(document).ready(function() {
            $('.summernote').summernote({
                height: 400,
                focus: true,
            });
        });
    </script>
</body>

</html>
