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

            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>

            @else
            <li class="breadcrumb-item active">{{ $title }}</li>
            @endif
        </ol>



        <form action="{{ url('album/moveTo/'.$id) }}" method="post" enctype="multipart/form-data">


            @method('PUT')

            @csrf

            <div class="form-group" class="form-control">
                <label for="exampleInputName">Name Of Album</label>
                <select class="form-control" name="album_id">
                    @foreach ($data as $key => $value )


                    @if ($value->id != $id)

                    <option value="{{ $value->id }}">{{ $value->name }}</option>

                    @endif


                    @endforeach

                </select>
            </div>


            <button type="submit" class="btn btn-primary">Move</button>
        </form>
    </div>

</main>


    @include('layouts/footer');
