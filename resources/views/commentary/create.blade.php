<div class="container-fluid">
  <div class="row flex-grow bg-transparent">
    <form action="{{ route('commentary.store') }}" method="POST">
      @csrf
      <input type="hidden" name="story_id" value="{{ $story_id }}"/>
      <input type="hidden" name="user_id" value="{{ Auth::user()->getId() }}"/>
      <div class="row flex-grow">
        <fieldset>
          <textarea class="form-control text-primary d-inline" name="comment" rows="5">
          </textarea>
        </fieldset>
        <button class="btn btn-secondary d-inline" type="submit">Envoyer</button>
      </div>
    </form>
  </div>
</div>
