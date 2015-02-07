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

    // *** append or remove last row from for depending on text in greyed-out class ************ /

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

    // *** save or update ************************************************************************ //

    $("input[name='task']").focusout(function () {

        // PUT THE CORRECT CLASSES ON IF INPUT HAS CONTENT
        if($(this).val() != ""){
            //remove this .greyed-out. Or could do it on save
            $(this).removeClass('greyed-out');
            //remove siblings child (inout) of .secondary
            $(this).parent().next().find(".secondary").removeClass('secondary')
        }
        console.log('focus out on: ' + $(this).parent().parent().find('input[type="hidden"]').val());


        // FIND OUT IF HIDDEN INPUT HAS ID, IF IT DOES PASS this to the update page
        if($(this).parent().parent().find('input[type="hidden"]').length > 0 ){
            //console.log('find hidden value: ' + $(this).parent().parent().length);
            //console.log('we have an id, update ' + $(this).val());
            var id = $(this).parent().parent().find('input[type="hidden"]').val();
            console.log('id for update: '+$(this).parent().parent().find('input[type="hidden"]').val());
            var row = $(this).parent().parent();
            var self = this;
            var data = {text:$(this).val(),id:id};
            console.log('text for update:'+ data.text);
            var jqxhr = $.ajax({
                context: this,
                type: "POST",
                url: data.id + "/update",
                //data: $(this).val()
                data: data
                })
                .done(function(data) {
                    //Has this just started working? YEEEEESSS!
                    //var obj = $.parseJSON(data);
                    console.log("success: " + data );
                })
                .fail(function(data) {
                    console.log("error " + data );
                    $('#result').text(data);
                    //console.log($(this).parent().parent());
                })
                .always(function(data) {
                    console.log("always, complete" );
                    //var obj = $.parseJSON(data);
                    console.log("this" +  row );
                    //$(this).parent().parent().append('<input type="hidden" class="id" value=""/>');
                });
        }// IF IT HAS SOMETHING, SAVE NEW
        else{
            //TODO get delete button and change delete text to saving
            //console.log($(this).parent().next().find('input').attr('value').text('Saving'));
            $(this).parent().next().find('input').attr('value', 'Saving');
            $(this).parent().next().find('input').addClass('alert');
            console.log('no id, save new as: ' + $(this).val());
            var jqxhr = $.ajax({
                type: "POST",
                context: this,
                url:"save",
                data: $(this).val()
                })
                .done(function(data) {
                    var obj = $.parseJSON(data);
                    console.log($(this));
                    $(this).parent().next().find('input').attr('value', 'Delete');
                    $(this).parent().next().find('input').removeClass('alert');
                    $(this).parent().parent().append('<input type="hidden" class="id" value="'+obj.id+'"/>');
                    console.log("success: " + obj.id );
                })
                .fail(function(data) {
                    $(this).parent().next().find('input').attr('value', 'Error');
                    console.log("error " + data );

                })
                .always(function(data) {
                    console.log("complete" );

                });
        }
    });

    $('#feature-form').submit(function () {
        //var url=$("#myForm").attr("action");
        //each action should be a call with AJAX

    });

});