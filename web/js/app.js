// ** ---------------------------------------- ** //
// grab the information from the feature form
// and send it to the controller
// ** ---------------------------------------- ** //

$(document).ready(function () {

    //TODO if we use the action then we need to disable it form happening.

    appendInput();
    var added = 0;

    function appendInput() {
        $('#feature-form').append(
            "<div class='row'><div class='small-1 columns'><input type='checkbox'/></div><div class='small-6 columns'><input class='greyed-out' name='task' type='text' placeholder='Task'/></div><div class='small-1 columns end'><input class='button tiny secondary' type='button' value='Delete'/></div></div>"
        );
        added++;
        //console.log('added: '+ added);
    }

    //append or remove last row from for depending on text in greyed-out class
    $(document.body).on('focusin', 'input[name="task"]' ,function(){
    //$('.greyed-out').focusin(function () {
        //console.log('focus in');

        $(this).keyup(function () {
            var length = $('#feature-form .row').length;
            if($(this).val() == ""){

                console.log('no text');

                if(added > 0){
                    $('#feature-form .row')[(length-1)].remove();
                    added--;
                }

            //check if the last one is blank, add one if not.
            }else if($('#feature-form .row').eq(length-1).find("input[name='task']").val() != ""){

                console.log('there is text');

                appendInput();

            }
            //why am I looping deal with each one at a time!
//            $('#feature-form .row').each(function (index, element) {
////                console.log(index,element);
////                console.log($(element).find('.greyed-out'));
//                //There's no text so check if it's got an id,
//                if ($(element).find('.greyed-out').val() == "") {
//                    //if it has an id leave it, otherwise remove
//                    if($(element).find('.id').val() !== ''){
//                        console.log("this has an id don't remove");
//                    }else{
//                        console.log("this has no text or id,remove it");
//                    }
//                    //console.log('text empty');
//
//                } else {
//                    //if it doesn't have id remove it
//                    console.log('there is text, dont remove');
//
//                }
//            });
        });

    });

    $("input[name='task']").focusout(function () {
        console.log('focus out on: ' + $(this).parent().parent().find('input[type="hidden"]').val());
        //if this text is empty and has no id save as new;
        if($(this).parent().parent().find('input[type="hidden"]').val() == ""){
            console.log('we have an id, update');
        }
        else{
            console.log('no id, save new as: ' + $(this).val());
            var jqxhr = $.ajax({
                type: "POST",
                url:"save",
                data: $(this).val()
            })
                .done(function(data) {
                    console.log("success" + data );
                })
                .fail(function(data) {
                    console.log("error " + data );
                })
                .always(function() {
                    console.log("complete" );
                });
        }
    });

    $('#feature-form').submit(function () {
        //var url=$("#myForm").attr("action");
        //each action should be a call with AJAX

    });

});