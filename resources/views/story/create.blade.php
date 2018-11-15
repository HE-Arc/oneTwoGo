@extends('layouts.app')

@section('content')
<div class='container'>
    <h2>Commence à écrire ton histoire !</h2>
    <div id="carouselThemes" class="carousel slide" data-ride="carousel" data-interval="false" style="width:600px">
        <ol class="carousel-indicators">
            @for ($i = 0; $i < sizeof($themes); $i++)
                <li data-target="#carouselThemes" data-slide-to="{{$i}}" @if ($i == 0)class="active"@endif></li>
            @endfor
        </ol>
        <div class="carousel-inner">
            @for ($i = 0; $i < sizeof($themes); $i++)
                <div data-themeid="{{$themes[$i]['id']}}" data-placeholder="{{$themes[$i]['placeholder']}}" class="carousel-item @if ($i == 0) active @endif">
                    <img class="d-block w-100" src="{{$themes[$i]['image']}}" alt="{{$themes[$i]['name']}}">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>{{$themes[$i]['name']}}</h5>
                    </div>
                </div>
            @endfor
        </div>
        <a class="carousel-control-prev" href="#carouselThemes" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselThemes" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
    <div>
        <h3>Contraintes</h3>
        <span id='constraints'></span>
        <i id='randomize' class="bigger fas fa-random"></i>
    </div>
    <h3>Histoire</h3>
    <form id='storyForm' action='{{route('storeStory')}}' method="post" style='width:600px'>
        @csrf
        <label for='title'>Title</label>
        <div>
            <input id='title' type='text' name='title' placeholder="My awesome story" style='width:100%' value=''>
        </div>
        <div>
            <textarea id="text" name='text' class="form-control" rows="10"></textarea>
        </div>
        <div>
            <i id='validate' visibility='hidden' class="bigger fas fa-check"></i>
        </div>
    </form>
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

        let constraintsWords = [];
        let constraintsWordsQte;

        function getRandomConstraints(themeid) {
            fetch("/constraint/random?theme_id="+themeid)
                .then(function(rep) {
                    if (rep.status !== 200) {
                        console.log("Impossible de fetch des nouvelles contraintes");
                        return;
                    }

                    rep.json().then(function(data) {
                        constraintsDOM.innerHTML = "";
                        constraintsWords = data;
                        for (let i = 0; i < data.length; i++) {
                            let constraintDOM = document.createElement("span");
                            constraintDOM.classList.add("bigger");
                            constraintDOM.classList.add("badge-pill");
                            constraintDOM.classList.add("badge-danger");
                            constraintsDOM.appendChild(constraintDOM);
                        }
                        verify();
                    });
                })
                .catch(function(error) {
                    console.log(error)
                })
        }

        //Same verification algorithme as in the view
        function verify() {
            let storyWords = parseTextToWords(textDOM.value);
            resetConstraintsQte();
            for (let i = 0; i < storyWords.length; i++) {
                let storyWord = storyWords[i];
                if (constraintsWords.includes(storyWord)) {
                    constraintsWordsQte[storyWord]++;
                }
            }
            updateConstraints();

            let isValid = isStoryValid();
            isValid &= titleDOM.value.length > 0;
            validateDOM.style.visibility = isValid ? "visible" : "hidden";
            return isValid;
        }

        function parseTextToWords(str) {
            str = str.toLowerCase();
            str = str.replace(/[^a-zA-Z0-9 ]/g, " "); //replace every non letter / figure and space by a space
            return str.split(" ");
        }

        function resetConstraintsQte() {
            constraintsWordsQte = {};
            for (let i = 0; i < constraintsWords.length; i++) {
                constraintsWordsQte[constraintsWords[i]] = 0;
            }
        }

        function isStoryValid() {
            let b = true;
            for (let i = 0; i < constraintsWords.length; i++) {
                let qte = constraintsWordsQte[constraintsWords[i]];
                if (qte <= 0)
                    b = false;
            }
            return b;
        }

        function updateConstraints() {
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

        function submit() {
            if(verify()) //over engineering
                formDOM.submit();
        }

        function currentTheme()
        {
            currentIndex = $('div.active').index();
            return themes[currentIndex];
        }

        updateTheme();

        function updateTheme()
        {
            theme = currentTheme();
            constraints = getRandomConstraints(theme.id);
            updateConstraints();
            titleDOM.placeholder = theme.placeholder;
        }

        // Contrôles
        $('#carouselThemes').on('slid.bs.carousel', function () {
            updateTheme();
        });
        randomizeDOM.addEventListener("click", updateTheme);
        validateDOM.addEventListener("click", submit);

        titleDOM.addEventListener("keyup", verify);
        titleDOM.addEventListener("change", verify);
        textDOM.addEventListener("keyup", verify);
        textDOM.addEventListener("change", verify);
    });
</script>
@endsection
