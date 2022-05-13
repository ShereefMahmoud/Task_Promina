<!-- Headers -->
@include('layouts/header')

<!-- nav bar -->
@include('layouts/navbar')


<!-- side bar -->
@include('layouts/sidebar')

<main>
    <div class="container-fluid">
        <h1 class="mt-4">Dashboard</h1>
        <ol class="breadcrumb mb-4">
            @if (session()->get('Message'))
            {{ session()->get('Message') }}
            @else
            <li class="breadcrumb-item active">{{ $title }}</li><br>
            @endif
        </ol>


        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table mr-1"></i>
                Pictures Data
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name Of Picture</th>
                                <th>Name Of Album</th>
                                <th>Picture</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>ID</th>
                                <th>Name Of Picture</th>
                                <th>Name Of Album</th>
                                <th>Picture</th>
                                <th>Actions</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($data as $key => $value)
                                <tr>
                                    <td>{{ ++$key }}</td>
                                    <td>{{ $value->name }}</td>
                                    <td>{{ $value->albumName }}</td>
                                    <td><img src="{{ url('album_pictures/'.$value->img_dir) }}" width="50px" height="50px"></td>


                                    <td>


                                        <a href='' data-toggle="modal"
                                            data-target="#modal_single_del{{ $value->id }}"
                                            class='btn btn-danger m-r-1em'>Remove </a>


                                        <a href="{{ url('pictures/' . $value->id . '/edit') }}"
                                            class='btn btn-primary m-r-1em'>Edit</a>
                                    </td>
                                </tr>



                                <div class="modal" id="modal_single_del{{ $value->id }}" tabindex="-1"
                                    role="dialog">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Delete confirmation</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>

                                            <div class="modal-body">
                                                Remove {{ $value->name }} !!!!
                                            </div>
                                            <div class="modal-footer">
                                                <form action="{{ url('pictures/' . $value->id) }}" method="post">

                                                    @method('delete')
                                                    @csrf

                                                    <div class="not-empty-record">
                                                        <button type="submit" class="btn btn-primary">Delete</button>
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">close</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

</main>

@include('layouts/footer');
