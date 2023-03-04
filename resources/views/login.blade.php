@extends('layouts.main')

    <div class="login-container">
        <div class="login-screen">
            <div class="login-screen_content">
                <form action="/login" method="POST" class="login-form">
                    @csrf
                    <div class="login-form_field">
                        <i class="login-form_icon fa-solid fa-user"></i>
                        <input type="text" class="login-form_input" placeholder="Username" name="username" required>
                    </div>

                    <div class="login-form_field">
                        <i class="login-form_icon fa-solid fa-lock"></i>
                        <input type="password" class="login-form_input" placeholder="Password" name="password" required>
                    </div>
                    <div class="login-fill_instruction">
                        <span class="login-fill_instruction_text">Username dan Password login menggunakan nis sekolah</span>
                        <span class="login-fill_instruction_nis">2212345</span>
                        <span class="login-fill_instruction_text">tanpa tanda strip</span>
                    </div>

                    <button class="button login-form_submit" type="submit">
                        <span class="login-button_text">Login</span>
                        <i class="login-button_icon fa-solid fa-chevron-right"></i>
                    </button>
                </form>
            </div>
            <div class="login-screen_background">
                <span class="login-screen_background_shape login-screen_background_shape4"></span>
                <span class="login-screen_background_shape login-screen_background_shape3"></span>
                <span class="login-screen_background_shape login-screen_background_shape2"></span>
                <span class="login-screen_background_shape login-screen_background_shape1"></span>
            </div>
        </div>
    </div>