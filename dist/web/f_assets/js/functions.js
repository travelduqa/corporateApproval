//GETS OFFER DATA AND OPENS MODAL
$(document).on('click', '.btn_request_offer', function(e){
    e.preventDefault();
    var url_root = 'http://localhost/duqa_mvc/';
    var current_article = $(this).closest('article');
    var clicked_button=$(this);
    var data = [], section= {};
    $(current_article).find('.main_section').each(
        function (i){
            var content = $(this).find('.section-content-drop');
            section[i]= '';
            if(content.find('.sub_section').length>0){
                //check if the section has sub sections which contain data on connect flights
                var sub_section= {}, trip_details = [];
                content.find('.sub_section').each(
                    function (i){
                        sub_section[i] = {
                            arrival_city:  $(this).find('.quote_arrival_city_gtb').text().trim(),
                            departure_city:  $(this).find('.quote_departure_city_gtb').text().trim(),
                            arrival_airport:  $(this).find('.quote_arrival_airport_gtb').text().trim(),
                            departure_airport:  $(this).find('.quote_departure_airport_gtb').text().trim(),
                            flight_class:  $(this).find('.flight_class_gtb').text().trim(),
                            departure_date:  $(this).find('.departure-date-gtb').text().trim(),
                            arrival_date:  $(this).find('.arrival-date-gtb').text().trim(),
                            departure_time:  $(this).find('.quote_dep_time_gtb').text().trim(),
                            arrival_time:  $(this).find('.quote_arr_time_gtb').text().trim(),
                            duration:  $(this).find('.quote_duration_gtb').text().trim(),
                            airline:  $(this).find('.quote_airline_gtb').text().trim(),
                            airline_no: $(this).find('.quote_flight_no_gtb').text().trim(),
                            connect_text:  $(this).find('.connect_text').text().trim()
                        };
                        //store connect trip details in an individual array
                        trip_details.push(sub_section[i]);
                    });
                //store general details about the flight
                section[i]= {
                    total_duration:  $(this).find('.quote_total_duration_gtb').text().trim(),
                    departure_date:  $(this).find('.departure-date-gtb-start').text().trim(),
                    arrival_date:  $(this).find('.arrival-date-gtb-end').text().trim(),
                    departure_city:  content.find('.quote_departure_city_gtb').text().trim(),
                    arrival_city:  $(this).find('.quote_arrival_city_gtb').text().trim(),
                    departure_time:  $(this).find('.quote_dep_time_tot').text().trim(),
                    arrival_time:  $(this).find('.quote_arr_time_tot').text().trim(),
                    airline_image: content.find('.quote_flight_image_otb').attr('src'),
                    more_details: trip_details

                };
            }else{
                //if there are no connect details
                section[i] = {
                    arrival_city:  content.find('.quote_arrival_city_gtb').text().trim(),
                    departure_city:  content.find('.quote_departure_city_gtb').text().trim(),
                    arrival_airport:  content.find('.quote_arrival_airport_gtb').text().trim(),
                    departure_airport:  content.find('.quote_departure_airport_gtb').text().trim(),
                    flight_class:  content.find('.flight_class_gtb').text().trim(),
                    departure_date:  $(this).find('.departure-date-gtb').text().trim(),
                    arrival_date:  $(this).find('.arrival-date-gtb').text().trim(),
                    departure_time:  $(this).find('.quote_dep_time_gtb').text().trim(),
                    arrival_time:  $(this).find('.quote_arr_time_gtb').text().trim(),
                    duration:  $(this).find('.quote_duration_gtb').text().trim(),
                    airline:  content.find('.quote_airline_gtb').text().trim(),
                    airline_no: content.find('.quote_flight_no_gtb').text().trim(),
                    airline_image: $(content).find('.quote_flight_image_otb').attr('src')
                };
            }
        });
    //push trip details
    data.push(section);
    //push offer_id to array
    data.push($(this).prop('id'));
    //push fare amount to array
    data.push( current_article.find('.quote_amount').text());
  
//   OPENS MODAL
    $.ajax({
        type: 'POST',
        url: url_root+'flights/get_offer_details/',
        data: {item_data: data},
        dataType: 'json',
        success: function (data) {
         $('#request_offer_modal .offer__details').html(data);
         $('#request_offer_modal').modal('show');

        },
        error: function(data) {
        }
    });
});

//OPENS CONFIRMATION
$(document).on('click', '.submit_user_request_btn', function(e){
    $('#request_offer_modal').modal('hide');
    $('#confirm_travel_request').modal('show');
});

//CONFIRMS AND SUBMITS TRAVEL REQUEST
$(document).on('click', '.confirm_request_submission_btn', function(e){
    var clicked_btn = $(this), return_date='-';
    if($('#request_offer_modal').find('.return_section').length>0){
        return_date = $('#request_offer_modal .return_section').find('.return_trip_dates').html();
    }
    var trip_details = {
        cities: $('#request_offer_modal .going_section').find('.going_trip_cities').html(),
        going_date: $('#request_offer_modal .going_section').find('.going_trip_dates').html(),
        returning_date: return_date,
        offer_amount: $('#request_offer_modal .offer_currency').html()+$('#request_offer_modal .offer_amount').html()
    };
    $.ajax({
        type: 'POST',
        url: url_root+'flights/send_request/',
        data: {
            offer_data: $('.offer__body').html(),
            offer_id: $('input[name="selected_offer_id"]').val(),
            trip_details: trip_details
        },
        dataType: 'json',
        success: function (data) {
            clicked_btn.find('.button_icon').replaceWith('<i class="fa fa-spinner fa-spin"></i>&nbsp;');
            clicked_btn.find('.button_text').text('Requesting');
            var i  = 0;
            setInterval(function() {

                clicked_btn.find('.button_text').append(".");
                i++;

                if(i === 5)
                {
                    clicked_btn.find('.button_text').html('Requesting');
                    i = 0;
                }

            }, 500);
            window.setTimeout(function(){
                window.location.replace(url_root + 'corporate/corporate_travel_requests/pending');
            },3000);
        },
        error: function(data) {
        }
    });
});
