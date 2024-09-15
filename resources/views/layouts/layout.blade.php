<!DOCTYPE html>
<html lang="en">

@include('layouts.head')
<body class="bg-gray-100 h-screen flex flex-col">
@include('layouts.header')
<div class="flex-grow">
    <div class="container min-h-full min-w-full px-4 mt-8 flex justify-center">
        <!-- Main Content -->
        @yield('content')
    </div>
</div>

@include('layouts.footer')

<script>
    $(document).ready(function() {
        $('#userDropdownButton').click(function() {
            $('#userDropdown').toggleClass('hidden');
        });

        $(document).click(function(event) {
            if (!$(event.target).closest('#userDropdownButton').length && !$(event.target).closest('#userDropdown').length) {
                $('#userDropdown').addClass('hidden');
            }
        });
    });
</script>
</body>
</html>
