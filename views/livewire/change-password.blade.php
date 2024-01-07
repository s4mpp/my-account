<div>
    <x-my-account::card-setting title="Senha" subtitle="Mantenha sua conta segura">
        <form wire:submit.prevent="changePassword" x-data="{loading: false}" x-on:submit="loading = true" x-on:reset-form="loading = false" >
            <div class="space-y-4">
                <x-input required autocomplete="new-password" type="password" name="current_password" wire:model.defer="current_password" title="Senha atual"></x-input>
                    
                <x-input required autocomplete="new-password" type="password" name="password" wire:model.defer="password" title="Digite a nova senha"></x-input>
                
                <x-input required autocomplete="new-password" type="password" name="password_confirmation" wire:model.defer="password_confirmation" title="Repita a nova senha"></x-input>
            </div>

            <x-button type="submit" className="mt-6 btn-primary">Alterar senha</x-button>
        </form>

    </x-my-account::card-setting>
</div>
