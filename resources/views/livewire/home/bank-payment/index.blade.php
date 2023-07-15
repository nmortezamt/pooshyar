<div>
    @php
        $logo = \App\Models\logoSite::get()[0];
    @endphp
    <!-- START HEADER -->
    <header class="header_wrap">

        <div class="middle-header dark_skin">
            <div class="container">
                <div class="nav_block">
                    <a class="navbar-brand" href="/">
                        <img src="/uploads/{{ $logo->img }}" alt="{{ env('APP_NAME') }}" class="rounded mx-auto d-block"
                            width="300">

                    </a>

                </div>
            </div>
        </div>

    </header>
    <!-- END HEADER -->

    <div class="alert alert-success">
        <p>شما به زودی به درگاه پرداخت متصل می شوید</p>
        <div class="loader mb-3 ml-3"></div>
    </div>

    <style>
        .alert {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .alert p {
            margin-right: 10px;
            font-size: 20px
        }

        .loader {
            border: 4px solid #f3f3f3;
            border-top: 4px solid #3498db;
            border-radius: 50%;
            width: 30px;
            height: 30px;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            from {
            transform: rotate(0deg);
            }

            to {
            transform: rotate(360deg);
            }

        }
    </style>
</div>
