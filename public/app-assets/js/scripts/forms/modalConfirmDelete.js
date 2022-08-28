$(function(){
    let DELETE_LINK
    let DELETE_TR

    $(document).on('click', '.removeItemWithConfirm', function(){
        DELETE_LINK = $(this).attr('data-href')
        DELETE_TR = $(this).closest('tr')
        $("#confirm-delete").modal('show')
    })

    $(document).on('click', '._confirmItemDelete', function(e){
        e.preventDefault()

        $("#confirm-delete").modal('hide')
        $.ajax({
            url: DELETE_LINK,
            success: function (response) {
                DELETE_TR.css('background-color', '#ff6262')
                DELETE_TR.fadeOut()
            }
        });

    })
})