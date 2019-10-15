@extends('layout.admin')

@section('header')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<meta name="csrf-token" content="{{ CSRF_TOKEN()}}">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
@endsection
@section('content')
	<div class="container">
		<table class="table table-inverse" id="tablePost">
			<thead>
				<tr>
					<th>#</th>
					<th>Address</th>
					<th>Area</th>
					<th>Prices</th>
					<th>Electric</th>
					<th>Water</th>
					<th>District</th>
					<th>Ward</th>
					<th>Status</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				@foreach($post as $key => $value)
				<tr>
					<td>{{$value->id}}</td>
					<td>{{$value->address}}</td>
					<td>{{$value->area}} m<sup>2</sup> </td>
					<td><?php echo number_format($value->price) ?></td>
					<td><?php echo number_format($value->electric)?number_format($value->electric):'null' ?></td>
					<td><?php echo number_format($value->water)?number_format($value->water):'null' ?></td>
					<td><?php foreach ($district as $key => $val) {
						if($val->id==$value->id_district) echo $val->name;
					} ?></td>
					<td><?php foreach ($ward as $key => $val) {
						if($val->id==$value->id_ward) echo $val->name;
					} ?></td>
					<td>
						@if($value->status==1)
							<p class="text-info">Chưa Thuê</p>
						@elseif($value->status==2)
							<p class="text-warning">Đang Giữ</p>
						@elseif($value->status==3)
							<p class="text-success">Đã Thuê</p>
						@elseif($value->status==4)
							<p class="text-danger">Chờ Accept</p>
						@endif
					</td>
					<td class="d-flex flex-column">
						@if($value->status==1)
							<div class="btn btn-warning mb-1 noAccept" data_id="{{$value->id}}"><i class="fas fa-times-circle"></i></div>
							<div class="btn btn-danger mb-1 delete" data_id="{{$value->id}}"><i class="fas fa-trash"></i></div> 
							<div class="btn btn-info update"><a href="{{route('home.edit',$value->id)}}"><i class="fas fa-pen"></i></a></div> 
						@elseif($value->status==2)
							<div class="btn btn-warning mb-1 noAccept" data_id="{{$value->id}}"><i class="fas fa-times-circle"></i></div>
							<div class="btn btn-danger mb-1 delete" data_id="{{$value->id}}"><i class="fas fa-trash"></i></div> 
							<div class="btn btn-info update"><a href="{{route('home.edit',$value->id)}}"><i class="fas fa-pen"></i></a></div> 
						@elseif($value->status==3)
							<div class="btn btn-warning mb-1 noAccept" data_id="{{$value->id}}"><i class="fas fa-times-circle"></i></div>
							<div class="btn btn-danger mb-1 delete" data_id="{{$value->id}}"><i class="fas fa-trash"></i></div> 
							<div class="btn btn-info update"><a href="{{route('home.edit',$value->id)}}"><i class="fas fa-pen"></i></a></div> 
						@elseif($value->status==4)
							<div class="d-flex mb-1 justify-content-between flex-row">
								<div class="btn btn-success accept" data_id="{{$value->id}}"><i class="fas fa-check"></i></div>
								<div class="btn btn-warning noAccept" data_id="{{$value->id}}"><i class="fas fa-times-circle"></i></div> 
							</div>
							<div class="btn btn-danger mb-1 delete" data_id="{{$value->id}}"><i class="fas fa-trash"></i></div> 
							<div class="btn btn-info update"><a href="{{route('home.edit',$value->id)}}"><i class="fas fa-pen"></i></a></div> 
						@endif
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
		<div class="row">
				{{$post->links()}}
		</div>
	</div>

<script type="text/javascript">
	$(document).ready(function(){
		$.ajaxSetup({
			headers:{
				'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
			}
		});

		$(document).on('click','.accept',function(){
			var idProduct = $(this).attr('data_id');
			console.log(idProduct);
			if(confirm('Bạn đang đồng ý yêu cầu này?')){
				$.ajax({
					url:'home',
					method:'post',
					dataType:'json',
					data:{
						id:idProduct
					},
					success:function(data){
						alert(data);
						$('#tablePost').load(' #tablePost');
					}
				});
			}
		});

		$(document).on('click','.noAccept',function(){
			var idProduct = $(this).attr('data_id');
			if(confirm('Bạn không chấp nhận yêu cầu này?')){
				$.ajax({
					url:'home/'+idProduct,
					method:'delete',
					dataType:'json',
					data:{
						id:idProduct
					},
					success:function(data){
						alert(data);
						$('#tablePost').load(' #tablePost');
					}
				});
			}
		});

		$(document).on('click','.delete',function(){
			var idProduct = $(this).attr('data_id');
			if(confirm('Bạn có muốn xóa bài post này?')){
				$.ajax({
					url:'home/'+idProduct,
					method:'delete',
					dataType:'json',
					data:{
						id:idProduct
					},
					success:function(data){
						alert(data);
						$('#tablePost').load(' #tablePost');
					}
				});
			}
		});
	});
</script>

@endsection