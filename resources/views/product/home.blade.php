     @include('../includes/header')
     @include('../includes/sidebar')

   
     <div class="page-wrapper" style="display: block;">
      <div class="page-breadcrumb">
        <div class="row">
            <div class="col-7 align-self-center">
                <h3 class="page-title text-truncate text-dark font-weight-medium mb-1">Products</h3>
            </div>
        </div>
      </div>
        <div class="container-fluid">
            <a class="btn btn-success pull-right mb-3" href="{{ route('add_product') }}">Add Product</a>
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Product Title</th>
                        <th>Description</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($products->isNotEmpty())
                        @foreach ($products as $product)
                            <tr>
                                <td>{{ $product->id }}</td>
                                <td>{{ $product->title }}</td>
                                <td>{{ $product->description }}</td>
                                <td>
                                    {{-- <a href="{{route('view_sticker', ['id' => $product->id]) }}"><i class="fa fa-eye"></i></a> --}}
                                    &nbsp; <a href="javascript:;" data-id="{{ $product->id }}" class="delete"><i
                                            class="fa fa-trash"></i></a></td>
                            </tr>
                        @endforeach
                    @else
                        <tr style="text-align: center">
                            <td colspan="4">Products not found</td>
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
