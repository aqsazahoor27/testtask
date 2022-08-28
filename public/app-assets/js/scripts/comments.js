// Need to add classname of .seeCommentsAll and add data-id = training_id
// also need to include commentlistmodal comment from includes

$('#commentListModal').on('shown.bs.modal', function () {
    $('#commentListModalLabel').text('Training Comments')
});

$('#commentListModal').on('hidden.bs.modal', function () {
    $('#commentListModalContainer').html('')
    $("#loadMoreCommentList").show()
    $('input[name=comment_result_counter]').val(0)
});

let trainingIdComment = null

$(document).on('click', '#loadMoreCommentList', function(){
    let skip = $('input[name=comment_result_counter]').val()
    loadComments(parseInt(skip))
})

$(document).on('click', '.seeCommentsAll', function(){
    trainingIdComment = $(this).attr('data-id')
    $('#commentListModal').modal('show')
    loadComments(0)
})

function loadComments(skip){
    let commentBody = $('#commentListModalContainer')

    var token = $('input[name=_token]').val();

    $.ajax({
        headers: {
            'X-CSRF-TOKEN': token
        },
        dataType: 'json',
        url: `/admin/fetCommentsByTraining/${trainingIdComment}?skip=${skip}`,
        success: function(response) {
            $('input[name=comment_result_counter]').val( skip + response.count )

            if(response.count == 0){
                $("#loadMoreCommentList").hide()
            }

            commentBody.append(response.response);
        }

    })
}