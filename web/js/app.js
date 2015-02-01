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
        console.log('added: '+ added);
    }

    //append or remove last row from for depending on text in greyed-out class
    $(document.body).on('focusin', '.greyed-out' ,function(){
    //$('.greyed-out').focusin(function () {
        console.log('focus in');
        //pressed a key, check if they are other greyed-out elements without text in
        $(this).keyup(function () {
            var length = $('#feature-form .row').length;
            //console.log(//'key up');
            //this doesn't have text make sure this is the last row
            if($(this).val() == ""){
                console.log('no text');
                if(added > 0){
                    $('#feature-form .row')[(length-1)].remove();
                    added--;
                }
                console.log('added: '+ added);
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

    $('.greyed-out').focusout(function () {
        console.log('focus out');
        //if this text is empty ;
    });

    $('#feature-form').submit(function () {
        //var url=$("#myForm").attr("action");

        //each action should be a call with AJAX

    });

});