<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" >
	<meta http-equiv="X-UA-Comptible" content="IE=edge">
	<title>AtoZ.com</title>
	<link href="{{ asset('assets/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
</head>
<body>
	<!-- need conditional session  -->
	@include('template/header') 
	@yield('content')
	<script src="{{ asset('assets/bootstrap/css/bootstrap.min.js') }}"></script>
	<script src="{{ asset('assets/jquery/jquery-3.2.1.min.js') }}"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$(document).on('click', '.pagination a',function(event){
				var url= $(this).attr('href');
				
				if (url.includes("{{route('search_order')}}")) {
					event.preventDefault();
					$('li').removeClass('active');
					$(this).parent('li').addClass('active');
					getData(url);
				}
			});
		});

		function getData(url){
			$.ajax({
				url: url,
				type: "post",
				data: {
					search: $('.search_order').val()
				},
				datatype: "html",
				success:function(data){
					$(".content").empty().html(data);
				},
				error: function(response) {
					console.log(response);
				}
			});
		}

		$('.search_order').change(function(){
			var url="{{route('search_order')}}";
			getData(url);
		});

	</script>
</body>
</html>