
<!--request approval/cancellation/resend confirmation Modal-->
<div class="modal fade" data-backdrop="static" data-keyboard="false" tabindex="-1" id="approve_cancel_modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <a href="#" class="close" data-dismiss="modal" aria-label="Close"><em class="icon ni ni-cross"></em></a>
            <div class="modal-body">
                <h5 class="modal-title mb-4"><em class="icon ni ni-info"></em>&nbsp;Approve Request</h5>
                <div class="px-4">
                    <div class="row mb-4">
                        <div class="col-lg-12 col-sm-12">
                            <p class="text-lg-center"><span class="confirmation__message">You are about to approve the travel request selected, allowing the user who requested it to book a flight</span>. Proceed?</p>
                        </div>
                    </div>
                    <div class="form-group text-center mt-2 ">
                        <button type="submit" class="btn btn-sm btn-success action__btn confirm_approval_btn"><em class="icon ni ni-check"></em><span>Approve Now</span> </button>
                        <a href="#" class="btn btn-sm btn-danger" data-dismiss="modal" aria-label="Close"><em class="icon ni ni-cross"></em> Close</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!--request booking confirmation Modal-->
<div class="modal fade" data-backdrop="static" data-keyboard="false" tabindex="-1" id="book_approved_request">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <a href="#" class="close" data-dismiss="modal" aria-label="Close"><em class="icon ni ni-cross"></em></a>
            <div class="modal-body">
                <h5 class="modal-title mb-4"><em class="icon ni ni-info"></em>&nbsp;Book Approved Request</h5>
                <div class="px-4">
                    <div class="row mb-4">
                        <div class="col-lg-12 col-sm-12">
                            <p class="text-lg-center"><span class="confirmation__message">You are about start a new search for the approved trip you have selected, allowing you to book the flight</span>. Proceed?</p>
                        </div>
                    </div>
                    <div class="form-group text-center mt-2 ">
                        <button type="submit" class="btn btn-sm btn-success confirm_approved_request_booking_btn"><em class="icon ni ni-send-alt"></em><span>Book Now</span> </button>
                        <a href="#" class="btn btn-sm btn-danger" data-dismiss="modal" aria-label="Close"><em class="icon ni ni-cross"></em> Close</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
