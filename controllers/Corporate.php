<?php
//FIXED DATATABELS SEARCH AND ADDED FUNCTIONALITY TO APPROVE AND CANCEL BUTTONS
  public function getCorpTravelRequests($status='awaiting approval'){
        $draw = $_POST['draw'];
        $row = $_POST['start'];
        $rowperpage = $_POST['length']; // Rows display per page
        $columnIndex = $_POST['order'][0]['column']; // Column index
        $columnName = $_POST['columns'][$columnIndex]['data']; // Column name
        $columnSortOrder = $_POST['order'][0]['dir']; // asc or desc
        $searchValue = $_POST['search']['value']; // Search value ;

        $array_column = array('id');
        $totalRecords = $this->admin_model->get_data_count('tbl_corporate_travel_requests', $array_column);

        $sql = '';
	  //FIXED SEARCH
        $sql = "SELECT * FROM tbl_corporate_travel_requests WHERE status='$status' AND user_id=35";
        if ($searchValue != '') {
            $sql .= " AND (travel_details LIKE '%$searchValue%' OR user_details LIKE '%$searchValue%' ) ";
        }
        $totalRecordwithFilter = $this->admin_model->get_data_where_count_sql($sql);


        if ($rowperpage == -1) {
            $rowperpage = $totalRecords;
        }
        $sql .= "  ORDER BY created_at DESC LIMIT $row , $rowperpage ";

        $datas = $this->admin_model->get_data_sql_all($sql);
        $i = 1;
        $ar = array();
        if ($datas) {
            foreach ($datas as $rec) {



                $user = '<div class="user space-y-2">
	                                <span class="block"><em class="icon ni ni-user "></em>&nbsp; ' . json_decode($rec['user_details'])->names . '</span>
                                    <span class="block"><em class="icon ni ni-call"></em>&nbsp;  ' . json_decode($rec['user_details'])->phone . '</span>
                                    <span class="block"><em class="icon ni ni-mail"></em>&nbsp; ' . json_decode($rec['user_details'])->email . '</span>
                                </div>
                
                ';
                $rec['travel_details'] = json_decode($rec['travel_details']);
                $flight='';
                if ($rec['travel_details']->returning_date != '-') {
                    $flight .= '<div class="travel_details space-y-2">
	                                <span class="block"><em class="icon ni ni-navigate "></em>&nbsp; <strong class="origin">' .explode('to', $rec['travel_details']->cities)[0]  . '</strong> <em class="icon ni ni-swap"></em> <strong class="destination">' . explode('to', $rec['travel_details']->cities)[1] . '</strong></span>
                                    <span class="block"><em class="icon ni ni-calender-date"></em>&nbsp; ' . date('Y-m-d', (strtotime(str_replace(',', '',explode('-', $rec['travel_details']->going_date)[0]))))  . ' <em class="icon ni ni-arrow-right"></em> ' . date('Y-m-d', (strtotime(str_replace(',', '',explode('-', $rec['travel_details']->returning_date)[0]))))  . '</span>
                                </div>
								

									';
                } else {
                    $flight .= '<div class="travel_details space-y-2">
	                                <span class="block"><em class="icon ni ni-navigate "></em>&nbsp; <strong class="origin">' .explode('to', $rec['travel_details']->cities)[0]  . '</strong> <em class="icon ni ni-arrow-right"></em> <strong class="destination">' . explode('to', $rec['travel_details']->cities)[1] . '</strong></span>
                                    <span class="block" ><em class="icon ni ni-calender-date"></em>&nbsp; ' .date('Y-m-d', (strtotime(str_replace(',', '',explode('-', $rec['travel_details']->going_date)[0]))))  . ' </span>
                               </div>
                          
									';

                }
                if ($rec['status'] == 'awaiting approval') {
                    $status = '<span class="badge badge-sm badge-dot has-bg badge-warning   d-none d-mb-inline-flex">'.ucfirst($rec['status']).'</span>';
			
			//CHANGED ACTION BUTTONS HERE
                    $action =
                        '
                        <div class="text-center" role="group" aria-label="Button group">
                            <button class="btn btn-sm btn-primary resend_request_btn" id="' . $rec['id'] . '"><em class="icon ni ni-send-alt"></em>&nbsp;Re-send Request</button>
                            <button class="btn btn-sm btn-success approve_request_btn" id="' . $rec['id'] . '"><em class="icon ni ni-check"></em>&nbsp;Approve</button>
                            <button class="btn btn-sm btn-danger cancel_request_btn" id="' . $rec['id'] . '"><em class="icon ni ni-cross-circle"></em>&nbsp;Cancel</button>
                         </div>                                
                        ';
                } else if ($rec['status'] == 'approved' ) {
                    $status = '<span class="badge badge-sm badge-dot has-bg badge-success   d-none d-mb-inline-flex">'.ucfirst($rec['status']).'</span>';
                    $action =
                        '
                        <div class="text-center" role="group" aria-label="Button group">
                             <button class="btn btn-sm btn-success book_this_request_btn" id="' . $rec['id'] . '"><em class="icon ni ni-send-alt"></em>&nbsp;Book Now</button>
                             <button class="btn btn-sm btn-danger cancel_request_btn" id="' . $rec['id'] . '"><em class="icon ni ni-cross-circle"></em>&nbsp;Cancel</button>
                         </div>                                
                        ';

                }else if ($rec['status'] == 'rejected') {
                    $status = '<span class="badge badge-sm badge-dot has-bg badge-danger  d-none d-mb-inline-flex">'.ucfirst($rec['status']).'</span>';
                    $action = '<div class="text-center"><span class="badge badge-sm badge-dot has-bg badge-danger  d-none d-mb-inline-flex">Request Rejected</span></div>';

                }
                else if ($rec['status'] == 'booked') {
                    $status = '<span class="badge badge-sm badge-dot has-bg badge-success  d-none d-mb-inline-flex">'.ucfirst($rec['status']).'</span>';
                    $action = '<div class="text-center"><span class="badge badge-sm badge-dot has-bg badge-success d-none d-mb-inline-flex">Flight Booked</span></div>';
                }

                $table = 'tbl_corporate_travel_requests';
                $ar[] = array($i++, $flight, $user, $rec['travel_details']->offer_amount , date('Y-m-d h:i A', strtotime($rec['created_at'])), $status, $action);
            }
            unset($rec);
        }

        $dom['draw'] = $draw;
        $dom['iTotalRecords'] = $totalRecords;
        $dom['iTotalDisplayRecords'] = $totalRecordwithFilter;
        $dom['aaData'] = $ar;
        echo json_encode($dom);
    }
