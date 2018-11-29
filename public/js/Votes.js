class Votes {
    static likeAJAX(id)
    {
      $.ajax({
          type: 'POST',
          url : "/story/" + id + "/like",
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          success : function (data) {
            $('#upVotesCount'+id).html(data[0]);
            $('#downVotesCount'+id).html(data[1]);
            $('#upVoteThumb'+id).toggleClass("text-danger", true);
            $('#downVoteThumb'+id).toggleClass("text-danger", false);
          }
      });
    }

    static dislikeAJAX(id)
    {
      $.ajax({
          type: 'POST',
          url : "/story/" + id + "/dislike",
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          success : function (data) {
            $('#upVotesCount'+id).html(data[0]);
            $('#downVotesCount'+id).html(data[1]);
            $('#upVoteThumb'+id).toggleClass("text-danger", false);
            $('#downVoteThumb'+id).toggleClass("text-danger", true);
          }
      });
    }

}
