@extends('layouts.frontend.master')

@section('title')
Indonesia Holiday Checker
@endsection

@section('content')

<section>
    <div class="grid-container">
        <div class="grid-x grid-y">
            <div class="small-12 medium-6 large-4">
                <h1>Indonesian Holiday Checker</h1>
                <input type="text" class="datepicker-input" name="date" placeholder="Insert date here">
                <button id="check-date" type="submit" class="pull-right button primary">Submit</button>
                <div class="clearfix"></div>
                <div class="callout hide" id="result"></div>
            </div>
        </div>
    </div>

</section>

@endsection

@push('header-scripts')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/foundation-datepicker/1.5.6/css/foundation-datepicker.min.css">
@endpush
@push('footer-scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/foundation-datepicker/1.5.6/js/foundation-datepicker.min.js"></script>
<script>
    $(function(){
        $('.datepicker-input').fdatepicker({
            format: 'yyyy-mm-dd'
        });
        $('#check-date').click(function(){
            date = $('input[name=date]').val();
            $('#result').html('');
            $('#result').addClass('hide');
            $.ajax({
                type: "GET",
                url: "{{ url("/api") }}/check/"+date,
                error: function(xhr) {
                    $('#result').html('<p>'+xhr.responseJSON.message+'</p>');
                    console.log(xhr.responseJSON.message);
                    $('#result').removeClass('hide');
                },
                success: function(data,xhr){
                    $('#result').append(data.date_formated+' is ');
                    if (data.name){
                        $('#result').append(data.name);
                    }
                    else{
                        $('#result').append('not an Indonesia Holiday');
                    }
                    console.log(data);
                    $('#result').removeClass('hide');
                }
            });
        })
    })
</script>
@endpush
