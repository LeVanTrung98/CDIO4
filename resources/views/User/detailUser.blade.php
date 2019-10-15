@extends('layout.user')

@section('header')
<meta name="csrf-token" content="{{ csrf_token() }}">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

@endsection

@section('container')
<div class="container">
	<div class="row">
		<div class="col-1"></div>
		<div class="col-10">
			<table class="table table-inverse" id="tableContainer">
				<thead>
					<tr>
						<th>Date</th>
						<th>User</th>
						<th>House</th>
						
						<th>Action</th>
					</tr>
				</thead>
				<tbody >
					@foreach($rent as $value)
					<tr>
						<td>{{$value->pivot->created_at}}</td>
						<td>{{$value->pivot->user_id}}</td>
						<td>{{$value->pivot->post_id}}</td>
						@if($value->pivot->status==5)
							<td><p class="btn btn-danger">Bạn đã hủy cho thuê</p></td>
						@endif
						@if($value->pivot->status==4)
							<td><p class="btn btn-success">Bạn đã cho thuê</p></td>
						@endif
						@if($value->pivot->status==2)
							<td><p class="btn btn-info">Đã đến xem</p></td>
						@endif
						@if($value->pivot->status==3)
							<td><p class="btn btn-warning">Không đến</p></td>
						@endif
						@if($value->pivot->status==1)
						<td >
							<p class="btn btn-danger khongthue" data_user="{{$value->pivot->user_id}}" data_id="{{$value->pivot->post_id}}">Không cho thuê</p>
							<p class="btn btn-primary den" data_user="{{$value->pivot->user_id}}" data_id="{{$value->pivot->post_id}}">Đã đến</p>
							<p class="btn btn-info dathue" data_user="{{$value->pivot->user_id}}" data_id="{{$value->pivot->post_id}}">Đã thuê</p>
						</td>
						@endif
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>

<<script  type="text/javascript">
	$(document).ready(function(){
		$.ajaxSetup({
			headers:{
				'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
			}
		});

		$(document).on('click','.khongthue',function(){
			var post = $(this).attr('data_id');
			var user = $(this).attr('data_user');
			if(confirm('Bạn có muốn cho thuê?')){
				$.ajax({
					url:'/users',
					type:'post',
					dataType:'json',
					data:{
						'post':post,
						'user':user
					},
					success:function(data){
						// console.log(data);
						alert(data);
						$('#tableContainer').load(' #tableContainer');
					}
				});
			}
		});

		$(document).on('click','.dathue',function(){
			var post = $(this).attr('data_id');
			var user = $(this).attr('data_user');
			console.log(post);
			if(confirm('Bạn có muốn không cho thuê trọ?')){
				$.ajax({
					url:'/users/accept',
					type:'post',
					dataType:'json',
					data:{
						'post':post,
						'user':user
					},
					success:function(data){
						// console.log(data);
						if(data.failer){
							alert(data.failer);
						}else{
							alert(data);
						}
						$('#tableContainer').load(' #tableContainer');
					}
				});
			}
		});

		$(document).on('click','.den',function(){
					var post = $(this).attr('data_id');
					var user = $(this).attr('data_user');
					console.log(post);
					if(confirm('Bạn có muốn tiếp tục?')){
						$.ajax({
							url:'/users/Come',
							type:'post',
							dataType:'json',
							data:{
								'post':post,
								'user':user
							},
							success:function(data){
								// console.log(data);
								alert(data);
								$('#tableContainer').load(' #tableContainer');
							}
						});
					}
				});

	});
</script>
@endsection