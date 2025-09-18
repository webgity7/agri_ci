<html lang="en"><!--begin::Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Admin | Login Page</title>

    <!--begin::Accessibility Meta Tags-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
    <meta name="color-scheme" content="light dark">
    <meta name="theme-color" content="#007bff" media="(prefers-color-scheme: light)">
    <meta name="theme-color" content="#1a1a1a" media="(prefers-color-scheme: dark)">
    <!--end::Accessibility Meta Tags-->

    <!--begin::Primary Meta Tags-->
    <meta name="title" content="Admin| Login Page">


    <!--end::Primary Meta Tags-->

    <!--begin::Accessibility Features-->
    <!-- Skip links will be dynamically added by accessibility.js -->

    <!--end::Accessibility Features-->

    <!--begin::Fonts-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css" integrity="sha256-tXJfXfp6Ewt1ilPzLDtQnJV4hclT9XuaZUKyUvmyr+Q=" crossorigin="anonymous" media="all" onload="this.media='all'">
    <!--end::Fonts-->

    <!--begin::Third Party Plugin(OverlayScrollbars)-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/styles/overlayscrollbars.min.css" crossorigin="anonymous">
    <!--end::Third Party Plugin(OverlayScrollbars)-->

    <!--begin::Third Party Plugin(Bootstrap Icons)-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css" crossorigin="anonymous">
    <!--end::Third Party Plugin(Bootstrap Icons)-->

    <!--begin::Required Plugin(AdminLTE)-->
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/adminlte.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/style.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!--end::Required Plugin(AdminLTE)-->
</head>
<!--end::Head-->
<!--begin::Body-->

<body class="login-page bg-body-secondary app-loaded">

    <div class="login-box">
        <div class="login-logo">
            <div><span style="font-weight:900; font-family: Tahoma, sans-serif;">Admin</span><span style="font-weight: lighter; font-family: Tahoma, sans-serif; ">Login</span></div>
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg" style="font-family: Tahoma, sans-serif;">Sign in to start your session</p>

                <form method="post" id="loginForm" action="verification.php">
                    <div class="input-group ">
                        <input id="username" type="text" class="form-control" placeholder="User Name" aria-label="Email" style="font-family: Tahoma, sans-serif; outline:#398ebd;" name="username">
                        <div class="input-group-text">
                            <span class="bi bi-person-circle"></span>

                        </div>

                    </div>
                    <div class="input-group mb-3 mt-3">
                        <input id="password" type="password" class="form-control" placeholder="Password" aria-label="Password" style="font-family: Tahoma, sans-serif; outline:#398ebd;" name="password">
                        <div class="input-group-text" onclick="showHidePassword()">
                            <span id="lockUnlockIcon" class="bi bi-lock"></span>
                        </div>
                    </div>
                    <div id="message" class="text-center"></div>
                    <!--begin::Row-->
                    <div class="row mt-1">
                        <!-- /.col -->
                        <div class="text-center">
                            <div class="">
                                <button type="submit" class="btn btn-primary" style="font-family: Tahoma, sans-serif; background-color:#398ebd; outline:none; border:none;">Sign In</button>
                            </div>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!--end::Row-->
                </form>



            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
    <!-- /.login-box -->
    <script>
        document.getElementById('loginForm').addEventListener('submit', async (event) => {
            event.preventDefault();

            const username = document.getElementById('username').value;
            const password = document.getElementById('password').value;
            const messageDiv = document.getElementById('message');

            try {
                console.log(username);
                console.log(password);
                const response = await fetch('verify', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        username,
                        password
                    })
                });


                const data = await response.json();
    
                if (response.ok) {
                    window.location =data.redirect

                } else {
                    messageDiv.textContent = data.message || 'Login failed.';
                    messageDiv.style.color = 'red';
                }

            } catch (error) {
                console.error('Error:', error);
                messageDiv.textContent = 'An error occurred. Please try again.';
                messageDiv.style.color = 'red';

            }
        });
    </script>

    <script src="<?= base_url('assets/js/script.js') ?>"></script>
</body><!--end::Body-->

</html>