@include('../includes/header')
@include('../includes/sidebar')


<div class="page-wrapper" style="display: block;">
 <div class="page-breadcrumb">
   <div class="row">
       <div class="col-7 align-self-center">
           <h3 class="page-title text-truncate text-dark font-weight-medium mb-1">Categories</h3>
       </div>
   </div>
 </div>
   <div class="container-fluid">
       <a class="btn btn-success pull-right mb-3" href="{{ route('add-categories') }}">Add Category</a>
       <table class="table">
           <thead>
               <tr>
                   <th>ID</th>
                   <th>Category Name</th>
                   <th>Description</th>
                   <th>Action</th>
               </tr>
           </thead>
           <tbody>
               @if ($categories->isNotEmpty())
                   @foreach ($categories as $category)
                       <tr>
                           <td>{{ $category->id }}</td>
                           <td>{!! $category->name . ($category->getParentCategory !== null ?  " - <span class='cat_par'>" . $category->getParentCategory->name : '')."</span>" !!}</td>
                           <td>{{ $category->description ??  "No Description Provided" }}</td>
                           <td>
                              <a href="{{ route('edit_categories',['id' => $category->id])}}" data-id="{{ $category->id }}" class="edit"><i class="fa fa-pencil"></i></a>
                              <a href="#" data-id="{{ $category->id }}" class="delete"><i class="fa fa-trash"></i></a>
                           </td>
                       </tr>
                   @endforeach
               @else
                   <tr style="text-align: center">
                       <td colspan="4">Categories are not found</td>
                   </tr>
               @endif

           </tbody>
       </table>
   </div>
</div>

@include('../includes/footer')

@section('scripts')
    @parent
    <script>
        $(".delete").on('click', function(e) {
            var id = $(this).attr('data-id');
            var thats = this;
            var route = "{{ route('delete_product') }}";
            $.ajax({
                url: route + '/?id=' + id,
                data: {
                    "_token": "{{ csrf_token() }}",
                },
                type: 'Delete',
                success: function(data) {
                    $(thats).parents('tr').remove();
                }
            });
        });
    </script>

    @if (config('shopify-app.appbridge_enabled'))
        <script type="text/javascript">
            var AppBridge = window['app-bridge'];
            var actions = AppBridge.actions;
            var TitleBar = actions.TitleBar;
            var Button = actions.Button;
            var Redirect = actions.Redirect;
            var titleBarOptions = {
                title: 'Welcome to Tshirt Designer',
            };
            // var myTitleBar = TitleBar.create(app, titleBarOptions);
        </script>
    @endif
@endsection
