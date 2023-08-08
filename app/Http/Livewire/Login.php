<?php

namespace App\Http\Livewire;

use App\Providers\RouteServiceProvider;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Livewire\Component;
use function PHPUnit\Framework\at;

class Login extends Component
{
    public ?string $cell_number, $password;
    public ?bool $isAuthenticated = null;

    /**
     * @return Factory|View|Application
     */
    public function render(): Factory|View|Application
    {
        return view('livewire.login');
    }

    /**
     * @param $propertyName
     * @return void
     * @throws ValidationException
     */
    public function updated($propertyName): void
    {
        $this->validateOnly($propertyName, [
            'cell_number' => ['required', 'string'],
            'password' => ['required', 'min:6']
        ], [
            'cell_number.required' => "This field is required.",
            'password.required' => 'This field is required.'
        ]);
    }

    /**
     * @return RedirectResponse|void
     */
    public function login()
    {
        $validatedData = $this->validate([
            'cell_number' => ['required'],
            'password' => ['required', 'min:6']
        ]);

        $this->isAuthenticated = false;
        $validatedData['cell_number'] = '+1' . str_replace([" ", '-', '(', ')', '_',], "", $validatedData['cell_number']);

        if (Auth::attempt($validatedData)) {
            $this->isAuthenticated = true;
            session()->regenerate();
            Auth::logoutOtherDevices($validatedData['password']);

            if (\auth()->user()->roles->first()->name == 'Admin') {
                return redirect('/admin');
            } else if (\auth()->user()->roles->first()->name == 'Perm School Nurse') {
                return redirect()->route('school-nurse.call-out.index');
            } else {
                return redirect('/nurse');
            }
        }
    }
}
