@if(isset($commentary) && !empty($commentary))
  @php
    $user = App\User::findOrFail($commentary->user_id);
  @endphp
  <div class="container-fluid">
    <div class="row flex-grow">
      <div class="col-md-3">
        <div class="border-primary text-white p-2 col-sm-2">
          <img src="https://via.placeholder.com/80" alt="picture" />
        </div>
      </div>
      <div class="col-md-9">
        <div class="form-control bg-transparent">
          <div class="row flex-grow d-block">
            <h6 class="text-left font-weight-bold text-white">
              {{ $user->name }}
            </h6>
          </div>
          <div class="row flex-grow d-block">
            <p class="text-white text-left">
              {{ $commentary->comment }}
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
@endif
