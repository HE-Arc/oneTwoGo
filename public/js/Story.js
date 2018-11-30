class Story {
    static toggleStory(icon, id)
    {
        let storyText = document.getElementById("storyText"+id);
        storyText.classList.toggle("story-text-open");
        storyText.classList.toggle("story-text-closed");
        icon.classList.toggle("fa-angle-down");
        icon.classList.toggle("fa-angle-up");
    }
}