$(function () {

    let INPROGRESS = false
    let REQ = false

    $('form#form_submit').on('submit', function(event){
        event.preventDefault();
    
        if(window.formValidationObj != null && window.formValidationObj.valid()){
            let data = $(this).serialize()
            let url = $(this).attr('action')
            let method = $(this).attr('method')
    
            let submitButton = $("#form_submit button[type=submit]")
            submitButton.attr('disabled', true)
            submitButton.text('Submitting...')

            if(!INPROGRESS){
                INPROGRESS = true
                REQ = $.ajax({
                    url: url,
                    type: method,
                    data: data
                });
            }
    
            REQ.done(function (response, textStatus, jqXHR){
                Swal.fire({
                    title: 'Success!',
                    text: response.message,
                    type: 'success',
                    toast: true,
                    position: 'top',
                    timer: 4000,
                    customClass: {
                        confirmButton: 'btn btn-success'
                    }
                });

                if(window.ResetValidationForm == 0){
                    $("#form_submit")[0].reset();
                }
            });
    
            REQ.fail(function (jqXHR, textStatus, errorThrown){
                Swal.fire({
                    title: 'Denied!',
                    text: textStatus.message ? textStatus.message : 'Something went wrong!',
                    type: 'error',
                    toast: true,
                    position: 'top',
                    timer: 4000,
                    customClass: {
                        confirmButton: 'btn btn-danger'
                    }
                });
            });
    
            REQ.always(function () {
                // window.formValidationObj = null
                INPROGRESS = false
                submitButton.text('Save Changes')
                submitButton.attr('disabled', false)
            });
    
        }else{
            return false
        }
    
    })
})