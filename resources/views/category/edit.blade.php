@include('../includes/header')
@include('../includes/sidebar')

<div class="page-wrapper" style="display: block;">
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-7 align-self-center">
                <h3 class="page-title text-truncate text-dark font-weight-medium mb-1">Edit Category</h3>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        @if (\Session::has('success'))
            <div class="alert alert-success">
                <ul>
                    <li>{!! \Session::get('success') !!}</li>
                </ul>
            </div>
        @endif
        <form id="form_add" method="post" action="{{ route('update-categories') }}" enctype="multipart/form-data">
            @csrf
            <div class="col-md-12">
                <div class="form-group">
                    <label>Category Title</label>
                    <input type="text" id="name" name="name" value="{{ $category->name }}" required
                        class="form-control">
                        <input type="hidden" name="id" value="{{$id}}"/>
                </div>
                <div class="form-group">
                    <label>Category Description</label>
                    <textarea type="text" id="description" value="{{ $category->description }}" name="description" class="form-control">{{ $category->description }}</textarea>
                </div>
                <div class="form-group">
                    <label>Parent Category</label>
                    <div class="form-group">
                        <select name="parent" class="form-control">
                            <option value="0" selected>Select Category</option>
                            @foreach ($parents as $parent)
                                @if($parent->id != $category->id)
                                    <option value="{{ $parent->id }}" {{ $category->parent == $parent->id ? "selected":"" }}>{{ $parent->name }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label>Category Image</label>
                    <input type="file" id="file" name="file" class="form-control">
                    @if($category->category_image)
                        <div class="col-md-2 p-0 mt-2">
                            <img src="{{asset($category->category_image)}}" class="img img-thumbnail"/>
                        </div>
                    @endif
                </div>
                <div class="form-group">
                    <input type="submit" name="submit" value="Update" class="btn btn-primary">
                </div>
            </div>
        </form>

    </div>
</div>

@include('../includes/footer')

@section('scripts')
    @parent

    <script>
        // actions.TitleBar.create(app, { title: 'Welcome' });

        $("#form_add").on('submit', function(e) {
            var action = $(this).attr("action")
            e.preventDefault();
            var formData = new FormData();
            formData.append("_token", "{{ csrf_token() }}");
            formData.append('file', $('#file')[0].files[0]);
            formData.append('name', $('#name').val());
            $.ajax({
                url: action,
                type: 'POST',
                data: formData,
                async: false,
                cache: false,
                contentType: false,
                enctype: 'multipart/form-data',
                processData: false,
                success: function(data) {
                    $(".alert-success").removeClass('d-none')
                }
            });
        })
    </script>
@endsection
