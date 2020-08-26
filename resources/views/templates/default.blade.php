<!DOCTYPE html>
<html lang="en">

@include('templates.partials._head')

<body>
  <div id="app">

    <div class="preloader">
      <div class="loading">
        <img src="{{ asset('assets/img/tenor.gif') }}" width="80">
        <p>Harap Tunggu</p>
      </div>
    </div>
    <div class="main-wrapper">
      <div class="navbar-bg"></div>
      @include('templates.partials._navbar')
      <div class="main-sidebar">
        @include('templates.partials._sidebar')
      </div>

      <!-- Main Content -->
      <div class="main-content">
        @include('sweetalert::alert')
        @yield('content')
      </div>
      @include('templates.partials._footer')
    </div>
  </div>

  @include('templates.partials._script')
</body>
</html>
