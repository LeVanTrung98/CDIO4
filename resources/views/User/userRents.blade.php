@extends('layout.user')


@section('header')
<meta name="csrf-token" content="{{csrf_token()}}">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
@endsection


@section('container')
<div class="container">
	<div class="row">
		<div class="col-7">
			<div class="alert alert-danger text-center">Cho Thuê</div>
			<table class="table table-inverse">
				<thead>
					<tr>
						<th>Date</th>
						<th>User</th>
						<th>House</th>
						<th>Status</th>
						<th>Update</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					@foreach($house as $value)
					<tr>
						<td><?php echo date_format($value->pivot->created_at,'Y-m-d') ?></td>
						<td>{{$value->pivot->user_id}}</td>
						<td>{{$value->id}}</td>
						<td>
							@if($value->status==4)
								<p class="text-info">Đang chờ accept</p>
							@elseif($value->status==1)
								<p class="text-primary">Đang cho thuê</p>
							@elseif($value->status==2)
								<p class="text-warning">User đang giữ</p>
							@elseif($value->status==3)
								<p class="text-success">User đã thuê</p>
							@endif
						</td>
						<td><a href="{{route('formUpdate',$value->id)}}" class="btn btn-warning">Update</a></td>
						<td ><a class="btn btn-success" href="{{route('detailUser',$value->id)}}" style="color: white;">Xem chi tiết</a></td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
		<div class="col-5">
			<div class="alert alert-success text-center">Đã Thuê</div>
			<table class="table table-inverse " id="tableRent">
				<thead>
					<tr>
						<th>Date</th>
						<td>House</td>
						<th>Status</th>
						<th>Delete</th>
					</tr>
				</thead>
				<tbody>
					@foreach($justRent as $key => $value)
					<tr>
						<td>{{$key}}</td>
						<td>{{$value->id}}</td>
						@if($value->pivot->status==4)
							<td class="text-success">Đã Thuê</td>
						@elseif($value->pivot->status==5)
							<td class="text-danger">Chủ không đồng ý</td>
						@elseif($value->pivot->status==1)
							<td class="text-info">Đang chọn</td>
						@elseif($value->pivot->status==3)
							<td class="text-warning">Không đến</td>
						@elseif($value->pivot->status==6)
							<td class="text-primary">Đã hủy giữ trọ</td>
						@endif
						<td>
							@if($value->pivot->status==1)
							<div class="btn btn-danger deleteKeepHouse" data_id="{{$value->id}}">Delete</div>
							@endif
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
		
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function(){
		$.ajaxSetup({
			headers:{
				'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
			}
		});

		$(document).on('click','.deleteKeepHouse',function(){
			var id = $(this).attr('data_id');
			if(confirm('Bạn có muốn hủy giữ trọ này không?')){
				$.ajax({
					url:'user/'+id,
					dataType:'json',
					method:'delete',
					success:function(data){
						alert(data);
						$('#tableRent').load(' #tableRent');
					}
				});
			}
		});
	});
</script>
@endsection