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
            let thumbUp = $('#upVoteThumb'+id);
            let thumbDown = $('#downVoteThumb'+id);
            if(thumbDown.hasClass("text-danger"))
            {
                thumbUp.toggleClass("text-primary", true);
                $('#upVotesCount'+id).toggleClass("text-primary", true);
            }
            else
            {
                thumbUp.toggleClass("text-primary");
                $('#upVotesCount'+id).toggleClass("text-primary");
            }
            thumbDown.toggleClass("text-danger", false);
            $('#downVotesCount'+id).toggleClass("text-danger", false);
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
            let thumbUp = $('#upVoteThumb'+id);
            let thumbDown = $('#downVoteThumb'+id);
            if(thumbUp.hasClass("text-primary"))
            {
                thumbDown.toggleClass("text-danger", true);
                $('#downVotesCount'+id).toggleClass("text-danger", true);
            }
            else
            {
                thumbDown.toggleClass("text-danger");
                $('#downVotesCount'+id).toggleClass("text-danger");
            }
            thumbUp.toggleClass("text-primary", false);
            $('#upVotesCount'+id).toggleClass("text-primary", false);
          }
      });
    }

}
