<?php

namespace S4mpp\MyAccount\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ChangePassword extends Component
{
    public $current_password;

    public $password;

    public $password_confirmation;

    public function render()
    {
        return view('my-account::livewire.change-password');
    }

    public function changePassword()
    {
        try
        {
            $validated_data = $this->_validateForm();

            $customer = Auth::user();

            throw_if(!Hash::check($this->current_password, $customer->password), 'Senha atual inválida');

            $customer->password = Hash::make($validated_data['password']);

            $customer->save();
            
            $this->dispatchBrowserEvent('show-notification', [
                'title' => 'Pronto!',
                'text' => 'Sua senha foi alterada.'
            ]);
            
            $this->reset();
        }
        catch(\Exception $e)
        {
            return $this->addError('change-password', $e->getMessage());
        }
        finally
        {
            $this->dispatchBrowserEvent('reset-form');
        }
    }

    private function _validateForm()
    {
        return $this->validate([ 
            'current_password' => ['required', 'string'],
            'password' => ['required', 'min:8', 'string', 'confirmed'],
            'password_confirmation' => ['required', 'min:8', 'string'],
        ]);
    }
}
