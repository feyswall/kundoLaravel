@extends('layouts.super_system')

@section('extra_style')
    <!-- include summernote css/js -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-lite.min.css"
    integrity="sha256-IKhQVXDfwbVELwiR0ke6dX+pJt0RSmWky3WB2pNx9Hg=" crossorigin="anonymous">
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
        <div class="container">
        <h5 class="lead mt-3 mb-2">Pdf Generator For KIMS </h5>
        <a href="{{ route('pdf.door.index') }}" class="btn btn-primary btn-sm mb-2"><< rudi kwenye orodha</a>
        <form method="post" action="{{ route('pdf.door.store') }}" id="pdfForm">
            @csrf
            <div class="mb-3">
                <label for="content">Anuani ya mpokeaji</label>
                <textarea class="summernoteOne" name="address" rows="4" required></textarea>
            </div>

            <div class="mb-3">
                <label for="copy">Andika Barua</label>
                <textarea class="summernoteTwo" name="content" rows="30" required></textarea>
            </div>

            <label for="copy">Nakala</label>
            <textarea class="summernoteThree" name="copy" rows="5"></textarea>

            <div class="mt-3">
                <button class="btn btn-primary btn-sm" id="sendBtn" type="button" name="btn" value="send">tuma</button>
                <button class="btn btn-warning btn-sm" id="testBtn" type="button" name="btn" value="test">jaribu</button>
            </div>
        </form>

    </div>
        </div>
    </div>
@endsection

@section('extra_script')
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-lite.min.js"
    integrity="sha256-5slxYrL5Ct3mhMAp/dgnb5JSnTYMtkr4dHby34N10qw=" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            $('.summernoteOne').summernote({
                height: 100,
                focus: true,
                toolbar: [
                    ['font', ['bold']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['view', ['fullscreen']],
                ],
            });

            $('.summernoteTwo').summernote({
                height: 400,
                focus: true,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'italic', 'underline', 'clear']],
                    ['fontname', ['fontname']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['insert', ['picture', 'hr']],
                    ['view', ['fullscreen']],
                ],
            });

            $('.summernoteThree').summernote({
                height: 200,
                focus: true,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['insert', ['hr']],
                    ['view', ['fullscreen']],
                ],
            });

            $('#testBtn').on('click', function (e) {
                e.preventDefault();
                testFormSubmit()
            });
            $('#sendBtn').on('click', function (e) {
                e.preventDefault();
                sendFormSubmit();
            });

            function testFormSubmit(){
                let form = $("#pdfForm");
                $(form).attr('target', '_blank');
                form.submit();
            }
            function sendFormSubmit(){
                let form = $("#pdfForm");
                $(form).attr('target', '_self');
                let input = "<input name='btn' value='send' type='hidden'>";
                $(form).append( input );
                form.submit();
            }

        });
    </script>
@endsection
