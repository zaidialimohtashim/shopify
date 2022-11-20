<html>

<head>
    <title>Tshirt Designer</title>
    <link rel="stylesheet" href="{{ asset('src/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('src/designerz.css?v=') . uniqid() }}" />
    <link rel="stylesheet" href="{{ asset('src/font-awesome.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('src/jquery-ui.css') }}" />
    <script src="{{ asset('src/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('src/jquery-ui.js') }}"></script>
    <script src="{{ asset('src/bootstrap.min.js') }}"></script>
    <script src="{{ asset('src/dom-to-image.js') }}"></script>
    @csrf
    <script>
        var baseImage = "{{ asset('src/download.png') }}"
        var shop_ids = 1;
        var product_ids = '{{$product->id}}';
    </script>
    <script src="{{ asset('src/deisgner.lib.js?v=') . uniqid() }}"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Anton&family=Asap+Condensed:wght@400;500&family=Fjalla+One&family=Jost:wght@200;300&family=Oswald:wght@200;300;400;500&family=Poppins:wght@300;400&family=Roboto:ital,wght@0,100;0,300;0,400;1,100&family=Ubuntu+Condensed&family=Ubuntu:ital,wght@0,300;0,500;0,700;1,500&display=swap"
        rel="stylesheet">
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">
            <img src="{{ asset('src/Logo.png') }}" width="30" height="30" class="d-inline-block align-top"
                alt="">
            Designer
        </a>
        <ul>
            <li><a href="{{  route('home') }}">Home</a></li>
            {{-- <li><a href="{{ route('product_list') }}">Home</a></li> --}}
            <li><a href="#">My Products</a></li>
        </ul>
    </nav>

    <div class="designer">
        <div class="tool_box col-md-3" id="toolbox">
            {{-- {{dd($product)}} --}}
            <div id="move">

            </div>
            <div class="publish col-md-12">
                <a class="save_icon disabled_mode" id="save" href="#"><i class="fa fa-save"></i> Save</a>
                {{-- <a class="save_icon" id="save_and_publish" href="#"><i class="fa fa-share"></i> Save & Add to Shopify</a> --}}
            </div>
            <div class="col-md-12 properties badges">
                <label>Badges</label>
                <div class="colapse">
                    <ul>
                        @foreach ($badges as $badge)
                            <li>
                                <span class="image"><img src="{{ URL::to($badge->image) }}" /></span>
                                <span>{{ $badge->name }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-md-12 properties badges">
                <label>Stickers</label>
                <div class="colapse">
                    <ul>
                        @foreach ($stickers as $sticker)
                            <li>
                                <span class="image"><img src="{{ URL::to($sticker->image) }}" /></span>
                                <span>{{ $sticker->name }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-md-12 properties badges">
                <label>Colors</label>
                <div class="colapse">
                    <ul class="colorPalette">
                        @foreach ($colors as $color)
                            <li>
                                <span class="colorbox" data-color_name="red" data-color="{{ $color->color }}"
                                    style="background:{{ $color->color }}"></span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-md-12 properties badges">
                <label>Text</label>
                <div class="colapse">
                    <div class="row">
                        <div class="col-md-5">
                            <select id="font_size">
                                <option>Font Size</option>
                                @for ($i = 6; $i < 72; $i++)
                                    <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                        <div class="col-md-6">
                            <select id="font_family">
                                <option>Font Family</option>
                                <option value="Anton">Anton</option>
                                <option value="Fjalla One">Fjalla One</option>
                                <option value="Jost">Jost</option>
                                <option value="Oswald">Oswald</option>
                                <option value="Poppins">Poppins</option>
                                <option value="Roboto">Roboto</option>
                                <option value="Ubuntu">Ubuntu</option>
                            </select>
                        </div>
                        <div class="col-md-12">
                            <a href="#" id="add_text" class="typo_icon"><i class="fa fa-font"
                                    aria-hidden="true"></i><i class="fa fa-plus" aria-hidden="true"></i></a>
                            <a href="#" id="do_bold" class="typo_icon"><i class="fa fa-bold"
                                    aria-hidden="true"></i></a>
                            <a href="#" id="do_underline" class="typo_icon"><i class="fa fa-underline"
                                    aria-hidden="true"></i></a>
                            <a href="#" id="do_italic" class="typo_icon"><i class="fa fa-italic"
                                    aria-hidden="true"></i></a>
                        </div>
                        <div class="col-md-12">
                            <input type="color" name="color" id="color" />
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="stage" id="stage">
            {{-- <img id="baseImg" src="{{ \App\Http\Controllers\DesignController::getImageFromRoute(route('get_product_image', ['color' => explode('#', $product->color)[1]])) }}" /> --}}
            <img id="baseImg" src="{{ URL::to($image) }}" />

        </div>

    </div>

    <script>
        async function getImageFromRoute(url) {
            var xhr = new XMLHttpRequest();
            xhr.withCredentials = true;

            xhr.addEventListener("readystatechange", function() {
                if (this.readyState === 4) {
                    $("#baseImg").attr('src', this.responseText)
                    // console.log(this.responseText);
                }
            });

            xhr.open("GET", url);
            // WARNING: Cookies will be stripped away by the browser before sending the request.
            xhr.send();
        }
        $(document).ready(function() {
            $(".colorbox").on('click', function() {
                var color = $(this).attr('data-color');
                var url = route + '?color=' + color.split('#')[1];
                getImageFromRoute(url);
                // $("#baseImg").attr('src',response.text())
            });
        });
    </script>
</body>

</html>
