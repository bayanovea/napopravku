$(document).ready(function(){
	
    /* Configure datepicker */
    $("#datepicker").datepicker();

    /* Book appointment */
    $('.available-doctors').on('click', '.book-appointment', function(){
        var _this = $(this);

        $.ajax({
            type: 'POST',
            url: '/app/ajax/index.php',
            data: {
                user_id: $('.receptions').attr('data-cur-user'),
                doctor_id: _this.parents('.doctor-item').attr('data-item'),
                year: $('#datepicker .ui-datepicker-current-day').attr('data-year'),
                month: $('#datepicker .ui-datepicker-current-day').attr('data-month'),
                day: $('#datepicker .ui-state-active').text(),
                time: _this.siblings('select').val(),
                type: 'book-appointment'
            },
            dataType: 'json',
            cache: false,
            success: function(data) {
                _this.hide();
                _this.siblings('select option[value='+id+']');
                alert('Вы успешно записались на приём');
            }
        });
    });

	/* Cancel appointment */
	$('.cancel-appointment').click(function(){
		var _this = $(this); 

		$.ajax({
        	type: 'POST',
        	url: '/app/ajax/index.php',
        	data: {
        		id: _this.parents('tr').attr('data-item'),
        		type: 'cancel-appointment'
        	},
        	dataType: 'json',
        	cache: false,
        	success: function() {
        		_this.parents('tr').addClass('delete');
        		_this.hide();
        	}
        });
	});

    /* Choice specialist */
    $('.speciality-list li').click(function(){
        $('.speciality-list li.active').removeClass('active');
        $(this).addClass('active');
        var _this = $(this); 

        $.ajax({
            type: 'POST',
            url: '/app/ajax/index.php',
            data: {
                speciality_id: _this.attr('data-item'),
                year: $('#datepicker .ui-datepicker-current-day').attr('data-year'),
                month: $('#datepicker .ui-datepicker-current-day').attr('data-month'),
                day: $('#datepicker .ui-state-active').text(),
                type: 'available-doctors'
            },
            dataType: 'json',
            cache: false,
            success: function(data) {
                console.log(data);
                var res = '<p class="availabel-list-head">Доступные доктора:</p>';
                if(!$.isEmptyObject(data)){
                    for(id in data) {
                        res = res + '<div data-item="'+id+'" class="doctor-item">';
                            res = res + '<p class="text-info">' + data[id].name + ' ' + data[id].last_name + '</p>';
                            if(data[id].hours) {
                                res = res + '<select>';
                                for(hour in data[id].hours) {
                                    res = res + '<option value="'+data[id].hours[hour]+'">'+data[id].hours[hour]+':00</option>';
                                }
                                res = res + '</select>';
                                res = res + '<div class="btn btn-success book-appointment">Записаться</div>';
                            } else {
                                res = res + '<p class="empty-doctors-hourse">Свободны часов нет</p>';
                            }
                        res = res + '</div>'; 
                    }
                } else {
                    res = res + '<p class="empty-available-doctors">Доступных докторов нет</p>';
                }

                $('.available-doctors').html(res);
            }
        });
    });

})