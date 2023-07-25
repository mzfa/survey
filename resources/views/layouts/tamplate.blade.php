<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>{{ env('APP_NAME') }}</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/backend-plugin.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/backend.css') }}?v=1.0.0">
    <link rel="stylesheet" href="{{ asset('assets/vendor/line-awesome/dist/line-awesome/css/line-awesome.min.css') }}">
    {{-- <link rel="stylesheet" href="{{ asset('assets/vendor/remixicon/fonts/remixicon.css') }}"> --}}

    {{-- <link rel="stylesheet" href="{{ asset('assets/vendor/tui-calendar/tui-calendar/dist/tui-calendar.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/tui-calendar/tui-date-picker/dist/tui-date-picker.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/tui-calendar/tui-time-picker/dist/tui-time-picker.css') }}"> --}}

    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    {{-- <link rel="stylesheet" href="{{ asset('assets/vendor/datatables-responsive/css/responsive.bootstrap4.min.css') }}"> --}}
    <link rel="stylesheet" href="{{ asset('assets/vendor/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        :root {
  --color-1: #6366f1;
  --color-1-hover: #4338ca;
  --color-2: #06b6d4;
  --color-2-hover: #0891b2;
  --text-color: #312e81;
  --status-btn-bg: #f8fafc;
  --status-btn-bg-hover: #f1f5f9;
}

body {
  background: linear-gradient(to left, var(--color-1), var(--color-2));
  padding: 2%;
}

.container {
  margin: 3rem auto;
  max-width: 500px;
  background: white;
  border-radius: 1rem;
  padding: 2rem;

}

.form-input {
  width: 100%;
  border: 1px solid #ddd;
  border-radius: .5rem;
  box-shadow: inset 0px 1px 2px rgba(0, 0, 0, .1);
  padding: 1rem;
  box-sizing: border-box;
  color: var(--text-color);
  transition: ease-in-out .3s all;
}

.form-input::placeholder {
  color: #cbd5e1;
}

.form-input:focus {
  outline: none;
  border-color: var(--color-1);
}

.btn:focus-within,
.form-input:focus-within {
  box-shadow: #f8fafc 0px 0px 0px 2px, #c7d2fe 0px 0px 0px 6px, #0000 0px 1px 2px 0px;
}

textarea.form-input {
  min-height: 150px;
}

.btn {
  border: 0;
  background: var(--color-1);
  padding: 1rem;
  border-radius: 25px; 
  color: white;
  cursor: pointer;
}

.btn[disabled] {
  opacity: .5;
  pointer-events: none;
}

.btn:hover {
  background: var(--color-1-hover);
  transition: ease-in-out .3s all;
}

.btn-submit {
  background-color: var(--color-2);
}

.btn-submit:hover {
  background-color: var(--color-2-hover);
}

.pagination {
  margin-top: 1rem;
  display: flex;
  align-items: center;
  justify-content: center;
}

.pagination .btn {
  width: 100%;
  text-align: center;
  margin: 0 6px;
}

.tab-status {
  display: flex;
  align-items: center;
}

.tab-status span {
  appearance: none;
  background: var(--status-btn-bg);
  border: none;
  border-radius: 50%;
  width: 2rem;
  height: 2rem;
  margin-right: .5rem;
  display: flex;
  align-items: center;
  justify-content: center;
}

.tab-status span.active {
  background-color: var(--color-2);
  color: white;
}

.hidden {
  display: none;
}


    </style>
</head>

<body class="  ">
    <!-- loader Start -->
    <div id="loading">
        <div id="loading-center">
        </div>
    </div>
    <!-- loader END -->
    <!-- Wrapper Start -->
    <div class="wrapper">
        @yield('content')
    </div>
    <!-- Wrapper End-->

    <!-- Modal list start -->
    <!-- Backend Bundle JavaScript -->
    <script src="{{ asset('assets/js/backend-bundle.min.js') }}"></script>

    <!-- Table Treeview JavaScript -->
    <script src="{{ asset('assets/js/table-treeview.js') }}"></script>

    <!-- Chart Custom JavaScript -->
    <script src="{{ asset('assets/js/customizer.js') }}"></script>

    <!-- Chart Custom JavaScript -->
    <script async src="{{ asset('assets/js/chart-custom.js') }}"></script>
    <!-- Chart Custom JavaScript -->
    <script async src="{{ asset('assets/js/slider.js') }}"></script>

    <!-- app JavaScript -->
    <!-- DataTables  & Plugins -->
    {{-- <script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script> --}}
    <script src="{{ asset('assets/js/app.js') }}"></script>

    <script src="{{ asset('assets/vendor/moment.min.js') }}"></script>
    @if (Session::has('success'))
    <script>
        Swal.fire(
          'Terimakasih !',
          'atas partisipasi Bapak dan Ibu dalam pengisian survey kepuasan kami. Kritik dan saran dari Bapak dan Ibu sangat berharga untuk kami demi memaksimalkan pelayanan kesehatan kami.',
          'success'
        );
    </script>
    @endif

    @stack('scripts')
</body>

</html>