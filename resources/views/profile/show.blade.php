<x-app-layout>
    <div class="bg-gray-100 text-center">

        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            <header class="mt-44 mb-20">
                <div class="py-6 px-4 sm:px-6 lg:items-center ">
                    <h1 class="text-3xl font-bold text-green-300 text-center">Perfil</h1>
                </div>
            </header>


            @if (Laravel\Fortify\Features::canUpdateProfileInformation())
                @livewire('profile.update-profile-information-form')
    
                <x-jet-section-border />
            @endif
    
            @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updatePasswords()))
                <div class="mt-10 sm:mt-0">
                    @livewire('profile.update-password-form')
                </div>
    
                <x-jet-section-border />
            @endif
    
            @if (Laravel\Fortify\Features::canManageTwoFactorAuthentication())
                <div class="mt-10 sm:mt-0">
                    @livewire('profile.two-factor-authentication-form')
                </div>
    
                <x-jet-section-border />
            @endif
    
            <div class="mt-10 sm:mt-0">
                @livewire('profile.logout-other-browser-sessions-form')
            </div>
    
            @if (Laravel\Jetstream\Jetstream::hasAccountDeletionFeatures())
                <x-jet-section-border />
    
                <div class="mt-10 sm:mt-0">
                    @livewire('profile.delete-user-form')
                </div>
            @endif
        </div>
    </div>
</x-app-layout>

