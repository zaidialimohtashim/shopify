@include('../includes/header')
@include('../includes/sidebar')


<div class="page-wrapper" style="display: block;">
 <div class="page-breadcrumb">
   <div class="row">
       <div class="col-7 align-self-center">
           <h3 class="page-title text-truncate text-dark font-weight-medium mb-1">Badges</h3>
       </div>
   </div>
 </div>
   <div class="container-fluid">
      <a class="btn btn-success pull-right mb-3" href="{{route('add_badge')}}">Add Badges</a>
      <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>File Name</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
          @if($badges->isNotEmpty())
              @foreach($badges as $badge)
                <tr>
                  <td>{{$badge->id}}</td>
                  <td>{{$badge->name}}</td>
                  <td>{{$badge->filename}}</td>
                  <td><a href="{{route('view_badge', ['id' => $badge->id]) }}"><i class="fa fa-eye"></i></a> &nbsp; <a href="javascript:;" data-id="{{$badge->id}}" class="delete"><i class="fa fa-trash"></i></a></td>
                </tr>
              @endforeach
            @else
              <tr style="text-align: center"><td colspan="4">Badges not found</td></tr>
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
            var route = "{{route('delete_badge')}}";
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
        actions.TitleBar.create(app, { title: 'Welcome' });
    </script>
@endsection