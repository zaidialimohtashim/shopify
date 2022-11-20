@section('content')
<div class="wrapper">
    @include('includes/sidebar')

    <div class="content_body">
      <a class="btn btn-success pull-right" href="{{route('list')}}">Back</a>
      <div class="card mt-5">
        <div class="card-header">Sticker Title</div>
        <div class="card-body">{{$product->name}}</div> 
        <div class="card-header">Sticker Image</div>
        <div class="card-body">
            <div class="col-md-3">
             <img src="{{URL::to($product->image)}}" class="img img-thumbnail"/>
            </div>
        </div> 
      </div>
    </div>
</div>
@endsection

@section('scripts')
    @parent
    <script>
       
        actions.TitleBar.create(app, { title: 'Welcome' });
    </script>
@endsection