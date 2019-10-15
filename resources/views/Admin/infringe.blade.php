@extends('layout.admin')

@section('content')
<div class="container">
	<table class="table table-inverse">
		<thead>
			<tr>
				<th>#</th>
				<th>User</th>
				<th>Status</th>
			</tr>
		</thead>
		<tbody>
			@foreach($infringe as $value) 
			<tr>
				<td>{{$value->id}}</td>
				<td>{{$value->user->name}}</td>
				<td>
					@if($value->status==1)
						<p class="text-warning">Tài khoản đang cảnh báo.</p>
					@elseif($value->status==2)
						<p class="text-danger">Tài khoản đã bị khóa.</p>
					@endif
				</td>
			</tr>
			@endforeach
		</tbody>

	</table>
	<div class="row">
		{{$infringe->links()}}
	</div>
</div>
@endsection