<div class="navbar-header">
    <div class="row align-items-center justify-content-between">
        <div class="col-auto">
            <div class="d-flex flex-wrap align-items-center gap-4">
                <button type="button" class="sidebar-toggle">
                    <iconify-icon icon="heroicons:bars-3-solid" class="icon text-2xl non-active"></iconify-icon>
                    <iconify-icon icon="iconoir:arrow-right" class="icon text-2xl active"></iconify-icon>
                </button>
                <button type="button" class="sidebar-mobile-toggle">
                    <iconify-icon icon="heroicons:bars-3-solid" class="icon"></iconify-icon>
                </button>
            </div>
        </div>
   <div class="col-auto">
    <div class="d-flex align-items-center gap-3">
        <form id="logout-form" action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" 
                    class="btn d-flex align-items-center gap-2 px-4 py-3 rounded-pill text-white fw-semibold shadow"
                    style="background: linear-gradient(135deg, #4f46e5, #6366f1); font-size: 15px; transition: all 0.3s ease;">
                <iconify-icon icon="solar:logout-3-bold" width="20" height="20" class="text-white"></iconify-icon>
                Logout
            </button>
        </form>
    </div>
</div>


    </div>
</div>
