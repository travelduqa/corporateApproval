<?php


    public function flight_requests(){
        $this->page_construct_flights('pages/flight_requests');
    }

//generate offer body
    public function get_offer_details(){
        if($_SERVER['REQUEST_METHOD']=='POST'){
            $flight_details = $_POST['item_data'];

            $html = '<input type="text" class="hidden" name="selected_offer_id" value="'.$flight_details[1].'">';
            $j=0;
            foreach ($flight_details[0] as $detail){
                if(!empty($detail['more_details'])){

                    $html.='
                <div>
					<div class="border quote_div '.($j==0?'going_section':'return_section').'" style="background:#fafafa;padding:10px; border-radius:5px;margin-bottom:10px;border: 1px #cacaca solid;">
                    <span ><strong>
                            '.($j==0?'
                                    <svg class="inline-block" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" id="IconChangeColor" height="24" width="24"> <g> <path fill="none" d="M0 0h24v24H0z" id="mainIconPathAttribute"></path> <path d="M10.478 11.632L5.968 4.56l1.931-.518 6.951 6.42 5.262-1.41a1.5 1.5 0 0 1 .776 2.898L5.916 15.96l-.776-2.898.241-.065 2.467 2.445-2.626.704a1 1 0 0 1-1.133-.48L1.466 10.94l1.449-.388 2.466 2.445 5.097-1.366zM4 19h16v2H4v-2z" id="mainIconPathAttribute"></path> </g> </svg>
                                    Going '
                            :'
                                    <svg class="inline-block" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" id="IconChangeColor" height="24" width="24" transform="scale(-1, 1)"> <g> <path fill="none" d="M0 0h24v24H0z" id="mainIconPathAttribute"></path> <path d="M10.478 11.632L5.968 4.56l1.931-.518 6.951 6.42 5.262-1.41a1.5 1.5 0 0 1 .776 2.898L5.916 15.96l-.776-2.898.241-.065 2.467 2.445-2.626.704a1 1 0 0 1-1.133-.48L1.466 10.94l1.449-.388 2.466 2.445 5.097-1.366zM4 19h16v2H4v-2z" id="mainIconPathAttribute"></path> </g> </svg>
                                    Return').'
                        
                        </strong></span>Trip From:
                                        <strong style="color:green"  class="'.($j==0?'going_trip_cities':'return_trip_cities').'">'.$detail['departure_city'].' to '.$detail['arrival_city'].' </strong> on <span style="color:#e14624 " class="'.($j==0?'going_trip_dates':'return_trip_dates').'">'.$detail['departure_date'].' - '.$detail['arrival_date'].'</span>

                    <table style="box-sizing: border-box; border-collapse: collapse; width: 100%; max-width: 710px; margin: 0px auto; background: #fafafa; margin-bottom:0px">
                        <tbody>
                        <tr>
                                <td><strong>Departure</strong><br>
                                    '.$detail['departure_date'].' - '.$detail['departure_time'].'
                                </td>
                                
                                <td><strong>Arriving</strong><br>
                                     '.$detail['arrival_date'].' - '.$detail['arrival_time'].'
                                </td>
                             
                                <td><strong>Total Duration</strong><br>'.$detail['total_duration'].'
                                </td>
                            </tr></tbody>
                    </table>
					<div class="quote_div_inner" style="background:#fafafa;padding:20px; border-radius:5px;margin-bottom:5px;">
                    <table style="box-sizing: border-box; border-collapse: collapse; width: 100%; max-width: 710px; margin: 0px auto; background: #fafafa; margin-bottom:0px">
                        <tbody>
                            <tr>
                                <td>
                                    <strong>'.$detail['more_details'][0]['departure_airport'].' to '.$detail['more_details'][0]['arrival_airport'].' </strong><br>
                                </td>
                            </tr><tr>
                        </tr></tbody>
                    </table>
                    <table style="box-sizing: border-box; border-collapse: collapse; width: 100%; max-width: 710px; margin: 0px auto; background: #fafafa;margin-bottom:10px">
                        <tbody >
                            
                            <tr>
                                <td>
                                    <img src="'.$detail['airline_image'].'" style="height:30px;width:30px">
                                </td>
                                <td><strong>'.$detail['more_details'][0]['airline'].'</strong><br>
                                    '.$detail['more_details'][0]['airline_no'].'
                                </td>
                                <td>
                                    <img style="max-width: 30px;" src="https://www.travelduqa.africa/dist/images/icons/flight_up.png" alt="Travelduqa" title="Travelduqa">
                                </td>
                                <td><strong>Departure</strong><br>
                                   '.$detail['more_details'][0]['departure_time'].'
                                </td>
                                <td>
                                    <img style="max-width: 30px;" src="https://www.travelduqa.africa/dist/images/icons/flight_down.png" alt="Travelduqa" title="Travelduqa">
                                </td>
                                <td><strong>Arriving</strong><br>
                                    '.$detail['more_details'][0]['arrival_time'].'
                                </td>
                                <td>
                                    <img style="max-width: 30px;" src="https://www.travelduqa.africa/dist/images/icons/clock.png" alt="Travelduqa" title="Travelduqa">
                                </td>
                                <td><strong>Duration</strong><br>'.$detail['more_details'][0]['duration'].'
                                </td>
                            </tr>
                            
                            <tr>
                                
                                
                            </tr>
                            
                        </tbody>
                        
                    </table>
                    <center><strong><span style="color:green">'.$detail['more_details'][0]['connect_text'].'</span></strong></center><table style="margin-bottom:-7px;">
                    <table style="box-sizing: border-box; border-collapse: collapse; width: 100%; max-width: 710px; margin: 0px auto; background: #fafafa; margin-bottom:0px">
                       <tbody>
                            <tr>
                                <td>
                                    <strong>'.$detail['more_details'][1]['departure_airport'].' to '.$detail['more_details'][1]['arrival_airport'].' </strong><br>
                                </td>
                            </tr><tr>
                        </tr></tbody>
                    </table>
                    <table style="box-sizing: border-box; border-collapse: collapse; width: 100%; max-width: 710px; margin: 0px auto; background: #fafafa;margin-bottom:0px">
                                <tbody>
                            
                                 <tr>
                                <td>
                                    <img src="'.$detail['airline_image'].'" style="height:30px;width:30px">
                                </td>
                                <td><strong>'.$detail['more_details'][1]['airline'].'</strong><br>
                                    '.$detail['more_details'][1]['airline_no'].'
                                </td>
                                <td>
                                    <img style="max-width: 30px;" src="https://www.travelduqa.africa/dist/images/icons/flight_up.png" alt="Travelduqa" title="Travelduqa">
                                </td>
                                <td><strong>Departure</strong><br>
                                   '.$detail['more_details'][1]['departure_time'].'
                                </td>
                                <td>
                                    <img style="max-width: 30px;" src="https://www.travelduqa.africa/dist/images/icons/flight_down.png" alt="Travelduqa" title="Travelduqa">
                                </td>
                                <td><strong>Arriving</strong><br>
                                    '.$detail['more_details'][1]['arrival_time'].'
                                </td>
                                <td>
                                    <img style="max-width: 30px;" src="https://www.travelduqa.africa/dist/images/icons/clock.png" alt="Travelduqa" title="Travelduqa">
                                </td>
                                <td><strong>Duration</strong><br>'.$detail['more_details'][1]['duration'].'
                                </td>
                            </tr>
                            
                            <tr>
                                
                                
                            </tr>
                            
                        </tbody>
                            </table>
                    </div>
                </div>
                </div>
';

                }else{
                    $html.='        
                    
                <div>
					<div class="border quote_div '.($j==0?'going_section':'return_section').'" style="background:#fafafa;padding:10px; border-radius:5px;margin-bottom:10px;border: 1px #cacaca solid;">
                        <span><strong>
                          '.($j==0?'
                                    <svg class="inline-block" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" id="IconChangeColor" height="24" width="24"> <g> <path fill="none" d="M0 0h24v24H0z" id="mainIconPathAttribute"></path> <path d="M10.478 11.632L5.968 4.56l1.931-.518 6.951 6.42 5.262-1.41a1.5 1.5 0 0 1 .776 2.898L5.916 15.96l-.776-2.898.241-.065 2.467 2.445-2.626.704a1 1 0 0 1-1.133-.48L1.466 10.94l1.449-.388 2.466 2.445 5.097-1.366zM4 19h16v2H4v-2z" id="mainIconPathAttribute"></path> </g> </svg>
                                    Going '
                            :'
                                    <svg class="inline-block" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" id="IconChangeColor" height="24" width="24" transform="scale(-1, 1)"> <g> <path fill="none" d="M0 0h24v24H0z" id="mainIconPathAttribute"></path> <path d="M10.478 11.632L5.968 4.56l1.931-.518 6.951 6.42 5.262-1.41a1.5 1.5 0 0 1 .776 2.898L5.916 15.96l-.776-2.898.241-.065 2.467 2.445-2.626.704a1 1 0 0 1-1.133-.48L1.466 10.94l1.449-.388 2.466 2.445 5.097-1.366zM4 19h16v2H4v-2z" id="mainIconPathAttribute"></path> </g> </svg>
                                    Return').'
                        </strong></span> Trip From: 
                        <strong style="color:green"  class="'.($j==0?'going_trip_cities':'return_trip_cities').'">'.$detail['departure_city'].' to '.$detail['arrival_city'].' </strong> on <span style="color:#e14624" class="'.($j==0?'going_trip_dates':'return_trip_dates').'" >'.$detail['departure_date'].' - '.$detail['arrival_date'].'</span>
                    <div class="quote_div_inner" style="background:#fafafa;padding:20px; border-radius:5px;margin-bottom:5px;">
                        <table style="box-sizing: border-box; border-collapse: collapse; width: 100%; max-width: 710px; margin: 0px auto; background: #fafafa; margin-bottom:0px">
                            <tbody>
                            <tr>
                                <td>
                                    <strong>'.$detail['departure_airport'].' to '.$detail['arrival_airport'].'</strong>
                                </td>
                              
                            </tr><tr>
                            </tr></tbody>
                        </table>
                        <table style="box-sizing: border-box; border-collapse: collapse; width: 100%; max-width: 710px; margin: 0px auto; background: #fafafa;margin-bottom:0px">
                            <tbody>

                            <tr>

                                <td>
                                    <img src="'.$detail['airline_image'].'" style="height:30px;width:30px">
                                </td>
                                <td><strong>'.$detail['airline'].'</strong><br>
                                    '.$detail['airline_no'].'
                                </td>
                                <td>
                                    <img style="max-width: 30px;" src="https://www.travelduqa.africa/dist/images/icons/flight_up.png" alt="Travelduqa" title="Travelduqa">
                                </td>
                                <td><strong>Departure</strong><br>
                                    '.$detail['departure_date'].' '.$detail['departure_time'].'
                                </td>
                                <td>
                                    <img style="max-width: 30px;" src="https://www.travelduqa.africa/dist/images/icons/flight_down.png" alt="Travelduqa" title="Travelduqa">
                                </td>
                                <td><strong>Arriving</strong><br>
                                     '.$detail['arrival_date'].' '.$detail['arrival_time'].'
                                </td>
                                <td>
                                    <img style="max-width: 30px;" src="https://www.travelduqa.africa/dist/images/icons/clock.png" alt="Travelduqa" title="Travelduqa">
                                </td>
                                <td><strong>Duration</strong><br>'.$detail['duration'].'
                                </td>
                            </tr>
                            <tr>
                            </tr>
                            </tbody>
                        </table>
                        </div>
                    </div>
                    </div>
               
';
                }
                $j++;
            }
            $html.='<span style="float:right;" class="offer_price"><span>Price:<strong style="font-size: 20px"> <span  class="offer_currency" >KES.</span> <span class="offer_amount">'.str_replace('KES','',$flight_details[2]).'</span></strong></span></span>';
        }
        echo json_encode($html);
    }
    
    
//submit user travel request
    public function send_request()
    {
        if($_SERVER['REQUEST_METHOD']=='POST') {
        //I USED A STATIC ID HERE CHANGE TO CURRENT LOGGED IN
            $corporate_user = $this->admin_model->get_data_where_row('tbl_corporate_employees', array('details, user_id'), array('id=?' => 35 ));
            $user_details = [
                'names' => json_decode($corporate_user->details)->first_name.' '.json_decode($corporate_user->details)->last_name,
                'email' => json_decode($corporate_user->details)->email_address,
                'phone' => json_decode($corporate_user->details)->phone_code.json_decode($corporate_user->details)->phone_number,
            ];
            $data = [
            //STATIC ID. CHANGE TO CURRENT LOGGED IN
                'user_id'=>35,
                'corporate_id' =>$corporate_user->user_id ,
                'offer_body' => $_POST['offer_data'] ,
                'user_details' => json_encode($user_details),
                'offer_id' => $_POST['offer_id'],
                'travel_details' => json_encode($_POST['trip_details']),
                'response_id' => time().'-'.rand(100000, 999999)
            ];

            if($this->admin_model->insert_basic('tbl_corporate_travel_requests', $data)){
                echo json_encode('request successfully created');
            }
        }
    }
