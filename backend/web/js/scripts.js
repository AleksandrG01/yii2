	// let $form = $('#subject-form');
	// $form.on('beforeSubmit', function() {
	// 		// var data = $form.serialize();
	// 		var files = '';
	// 		var data = new FormData($form[0]);
	// 		data.forEach(function(item, i, arr){
	// 			if(i == 'files'){
	// 				data.append(item.name, item);
	// 			}
	// 		})
	// 		data.append( 'logo', 1 );
	// 		console.log(data);
	// 		$.ajax({
	// 				url: $form.attr('action'),
	// 				type: 'POST',
	// 				data: data,
	// 				success: function (message) {
	// 						// console.log(message);
	// 						$form[0].reset();
	// 						if(message.add_subject == "ok"){
	// 							Swal.fire({
	// 								icon: 'success',
	// 								title: 'Субьект добавлен',
	// 								showConfirmButton: false,
	// 								timer: 1500
	// 							})
	// 						}
	// 				},
	// 				error: function(jqXHR, errMsg) {
	// 						alert(errMsg);
	// 				}
	// 		}); 
	// 		return false;
	// });

