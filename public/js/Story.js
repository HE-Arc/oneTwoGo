class Story {
    static toggleStory(icon, id)
    {
        let storyText = document.getElementById("storyTextLimiter"+id);
        storyText.classList.toggle("story-text-open");
        storyText.classList.toggle("story-text-closed");
        icon.classList.toggle("fa-angle-down");
        icon.classList.toggle("fa-angle-up");
    }

    /*
    * After one hour of various attemps I did not succeed to call that function from show.blade.php of story
    * If we print randomPage it will work but not when dynamicaly loading stories
    * I tried jQuery, addEventListener, onload, and console.log, alert as function to "debug"
    * Nothing work and the <script></script> just disappear from the html when returned by AJAX
    */
    static hideIcon(id) {
        // If text is smaller than his container, hide toggle button
        if (document.getElementById("storyText"+id).style.height < document.getElementById("storyTextLimiter"+id).style.maxHeight) {
            document.getElementById("storyExpendIcon"+id).style.display = "none";
        }
    }
}