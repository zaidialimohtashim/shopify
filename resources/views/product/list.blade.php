@extends('shopify-app::layouts.default')
<link rel="stylesheet" href="{{ asset('src/bootstrap.min.css') }}" />
<link rel="stylesheet" href="{{ asset('src/designerz.css?v=') . uniqid() }}" />
<script src="{{ asset('src/bootstrap.min.js') }}"></script>
@section('content')
    <div class="wrapper">
        <div class="content_body">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <a class="navbar-brand" href="#">
                    <img src="{{ asset('src/Logo.png') }}" width="30" height="30" class="d-inline-block align-top"
                        alt="">
                    Designer
                </a>
                <ul>
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li><a href="#">My Products</a></li>
                </ul>
            </nav>
            @if ($products->isNotEmpty())
                <div class="row p-3">
                    @foreach ($products as $product)
                        <div class="card col-md-2 p-3 m-1" style="width: 18rem;">
                            {{-- <a href="{{URL::to('designerz/').'/'.$product->id}}"><img class="card-img-top" src="<?php echo URL::to($product->featured_image); ?>" alt="Card image cap"></a> --}}
                            <a href="{{ route('designer', ['id' => $product->id]) }}"><img class="card-img-top"
                                    src="<?php echo URL::to($product->featured_image); ?>" alt="Card image cap"></a>
                            <div class="card-body">
                                <h4 style="font-size: 14px;"><strong><?php echo $product->title; ?></strong></h4>
                                <p class="card-text" style="font-size: 14px;">
                                    <?php echo substr($product->description, 0, 40) . '...'; ?>
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <span>Products not found</span>
            @endif

        </div>
    </div>
@endsection

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
