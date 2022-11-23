<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ajax</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('Assets/css/all.min.css')}}">
    <link rel="stylesheet" href="{{asset('Assets/css/bootstrap.min.css')}}">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Ajax</a>
        <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#collapsibleNavId"
                aria-controls="collapsibleNavId"
                aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="collapsibleNavId">
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Link</a>
                </li>

            </ul>
            <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="text" placeholder="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>
        </div>
    </div>
</nav>


<section class="ajax_form my-3">
    <div class="container">
        <form id="my_city_form"
              method="post"
              class="bg-dark text-white p-3 rounded ">
            @csrf
            <div class="form-group">
                <label for="name">Name</label>
                <input name="name" type="text" class="form-control" id="name" aria-describedby="emailHelp"
                       placeholder="Enter Name">
                @error('name')
                <small id="emailHelp" class="form-text text-muted">{{$message}}</small>
                @enderror
            </div>

            <div class="form-group d-flex justify-content-end">
                <button type="submit" id="submit" class="btn btn-default btn-sm ">
                    <i class="fas fa-plus"></i>
                </button>
            </div>
        </form>
    </div>
</section>
<hr>

<section class="data_tables">


</section>


<script src="{{asset('Assets/js/popper.min.js')}}"></script>
<script src="{{asset('Assets/js/jquery-3.6.1.min.js')}}"></script>
<script src="{{asset('Assets/js/bootstrap.js')}}"></script>
<script src="{{asset('Assets/js/jquery.dataTables.min.js')}}"></script>
<script>
    $(document).ready(function () {
        /*--- Insert Data---*/
        $('#submit').click(function (e) {
            e.preventDefault();
            $.ajax({
                url: "{{url('city/store')}}",
                method: "post",
                dataType: "json",
                data: $('#my_city_form').serialize(),
                success: function (response) {
                    $("#my_city_form").reset();

                }
            });
        });

        /*--- Display Data---*/
        

    })
</script>
</body>
</html>
