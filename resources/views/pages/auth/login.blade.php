@extends('layout.root')

@section('title-page')
Login
@endsection

@section('content')
<section class="vh-100" style="background-image: url('https://static.vecteezy.com/system/resources/previews/004/242/510/original/abstract-wave-trendy-geometric-abstract-background-with-white-and-blue-gradient-vector.jpg'); background-size: cover;">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                <form class="card" action="{{ route('login-action') }}" method="post" style="border-radius: 1rem; background: rgba(255, 255, 255, 0.5); backdrop-filter: blur(5px)">
                @csrf
                    <div class="card-body p-5">
                        <div class="mt-md-4">
                            <h2 class="fw-bold mb-2 text-uppercase">Login</h2>
                            <p class="mb-5">Masukan Email dan Password Untuk Login</p>
                            <div class="form-group">
                                <label for="input-email">Email</label>
                                <input name="email" type="email" id="input-email" class="form-control" placeholder="masukan email anda">
                            </div>
                            <div class="form-group">
                                <label for="input-password">Password</label>
                                <input name="password" type="password" id="input-password" class="form-control" placeholder="masukan password anda">
                            </div>
                            <div class="checkbox">
                                <input name="remember-me" type="checkbox" id="remember-me" class='form-check-input'>
                                <label for="remember-me">Ingat Saya</label>
                            </div>
                            <button class="btn btn-outline-secondary btn-lg px-5 mt-4"type="submit">Login</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection