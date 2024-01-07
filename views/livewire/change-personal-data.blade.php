<div>
    <x-my-account::card-setting title="Dados pessoais" subtitle="Altere os dados da sua conta">
        <div x-data="{modalPassword: false}" x-on:close-modal-password.window="modalPassword = false">
            <form x-on:submit.prevent="modalPassword = true" >
                <div class="space-y-4">
                    <x-input required  type="text" name="nome" wire:model.defer="name" title="Nome"></x-input>
                    <x-input required  type="email" name="email" wire:model.defer="email" title="E-mail"></x-input>
                </div>

                <x-button type="submit" className="mt-6 btn-primary">Salvar</x-button>
            </form>

            @include('my-account::components.modal-password', ['action' => 'changeEmail'])
        </div>
    </x-my-account::card-setting>
</div>