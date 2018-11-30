class Comments {
	static addAJAX(storyId) {
		let comment = document.getElementById("comment-text-" + storyId);
		if (comment.value == "") {
			comment.classList.add("is-invalid");
			return;
		} else
			comment.classList.remove("is-invalid");
		$.ajax({
			type: 'POST',
			url: '/commentary/store',
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			data: {
				story_id: storyId,
				comment: comment.value
			},
			success: function(comment) {
				Comments.addToTable(storyId, comment);
				let count = document.getElementById("comments-count-" + storyId);
				count.innerHTML = ""+(parseInt(count.innerHTML)+1);
			}
		});
		comment.value = "";
	}

	static addToTable(storyId, comment) {
		let storyTable = document.getElementById("comments-story-" + storyId);
		storyTable.innerHTML = comment + storyTable.innerHTML;
	}

}