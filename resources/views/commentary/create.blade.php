<div class="container-fluid">
	<div class="row flex-grow bg-transparent">
		<form class='w-100 row' action="{{ route('commentary.store') }}" method="POST">
			@csrf
			<input type="hidden" name="story_id" value="{{ $story_id }}" />
			<input type="hidden" name="user_id" value="{{ Auth::user()->getId() }}" />
			<fieldset class='col-10'>
				<textarea class="form-control text-primary d-inline w-100" name="comment" rows="1"></textarea>
			</fieldset>
			<button class="btn btn-secondary col-2" type="submit">Envoyer</button>
		</form>
	</div>
</div>