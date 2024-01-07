<?php

namespace S4mpp\MyAccount\Livewire;

use Livewire\Component;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use S4mpp\MyAccount\Traits\ProtectedByPassword;

class ChangePersonalData extends Component
{
    use ProtectedByPassword;

    public $name;

    public $email;

    public function mount()
    {
        $this->name = Auth::user()->name;
        
        $this->email = Auth::user()->email;
    }

    public function render()
    {
        return view('my-account::livewire.change-personal-data');
    }

    public function changeEmail()
    {
        try
        {
            $this->resetValidation();

            $validated_data = $this->_validateForm();

            $this->_validatePassword();

            $customer = Auth::user();

            $customer->name = $validated_data['name'];
            $customer->email = $validated_data['email'];

            $customer->save();
            
            $this->dispatchBrowserEvent('show-notification', [
                'title' => 'Pronto!',
                'text' => 'Seu e-mail foi alterado.'
            ]);
        }
        catch(\Exception $e)
        {
            return $this->addError('change-email', $e->getMessage());
        }
        finally
        {
            $this->dispatchBrowserEvent('reset-form');
            $this->dispatchBrowserEvent('close-modal-password');

            $this->reset('password');
        }
    }

    private function _validateForm()
    {
        return $this->validate([ 
            'name' => ['required', 'string'],
            'email' => ['required', 'string', 'email', Rule::unique('customers')->ignore(Auth::id())],
        ]);
    }
}
