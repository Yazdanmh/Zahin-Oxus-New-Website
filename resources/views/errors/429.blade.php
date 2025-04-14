<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Too Many Requests</title>
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/css/core.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/css/theme-default.css') }}">

</head>

<body>
    <!-- Error -->
    <div class="container-xxl container-p-y py-5">
        <div class="misc-wrapper text-center">
            <h2 class="mb-2 mx-2">Too Many Request :(</h2>
            <p class="mb-4 mx-2">
                Oops! 😖 You’ve made too many requests in a short time. Please wait and try again later.
            </p>
            <a href="/" class="btn btn-primary">Back to home</a>
            <div class="mt-3">
                <img src="/frontend/assets/img/too-many-request.svg" alt="page-misc-error-light" width="400"
                    class="img-fluid" data-app-dark-img="illustrations/page-misc-error-dark.png"
                    data-app-light-img="illustrations/page-misc-error-light.png" />
            </div>
        </div>
    </div>

</body>

</html>
