<flux:dropdown position="bottom" align="start">
    <flux:sidebar.profile
        :name="auth()->user()->name"
        :initials="auth()->user()->initials()"
        icon:trailing="chevrons-up-down"
        data-test="sidebar-menu-button"
    />

    <flux:menu>
        <div class="flex items-center gap-2 px-1 py-1.5 text-start text-sm">
            <flux:avatar
                :name="auth()->user()->name"
                :initials="auth()->user()->initials()"
            />
            <div class="grid flex-1 text-start text-sm leading-tight">
                <flux:heading class="truncate">{{ auth()->user()->name }}</flux:heading>
                <flux:text class="truncate">{{ auth()->user()->email }}</flux:text>
            </div>
        </div>
        <flux:menu.separator />
        <flux:menu.radio.group>
            <flux:menu.item :href="route('profile.edit')" icon="cog" wire:navigate>
                {{ __('Settings') }}
            </flux:menu.item>
        </flux:menu.radio.group>

        <form method="POST" action="{{ route('logout') }}" class="w-full">
            @csrf
            <button
                type="submit"
                class="flex w-full cursor-pointer items-center rounded-md px-2 py-1.5 text-start text-sm font-medium text-zinc-800 focus:outline-hidden data-active:bg-zinc-50 dark:text-white dark:data-active:bg-zinc-600"
                data-flux-menu-item
                data-flux-menu-item-has-icon
                data-test="logout-button"
            >
                <flux:icon
                    icon="arrow-right-start-on-rectangle"
                    variant="mini"
                    class="me-2 text-zinc-400 dark:text-white/60"
                    data-flux-menu-item-icon
                />
                {{ __('Log out') }}
            </button>
        </form>
    </flux:menu>
</flux:dropdown>
