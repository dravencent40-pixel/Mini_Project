<?php

namespace App\Livewire\Auth;

use App\Livewire\Forms\LoginForm;
use Livewire\Attributes\Layout; // 1. Import Attribute Layout
use Livewire\Component;

#[Layout('layouts.app')] // 2. Pasang Layout di sini
class Login extends Component
{
    public LoginForm $form;

    public function login()
    {
        if ($this->form->store()) {
            return redirect()->intended('/dashboard');
        }
    }

    public function render()
    {
        // 3. Cukup return view biasa tanpa ->layout()
        return view('livewire.pages.auth.login');
    }
}