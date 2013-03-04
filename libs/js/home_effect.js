// $(function(){
// 	$('.container #reg').click(
// 		function(){
// 			$('.content').slideUp(),
// 			$('.content').slideDown('slow'),
// 			$('.login').css('display','none'),
// 			$('.register').css('display','block')
// 		}
// 	);
// 	$('.container #log').click(
// 		function(){
// 			$('.content').slideUp(),
// 			$('.content').slideDown('slow'),
// 			$('.register').css('display','none'),
// 			$('.login').css('display','block')
// 		}
// 	)

// })
$(function(){
	$('.container #reg').click(
		$('.msg').css('display','block'),
		function(){
			$('.msg').css('display','none'),
			$('.content').css('display','block'),
			$('.login').slideUp('slow'),
			$('.register').slideDown('slow')
		}
	);
	$('.container #log').click(
		function(){
			$('.msg').css('display','none'),
			$('.content').css('display','block'),
			$('.register').slideUp('slow'),
			$('.login').slideDown('slow')
		}
	)
})