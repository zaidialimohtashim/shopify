@include('../includes/header')
@include('../includes/sidebar')


<div class="page-wrapper" style="display: block;">
 <div class="page-breadcrumb">
   <div class="row">
       <div class="col-7 align-self-center">
           <h3 class="page-title text-truncate text-dark font-weight-medium mb-1">View Badges</h3>
       </div>
   </div>
 </div>
   <div class="container-fluid">
      <div class="card mt-5">
        <div class="card-header">Badge Title</div>
        <div class="card-body">{{$badge->name}}</div> 
        <div class="card-header">Badge Image</div>
        <div class="card-body">
            <div class="col-md-3">
             <img src="{{URL::to($badge->image)}}" class="img img-thumbnail"/>
            </div>
        </div> 
      </div>
    </div>
</div>
</div>
@include('../includes/footer')

@section('scripts')
    @parent
    <script>
       
        actions.TitleBar.create(app, { title: 'Welcome' });
    </script>
@endsection