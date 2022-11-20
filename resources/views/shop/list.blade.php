@include('../includes/header')
@include('../includes/sidebar')


<div class="page-wrapper" style="display: block;">
 <div class="page-breadcrumb">
   <div class="row">
       <div class="col-7 align-self-center">
           <h3 class="page-title text-truncate text-dark font-weight-medium mb-1">Shops (Installed App)</h3>
       </div>
   </div>
 </div>
   <div class="container-fluid">
      <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                {{-- <th>Action</th> --}}
            </tr>
        </thead>
        <tbody>
          @if($shops->isNotEmpty())
              @foreach($shops as $shop)
                <tr>
                  <td>{{$shop->id}}</td>
                  <td>{{$shop->name}}</td>
                  <td>{{$shop->email}}</td>
                  {{-- <td><a href="{{route('view_badge', ['id' => $badge->id]) }}"><i class="fa fa-eye"></i></a> &nbsp; <a href="javascript:;" data-id="{{$badge->id}}" class="delete"><i class="fa fa-trash"></i></a></td> --}}
                </tr>
              @endforeach
            @else
              <tr style="text-align: center"><td colspan="4">Shops not found</td></tr>
           @endif
        </tbody>
      </table>
    </div>
</div>
@include('../includes/footer')
