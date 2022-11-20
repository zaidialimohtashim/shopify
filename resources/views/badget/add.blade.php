@include('../includes/header')
@include('../includes/sidebar')


<div class="page-wrapper" style="display: block;">
 <div class="page-breadcrumb">
   <div class="row">
       <div class="col-7 align-self-center">
           <h3 class="page-title text-truncate text-dark font-weight-medium mb-1">Add Badges</h3>
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
        <form id="form_add" method="post" action="{{route('save_badge')}}" enctype="multipart/form-data">
            @csrf
            <div class="col-md-12">
                <div class="form-group">
                    <label>Badge Title</label>
                    <input type="text" id="name" name="name" required class="form-control">
                </div>
                <div class="form-group">
                    <label>Badge Image</label>
                    <input type="file" id="file" name="file" required class="form-control">
                </div>
                <div class="form-group">
                    <input type="submit" name="submit" value="Add Badge" class="btn btn-primary">
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

        $("#form_add").on('submit',function(e){
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
                success : function(data) {
                   $(".alert-success").removeClass('d-none')
                }
            });
        })
        

    </script>

@endsection