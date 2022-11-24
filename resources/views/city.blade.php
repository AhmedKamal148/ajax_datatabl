<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ajax</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('Assets/css/all.min.css')}}">
    <link rel="stylesheet" href="{{asset('Assets/css/jquery.dataTables.min.css')}}">
    <link rel="stylesheet" href="{{asset('Assets/css/bootstrap.min.css')}}">
</head>
<body>

{{--Begin Navbar--}}
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
                <label>
                    <input class="form-control mr-sm-2" type="text" placeholder="Search">
                </label>
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>
        </div>
    </div>
</nav>
{{--End Navbar--}}


{{--Begin Form_section --}}
<section class="ajax_form my-3">
    <div class="container">
        <form id="my_city_form"
              method="post"
              class="bg-dark text-white p-3 rounded ">
            @csrf
            <div class="form-group">
                <label for="name">Name</label>
                <input name="name" type="text" class="form-control" id="name" aria-describedby="cityName"
                       placeholder="Enter Name">
                @error('name')
                <small id="cityName" class="form-text text-muted">{{$message}}</small>
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
{{--End  Form_section --}}
<hr>
{{--Begin  Data_Tables_section --}}

<section class="data_tables">
    <div class="container">
        <table class="table" id="cities">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Created_at</th>
                <th scope="col">updated_at</th>
                <th scope="col">actions</th>
            </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</section>

{{--End  Data_Tables_section --}}

{{--Start  Models_section --}}
@include('models._cityModels')
{{--End  Models_section --}}

<script src="{{asset('Assets/js/popper.min.js')}}"></script>
<script src="{{asset('Assets/js/jquery-3.5.1.js')}}"></script>
<script src="{{asset('Assets/js/bootstrap.js')}}"></script>
<script src="{{asset('Assets/js/jquery.dataTables.min.js')}}"></script>

{{--Ajax Logic--}}
<script>
    $(document).ready(function () {
        /*--- Insert Data logic---*/
        $('#submit').click(function (e) {
            e.preventDefault();
            $.ajax({
                url: "{{url('city/store')}}",
                method: "post",
                dataType: "json",
                data: $('#my_city_form').serialize(),
                success: function (response) {
                    $("#my_city_form").trigger('reset');
                    table.ajax().reload();

                }
            });
        });

        /*--- Display Data logic---*/
        let table = $('#cities').DataTable({
            ajax: "{{url('city/get-data')}}",

            columns: [
                {
                    "data": "id",

                },
                {
                    "data": "name"
                },
                {
                    "data": "created_at"
                },
                {
                    "data": "updated_at"
                },
                {
                    data: null, render: function (data) {
                        return `
                                <td>
                                   <div class="d-flex">
                                    <button id="edit"
                                            data-id="${data.id}"
                                            class="btn btn-sm btn-outline-success mr-2"
                                            data-toggle="modal" data-target="#editModel" >
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button id="delete" data-id="${data.id}" class="btn btn-sm btn-outline-danger">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                   </div>
                                </td>
                               `
                    }
                }

            ]
        });

        /*--- Edit form logic---*/
        $(document).on('click', '#edit', function (e) {
            $.ajax({
                url: "{{url('city/edit')}}",
                type: "post",
                dataType: "json",
                data: {
                    '_token': "{{ csrf_token() }}",
                    'id': $(this).data('id'),

                },
                success: function (response) {
                    $('input[name="id"]').val(response.data.id);
                    $('input[name="edit_Name"]').val(response.data.name);
                    $("input[name='city_id']").val(response.data.id);
                }
            })
        });
        /*--- Update form logic---*/
        $(document).on('click', '#updateCity', function (e) {

            if (confirm('Are You Sure To Update')) {
                $.ajax({
                    url: "{{url('city/update')}}",
                    type: 'post',
                    dataType: "json",
                    data: $('#update_form').serialize(),
                    success: function (response) {
                        $('#update_form').trigger('reset');
                        $('#editModel').modal('hide');
                        table.ajax.reload();
                    }
                })
            }
        })
        /*--- Delete form logic---*/
        $(document).on('click', '#delete', function () {
            if (confirm('Delete It ')) {
                $.ajax(
                    {
                        url: "{{url('city/delete')}}",
                        method: "post",
                        dataType: "json",
                        data: {
                            "_token": "{{csrf_token()}}",
                            "id": $(this).data('id'),
                        },
                        success: function (response) {
                            table.ajax.reload();

                        }

                    }
                )
            }

        });
    }); // end of document
</script>
</body>
</html>
