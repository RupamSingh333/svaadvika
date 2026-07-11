<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel') - {{ config('app.name', 'Food Ordering') }}</title>
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Theme Check (Run before render to prevent flash) -->
    <script>
        if (localStorage.getItem('adminTheme') === 'dark') {
            document.documentElement.setAttribute('data-bs-theme', 'dark');
            document.documentElement.classList.add('dark-mode');
        }
    </script>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- FontAwesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    
    <!-- Custom Admin CSS -->
    <link rel="stylesheet" href="{{ asset('admin/css/admin.css') }}">
    
    @stack('styles')
</head>
<body>
    <div class="admin-wrapper">
        <!-- Sidebar -->
        @include('admin.layouts.sidebar')

        <div class="main-content">
            <!-- Header -->
            @include('admin.layouts.header')

            <!-- Content -->
            <main class="content-area p-4">
                <div class="container-fluid p-0">
                    <!-- Breadcrumb -->
                    @yield('breadcrumb')
                    
                    <!-- Alerts -->
                    @include('admin.layouts.alerts')
                    
                    @yield('content')
                </div>
            </main>

            <!-- Footer -->
            @include('admin.layouts.footer')
        </div>
    </div>

    <!-- Bootstrap 5 JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Custom Admin JS -->
    <script src="{{ asset('admin/js/admin.js') }}"></script>
    
    <!-- TinyMCE -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/6.8.2/tinymce.min.js"></script>
    <script>
        tinymce.init({
            selector: '.richtext',
            plugins: 'code link image lists table media fullscreen visualblocks help wordcount preview searchreplace',
            toolbar: 'undo redo | formatselect | bold italic underline strikethrough | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media table | removeformat | fullscreen preview code | help',
            height: 500,
            promotion: false,
            branding: false,
            image_title: true,
            automatic_uploads: true,
            file_picker_types: 'image',
        });
    </script>

    @stack('scripts')
</body>
</html>
