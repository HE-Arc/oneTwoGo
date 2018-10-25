@extends('layouts.app')

@section('content')
<h1>Start writing your story !</h1>
<div>
    <i class="navicon fas fa-arrow-left"></i>
    <img src='' width="400px" height="200px">
    <i class="navicon fas fa-arrow-right"></i>
</div>
<div>
    <h2>Constraint</h2>
    <div id='constraints'></div>
    <i id='randomize' class="navicon fas fa-random"></i>
</div>
<h2>Story</h2>
<form action='test' style='width:700px'>
    <label for='title'>Title</label>
    <div>
        <input type='text' name='title' placeholder="My awesome story" style='width:100%'>
    </div>
    <div>
        <textarea id="story" class="form-control" rows="15"></textarea>
    </div>
    <i class="navicon fas fa-save" onclick="this.form.submit();"></i>
</form>
@endsection
<script>
    document.addEventListener("DOMContentLoaded", function() {

        let constraintsDOM = document.getElementById("constraints");
        let randomizeDOM = document.getElementById("randomize");
        let storyDOM = document.getElementById("story");

        let constraintsWords;

        function getRandomConstraints() {
            fetch("/constraint/random").
            then(function(rep) {
                if (rep.status !== 200) {
                    console.log("Impossible de fetch des nouvelles contraintes");
                    return;
                }

                rep.json().then(function(data) {
                    constraints.innerHTML = "";
                    constraintsWords = data;
                    for (let i = 0; i < data.length; i++) {
                        //<span style='font-size:20px' class="badge badge-danger">Contrainte2</span>
                        let constraintDOM = document.createElement("span");
                        constraintDOM.innerHTML = data[i];
                        constraintDOM.classList.add("badge");
                        constraintDOM.classList.add("badge-danger");
                        constraintsDOM.appendChild(constraintDOM);
                    }
                });
            }).
            catch(function(error) {
                console.log(error)
            })
        }

        function verify() {
            let words = storyDOM.value.toLowerCase().split(" ");
            for(let i = 0; i < constraintsWords.length; i++)
            {
                //if containt highlight todo
            }
            console.log(words);
        }

        getRandomConstraints();
        randomizeDOM.addEventListener("click", getRandomConstraints);
        storyDOM.addEventListener("keyup", verify);
        storyDOM.addEventListener("change", verify);
    });
</script>
