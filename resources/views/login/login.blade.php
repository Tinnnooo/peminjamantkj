@extends('login.main')

    <main class="form-signin shadow-lg">
      <form method="POST" action="{{ route('authenticate') }}">
        @csrf
        <h1 class="h3 mb-3 fw-normal text-muted">Silahkan Login</h1>
    
        <div class="form-group user_box">
            <input type="text" class="form-control" id="username" name="username" required>
            <label for="username"><i class='bx bx-user'></i>Username</label>
        </div>
        <div class="form-group user_box">
            <input type="password" class="form-control" name="password" id="password" required>
            <label for="password"><i class='bx bx-lock-alt'></i>Password</label>
        </div>

        <div class="submit_button text-center">
            <button class="btn btn-lg btn-primary" type="submit">Login</button>
        </div>

        <div class="text_info">
            <p>username dan password login menggunakan nis sekolah</p>
            <p>221345</p>
            <p>tanpa tanda strip</p>
        </div>
      </form>
    </main>
    
    
        
