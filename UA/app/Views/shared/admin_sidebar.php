
<div class="text-white fw-nunito px-2 pt-4">
    <img src="/assets/images/logo.png" class="me-2" height="40"> SCANTRASH
</div>

<hr class="text-white">

<ul class="nav flex-column">
    <li class="nav-item">
        <a class="nav-link <?php echo (current_url() == site_url('/admin')) ? 'sidebar-selected' : ''; ?>" 
        href="/admin">
            <div class="row">
                <div class="col-2"><i class="fa-solid fa-house"></i></div>
                <div class="col-auto">Home</div>
            </div>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link <?php echo (current_url() == site_url('/admin/Accounts')) ? 'sidebar-selected' : ''; ?>" 
        href="/admin/Accounts">
            <div class="row">
                <div class="col-2"><i class="fa-solid fa-users"></i></div>
                <div class="col-auto">Accounts</div>
            </div>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link <?php echo (current_url() == site_url('/admin/Rewards')) ? 'sidebar-selected' : ''; ?>" 
        href="/admin/Rewards">
            <div class="row">
                <div class="col-2"><i class="fa-solid fa-list"></i></div>
                <div class="col-auto">Rewards</div>
            </div>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link <?php echo (current_url() == site_url('/admin/Exchange')) ? 'sidebar-selected' : ''; ?>" 
        href="/admin/Exchange">
            <div class="row">
                <div class="col-2"><i class="fa-solid fa-right-left"></i></i></div>
                <div class="col-auto">Exchange</div>
            </div>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link <?php echo (current_url() == site_url('/admin/exchangehistory')) ? 'sidebar-selected' : ''; ?>" 
        href="/admin/exchangehistory">
            <div class="row">
                <div class="col-2"><i class="fa-solid fa-clock-rotate-left"></i></div>
                <div class="col-auto">Exchange History</div>
            </div>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link <?php echo (current_url() == site_url('/admin/User')) ? 'sidebar-selected' : ''; ?>" 
        href="/admin/User">
            <div class="row">
                <div class="col-2"><i class="fa-solid fa-user-tie"></i></div>
                <div class="col-auto">Users</div>
            </div>
        </a>
    </li>
 
</ul>

<div id="sidebar-footer" class="text-white text-center mb-2">
    <small class=""><i class="fa-regular fa-copyright me-2"></i> 2024, Barbaza Antique Scantrash to Cash </small>
</div>
