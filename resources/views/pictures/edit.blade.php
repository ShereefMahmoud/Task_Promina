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



        <form action="{{ url('pictures/'.$data->id) }}" method="post" enctype="multipart/form-data">


            @method('PUT')

            @csrf

            <div class="form-group">
                <label for="exampleInputtitle">Name Of Picture</label>
                <input type="text" class="form-control" id="exampleInputtitle" aria-describedby="" name="name"
                    placeholder="Enter Name" value="{{ $data->name }}">
            </div>


            <div class="form-group" class="form-control">
                <label for="exampleInputName">Name Of Album</label>
                <select class="form-control" name="album_id">
                    @foreach ($data_album as $key => $value )


                    <option value="{{ $value->id }}" @if($data->album_id == $value->id) {{ "selected" }}  @endif>{{ $value->name }}</option>

                    @endforeach

                </select>
            </div>


            <div class="mb-3">
                <label for="formFile" class="form-label">Picture</label>
                <input class="form-control" type="file" id="formFile" name="img_dir">
            </div>

            <img src="{{ url('album_pictures/'.$data->img_dir) }}" width="75px" height="75px" style="margin-bottom: 20px"><br>



            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>

</main>


    @include('layouts/footer');
