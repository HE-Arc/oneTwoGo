@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-2 spacer"></div>
        <!-- Story list -->
        <div class="col-md-8">
            <div class="row flex-grow">
                <div id="storyLoaded" class='w-100'>
                </div>
            </div>
            <div style='text-align:center; margin-top:10px;'>
                <input id='loadNewStoriesButton' type="button" class="btn btn-success" value='Load new stories'>
                <span id='fullyLoaded' hidden>Toutes les histoires ont été chargées</span>
                <span id='errorOnLoad' hidden>Une erreur est survenue lors du chargement de la page</span>
            </div>

            </div>
        </div>
        <!-- Enf of Story list -->
        <div class="col-md-2 spacer"></div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        let storyLoaded = document.getElementById("storyLoaded");
        let fullyLoaded = document.getElementById("fullyLoaded");
        let errorOnLoad = document.getElementById("errorOnLoad");
        let loadNewStoriesButton = document.getElementById("loadNewStoriesButton");
        let nextPageUrl = "{{ $routeAJAX }}";
        let page = 1;
        let disable = false;

        function loadNewStories() {
            if(!disable)
            {
                fetch(nextPageUrl + "?page=" + page++).then(function(rep) {
                    if (rep.status == 403) {
                        loadNewStoriesButton.style.display = "none";
                        fullyLoaded.hidden = false;
                        disable = true;
                        return
                    } else if (rep.status !== 200) {
                        errorOnLoad.hidden = false;
                        return;
                    }

                    rep.text().then(function(text) {
                        storyLoaded.innerHTML += text;

                        // retrieve script js
                        var start = text.indexOf("<script>");
                        var end = text.indexOf("<\/script>");
                        var script = text.substring(start + 8, end);

                        // launch script js
                        eval(script);
                    });
                });
            }
        }

        //https://gist.github.com/nathansmith/8939548
        window.onscroll = function() {
            var d = document.documentElement;
            var offset = d.scrollTop + window.innerHeight;
            var height = d.offsetHeight;

            if (offset >= height) {
                loadNewStories();
            }
        };

        loadNewStoriesButton.addEventListener("click", loadNewStories);
        loadNewStories();
    });
</script>
@endsection
