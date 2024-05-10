<div x-data="{ open: false }"
     :class="{ 'hidden': !open }"
     @open-settings-modal.window="open = true"
     class="fixed hidden inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center">

    <!-- Modal Container: Full screen on mobile, 50% width on larger screens -->
    <div class="w-full sm:w-1/2 max-w-xl mx-auto rounded shadow-lg p-4 bg-primary-darkest">

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
                document.body.classList.toggle('theme-light', this.selectedTheme === 'light');
                localStorage.setItem('theme', this.selectedTheme);
            } }">

                <!-- Dropdown Menu Always Visible -->
                <select x-model="selectedTheme" class="p-2 border w-2/3 rounded  border-primary-darkest bg-primary text-primary">
                    <option value="dark">Dark Mode</option>
                    <option value="light">Light Mode</option>
                </select>

                <!-- Button to Confirm and Apply Theme -->
                <button @click="toggleTheme" class="ml-2 w-1/3 p-2 rounded bg-secondary text-darkest" >
                    Apply Theme
                </button>
            </div>
        </div>

        <!-- Close button -->
        <button @click="open = false"
                class="mt-4 p-2 border rounded border-primary-darkest">Close Modal</button>
    </div>
</div>
