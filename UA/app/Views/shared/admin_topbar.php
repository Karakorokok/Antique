<?php  $session = session();
        $user = $session->get('User');?>

<nav class="navbar navbar-expand-lg rounded bg-custom-yellow mt-2 shadow-sm p-3">
    <div class="container-fluid">
        <div class="">
            <a id="sidebar-toggle-btn" class="h4"><i class="fa-solid fa-chevron-left"></i></a>
            <span class="h6 ms-3"><?=$Page?></span>
        </div>
         
        <div>
            <div class="dropdown">
                <a class="dropdown-toggle nav-link position-relative" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <span class="text-secondary me-3"><?=$user;?></span>
                    <img src="/assets/images/2.png" alt="profile-pic" width="40" class="ms-3">
                    <span class="position-absolute bottom-0 start-75 translate-middle p-1 bg-green border border-light rounded-circle">
                    </span>
                </a>
                <ul class="dropdown-menu dropdown-menu-end p-2">
                    <li>
                        <a class="dropdown-item text-secondary" href="/Logout">
                            <i class="fa-solid fa-arrow-up-right-from-square me-3"></i>Logout
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>