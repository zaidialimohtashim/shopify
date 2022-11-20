@include('../includes/header')
@include('../includes/sidebar')


<div class="page-wrapper" style="display: block;">
 <div class="page-breadcrumb">
   <div class="row">
       <div class="col-7 align-self-center">
           <h3 class="page-title text-truncate text-dark font-weight-medium mb-1">Customized Products</h3>
       </div>
   </div>
 </div>
   <div class="container-fluid">
          <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Product Title</th>
                    <th>Description</th>
                    <th>Customize Image</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
              @if($products->isNotEmpty())
              @foreach($products as $product)
              <tr>
                <td>{{$product->id}}</td>
                <td>{{$product->product->title}}</td>
                <td>{{$product->product->description}}</td>
                <td><a href="{{URL::to($product->customize_url)}}"  data-lightbox="example-1"><img class="img img-thumbnail" src="{{URL::to($product->customize_url)}}"/></a></td>
                <td>
                  {{-- <a href="{{route('view_sticker', ['id' => $product->id]) }}"><i class="fa fa-eye"></i></a>  --}}
                  &nbsp; <a href="javascript:;" title="Delete"  data-toggle="tooltip" data-placement="top" data-id="{{$product->id}}" class="delete"><i class="fa fa-trash"></i></a></td>
              </tr>
              @endforeach
            @else
              <tr style="text-align: center"><td colspan="4">Products not found</td></tr>
            @endif
          
          </tbody>
          </table>
         
        </div>
</div>
@include('../includes/footer')
@section('scripts')
    @parent
    <script>
        $(".delete").on('click',function(e){
            var id = $(this).attr('data-id');
            var thats = this;
            var route = "{{route('delete_product')}}";
            $.ajax({
                url: route+'/?id='+id,
                data:{
                  "_token" :"{{ csrf_token() }}",
                },
                type: 'Delete',
                success : function(data) {
                   $(thats).parents('tr').remove();
                }
            });
        });

       $(document).ready(function(){
        $('a[data-lightbox]').lightBox({
                          maxHeight: 700, 
                         maxWidth: 700
                    });
                    $('[data-toggle="tooltip"]').tooltip()
       })
      
    </script>

@if(config('shopify-app.appbridge_enabled'))
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