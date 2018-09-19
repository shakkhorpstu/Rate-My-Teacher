<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Rate My Teacher | Admin</title>

  @include('backend.partials.styles')

  @section('styles')
  @show

</head>

<body class="app sidebar-mini rtl">
  <div id="wrapper">

    @include('backend.partials.nav')

    @include('backend.partials.sidebar')

    <div id="page-wrapper">
      <main class="app-content">

        @section('content')
        @show

    </main>
    </div>

  </div>

  @include('backend.partials.scripts')

  @section('scripts')
  @show

</body>
</html>
