<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            All Category <b> </b>
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="container">
            <div class="row">
                <div class="col-8">
                    <div class="card">

                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>{{ session('success') }}</strong>.
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                        <div class="card-header">All Category</div>
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">SL No</th>
                                <th scope="col">Category Name</th>
                                <th scope="col">User</th>
                                <th scope="col">Created At</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($categories as $index=>$category)
                                <tr>
                                    <th scope="row">{{ $categories->firstItem()+$loop->index }}</th>
                                    <td> {{ $category->category_name }} </td>
                                    <td> {{ $category->user->name }} </td>
                                    <td>
                                        @if($category->created_at == NULL )
                                            <span class="text-danger">No Date Set</span>
                                        @else
                                            {{ Carbon\Carbon::parse($category->created_at)->diffforHumans() }}
                                    </td>
                                    @endif
                                    <td>
                                        <a href="{{ url('category/edit/'.$category->id) }}"
                                           class="btn btn-info">Edit</a>
                                        <a href="{{ url('softdelete/category/'.$category->id) }}"
                                           class="btn btn-danger">Soft Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{ $categories->links() }}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">Add Category</div>
                        <div class="card-body">
                            <form action="{{ route('store.category') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="exampleInputEmail1" class="form-label">Category Name</label>
                                    <input type="text" name="category_name" class="form-control" id="exampleInputEmail1"
                                           aria-describedby="emailHelp">
                                    @error('category_name')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-primary">Add Category</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- Trash Part -->
        <div class="container">
            <div class="row">
                <div class="col-8">
                    <div class="card">
                        <div class="card-header">Trash list</div>
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">SL No</th>
                                <th scope="col">Category Name</th>
                                <th scope="col">User</th>
                                <th scope="col">Created At</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach( $trachCats as $index=>$trachCat)
                                <tr>
                                    <td>{{ $trachCats->firstItem()+$loop->index }}</td>
                                    <td>{{ $trachCat->category_name}}</td>
                                    <td>{{ $trachCat->user->name }}</td>
                                    <td>{{ Carbon\Carbon::parse($trachCat->created_at)->diffforHumans() ? Carbon\Carbon::parse($trachCat->created_at)->diffforHumans() : 'No data set'}}</td>
                                    <td>
                                        <a href="{{ url('category/restore/'.$trachCat->id) }}"
                                           class="btn btn-info">Restore</a>
                                        <a href="{{ url('/delete/category/'.$trachCat->id) }}"
                                           class="btn btn-danger">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{ $trachCats->links() }}
                    </div>
                </div>
                <div class="col-md-4">
                </div>
            </div>
        </div>
        <!--end trash-->
    </div>
</x-app-layout>
