@extends('Admin.index')
@if($questions->isNotEmpty())
@section('title-page')
 <i class="fas fa-file"></i>  {{$quize->code_quize}}
 <hr>
 <h6 class="alert alert-danger">
    <i class="fas fa-exclamation-triangle" style="color:yellow"></i>
    If you leave this page, you will not be able to log in again
</h6>
@endsection

@section('content')

<div class="quize_student">

    <div class="text-right">
        <form action="{{url('quize/result')}}" method="POST">
            {{csrf_field()}}
            <input type="hidden" name="quize_id" value="{{$quize->id}}">
            <button type="submit" class="btn btn-primary" id="finish">Finish Assignment</button>
        </form>
    </div>

    <div class="data-quize">
        <ul class="list-unstyled">
            <li><i class="fas fa-marker"></i> Total Mark :  <span style="color:red">{{$quize->fullmark}} M</span></li>
            <hr>
            <li><i class="fas fa-stopwatch"></i> Total Time : <span style="color:red"> {{$quize->full_time}}  Minute</span></li>
        </ul>
    </div>
    <hr>


    @include('Design.student.questions_quizes')

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
  $time_choise = $('#time-question-choise').text();
  $("#time-question-choise").timer({
      countdown: true,
      duration:$time_choise+'m',
      callback: function() {

          var url = $('#time-question-choise').parents('section').find('form').attr('action');
          var form = $('#time-question-choise').parents('section').find('form').serialize('action');

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

          $('#time-question-choise').parents('section').remove().next().show();
          $('#time-question-choise').siblings('#time-question-choise').remove();
      }
  });



  $true_false = $('#true_false').text();
  $("#true_false").timer({
      countdown: true,
      duration:$true_false+'m',
      callback: function() {

          var url = $('#true_false').parents('section').find('form').attr('action');
          var form = $('#true_false').parents('section').find('form').serialize('action');

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

          $('#true_false').parents('section').remove().next().show();
          $('#true_false').siblings('#true_false').remove();
      }
  });

    $('.btn-send').on('click', function(e){

        e.preventDefault();

        $(this).parents('section').not('section:last-child').remove().next().show();

        var url = $(this).parents('section').find('form').attr('action');
        var form = $(this).parents('section').find('form').serialize('action');


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


    //==== Button Escape Question
    $('#escape').on('click', function(){
       $(this).parents('section').insertAfter($('section:last-child'));
       $(this).remove();

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
