<tr class="border border-light rounded-circle">
	<td>
		<div class="container-fluid">
			<div class="row flex-grow">
				<div class="col-2 flex-grow d-block">
					<h6 class="text-left font-weight-bold text-white">{{ $commentary->user->name }}</h6>
					<h6 class="text-left font-weight-bold text-white">{{ $commentary->updated_at }}</h6>
				</div>
				<div class="col-10 flex-grow d-block">
					<p class="text-white text-left">{{ $commentary->comment }}</p>
				</div>
			</div>
		</div>
	</td>
</tr>
