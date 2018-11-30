<div class="container-fluid">
	<div class="row flex-grow bg-transparent">
		<fieldset class='col-10'>
			<textarea id='comment-text-{{ $story_id }}' class="form-control text-primary d-inline w-100" rows="1"></textarea>
			<div class="invalid-feedback">Veuillez spécifier un commentaire</div>
		</fieldset>
		<button class="btn btn-secondary col-2" onclick="Comments.addAJAX({{ $story_id }})">Envoyer</button>
	</div>
</div>