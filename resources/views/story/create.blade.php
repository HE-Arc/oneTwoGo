@extends('layouts.app')

@section('content')
<div class="row">
	<div class="col-3 spacer"></div>
	<div class='col-6 card mb-3'>
		<h2 class='card-header center'>Écris une histoire !</h2>
		<div class='card-body'>
			<h3>Thème</h3>
			<div id="carouselThemes" class="carousel slide w-100" data-ride="carousel" data-interval="false" style="width:600px">
				<ol class="carousel-indicators">
					@for ($i = 0; $i < sizeof($themes); $i++)
						<li data-target="#carouselThemes" data-slide-to="{{$i}}" @if ($i == 0)class="active"@endif></li>
					@endfor
				</ol>
				<div class="carousel-inner carousel-text">
					@for ($i = 0; $i < sizeof($themes); $i++)
						<div data-themeid="{{$themes[$i]['id']}}" data-placeholder="{{$themes[$i]['placeholder']}}" class="carousel-item @if ($i == 0) active @endif">
							<!--<img class="d-block w-100" src="{{$themes[$i]['image']}}" alt="{{$themes[$i]['name']}}">-->
							<h5 class='center'>{{$themes[$i]['name']}}</h5>
						</div>
					@endfor
				</div>
				<a class="carousel-control-prev" href="#carouselThemes" role="button" data-slide="prev">
					<span class="carousel-control-prev-icon"></span>
					<span class="sr-only">Précédent</span>
				</a>
				<a class="carousel-control-next" href="#carouselThemes" role="button" data-slide="next">
					<span class="carousel-control-next-icon"></span>
					<span class="sr-only">Suivant</span>
				</a>
			</div>

			<h3>Contraintes <i id='randomize' class="fas fa-random"></i></h3>
			<div>
				<h4>Doit contenir</h4>
				<span id='mustContain'></span>
				<h4>Ne doit pas contenir</h4>
				<span id='mustntContain'></span>
			</div>
			<p class='w-100'>
				<div class="form-group has-danger">
					<h3 class="form-control-label" for="title">Titre</h3>
					<input id='title' type='text' name='title' placeholder="" class="form-control" maxlength="{{ $lenghtConstraints[1] }}">
					<div id='titleMinSizeFeedback' class="invalid-feedback">Le titre est trop court, minimum {{ $lenghtConstraints[0] }} charactères</div>
					<div id='titleMaxSizeFeedback' class="invalid-feedback">Le titre ne peut pas être plus long que {{ $lenghtConstraints[1] }} charactères</div>
				</div>
			</p>
			<div>
				<div class="form-group has-danger">
					<h3 class="form-control-label" for="text">Texte</h3>
					<textarea id="text" name='text' class="form-control" rows="10" maxlength="{{ $lenghtConstraints[3] }}"></textarea>
					<div id='textMinSizeFeedback' class="invalid-feedback">Le texte est trop court, minimum {{ $lenghtConstraints[2] }} charactères @if($lenghtConstraints[2] == 280), car on est pas Twitter =} @endif</div>
					<div id='textMaxSizeFeedback' class="invalid-feedback">Le texte ne peut pas être plus long que {{ $lenghtConstraints[3] }} charactères</div>
					<div id='textConstraintFeedback' class="invalid-feedback">Veuillez respecter toutes les contraintes de votre histoire</div>
				</div>
			</div>
			<div>
				<div id='validate' class="btn btn-otg float-right">Envoyer</div>
			</div>
			<!-- Form used for the csrf request -->
			<form id='form'>
				@csrf
			</form>
		</div>
		<div class="col-3 spacer"></div>
	</div>
	<script>
		document.addEventListener("DOMContentLoaded", function() {
			let mustContainDOM = document.getElementById("mustContain");
			let mustntContainDOM = document.getElementById("mustntContain");
			let randomizeDOM = document.getElementById("randomize");
			let titleDOM = document.getElementById("title");
			let textDOM = document.getElementById("text");
			let validateDOM = document.getElementById("validate");
			let carouselDOM = document.getElementById("carouselThemes");

			//Feedbacks
			let titleMinSizeFeedback = document.getElementById("titleMinSizeFeedback");
			let titleMaxSizeFeedback = document.getElementById("titleMaxSizeFeedback");
			let textMinSizeFeedback = document.getElementById("textMinSizeFeedback");
			let textMaxSizeFeedback = document.getElementById("textMaxSizeFeedback");
			let textConstraintFeedback = document.getElementById("textConstraintFeedback");

			let minCharactersTitle = {{ $lenghtConstraints[0] }};
			let maxCharactersTitle = {{ $lenghtConstraints[1] }};
			let minCharactersStory = {{ $lenghtConstraints[2] }};
			let maxCharactersStory = {{ $lenghtConstraints[3] }};

			let themes = <?php echo json_encode($themes); ?>;

			let constraints = [];

			function getRandomConstraints(theme_id) {
				fetch("/constraint/random?theme_id=" + theme_id)
					.then(function(rep) {
						if (rep.status !== 200) {
							console.log("Impossible de fetch des nouvelles contraintes");
							return;
						}
						rep.json().then(addConstraints);

					})
					.catch(function(error) {
						console.log(error)
					})
			}

			function addConstraints(data) {
				mustContainDOM.innerHTML = "";
				mustntContainDOM.innerHTML = "";
				constraints = [];
				for (let i = 0; i < data.length; i++) {
					let constraintDOM = document.createElement("span");
					constraintDOM.id = "constraint-" + i;
					constraintDOM.style.display = "inline-block";
					constraintDOM.classList.add("bigger");
					constraintDOM.classList.add("badge-otg");
					constraints.push(data[i]);
					if (data[i].use == 1) {
						constraintDOM.classList.add("border-success");
						mustContainDOM.appendChild(constraintDOM);
					} else {
						constraintDOM.classList.add("border-danger");
						mustntContainDOM.appendChild(constraintDOM);
					}
				}
				updateConstraints();
			}

			function updateCounts() {
				textParsed = textDOM.value;
				for (let i = 0; i < constraints.length; i++) {
					constraints[i]["qte"] = 0;
				}

				let constraintWords = constraints.map(function(c) {
					return c.word;
				});

				for (let i = 0; i < constraintWords.length; i++) {
					let constraint = constraintWords[i];
					let regex = new RegExp(constraint, 'gi');
					let found = textParsed.match(regex);
					if(found != null){
						constraints[i]["qte"] = found.length;
					}
				}
			}

			function updateConstraints() {
				updateCounts();

				for (let i = 0; i < constraints.length; i++) {
					let constraint = constraints[i];
					let id = "constraint-" + i;
					let constraintDOM = document.getElementById(id);
					constraintDOM.innerHTML = constraint.word + "&nbsp;(" + constraint.qte + ")";

					if (constraint.use == 0) //musnt contain
					{
						constraintDOM.classList.remove("text-white");
						constraintDOM.classList.remove("text-danger");
						constraintDOM.classList.remove("bg-danger");
						if (constraint.qte > 0) {
							constraintDOM.classList.add("bg-danger");
							constraintDOM.classList.add("text-white");
						} else {
							constraintDOM.classList.add("text-danger");
						}
					}
					if (constraint.use == 1) //must contain
					{
						constraintDOM.classList.remove("text-white");
						constraintDOM.classList.remove("text-success");
						constraintDOM.classList.remove("bg-success");
						if (constraint.qte > 0) {
							constraintDOM.classList.add("bg-success");
							constraintDOM.classList.add("text-white");
						} else {
							constraintDOM.classList.add("text-success");
						}
					}
				}
			}

			function updatePlaceholder(placeholder) {
				titleDOM.placeholder = placeholder;
			}


			function verifyTitle() {
				titleMinSizeFeedback.style.display = "none";
				titleMaxSizeFeedback.style.display = "none";

				if(titleDOM.value.length <= minCharactersTitle)
				{
					titleMinSizeFeedback.style.display = "block";
					return false;
				}

				if(titleDOM.value.length == maxCharactersTitle)
				{
					titleMaxSizeFeedback.style.display = "block";
				}

				if(titleDOM.value.length > maxCharactersTitle) {
					return false;
				}

				return true;
			}

			//Same verification algorithme as in the view
			function verifyStory(showmessage = false) {
				updateConstraints();

				textMinSizeFeedback.style.display = "none";
				textMaxSizeFeedback.style.display = "none";
				textConstraintFeedback.style.display = "none";

				let bMin = true;
				let bMax = true;
				let bMConstraint = true;

				if(textDOM.value.length <= minCharactersStory)
				{
					bMin = false;
					textMinSizeFeedback.style.display = "block";
				}

				if(textDOM.value.length > maxCharactersStory)
				{
					bMax = false;
					textMaxSizeFeedback.style.display = "block";
				}

				if(textDOM.value.length == maxCharactersStory)
					textMaxSizeFeedback.style.display = "block";

				for (let i = 0; i < constraints.length; i++) {
					let constraint = constraints[i];
					if (constraint.use == 1 && constraint.qte <= 0 || constraint.use == 0 && constraint.qte > 0)
					{
						bMConstraint = false;
					}
				}

				if(showmessage && !bMConstraint)
					textConstraintFeedback.style.display = "block";

				return bMin && bMax && bMConstraint;
			}

			function verify(showmessage = false) {
				let titleOk = verifyTitle();
				let storyOk = verifyStory(showmessage);
				return titleOk && storyOk;
			}

			function submit() {
				let isok = verify(true);
				if (isok) {
					let form = document.getElementById("form");

					form.setAttribute("method", "post");
					form.setAttribute("action", "/story/store");

					let params = {
						title: titleDOM.value,
						text: textDOM.value,
					};

					for (let key in params) {
						let hiddenField = document.createElement("input");
						hiddenField.setAttribute("type", "hidden");
						hiddenField.setAttribute("name", key);
						hiddenField.setAttribute("value", params[key]);

						form.appendChild(hiddenField);
					}

					document.body.appendChild(form);
					form.submit();
				}
			}

			function currentTheme() {
				currentIndex = $('div.active').index();
				return themes[currentIndex];
			}

			function updateTheme() {
				theme = currentTheme();
				getRandomConstraints(theme.id);
				updatePlaceholder(theme.placeholder);
			}

			updateTheme(); //initial fetch

			// Contrôles
			$('#carouselThemes').on('slid.bs.carousel', function() {
				updateTheme();
			});

			randomizeDOM.addEventListener("click", updateTheme);
			validateDOM.addEventListener("click", submit);

			titleDOM.addEventListener("keyup", verifyTitle);
			// titleDOM.addEventListener("change", verifyTitle);
			textDOM.addEventListener("keyup", function() {
				verifyStory()
			}); //because  of the show message default value cant use the functer
			textDOM.addEventListener("change", function() {
				verifyStory()
			});
		});
	</script>
	@endsection
