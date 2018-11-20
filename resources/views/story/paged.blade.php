@extends('layouts.app')

@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col-md-2 spacer"></div>
    <!-- Story list -->
    <div class="col-md-8">
      <div class="row flex-grow" id='storyLoaded'>
      </div>
      <input id='loadNewStoriesButton' type='button' value='Load new stories'>
    </div>
    <!-- Enf of Story list -->
    <div class="col-md-2 spacer"></div>
  </div>
</div>
<script>

document.addEventListener("DOMContentLoaded", function() {
    let storyLoaded = document.getElementById("storyLoaded");
    let loadNewStoriesButton = document.getElementById("loadNewStoriesButton");
    let nextPageUrl = "{{route("pageStory")}}";

    function loadNewStories()
    {
        console.log("loading new stories");
        fetch(nextPageUrl).then(function(rep) {
            if (rep.status !== 200) {
                console.log("Impossible de fetch des nouvelles stories");
                return;
            }
            rep.json().then(handleJSONStories);
        });
    }

    function handleJSONStories(jsn)
    {
        nextPageUrl = jsn.next_page_url;
        if(nextPageUrl == null)
        {
            loadNewStoriesButton.style.display = "none";
        }
        for(let i = 0; i < jsn.data.length; i++)
        {
            let story = jsn.data[i];
            requestAndAddStory(story.id);
        }
    }

    //not the best way, we should probably use vue.js to do this but we're not really familared with it so it's for a next time
    //it takes n+1 ajax request to load n stories...
    function requestAndAddStory(id) {
        console.log("loading story " + id);
        fetch("/story/" + id + "/show")
        .then(function(rep) {
            if (rep.status !== 200) {
                return;
            }
            return rep.text();
        })
        .then(function(text) {
            storyLoaded.innerHTML += text;
        });
    }

    loadNewStoriesButton.addEventListener("click", loadNewStories);
    loadNewStories();
});
</script>

@endsection
