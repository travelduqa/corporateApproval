<!-- HANDLES PENDING REQUESTS -->
<?php
if($data->requests_status=='pending'){
    $data->requests_status='';
}
?>
<!-- content @s -->
<div class="nk-content ">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title"><?=$meta->page_title;?></h3>
                            <p> You have <span class="text-info"><?=$data->pending_requests_no?></span> travel request(s)
                                <?php if($data->requests_status=='rejected'||$data->requests_status=='booked'||$data->requests_status=='approved'){ ?>
                                    that have been <?=$data->requests_status?>.
                                <?php }else{ ?>
                                    that are awaiting approval.
                                <?php }?></p>
                        </div><!-- .nk-block-head-content -->

                        <div class="nk-block-head-content">
                            <div class="toggle-wrap nk-block-tools-toggle">
                                <a href="#" class="btn btn-icon btn-trigger toggle-expand mr-n1" data-target="pageMenu"><em class="icon ni ni-more-v"></em></a>
                            </div>
                        </div><!-- .nk-block-head-content -->
                    </div>
                </div>
                <div class="nk-block">
                    <div class="card card-stretch">
                        <div class="card-inner-group">
                            <div class="card-inner  overflow-auto">
                                <table class="table_ajax table table-hover nowrap" cellspacing="0" width="100%">
                                    <thead>
                                    <tr>
                                        <th class="no-sort">#</th>
                                        <th>Flight Details</th>
                                        <th>User Details</th>
                                        <th>Amount</th>
                                        <th>Request Date</th>
                                        <th >Status</th>
<!--                                       REMOVES ACTION FOR REJECTED AND BOOKED REQUESTS -->
                                        <?php if($data->requests_status!=='rejected'&&$data->requests_status!=='booked'){ ?>
                                            <th class="noExport text-center" >Action</th>
                                        <?php }else{ ?>

                                        <?php }?>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
</div>
<div class="modal fade" data-backdrop="static" data-keyboard="false" tabindex="-1" id="view_flight_details">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><em class="icon ni ni-card-view"></em>&nbsp;Flight Details</h5>
                <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <div class="modal-body">
                    <div class="flight_details_body"></div>
            </div>
        </div>
    </div>
</div>

<!-- DYNAMIC URL -->
<script>
    datatables_url = '<?= URLROOT  ?>/corporate/getCorpTravelRequests/<?=$data->requests_status?>';
</script>
