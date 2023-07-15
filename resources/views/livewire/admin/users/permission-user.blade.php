<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>پوشیار | دسترسی دادن به کاربر</title>

    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('pooshyar/assets/images/pooshyar.png') }}">

    <link rel="stylesheet" href="{{ asset('panel/css/bootstrap.rtl.min.css') }}">

    <link rel="stylesheet" href="{{ asset('panel/css/style.css') }}">

    <link rel="stylesheet" href="{{ asset('panel/css/responsive_991.css') }}" media="(max-width:991px)">

    <link rel="stylesheet" href="{{ asset('panel/css/responsive_768.css') }}" media="(max-width:768px)">

    <link rel="stylesheet" href="{{ asset('panel/css/font.css') }}">

    <script src="{{ asset('panel/js/ckeditor.js') }}"></script>

    <script src="{{ asset('panel/js/sweetalert2@11.js') }}"></script>

    <style>
        .breadcrumb {
            display: block;
        }

        .form-group {
            margin-bottom: 10px;
        }

        .style {
            margin-top: 10px;
        }

        .dropdown-select {
            display: none;
        }

        .item-restore::before {
            content: "\E0e5";
            font-size: 20px;
            top: 10px;
            right: 15px;
            color: #636e72;
        }

        .table td {
            white-space: nowrap;
            color: #444;
            padding: 13px 7px;
            font-size: 13px;
        }

        .checkbox {
            margin-top: -10px;
        }
    </style>
</head>
<body>
    @include('sweetalert::alert', ['cdn' => "{{ asset('js/sweetalert2@9.js') }}"])
    <livewire:admin.dashboard.sidebar />

<div class="content">

<livewire:admin.dashboard.header />

    <div class="main-content">
        <div class="row">
            <div class="col-12 bg-white">
                <p class="box__title"> دسترسی دادن به کاربر_{{ $user->name }}</p>
                <form action="{{ route('users.permission.create',$user->id) }}" class="padding-10" method="POST">
                    @csrf
                    @forelse (\App\Models\permission::all() as $permission)
                    <p>{{ $permission->description }}</p>
                    <div class="notificationGroup">
                        <input id="option{{ $permission->id }}" type="checkbox" name="permission[]" class="form-control" value="{{ $permission->id }}"
                        {{ in_array($permission->id,$user->permissions->pluck('id')->toArray()) ? 'checked' : '' }}/>
                        <label for="option{{ $permission->id }}">{{ $permission->name }}</label>

                    </div>
                    <hr>
                    @empty
                    <div>دسترسی وجود ندارد</div>
                    @endforelse

                    <button class="btn btn-brand" type="submit">دسترسی دادن</button>
                </form>
        </div>
    </div>
</div>
</div>
</body>
<script src="{{ asset('panel/js/jquery-3.4.1.min.js') }}"></script>
<script src="{{ asset('panel/js/js.js') }}"></script>
<script src="{{ asset('panel/js/jscolor.js') }}"></script>

</html>
