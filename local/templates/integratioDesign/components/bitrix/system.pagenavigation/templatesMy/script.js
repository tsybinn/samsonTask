$(document).ready(function(){

 //* ajax pagination
	$(document).on('click', '.load_more', function(){
		var targetContainer = $('.news-list_elem'),          //  Контейнер, в котором хранятся элементы
			url =  $('.load_more').attr('data-url');    //  URL, из которого будем брать элементы

		if (url !== undefined) {
			$.ajax({
				type: 'GET',
				url: url,
				dataType: 'html',
				success: function(data){

					//  Удаляем старую навигацию
					//$('.load_more').remove();

					var elements = $(data).find('.news-item');  //  Ищем элементы
						//console.log(elements);
						 var pagination = $(data).find('.load_more').attr("data-url");//  Ищем навигацию
					$('.load_more').attr("data-url",pagination);
					console.log(pagination);
					targetContainer.append(elements);   //  Добавляем посты в конец контейнера
					//targetContainer.append(pagination); //  добавляем навигацию следом

				}
			})
		}
	});
});

