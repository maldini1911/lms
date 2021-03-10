
$(document).ready(function(){

    if($('#notifications').height() > 180)
    {
      $('#notifications').css('overflow-y', 'scroll');
    }


    $('#attend-lecture').click(function(){
          alert("sss");
    });

    $('#datetimepicker').datetimepicker({
       format:'Y-m-d H:i',
       inline:false,
       lang:'ar'
     });

     $('#datetimepicker2').datetimepicker({
        format:'Y-m-d H:i',
        inline:false,
        lang:'ar'
      });

      //===== Select Type Media Lecture And Lesson
      $('#type-media').change(function(){
           if(this.options[this.selectedIndex].value == 'image') {
               $('.image-type').slideDown();
               $('.video-type').slideUp();
           }

           if(this.options[this.selectedIndex].value == 'video') {
              $('.image-type').slideUp();
              $('.video-type').slideDown();
           }
       });


       //===== Select Type Media Lecture And Lesson
       $('#filter-squads').change(function(){
          $id = $("#filter-squads option:selected").val();
          $url = $(this).attr('data-url');

          $.ajax({
              url:$url+'/'+$id,
              type:"GET",
              success:function(data)
              {

                $('#data').html(data);
                $('#squads').slideDown();
                //+'<br>'+data.term
              }
          });


        });
    //==================================================================
    // $('input[name="course_scheduling"]').daterangepicker({
    //   timePicker: true,
    //   startDate: moment().startOf('hour'),
    //   endDate: moment().startOf('hour').add(32, 'hour'),
    //   locale: {
    //     format: 'M/DD hh:mm A'
    //   }
    // });
    //================ Fetch Squads Ny Department ==========
    $('#department-filter-squads').change(function(){
       $id = $("#department-filter-squads option:selected").val();
       $url = $(this).attr('data-url');
       $.ajax({
           url:$url+'/'+$id,
           type:"GET",
           success:function(data)
           {

             $('.squads-data').html(data.data);
             $('#squads-course').slideDown();
             //+'<br>'+data.term
           }
       });

     });

     //================== Fetch Terms By Squad ===============================
     $('#department-filter-terms').change(function(){
        $id = $("#department-filter-terms option:selected").val();
        $url = $(this).attr('data-url');

        $.ajax({
            url:$url+'/'+$id,
            type:"GET",
            success:function(data)
            {

              $('#terms-data').html(data.data);
              $('#term-course').slideDown();
              //+'<br>'+data.term
            }
        });

      });

    //============================================
    $('.add-url').click(function(){
        $('.url-inputs').append('<input type="url" name="url_youtube[]" class="form-control" placeholder="Enter Your URL"> <hr>');
    });

    $('.add-video').click(function(){
        $('.videos-inputs').append('<div class="input-group">'+
        '<div class="custom-file">'+
          '<input type="file" name="video[]" class="custom-file-input" id="exampleInputFile" multiple="multiple">'+
          '<label class="custom-file-label" for="exampleInputFile">Upload Video</label>'+
        '</div>'+
      '</div>');
    });





    $('#add-question-image').click(function(){
        $('.image-choise').slideDown();
        $('.text-choise').slideUp();
    });

    $('#add-question-text').click(function(){
        $('.text-choise').slideDown();
        $('.image-choise').slideUp();
    });
    //==> Start Assignment


    //======== Edit Image

    $('.assignment .edit-image').click(function(){

        $('.assignment form .section-edit-image').append('<section > <div class="edit-image">'+
                                        '<div class="form-group">'+
                                            '<label for="exampleFormControlTextarea1">Question title </label>'+
                                            '<input type="text" class="form-control" name="title_edit_image[]">'+
                                          '</div>'+
                                          '<hr>'+
                                          '<div class="form-group">'+
                                              '<label for="exampleFormControlTextarea1"> Question Image </label>'+
                                              '<input type="file" class="form-control" name="question_edit_image[]" multiple="multiple">'+
                                            '</div>'+
                                    '</div>'+
                                    '<button type="button" class="btn btn-danger delete-question">Delete</button>'+
                                    '</section><hr>');

            $('.delete-question').show();
            $('.delete-question').click(function(){
              $(this).parent('section').prev().remove();
                $(this).parent('section').remove();
            });

            //====>
            $('.assignment form .section-edit-image .mark-time').show();
    });

    //=======================================================
    $('.assignment .text-que').click(function(){

        $('.assignment form .section-text-que').append('<section > <div class="text-question">'+
                                        '<div class="form-group">'+
                                            '<label for="exampleFormControlTextarea1"> Question text </label>'+
                                            '<textarea class="form-control" rows="3" name="question_text[]"></textarea>'+
                                          '</div>'+
                                          '<div class="form-group">'+
                                          '<label for="exampleFormControlInput1">Answer</label>'+
                                          '<input type="text" class="form-control" name="answer_text[]">'+
                                          '</div>'+
                                          '<hr>'+
                                    '</div>'+
                                    '<button type="button" class="btn btn-danger delete-question">Delete</button>'+
                                    '</section><hr>');

            $('.delete-question').show();
            $('.delete-question').click(function(){
                $(this).parent('section').prev().remove();
                $(this).parent('section').remove();
            });

            //====>
            $('.assignment form .section-text-que .mark-time').show();
    });
    //=======================================================
    $('.assignment .choice-que').click(function(){

            $('.assignment .section-choice-que section').prepend(
            '<button type="button" id="add-question-text" class="btn btn-primary"> Add Answers Text </button>'+
            '<button type="button" id="add-question-image" class="btn btn-primary">Add Answers Image</button>'
            );

            $('#add-question-text').click(function(){
                $('.text-choise').slideDown();
                $('.image-choise').slideUp();
            });

            $('#add-question-image').click(function(){
                $('.text-choise').slideUp();
                $('.image-choise').slideDown();
            });

            //====>
            $('.assignment .section-choice-que .mark-time').show();

        $('.assignment form .section-choice-que').append('<section><div class="multi-choise">'+
                                    //==================================================
                                    '<div class="text-choise">'+
                                          //=====================
                                          '<div class="form-group">'+
                                          '<label for="exampleFormControlInput1">Question title</label></label>'+
                                          '<input type="text" class="form-control" name="title_choice_text[]">'+
                                          '</div>'+
                                          '<div class="form-group">'+
                                            '<label for="exampleFormControlInput1">Question</label></label>'+
                                            '<input type="text" class="form-control" name="question_choice_text[]">'+
                                          '</div>'+
                                          '<div class="form-group">'+
                                          '<label for="exampleFormControlInput1">Question</label></label>'+
                                          '<input type="file" class="form-control" name="question_text_image[]">'+
                                          '</div>'+
                                           //====================
                                          '<div class="row">'+
                                                //======================
                                                '<div class="col-lg-6">'+
                                                    '<div class="form-group">'+
                                                        '<label for="exampleFormControlInput1">(1)</label>'+
                                                        '<input type="text" class="form-control" name="choice1[]">'+
                                                    '</div>'+
                                                '</div>'+
                                                //======================
                                                '<div class="col-lg-6">'+
                                                    '<div class="form-group">'+
                                                        '<label for="exampleFormControlInput1">(2)</label>'+
                                                        '<input type="text" class="form-control" name="choice2[]">'+
                                                    '</div>'+
                                                '</div>'+
                                                //====================
                                                '<div class="col-lg-6">'+
                                                    '<div class="form-group">'+
                                                        '<label for="exampleFormControlInput1">(3)</label>'+
                                                        '<input type="text" class="form-control" name="choice3[]">'+
                                                    '</div>'+
                                                '</div>'+
                                                //====================
                                                '<div class="col-lg-6">'+
                                                    '<div class="form-group">'+
                                                        '<label for="exampleFormControlInput1">(4)</label>'+
                                                        '<input type="text" class="form-control" name="choice4[]">'+
                                                    '</div>'+
                                                '</div>'+
                                                //======================
                                              '<div class="col-lg-12">'+
                                                    '<div class="form-group">'+
                                                        '<label for="exampleFormControlInput1">Answer</label>'+
                                                        '<input type="number" class="form-control" name="answer_choice[]" placeholder="Enter Your Right Answer">'+
                                                    '</div>'+
                                                '</div>'+
                                            '</div>'+
                                            '</div>'+
                                          //====================================
                                          '<div class="image-choise">'+ //======== Images
                                                //=================================== edit section
                                                '<div class="form-group">'+
                                                '<label for="exampleFormControlInput1">Question title</label></label>'+
                                                '<input type="text" class="form-control" name="title_choice_image[]">'+
                                                '</div>'+
                                                '<div class="form-group">'+
                                                '<label for="exampleFormControlInput1">Question</label></label>'+
                                                '<input type="text" class="form-control" name="question_choice_image[]">'+
                                                '</div>'+
                                                //===================================
                                            '<div class="row">'+
                                                //=====
                                                '<div class="col-lg-6">'+
                                                     '<div class="form-group">'+
                                                      '<label for="exampleFormControlInput1">(1)</label>'+
                                                      '<input type="file" class="form-control" name="image_choice1[]">'+
                                                    '</div>'+
                                                '</div>'+
                                                //======
                                                '<div class="col-lg-6">'+
                                                     '<div class="form-group">'+
                                                      '<label for="exampleFormControlInput1">(2)</label>'+
                                                      '<input type="file" class="form-control" name="image_choice2[]">'+
                                                    '</div>'+
                                                '</div>'+
                                                //=====
                                               '<div class="col-lg-6">'+
                                                     '<div class="form-group">'+
                                                      '<label for="exampleFormControlInput1">(3)</label>'+
                                                      '<input type="file" class="form-control" name="image_choice3[]">'+
                                                    '</div>'+
                                                '</div>'+
                                                //=====
                                                '<div class="col-lg-6">'+
                                                     '<div class="form-group">'+
                                                      '<label for="exampleFormControlInput1">(4)</label>'+
                                                      '<input type="file" class="form-control" name="image_choice4[]">'+
                                                    '</div>'+
                                                '</div>'+
                                                //=====
                                                '<div class="col-lg-12">'+
                                                    '<div class="form-group">'+
                                                        '<label for="exampleFormControlInput1">Answer</label>'+
                                                        '<input type="number" class="form-control" name="image_answer_choice[]" placeholder="Enter Your Right Answer">'+
                                                    '</div>'+
                                                '</div>'+
                                                //=====
                                            '</div>'+
                                        '</div>'+
                                        '<hr>'+
                                    '</div>'+
                                    '  <button type="button" id="add-question-text" class="btn btn-primary"> Add Answers Text </button> '+
                                     ' <button type="button" id="add-question-image" class="btn btn-primary">Add Answers Image</button> '+
                                     ' <button type="button" class="btn btn-danger delete-question">Delete</button> '+
                                    '</section><hr>');

                        $('.delete-question').show();

                        $('.delete-question').click(function(){
                            $(this).parent('section').prev().remove();
                            $(this).parent('section').remove();
                        });

                         $('#add-question-text').click(function(){
                                $('.text-choise').slideDown();
                                $('.image-choise').slideUp();
                            });

                            $('#add-question-image').click(function(){
                                $('.text-choise').slideUp();
                                $('.image-choise').slideDown();
                            });

    });
    //=======================================================
    $('.assignment .img-que').click(function(){

        //====>
        $('.assignment form .section-img-que .mark-time').show();

        $('.assignment form .section-img-que').append('<section > <div class="file-image">'+
                                        '<div class="form-group">'+
                                            '<label for="exampleFormControlInput1">The title of the question</label>'+
                                            '<input type="text" class="form-control" name="title_file[]">'+
                                         '</div>'+

                                          '<div class="form-group videos-inputs">'+
                                                '<label for="exampleInputFile">Image Question</label>'+
                                                '<div class="input-group">'+
                                                    '<div class="custom-file">'+
                                                    '<input type="file" class="custom-file-input" id="exampleInputFile" multiple="multiple" name="question_file[]">'+
                                                    '<label class="custom-file-label" for="exampleInputFile"></label>'+
                                                    '</div>'+
                                                '</div>'+
                                            '</div>'+

                                            '<div class="form-group">'+
                                                '<label for="exampleFormControlInput1">Choise Right Answer </label>'+
                                                '<select name="answer_file[]" class="form-control">'+
                                                    '<option value="yes">Yes</option>'+
                                                    '<option value="no">No</option>'+
                                                '</select>'+
                                            '</div>'+
                                          '<hr>'+
                                    '</div>'+
                                     '<button type="button" class="btn btn-danger delete-question">Delete</button>'+
                                    '</section><hr>');

                                     $('.delete-question').show();
                                     $('.delete-question').click(function(){
                                       $(this).parent('section').prev().remove();
                                        $(this).parent('section').remove();
                                    });
    });
    //=======================================================
    $('.assignment .true-false').click(function(){

        $('.assignment form .section-true-false .mark-time').show();

        $('.assignment form .section-true-false').append('<section> <div class="true-false-question">'+
                                    '<div class="form-group">'+
                                        '<label for="exampleFormControlInput1"> Question</label>'+
                                        '<input type="text" class="form-control" name="question_correct[]" required="required">'+
                                     '</div>'+
                                     '<div class="form-group">'+
                                        '<label for="exampleFormControlInput1">Choise Right Answer </label>'+
                                        '<select name="answer_correct[]" class="form-control">'+
                                            '<option value="yes">Yes</option>'+
                                            '<option value="no">No</option>'+
                                        '</select>'+
                                     '</div>'+
                                     '</div><hr>'+
                                     '<button type="button" class="btn btn-danger delete-question">Delete</button>'+
                                     '</section> <hr>');

                                     $('.delete-question').show();
                                     $('.delete-question').click(function(){
                                        $(this).parent('section').remove();
                                    });
    });
    //=======================================================
    $('.assignment .btn-send').click(function(){

        $('.assignment form').prepend(
            ' <button type="submit" class="btn btn-primary" name="action" value="publish"> Publish</button>'+
            ' <button type="submit" class="btn btn-info" name="action" value="save"> Save to draft</button>'+
            ' <button type="submit" class="btn btn-danger" name="action" value="scheduling"> Scheduling</button>'
            +'<hr>');
    });
    //=======================================================
    //==> End Assignment





     //==> Start Quizes
     $('.quizes .edit-image').click(function(){

       $('.quizes form .section-edit-image .mark-time').show();

       $('.quizes .section-edit-image').append('<section > <div class="edit-image">'+
                                         '<div class="form-group">'+
                                             '<label for="exampleFormControlTextarea1"> Question Edit Image </label>'+
                                             '<input type="text" class="form-control" name="question_edit_image[]">'+
                                           '</div>'+
                                           '<hr>'+
                                     '</div>'+
                                     '<button type="button" class="btn btn-danger delete-question">Delete</button>'+
                                     '</section><hr>');

             $('.delete-question').show();
             $('.delete-question').click(function(){
               $(this).parent('section').prev().remove();
                 $(this).parent('section').remove();
             });


     });

    //=======================================================
    $('.quizes .text-que').click(function(){

        $('.quizes form .section-text-que .mark-time').show();

        $('.quizes form .section-text-que').append('<section><div class="text-question">'+
                                          '<div class="form-group">'+
                                            '<label for="exampleFormControlTextarea1"> Question text </label>'+
                                            '<textarea class="form-control" rows="3" name="question_text[]"></textarea>'+
                                          '</div>'+
                                          '<div class="form-group">'+
                                          '<label for="exampleFormControlInput1">Answer</label>'+
                                          '<input type="text" class="form-control" name="answer_text[]">'+
                                          '</div>'+
                                    '</div>'+
                                     '<button type="button" class="btn btn-danger delete-question">Delete</button>'+
                                    '</section><hr>');

        $('.delete-question').show();
            $('.delete-question').click(function(){
              $(this).parent('section').prev().remove();
            $(this).parent('section').remove();
        });

    });
    //=======================================================
    $('.quizes .choice-que').click(function(){


    $('.quizes form .section-choice-que .mark-time').show();

    $('.quizes form .section-choice-que').append('<section>'+
                                '<div class="multi-choise">'+
                                //==================================================
                                '<div class="text-choise">'+
                                      //=====================
                                      '<div class="form-group">'+
                                      '<label for="exampleFormControlInput1">Question title</label></label>'+
                                      '<input type="text" class="form-control" name="title_choice_text[]">'+
                                      '</div>'+
                                      '<div class="form-group">'+
                                        '<label for="exampleFormControlInput1">Question</label></label>'+
                                        '<input type="text" class="form-control" name="question_choice_text[]">'+
                                      '</div>'+
                                      '<div class="form-group">'+
                                      '<label for="exampleFormControlInput1">Question</label></label>'+
                                      '<input type="file" class="form-control" name="question_text_image[]">'+
                                      '</div>'+
                                       //====================
                                      '<div class="row">'+
                                            //======================
                                            '<div class="col-lg-6">'+
                                                '<div class="form-group">'+
                                                    '<label for="exampleFormControlInput1">(1)</label>'+
                                                    '<input type="text" class="form-control" name="choice1[]">'+
                                                '</div>'+
                                            '</div>'+
                                            //======================
                                            '<div class="col-lg-6">'+
                                                '<div class="form-group">'+
                                                    '<label for="exampleFormControlInput1">(2)</label>'+
                                                    '<input type="text" class="form-control" name="choice2[]">'+
                                                '</div>'+
                                            '</div>'+
                                            //====================
                                            '<div class="col-lg-6">'+
                                                '<div class="form-group">'+
                                                    '<label for="exampleFormControlInput1">(3)</label>'+
                                                    '<input type="text" class="form-control" name="choice3[]">'+
                                                '</div>'+
                                            '</div>'+
                                            //====================
                                            '<div class="col-lg-6">'+
                                                '<div class="form-group">'+
                                                    '<label for="exampleFormControlInput1">(4)</label>'+
                                                    '<input type="text" class="form-control" name="choice4[]">'+
                                                '</div>'+
                                            '</div>'+
                                            //======================
                                          '<div class="col-lg-12">'+
                                                '<div class="form-group">'+
                                                    '<label for="exampleFormControlInput1">Answer</label>'+
                                                    '<input type="number" class="form-control" name="answer_choice[]" placeholder="Enter Your Right Answer">'+
                                                '</div>'+
                                            '</div>'+
                                        '</div>'+
                                        '</div>'+
                                      //====================================
                                      '<div class="image-choise">'+ //======== Images
                                            //=================================== edit section
                                            '<div class="form-group">'+
                                            '<label for="exampleFormControlInput1">Question title</label></label>'+
                                            '<input type="text" class="form-control" name="title_choice_image[]">'+
                                            '</div>'+
                                            '<div class="form-group">'+
                                            '<label for="exampleFormControlInput1">Question</label></label>'+
                                            '<input type="text" class="form-control" name="question_choice_image[]">'+
                                            '</div>'+
                                            //===================================
                                        '<div class="row">'+
                                            //=====
                                            '<div class="col-lg-6">'+
                                                 '<div class="form-group">'+
                                                  '<label for="exampleFormControlInput1">(1)</label>'+
                                                  '<input type="file" class="form-control" name="image_choice1[]">'+
                                                '</div>'+
                                            '</div>'+
                                            //======
                                            '<div class="col-lg-6">'+
                                                 '<div class="form-group">'+
                                                  '<label for="exampleFormControlInput1">(2)</label>'+
                                                  '<input type="file" class="form-control" name="image_choice2[]">'+
                                                '</div>'+
                                            '</div>'+
                                            //=====
                                           '<div class="col-lg-6">'+
                                                 '<div class="form-group">'+
                                                  '<label for="exampleFormControlInput1">(3)</label>'+
                                                  '<input type="file" class="form-control" name="image_choice3[]">'+
                                                '</div>'+
                                            '</div>'+
                                            //=====
                                            '<div class="col-lg-6">'+
                                                 '<div class="form-group">'+
                                                  '<label for="exampleFormControlInput1">(4)</label>'+
                                                  '<input type="file" class="form-control" name="image_choice4[]">'+
                                                '</div>'+
                                            '</div>'+
                                            //=====
                                            '<div class="col-lg-12">'+
                                                '<div class="form-group">'+
                                                    '<label for="exampleFormControlInput1">Answer</label>'+
                                                    '<input type="number" class="form-control" name="image_answer_choice[]" placeholder="Enter Your Right Answer">'+
                                                '</div>'+
                                            '</div>'+
                                            //=====
                                        '</div>'+
                                    '</div>'+
                                    '<hr>'+
                                '</div>'+
                                     ' <button type="button" id="add-question-text" class="btn btn-primary"> Add Answers Text </button> '+
                                     ' <button type="button" id="add-question-image" class="btn btn-primary">Add Answers Image</button> '+
                                    ' <button type="button" class="btn btn-danger delete-question">Delete</button> '+
                                '</section><hr>');


                                    $('.delete-question').show();

                                    $('.delete-question').click(function(){
                                      $(this).parent('section').prev().remove();
                                        $(this).parent('section').remove();
                                    });

                                      $('#add-question-text').click(function(){
                                            $('.text-choise').slideDown();
                                            $('.image-choise').slideUp();
                                        });

                                        $('#add-question-image').click(function(){
                                            $('.text-choise').slideUp();
                                            $('.image-choise').slideDown();
                                        });


});
    //=======================================================
    $('.quizes .img-que').click(function(){

        $('.quizes form .section-img-que .mark-time').show();

        $('.quizes form .section-img-que').append('<section><div class="file-image">'+
                                        '<div class="form-group">'+
                                            '<label for="exampleFormControlInput1">The title of the question</label>'+
                                            '<input type="text" class="form-control" name="title_file[]">'+
                                         '</div>'+

                                          '<div class="form-group videos-inputs">'+
                                                '<label for="exampleInputFile">Image Question</label>'+
                                                '<div class="input-group">'+
                                                    '<div class="custom-file">'+
                                                    '<input type="file" class="custom-file-input" id="exampleInputFile" multiple="multiple" name="question_file[]">'+
                                                    '<label class="custom-file-label" for="exampleInputFile"></label>'+
                                                    '</div>'+
                                                '</div>'+
                                            '</div>'+

                                            '<div class="form-group">'+
                                            '<label for="exampleFormControlInput1">Choise Right Answer </label>'+
                                            '<select name="answer_file[]" class="form-control">'+
                                                '<option value="yes">Yes</option>'+
                                                '<option value="no">No</option>'+
                                            '</select>'+
                                        '</div>'+

                                          '<hr>'+
                                    '</div>'+
                                    '<button type="button" class="btn btn-danger delete-question">Delete</button>'+
                                    '</section><hr>');

                                     $('.delete-question').show();

                                    $('.delete-question').click(function(){
                                      $(this).parent('section').prev().remove();
                                        $(this).parent('section').remove();
                                    });

    });
    //=======================================================
    $('.quizes .true-false').click(function(){

        $('.quizes form .section-true-false .mark-time').show();

        $('.quizes form .section-true-false').append('<section> <div class="true-false-question">'+

                                    '<div class="form-group">'+
                                        '<label for="exampleFormControlInput1"> Question</label>'+
                                        '<input type="text" class="form-control" name="question_correct[]" required="required">'+
                                     '</div>'+
                                     '<div class="form-group">'+
                                        '<label for="exampleFormControlInput1">Choise Right Answer </label>'+
                                        '<select name="answer_correct[]" class="form-control">'+
                                            '<option value="yes">Yes</option>'+
                                            '<option value="no">No</option>'+
                                        '</select>'+
                                    '</div>'+
                                     '</div>'+
                                      '<button type="button" class="btn btn-danger delete-question">Delete</button>'+
                                     '</section><hr>');


                                    $('.delete-question').show();

                                    $('.delete-question').click(function(){
                                      $(this).parent('section').prev().remove();
                                        $(this).parent('section').remove();
                                    });
    });
    //=======================================================
    $('.quizes .btn-send').click(function(){

        $('.quizes form').prepend(
            ' <button type="submit" class="btn btn-primary" name="action" value="publish"> Publish</button>'+
            ' <button type="submit" class="btn btn-info" name="action" value="save"> Save to draft</button>'+
            ' <button type="submit" class="btn btn-danger" name="action" value="scheduling"> Scheduling</button>'
            +'<hr>');
    });
    //=======================================================
    //==> End Quizes


    /*  ==========================================
        SHOW UPLOADED IMAGE
    * ========================================== */
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#imageResult')
                    .attr('src', e.target.result);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    $(function () {
        $('#upload').on('change', function () {
            readURL(input);
        });
    });

    /*  ==========================================
        SHOW UPLOADED IMAGE NAME
    * ========================================== */
    var input = document.getElementById( 'upload');
    var infoArea = document.getElementById( 'upload-label' );

    input.addEventListener( 'change', showFileName );
    function showFileName( event ) {
      var input = event.srcElement;
      var fileName = input.files[0].name;
      infoArea.textContent = 'File name: ' + fileName;
    }


});



//======================== Delete All =====================
function check_all(){
    $('input[class="item_checkbox"]:checkbox').each(function(){

  if($('input[class="check_all"]:checkbox:checked').length == 0){

    $(this).prop('checked', false);

  }else{

    $(this).prop('checked', true);

  }

    });
  }


$(document).on('click', '.del_all', function(){
    $('#form_delete').submit();
});

$(document).on('click', '.delBtn', function(){
    var items_checked = $('input[class="item_checkbox"]:checkbox').filter(':checked').length;

    if(items_checked > 0){

        $('.full_delete').show();
        $('.delete_count').text(items_checked);
        $('.empty_delete').hide();

    }else{
        $('.full_delete').hide();
        $('.empty_delete').show();

    }

        $('#multiDelete').modal('show');
});
