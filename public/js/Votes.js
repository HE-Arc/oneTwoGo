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
                thumbUp.toggleClass("text-success", true);
            else
                thumbUp.toggleClass("text-success");
            thumbDown.toggleClass("text-danger", false);
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
            if(thumbUp.hasClass("text-success"))
                thumbDown.toggleClass("text-danger", true);
            else
                thumbDown.toggleClass("text-danger");
            thumbUp.toggleClass("text-success", false);
          }
      });
    }

}
