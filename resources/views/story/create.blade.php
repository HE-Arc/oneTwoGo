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
					<input id='title' type='text' name='title' placeholder="" class="form-control">
					<div class="invalid-feedback">Veuillez spécifier un titre !</div>
				</div>
			</p>
			<div>
				<div class="form-group has-danger">
					<h3 class="form-control-label" for="text">Texte</h3>
					<textarea id="text" name='text' class="form-control" rows="10"></textarea>
					<div class="invalid-feedback">Veuillez respecter toutes les contraintes</div>
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
                if(data[i].use == 1)
                    mustContainDOM.appendChild(constraintDOM);
                else
                    mustntContainDOM.appendChild(constraintDOM);
			}
			updateConstraints();
		}

		function parseTextToWords(str) {
			str = str.toLowerCase();
			//replace every non special character with a space
			str = str.replace(/[,.^'?\-;:!~+#&()=\n]/g, " ");
			return str.split(" ");
		}

		function updateCounts()
		{
			storyWords = parseTextToWords(textDOM.value);
			for (let i = 0; i < constraints.length; i++) {
				constraints[i]["qte"] = 0;
			}
            constraintWords = constraints.map(function(c){return c.word;});
			for (let i = 0; i < storyWords.length; i++) {
				let storyWord = storyWords[i];
                let index = constraintWords.indexOf(storyWord);
				if (index != -1) {
					constraints[index].qte++;
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

				if(constraint.use == 0) //musnt contain
				{
					constraintDOM.classList.remove("badge-otg-no");
					constraintDOM.classList.remove("badge-otg-no-outline");
					if(constraint.qte > 0)
						constraintDOM.classList.add("badge-otg-no");
					else
						constraintDOM.classList.add("badge-otg-no-outline");
				}
				if(constraint.use == 1) //must contain
				{
					constraintDOM.classList.remove("badge-otg-yes");
					constraintDOM.classList.remove("badge-otg-yes-outline");
					if(constraint.qte > 0)
						constraintDOM.classList.add("badge-otg-yes");
					else
						constraintDOM.classList.add("badge-otg-yes-outline");
				}
			}
		}

		function updatePlaceholder(placeholder)
		{
			titleDOM.placeholder = placeholder;
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
		function verifyStory(showmessage = false)
		{
            textDOM.classList.remove("is-invalid");

			updateConstraints();
			let b = true;
			for (let i = 0; i < constraints.length; i++) {
                let constraint = constraints[i];
				if (constraint.use == 1 && constraint.qte <= 0 || constraint.use == 0 && constraint.qte > 0)
					b = false;
			}

			if(!b && showmessage)
				textDOM.classList.add("is-invalid");

			return b;
		}

		function verify(showmessage = false)
		{
			return verifyTitle() & verifyStory(showmessage);
		}

        function submit() {
            let isok = verify(true);
            if(isok)
            {
                let form = document.getElementById("form");

                form.setAttribute("method", "post");
                form.setAttribute("action", "/story/store");

                let params = {
                    title : titleDOM.value,
                    text : textDOM.value,
                };

                for(let key in params) {
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
		textDOM.addEventListener("keyup", function() {verifyStory()}); //because  of the show message default value cant use the functer
		textDOM.addEventListener("change", function() {verifyStory()});
	});
</script>
@endsection
