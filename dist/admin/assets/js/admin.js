//confirm booking
$(document).on('click', '.book_this_request_btn', function(e){
    e.preventDefault();

    $('#book_approved_request .confirm_approved_request_booking_btn').prop('id',  $(this).prop('id'));
    $('#book_approved_request').modal('show');
});



// confirm approval and cancel
$(document).on('click', '.approve_request_btn,.cancel_request_btn', function(e){
    e.preventDefault();
    if($(this).hasClass('approve_request_btn')){
        $('#approve_cancel_modal .modal-title').html('<em class="icon ni ni-info"></em>&nbsp;Approve Request');
        $('#approve_cancel_modal .confirmation__message').html('You are about to approve the travel request selected, allowing the user who requested it to book a flight');
        $('#approve_cancel_modal .action__btn').prop('id',  $(this).prop('id'));
        $('#approve_cancel_modal .action__btn').removeClass('confirm_cancel_btn').addClass('confirm_approval_btn').html('<em class="icon ni ni-check"></em><span>Approve Now</span> ');
        $('#approve_cancel_modal').modal('show');

    }else  if($(this).hasClass('cancel_request_btn')){
        $('#approve_cancel_modal .modal-title').html('<em class="icon ni ni-info"></em>&nbsp;Cancel Request');
        $('#approve_cancel_modal .confirmation__message').html('You are about to cancel the travel request selected, preventing the user who requested it from booking a flight');
        $('#approve_cancel_modal .action__btn').prop('id', $(this).prop('id'));
        $('#approve_cancel_modal .action__btn').removeClass('confirm_approval_btn').addClass('confirm_cancel_btn').html('<em class="icon ni ni-cross-circle"></em><span>Cancel Now</span> ');
        $('#approve_cancel_modal').modal('show');

    }
});
