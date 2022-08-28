// Need to add classname of .seePagesListing and add data-id = training_id
// also need to include commentlistmodal comment from includes

$('#commentListModal').on('shown.bs.modal', function () {
    $('#commentListModalLabel').text('Training Lessons')
});

$('#commentListModal').on('hidden.bs.modal', function () {
    $('#commentListModalContainer').html('')
    $("#loadMoreCommentList").show()
    $('input[name=comment_result_counter]').val(0)
});

let trainingIdPage = null
let pageId = null

$(document).on('click', '#loadMoreCommentList', function(){
    let skip = $('input[name=comment_result_counter]').val()
    loadPages(parseInt(skip))
})

$(document).on('click', '.seePagesListing', function(){
    trainingIdPage = $(this).attr('data-id')
    $('#commentListModal').modal('show')
    loadPages(0)
})

function loadPages(skip){
    let commentBody = $('#commentListModalContainer')

    var token = $('input[name=_token]').val();

    $.ajax({
        headers: {
            'X-CSRF-TOKEN': token
        },
        dataType: 'json',
        url: `/admin/fetPagesByTraining/${trainingIdPage}?skip=${skip}`,
        success: function(response) {
            $('input[name=comment_result_counter]').val( skip + response.count )

            if(response.count == 0){
                $("#loadMoreCommentList").hide()
            }

            commentBody.append(response.response);
        }

    })
}


// delete page

$(document).on('click', '.trashPageFromModal', function(){
    pageId = $(this).attr('data-id')

    Swal.fire({
        title: 'Do you want to remove the lesson?',
        showCancelButton: true,
        confirmButtonText: 'Yes, Delete it',
        confirmButtonColor: '#dc3545',
        denyButtonText: `Don't Delete`,
      }).then((result) => {
        if (result.value) {

            var token = $('input[name=_token]').val();

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': token
                },
                dataType: 'json',
                url: `/admin/deletelessonAjax/${pageId}`,
                success: function(response) {
                    Swal.fire('Success!', 'Lesson removed successfully!', 'success')
                    $('#commentListModalContainer').html('')
                    loadPages(0)
                }
        
            })

        }
    })

})