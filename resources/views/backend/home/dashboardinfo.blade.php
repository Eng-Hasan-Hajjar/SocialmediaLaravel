<head>
    <!-- إضافة Bootstrap و Font Awesome -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

    <style>
        /* تنسيق إشعارات التنقل */
        .navbar .dropdown-menu {
            left: auto;
            right: 0;
        }

        .notification-icon {
            position: relative;
            cursor: pointer;
        }

        .notification-icon .badge {
            position: absolute;
            top: -5px;
            right: -10px;
            background-color: red;
            color: white;
            font-size: 12px;
            padding: 4px 6px;
            border-radius: 50%;
        }

        /* تنسيق البطاقات */
        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .card:hover {
            transform: scale(1.05);
        }

        .card-title {
            font-size: 1.5rem;
            font-weight: bold;
        }

        .card-text {
            font-size: 2.5rem;
            font-weight: bold;
        }

        .bg-facebook {
            background-color: #3b5998;
        }

        .bg-instagram {
            background-color: #e4405f;
        }

        .bg-youtube {
            background-color: #ff0000;
        }

        .icon {
            font-size: 2rem;
            margin-right: 10px;
        }
    </style>
</head>

<body>
    <!-- عرض رسائل الجلسة -->
    @if (session('success'))
        <div class="alert alert-success text-center">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger text-center">
            {{ session('error') }}
        </div>
    @endif

    <!-- قسم عرض الإحصائيات -->
    <div class="container mt-5">
        <div class="row text-center">
            <div class="col-md-4 mb-4">
                <div class="card text-white bg-primary">
                    <div class="card-body">
                        <h5 class="card-title">Customers<i class="fas fa-user-tie icon"></i> </h5>
                        <p class="card-text">{{ $customerCount }}</p>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-4">
                <div class="card text-white bg-secondary">
                    <div class="card-body">
                        <h5 class="card-title">Admins<i class="fas fa-user-shield icon"></i> </h5>
                        <p class="card-text">{{ $adminCount }}</p>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-4">
                <div class="card text-white bg-info">
                    <div class="card-body">
                        <h5 class="card-title">Employees<i class="fas fa-users icon"></i> </h5>
                        <p class="card-text">{{ $employeeCount }}</p>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-4">
                <div class="card text-white bg-facebook">
                    <div class="card-body">
                        <h5 class="card-title">Facebook Pages<i class="fab fa-facebook icon"></i> </h5>
                        <p class="card-text">{{ $facebookPageCount }}</p>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-4">
                <div class="card text-white bg-instagram">
                    <div class="card-body">
                        <h5 class="card-title">Instagram Accounts<i class="fab fa-instagram icon"></i> </h5>
                        <p class="card-text">{{ $instagramAccountCount }}</p>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-4">
                <div class="card text-white bg-youtube">
                    <div class="card-body">
                        <h5 class="card-title">YouTube Channels<i class="fab fa-youtube icon"></i> </h5>
                        <p class="card-text">{{ $youtubeChannelCount }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- قسم إضافة العناصر -->
    <div class="container mt-4 text-center">
        @if(Auth::user()->can('isEmployee') || Auth::user()->can('isAdmin'))
            <div class="row justify-content-center">
                <div class="col-md-2">
                    <a href="{{ route('categories.create') }}" class="btn btn-success btn-block mb-2">Create Categories</a>
                </div>
                <div class="col-md-2">
                    <a href="{{ route('products.create', ['car' => 1]) }}" class="btn btn-danger btn-block mb-2">Create Products</a>
                </div>
                <div class="col-md-2">
                    <a href="{{ route('youtube_channels.create', ['car' => 1]) }}" class="btn btn-warning btn-block mb-2">Create YouTube Channels</a>
                </div>
                <div class="col-md-2">
                    <a href="{{ route('instagram_accounts.create') }}" class="btn btn-info btn-block mb-2">Create Instagram Accounts</a>
                </div>
                <div class="col-md-2">
                    <a href="{{ route('facebook_pages.create') }}" class="btn btn-primary btn-block mb-2">Create Facebook Pages</a>
                </div>
            </div>
        @endif
    </div>

    <!-- إضافة Bootstrap و Font Awesome JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
