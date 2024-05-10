<div @click="openModal" class="cursor-pointer text-primary-lighter" x-data="{
    openModal() {
        this.$dispatch('open-settings-modal');
    }
}">
    <x-feather-icon name="settings" className="h-6 w-6"/>
</div>
