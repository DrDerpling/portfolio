<div data="{}" class="w-full sm:w-1/2 max-w-xl mx-auto rounded shadow-lg p-4 text-primary-lighter bg-primary-darker">
    <!-- Modal title -->
    <div class="flex items-center space-x-1">
        <x-feather-icon name="settings" className="h-5 w-5"/>
        <h2 class="text-2xl font-bold">Settings</h2>
    </div>

    <!-- Modal body -->
    <div>
        <label for="theme" class="block font-bold">Theme</label>
        <div
            class="flex"
            x-data="{ selectedTheme: 'dark', toggleTheme() {
                localStorage.setItem('theme', this.selectedTheme);

                document.dispatchEvent(new Event('theme-updated'));
            } }">

            <select x-model="selectedTheme"
                    class="p-2 border w-2/3 rounded  border-primary-darkest bg-primary text-primary">
                <option value="dark">Dark Mode</option>
                <option value="light">Light Mode</option>
                <option value="dark-purple">Dark purple</option>
                <option value="ocean-blue">Ocean blue</option>
                <option value="sunset-orange">Sunset orange</option>
                <option value="forest-green">Forest green</option>
                <option value="royal-gold">Royal gold</option>
                <option value="midnight-purple">Midnight purple</option>
                <option value="directus">Directus</option>
                <option value="nintendo">Nintendo (unreadable)</option>
                <option value="random">Random (unreadable)</option>
            </select>


            <button @click="toggleTheme" class="ml-2 w-1/3 p-2 rounded bg-secondary text-darkest">
                Apply Theme
            </button>
        </div>
    </div>

    <button @click="$dispatch('toggle-settings-modal')"
            class="mt-4 p-2 border rounded text-primary-lighter border-primary-darkest">Close Modal
    </button>
</div>

