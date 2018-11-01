@extends('layouts.app')

@section('content')
<div class='container'>
    <h2>Commence à écrire ton histoire !</h2>
    <div id="carouselThemes" class="carousel slide" data-ride="carousel" data-interval="false" style="width:600px">
        <ol class="carousel-indicators">
            <li data-target="#carouselThemes" data-slide-to="0" class="active"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img class="d-block w-100" src="..." alt="First slide">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Nom du theme</h5>
                    <p>Description du theme</p>
                </div>
            </div>
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
    <form action='test' style='width:600px'>
        <label for='title'>Title</label>
        <div>
            <input id='title' type='text' name='title' placeholder="My awesome story" style='width:100%'>
        </div>
        <div>
            <textarea id="story" class="form-control" rows="10"></textarea>
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
        let storyDOM = document.getElementById("story");
        let validateDOM = document.getElementById("validate");
        let carouselDOM = document.getElementById("carouselThemes");

        let constraintsWords = [];
        let constraintsWordsQte;

        function getRandomConstraints() {
            fetch("/constraint/random")
                .then(function(rep) {
                    if (rep.status !== 200) {
                        console.log("Impossible de fetch des nouvelles contraintes");
                        return;
                    }

                    rep.json().then(function(data) {
                        constraints.innerHTML = "";
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

        function verify() {
            let storyWords = parseTextToWords(storyDOM.value);
            resetConstraintsQte();
            for (let i = 0; i < storyWords.length; i++) {
                let storyWord = storyWords[i];
                if (constraintsWords.includes(storyWord)) {
                    constraintsWordsQte[storyWord]++;
                }
            }
            updateConstraints();

            let isValid = isStoryValid();
            validateDOM.style.visibility = isValid ? "visible" : "hidden";
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

        getRandomConstraints();
        randomizeDOM.addEventListener("click", getRandomConstraints);
        storyDOM.addEventListener("keyup", verify);
        storyDOM.addEventListener("change", verify);

        carouselDOM.addEventListener('slid.bs.carousel', function() {
            console.log("a");
        })

    });
</script>
@endsection
