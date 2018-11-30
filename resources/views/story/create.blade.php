@extends('layouts.app')

@section('content')
<div class="row">
	<div class="col-3 spacer"></div>
	<div class='col-6 card mb-3'>
		<h2 class='card-header center'>Écrit une histoire !</h2>
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
					<span class="sr-only">Previous</span>
				</a>
				<a class="carousel-control-next" href="#carouselThemes" role="button" data-slide="next">
					<span class="carousel-control-next-icon"></span>
					<span class="sr-only">Next</span>
				</a>
			</div>

			<h3>Contraintes</h3>
			<div>
				<span id='constraints'></span>
				<i id='randomize' class="bigger fas fa-random"></i>
			</div>

			<form id='storyForm' class='w-100' action='{{route('storeStory')}}' method="post">
				@csrf
				<div>
					<div class="form-group has-danger">
						<h3 class="form-control-label" for="title">Titre</h3>
						<input id='title' type='text' name='title' placeholder="" class="form-control">
						<div class="invalid-feedback">Veuillez spécifier un titre !</div>
					</div>
				</div>
				<div>
					<div class="form-group has-danger">
						<h3 class="form-control-label" for="text">Texte</h3>
						<textarea id="text" name='text' class="form-control" rows="10"></textarea>
						<div class="invalid-feedback">Veuillez utiliser toutes les contraintes</div>
					</div>
				</div>
				<div>
					<i id='validate' class="bigger fas fa-check"></i>
				</div>
			</form>
		</div>
	<div class="col-3 spacer"></div>
</div>
<script>
	document.addEventListener("DOMContentLoaded", function() {

		let constraintsDOM = document.getElementById("constraints");
		let randomizeDOM = document.getElementById("randomize");
		let titleDOM = document.getElementById("title");
		let textDOM = document.getElementById("text");
		let validateDOM = document.getElementById("validate");
		let carouselDOM = document.getElementById("carouselThemes");
		let formDOM = document.getElementById("storyForm");

		let themes = <?php echo json_encode($themes); ?>;
		let storyWords;

		let constraintsWords = [];

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
			constraintsDOM.innerHTML = "";
			constraintsWords = data;
			for (let i = 0; i < data.length; i++) {
				let constraintDOM = document.createElement("span");
				constraintDOM.classList.add("bigger");
				constraintDOM.classList.add("badge-pill");
				constraintDOM.classList.add("badge-danger");
				constraintsDOM.appendChild(constraintDOM);
			}
			updateConstraints();
		}

		function parseTextToWords(str) {
			str = str.toLowerCase();
			//replace every non letter / figure and space by a space
			str = str.replace(/[^a-zA-Z0-9 ]/g, " ");
			return str.split(" ");
		}

		function countConstraints()
		{
			constraintsWordsQte = {};
			for (let i = 0; i < constraintsWords.length; i++) {
				constraintsWordsQte[constraintsWords[i]] = 0;
			}
			for (let i = 0; i < storyWords.length; i++) {
				let storyWord = storyWords[i];
				if (constraintsWords.includes(storyWord)) {
					constraintsWordsQte[storyWord]++;
				}
			}
			return constraintsWordsQte;
		}

		function updateConstraints() {
			storyWords = parseTextToWords(textDOM.value);
			constraintsWordsQte = countConstraints();

			let children = constraintsDOM.children;
			for (let i = 0; i < children.length; i++) {
				let child = children[i];
				let word = constraintsWords[i];
				let qte = constraintsWordsQte[constraintsWords[i]];
				child.innerHTML = word + " (" + qte + ")";
				child.classList.remove("badge-danger", "badge-success");
				if (qte > 0) {
					child.classList.add("badge-success");
				} else {
					child.classList.add("badge-danger");
				}
			}
		}

		function updatePlaceholder(placeholder)
		{
			titleDOM.placeholder = placeholder;
		}

		function submit() {
			if(verify())
				formDOM.submit();
			else
				verifyTitle();
		}

		function verifyTitle()
		{
			titleDOM.classList.remove("is-invalid");
			if(titleDOM.value.length <= 0)
			{
				titleDOM.classList.add("is-invalid");
				return false;
			}
			return true;
		}

		//Same verification algorithme as in the view
		function verifyStory()
		{
			updateConstraints();
			let b = true;
			for (let i = 0; i < constraintsWords.length; i++) {
				let qte = constraintsWordsQte[constraintsWords[i]];
				if (qte <= 0)
					b = false;
			}
			if(b)
				setStoryStatus(true);

			return b;
		}

		function verify()
		{
			return setStoryStatus(verifyStory()) && verifyTitle();
		}

		function setStoryStatus(b)
		{
			textDOM.classList.remove("is-invalid");
			if(!b)
				textDOM.classList.add("is-invalid");
			return b;
		}

		function currentTheme()
		{
			currentIndex = $('div.active').index();
			return themes[currentIndex];
		}

		function updateTheme()
		{
			theme = currentTheme();
			getRandomConstraints(theme.id);
			updatePlaceholder(theme.placeholder);
		}

		updateTheme(); //initial fetch

		// Contrôles
		$('#carouselThemes').on('slid.bs.carousel', function () {
			updateTheme();
		});
		randomizeDOM.addEventListener("click", updateTheme);
		validateDOM.addEventListener("click", submit);

		titleDOM.addEventListener("keyup", verifyTitle);
		titleDOM.addEventListener("change", verifyTitle);
		textDOM.addEventListener("keyup", verifyStory);
		textDOM.addEventListener("change", verifyStory);
	});
</script>
@endsection
