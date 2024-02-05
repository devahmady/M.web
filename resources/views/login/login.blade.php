<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Login</title>
    <!-- CSS files -->
    <link href="{{ asset('mikman') }}/css/tabler.min.css?1668287865" rel="stylesheet" />
   
    <style>
        @import url('https://rsms.me/inter/inter.css');

        :root {
            --tblr-font-sans-serif: Inter, -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
        }
    </style>
</head>

<body class=" border-top-wide border-primary flex-column">
    <div class="page page-center">
        <div class="container container-tight">

            <div class="card card-md">
                <div class="card-body">
                    <h1 class="text-center mb-4">
                        <img src="{{ asset('mikman') }}/img/mikman.png" alt="Tabler" class="navbar-brand-image ">
                    </h1>
                    <form action="{{ route('login.mikman') }}" method="POST" novalidate id="loginForm">
                        @csrf

                        <div class="input-group input-group-sm mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroup">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-prompt"
                                        width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                        stroke="currentColor" fill="none" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <polyline points="5 7 10 12 5 17"></polyline>
                                        <line x1="13" y1="17" x2="19" y2="17"></line>
                                    </svg>
                                </span>
                            </div>
                            <input type="text" class="form-control" aria-label="Small"
                                aria-describedby="inputGroup-sizing-sm" name="ip" placeholder="IP Router" required>
                        </div>
                        <div class="input-group input-group-sm mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroup">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="icon icon-tabler icon-tabler-user-circle" width="24" height="24"
                                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <circle cx="12" cy="12" r="9"></circle>
                                        <circle cx="12" cy="10" r="3"></circle>
                                        <path d="M6.168 18.849a4 4 0 0 1 3.832 -2.849h4a4 4 0 0 1 3.834 2.855"></path>
                                    </svg>
                                </span>
                            </div>
                            <input type="text" class="form-control" aria-label="Small"
                                aria-describedby="inputGroup-sizing-sm" name="user" placeholder="Username">
                        </div>
                        <div class="input-group input-group-sm mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroup">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="icon icon-tabler icon-tabler-brand-mixpanel" width="24"
                                        height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                        fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <circle cx="4.5" cy="12" r="2.5"></circle>
                                        <circle cx="20.5" cy="12" r="1.5"></circle>
                                        <circle cx="13" cy="12" r="2"></circle>
                                    </svg>
                                </span>
                            </div>
                            <input type="text" class="form-control" aria-label="Small"
                                aria-describedby="inputGroup-sizing-sm" name="password" placeholder="Password">
                        </div>
                        <div class="form-footer">
                            <button type="submit" id="submitBtnLogin" class="btn btn-primary w-100">Login</button>
                            <div id="loadinglogin" class="d-none text-center mt-3">
                                <div class="spinner-border text-primary" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                                <p class="text-primary mt-2">Menambahkan...</p>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="hr-text">Want to give me a Gift?</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col"><a href="#" class="btn w-100">
                                <!-- Download SVG icon from http://tabler-icons.io/i/brand-github -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-gift"
                                    width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                    stroke="currentColor" fill="none" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <rect x="3" y="8" width="18" height="4" rx="1"></rect>
                                    <line x1="12" y1="8" x2="12" y2="21"></line>
                                    <path d="M19 12v7a2 2 0 0 1 -2 2h-10a2 2 0 0 1 -2 -2v-7"></path>
                                    <path
                                        d="M7.5 8a2.5 2.5 0 0 1 0 -5a4.8 8 0 0 1 4.5 5a4.8 8 0 0 1 4.5 -5a2.5 2.5 0 0 1 0 5">
                                    </path>
                                </svg>
                                Donat
                            </a></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Libs JS -->
        <!-- Tabler Core -->
        <script src="{{ asset('mikman') }}/js/tabler.min.js?1668287865" defer></script>
        <script src="{{ asset('mikman') }}/js/demo.min.js?1668287865" defer></script>
</body>

</html>
