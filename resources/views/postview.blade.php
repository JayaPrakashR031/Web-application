@include("layouts.header")

                <!-- Begin Page Content -->
                <div class="container">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">post Tables</h1>
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">post details</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable">
                                    <thead>
                                        <tr>
                                            <th>Book Image</th>
                                            <th>Name</th>
                                            <th>Author</th>
                                            <th>Summary</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($users as $data)
                                        <tr>
                                                <td><img src="uploads/posts/{{$data->image}}" alt="{{$data->image}}" width="100px" height="100px"></td>
                                                <td>{{$data->name}}</td>
                                                <td>{{$data->author}}</td>
                                                <td>{{$data->summary}}</td>
                                                <td>
                                                    <a href="{{url('/delete')}}/{{$data->id}}" class="text-decoration-none">
                                                        <button class="btn-sm btn-danger">Delete</button>
                                                    </a>
                                                    <a href="{{url('/edit')}}/{{$data->id}}" class="text-decoration-none">
                                                        <button class="btn-sm btn-primary">edit</button>
                                                    </a>
                                                </td>
                                        </tr>

                                    @endforeach
                                    </tbody>
                                </table>
                                {{ $users->links() }}
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

@include("layouts.footer")
