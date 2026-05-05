<!-- Sidebar - PSU Blue -->
<div id="admin-sidebar" class="w-64 psu-blue-bg text-white shadow-2xl flex flex-col h-screen fixed overflow-y-auto psu-scrollbar z-40 transform -translate-x-full lg:translate-x-0 transition-transform duration-300 ease-in-out">
    <!-- Logo Section -->
    <div class="p-8 border-b border-blue-800 border-opacity-30">
        <div class="flex flex-col items-center text-center space-y-4">
            <div class="w-20 h-20 bg-gradient-to-tr from-yellow-400 to-yellow-600 rounded-full p-1.5 shadow-xl transform hover:rotate-6 transition-transform duration-300">
                <div class="w-full h-full bg-white rounded-full overflow-hidden flex items-center justify-center border-2 border-[#000035]">
                    <img src="{{ asset('images/PSU_LOGO.png') }}" 
                         alt="PSU Logo" 
                         class="w-[85%] h-[85%] object-contain"
                         onerror="this.onerror=null; this.parentElement.innerHTML='<span class=\'text-2xl font-black text-[#000035]\'>PSU</span>';">
                </div>
            </div>
            <div>
                <h2 class="text-xl font-black tracking-tight leading-tight">PSU ADMIN</h2>
                <div class="h-1 w-12 bg-yellow-400 mx-auto mt-2 rounded-full"></div>
            </div>
        </div>
    </div>
    
    <!-- Notifications Panel -->
    <div class="px-4 pt-4 pb-2" x-data="notificationPanel()" x-init="init()">
        <button @click="toggle()"
                class="w-full flex items-center justify-between px-4 py-3 rounded-xl transition-all duration-200 text-blue-100 hover:bg-white hover:bg-opacity-10 group">
            <span class="flex items-center gap-3">
                <span class="relative">
                    <svg class="w-5 h-5 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                    </svg>
                    <span x-show="count > 0"
                          x-text="count > 9 ? '9+' : count"
                          class="absolute -top-1.5 -right-1.5 bg-red-500 text-white text-[10px] font-black rounded-full w-4 h-4 flex items-center justify-center leading-none"></span>
                </span>
                <span class="text-sm tracking-wide uppercase font-black">Notifications</span>
            </span>
            <svg :class="open ? 'rotate-180' : ''" class="w-4 h-4 transition-transform duration-300 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
            </svg>
        </button>

        <!-- Dropdown Panel -->
        <div x-show="open"
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 -translate-y-2"
             x-transition:enter-end="opacity-100 translate-y-0"
             class="mt-1 rounded-xl bg-[#000028] border border-white/10 overflow-hidden"
             style="display:none">

            <div class="px-3 py-2 border-b border-white/10 flex items-center justify-between">
                <span class="text-[10px] uppercase tracking-widest font-black text-yellow-400">New Applications</span>
                <button @click="markRead()" x-show="count > 0"
                        class="text-[10px] text-blue-300 hover:text-white transition">Mark all read</button>
            </div>

            <!-- Notification List -->
            <div class="max-h-64 overflow-y-auto">
                <template x-if="notifications.length === 0">
                    <p class="text-center text-xs text-blue-400 py-6">No new notifications</p>
                </template>
                <template x-for="n in notifications" :key="n.id">
                    <a :href="'/admin/application/' + n.application_id"
                       class="block px-3 py-3 hover:bg-white/5 transition border-b border-white/5 last:border-0">
                        <div class="flex items-start gap-2">
                            <div class="w-1.5 h-1.5 rounded-full bg-yellow-400 mt-1.5 flex-shrink-0"></div>
                            <div class="min-w-0">
                                <p class="text-white text-xs font-bold truncate" x-text="n.applicant_name"></p>
                                <p class="text-blue-300 text-[11px] truncate" x-text="n.course"></p>
                                <p class="text-blue-400 text-[10px] mt-0.5" x-text="n.campus + ' · ' + n.time"></p>
                            </div>
                        </div>
                    </a>
                </template>
            </div>
        </div>
    </div>

    <!-- Navigation Menu -->
    <nav class="mt-2 flex-1 px-4 space-y-2">
        <!-- Dashboard Link -->
        <a href="{{ route('admin.dashboard') }}" 
           class="group flex items-center px-4 py-3.5 rounded-xl transition-all duration-200 {{ request()->routeIs('admin.dashboard') ? 'sidebar-active shadow-lg' : 'text-blue-100 hover:bg-white hover:bg-opacity-10' }}">
            <svg class="w-5 h-5 mr-3 {{ request()->routeIs('admin.dashboard') ? 'text-[#000035]' : 'text-yellow-400 group-hover:scale-110 transition-transform' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
            </svg>
            <span class="text-sm tracking-wide uppercase font-black">Dashboard</span>
        </a>

        <!-- Applications Accordion -->
        <div x-data="{ open: {{ (request()->is('admin/applications*') || request()->is('admin/view*') || request()->is('admin/edit*')) ? 'true' : 'false' }} }" class="space-y-1">
            <button @click="open = !open" 
                    class="w-full flex items-center justify-between px-4 py-3.5 rounded-xl transition-all duration-200 group {{ (request()->is('admin/applications*') || request()->is('admin/view*') || request()->is('admin/edit*')) ? 'bg-white bg-opacity-10 text-white font-black' : 'text-blue-100 hover:bg-white hover:bg-opacity-10' }}">
                <span class="flex items-center">
                    <svg class="w-5 h-5 mr-3 {{ (request()->is('admin/applications*') || request()->is('admin/view*') || request()->is('admin/edit*')) ? 'text-yellow-400' : 'text-yellow-400 group-hover:scale-110 transition-transform' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                    </svg>
                    <span class="text-sm tracking-wide uppercase">Applications</span>
                </span>
                <svg :class="open ? 'rotate-180' : ''" class="w-4 h-4 transition-transform duration-300 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                </svg>
            </button>

            <!-- Sublinks Area -->
            <div x-show="open" 
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0 -translate-y-2"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 class="pl-12 pr-4 space-y-1 overflow-hidden"
                 style="display: none;">
                
                <a href="{{ route('admin.applications') }}" 
                   class="block py-2 text-xs font-black uppercase tracking-widest transition duration-200 {{ (request()->routeIs('admin.applications') && !request()->has('status')) ? 'text-yellow-400' : 'text-blue-300 hover:text-white' }}">
                   All Registry
                </a>
                
                <a href="{{ route('admin.applications', ['status' => 'Pending']) }}" 
                   class="block py-2 text-xs font-black uppercase tracking-widest transition duration-200 {{ (request('status') == 'Pending') ? 'text-yellow-400' : 'text-blue-300 hover:text-white' }}">
                   Pending Only
                </a>

                <a href="{{ route('admin.applications', ['status' => 'Approved']) }}"
                   class="block py-2 text-xs font-black uppercase tracking-widest transition duration-200 {{ (request('status') == 'Approved') ? 'text-yellow-400' : 'text-blue-300 hover:text-white' }}">
                   Approved Only
                </a>

                <a href="{{ route('admin.applications', ['status' => 'Waitlisted']) }}"
                   class="block py-2 text-xs font-black uppercase tracking-widest transition duration-200 {{ (request('status') == 'Waitlisted') ? 'text-yellow-400' : 'text-blue-300 hover:text-white' }}">
                   Waitlisted Only
                </a>

                <a href="{{ route('admin.applications', ['status' => 'Rejected']) }}"
                   class="block py-2 text-xs font-black uppercase tracking-widest transition duration-200 {{ (request('status') == 'Rejected') ? 'text-yellow-400' : 'text-blue-300 hover:text-white' }}">
                   Rejected Only
                </a>

                <!-- Conditional Sub-functions -->
                @if(request()->routeIs('admin.view'))
                    <div class="h-px w-full bg-blue-800 my-2 bg-opacity-30"></div>
                    <span class="block px-2 py-2 text-[10px] uppercase tracking-tighter text-yellow-500 opacity-60 font-black">Focused On: View</span>
                    <a href="#" class="flex items-center py-2 text-xs font-black uppercase tracking-widest text-yellow-400 animate-pulse">
                        <div class="w-1.5 h-1.5 bg-yellow-400 rounded-full mr-2 shadow-[0_0_8px_rgba(255,215,0,0.8)]"></div>
                        Details View
                    </a>
                @endif

                @if(request()->routeIs('admin.edit'))
                    <div class="h-px w-full bg-blue-800 my-2 bg-opacity-30"></div>
                    <span class="block px-2 py-2 text-[10px] uppercase tracking-tighter text-yellow-500 opacity-60 font-black">Focused On: Edit</span>
                    <a href="#" class="flex items-center py-2 text-xs font-black uppercase tracking-widest text-yellow-400 animate-pulse">
                        <div class="w-1.5 h-1.5 bg-yellow-400 rounded-full mr-2 shadow-[0_0_8px_rgba(255,215,0,0.8)]"></div>
                        Modifying
                    </a>
                @endif
            </div>
        </div>
    </nav>
    
    <!-- Logout Section -->
    <div class="p-6 border-t border-blue-800 border-opacity-30">
        <form method="POST" action="{{ route('admin.logout') }}">
            @csrf
            <button type="submit" class="w-full group flex items-center justify-center px-4 py-3 bg-red-600 bg-opacity-20 text-red-400 rounded-xl hover:bg-red-600 hover:text-white transition-all duration-300 font-black uppercase tracking-widest text-xs">
                <svg class="w-4 h-4 mr-2 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                </svg>
                Sign Out
            </button>
        </form>
    </div>
</div>

<script>
function notificationPanel() {
    return {
        open: false,
        count: 0,
        notifications: [],
        poller: null,

        init() {
            this.fetch();
            this.poller = setInterval(() => this.fetch(), 30000);
        },

        toggle() {
            this.open = !this.open;
        },

        fetch() {
            fetch('{{ route("admin.notifications") }}', {
                headers: { 'X-Requested-With': 'XMLHttpRequest' }
            })
            .then(r => r.json())
            .then(data => {
                this.count = data.count;
                this.notifications = data.notifications;
            })
            .catch(() => {});
        },

        markRead() {
            fetch('{{ route("admin.notifications.read") }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content
                        || '{{ csrf_token() }}',
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(() => {
                this.count = 0;
                this.notifications = [];
            })
            .catch(() => {});
        }
    };
}
</script>
