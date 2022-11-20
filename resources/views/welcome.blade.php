@extends('shopify-app::layouts.default')


@section('content')
<div class="wrapper">
   
    @include('product/list')

</div>
@endsection



@section('scripts')

    @parent



    <script>

        actions.TitleBar.create(app, { title: 'Welcome' });

    </script>

@endsection