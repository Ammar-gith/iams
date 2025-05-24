@extends('masterLayout.master')

{{-- Custom CSS --}}
@push('style')
@endpush

@push('content')
    <!-- Dynamic Breadcrumb -->
    <div class="row">
        <!-- Basic Breadcrumb -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href={{ route('home') }}>Home</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('books.dashboard') }}">Dashboard</a>
                </li>

                <li class="breadcrumb-item active text-primary">Books</li>
            </ol>
        </nav>
    </div>
    <!--/ Dynamic Breadcrumb -->

    <h6 class="pb-1 mb-4 text-muted">Masonry</h6>
    <div class="row gy-4" data-masonry='{"percentPosition": true }'>
      <div class="col-sm-6 col-lg-4">
        <div class="card">
          <img class="card-img-top" src="../../assets/img/elements/5.jpg" alt="Card image cap" />
          <div class="card-body">
            <h5 class="card-title">Card title that wraps to a new line</h5>
            <p class="card-text">
              This is a longer card with supporting text below as a natural lead-in to additional content.
              This content is a little bit longer.
            </p>
          </div>
        </div>
      </div>
      <div class="col-sm-6 col-lg-4">
        <div class="card p-3">
          <figure class="p-3 mb-0">
            <blockquote class="blockquote">
              <p>A well-known quote, contained in a blockquote element.</p>
            </blockquote>
            <figcaption class="blockquote-footer mb-0 text-muted">
              Someone famous in <cite title="Source Title">Source Title</cite>
            </figcaption>
          </figure>
        </div>
      </div>
      <div class="col-sm-6 col-lg-4">
        <div class="card">
          <img class="card-img-top" src="../../assets/img/elements/18.jpg" alt="Card image cap" />
          <div class="card-body">
            <h5 class="card-title">Card title</h5>
            <p class="card-text">
              This card has supporting text below as a natural lead-in to additional content.
            </p>
            <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
          </div>
        </div>
      </div>
      <div class="col-sm-6 col-lg-4">
        <div class="card bg-primary text-white text-center p-3">
          <figure class="mb-0">
            <blockquote class="blockquote">
              <p>A well-known quote, contained in a blockquote element.</p>
            </blockquote>
            <figcaption class="blockquote-footer mb-0 text-white">
              Someone famous in <cite title="Source Title">Source Title</cite>
            </figcaption>
          </figure>
        </div>
      </div>
      <div class="col-sm-6 col-lg-4">
        <div class="card text-center">
          <div class="card-body">
            <h5 class="card-title">Card title</h5>
            <p class="card-text">This card has a regular title and short paragraph of text below it.</p>
            <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
          </div>
        </div>
      </div>
      <div class="col-sm-6 col-lg-4">
        <div class="card">
          <img class="card-img-top" src="../../assets/img/elements/4.jpg" alt="Card image cap" />
        </div>
      </div>
      <div class="col-sm-6 col-lg-4">
        <div class="card p-3 text-end">
          <figure class="mb-0">
            <blockquote class="blockquote">
              <p>A well-known quote, contained in a blockquote element.</p>
            </blockquote>
            <figcaption class="blockquote-footer mb-0 text-muted">
              Someone famous in <cite title="Source Title">Source Title</cite>
            </figcaption>
          </figure>
        </div>
      </div>
      <div class="col-sm-6 col-lg-4">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Card title</h5>
            <p class="card-text">
              This is another card with title and supporting text below. This card has some additional content
              to make it slightly taller overall.
            </p>
            <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
          </div>
        </div>
      </div>
    </div>
@endpush

@push('scripts')
@endpush
