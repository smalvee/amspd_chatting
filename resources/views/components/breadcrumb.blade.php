<div class="card mb-3">
    <div class="bg-holder d-none d-lg-block bg-card"
        style="background-image:url(../../assets/img/icons/spot-illustrations/corner-4.png);"></div>
    <!--/.bg-holder-->
    <div class="card-body position-relative">
        <div class="row flex-between-center">
            <div class="col-md">
              <h5 class="mb-2 mb-md-0">{{ $title }}</h5>
            </div>
            <div class="col-auto">
                @if($btn)
                <button class="btn btn-falcon-primary btn-sm" data-bs-toggle="modal" data-bs-target="#create_and_edit_modal">+ Add</button>
                @endif
            </div>
          </div>
    </div>
</div>
