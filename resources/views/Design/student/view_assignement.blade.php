@extends('Admin.index')

@if($questions->isNotEmpty())

@section('title-page')
<i class="fas fa-file"></i>
{{$assignment->code_assignment}}
 <hr>
 @endsection

@section('content')

<div class="assignement_student">

    <div class="text-right">

        <!-- Start Finssh Assignment -->
        <form action="{{url('assignment/result')}}" method="POST" style="display:inline-block">
            {{csrf_field()}}
            <input type="hidden" name="assignment_id" value="{{$assignment->id}}">
            <button type="submit" class="btn btn-primary" id="finish">Finish Assignment</button>
        </form>
        <!-- End Finssh Assignment -->
    </div>

    <div class="data-quize">
        <ul class="list-unstyled">
            <li><i class="fas fa-marker"></i> Total Mark :  <span style="color:red">{{$assignment->fullmark}} M</span></li>
            <hr>
            <li id="total_time" style="color:red"><i class="fas fa-stopwatch"></i> Total Time : {{$assignment->full_time}} </li>
        </ul>
    </div>
    <hr>


    @include('Design.student.questions_assignments')

</div>

<div id="results" class="text-left" style="display:none">
    <div class="container">
       <h1 class="text-center">Result </h1>
        <h2 class="text-center">{{auth()->guard('student')->user()->name}}</h2>
        <hr>
        <ul class="list-unstyled">
            <li class="total">Total Mark : <span></span></li>
            <hr>
            <li class="mark">Your Mark : <span></span></li>
            <hr>
            <li class="result">Result : <span></span></li>
        </ul>
    </div>
</div>


@push('js')

<script src="https://cdnjs.cloudflare.com/ajax/libs/timer.jquery/0.7.0/timer.jquery.js"></script>

<script>


$(function(){

    //==== Time Choise
    $total_time = $('#total_time').text();
    $("#total_time").timer({
        countdown: true,
        duration:$total_time+'m',
        callback: function() {

            var url = $('#total_time').parents('section').find('form').attr('action');
            var form = $('#total_time').parents('section').find('form').serialize('action');

            $.ajax({
                url:url,
                type:"POST",
                dataType:"JSON",
                data:form,
                success:function(data)
                {
                    alert('success');
                }
            });

        }
    });


    //==== Send Data Answers To Database
    $('.btn-send').on('click', function(e){

        e.preventDefault();

        var url = $(this).parents('form').find('p').slideDown().delay(1000).slideUp();
        var url = $(this).parents('form').attr('action');
        var form = $(this).parents('form').serialize('action');

        $.ajax({
            url:url,
            type:"POST",
            dataType:"JSON",
            data:form,
            success:function(data)
            {
                alert('success');
            }
        });

        return false;
    });


    //==== Get Result Student
    $('#finish').on('click', function(e){

        e.preventDefault();
        $('.assignemt_student section').remove();
        $('#results').show();


        var url = $(this).parent('form').attr('action');
        var form = $(this).parent('form').serialize('action');

        $.ajax({
            url:url,
            type:"POST",
            dataType:"JSON",
            data:form,
            success:function(data)
            {
                $('#results .total span').html(data.total);
                $('#results .mark span').html(data.fullmark);
                $('#results .result span').html(data.stauts_result);
            }
        });


        $(this).remove();
        $('.data-quize').remove();

         return false;
    });



    });

</script>

@endpush


@endsection
@else
<!-- Start Message After Show All Questions -->
<section class="end-questions" style="margin-top:300px">
    <h3 class="alert alert-danger text-center">Not Found Any Questions</h3>
</section>
<!-- End Message After Show All Questions -->
@endif
