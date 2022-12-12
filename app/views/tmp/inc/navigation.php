<nav class="sidebar">
    <div class="sidebar-header">
    <a href="#" class="sidebar-brand">
        <span><?php echo COMPANY_NAME?></span>
    </a>
    <div class="sidebar-toggler not-active">
        <span></span>
        <span></span>
        <span></span>
    </div>
    </div>
    <div class="sidebar-body">
    <ul class="nav">
        <li class="nav-item nav-category">Main</li>
        <li class="nav-item">
            <a href="<?php echo _route('dashboard:index')?>" class="nav-link">
                <i class="link-icon" data-feather="box"></i>
                <span class="link-title">Dashboard</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="<?php echo _route('user:index', null)?>" class="nav-link">
                <i class="link-icon" data-feather="message-square"></i>
                <span class="link-title">Users</span>
            </a>
        </li>

        <li class="nav-item">
            <a href="<?php echo _route('user:members', null)?>" class="nav-link">
                <i class="link-icon" data-feather="message-square"></i>
                <span class="link-title">Members</span>
            </a>
        </li>

        <li class="nav-item">
            <a href="<?php echo _route('user:members', null)?>" class="nav-link">
                <i class="link-icon" data-feather="message-square"></i>
                <span class="link-title">Instructors</span>
            </a>
        </li>

        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="link-icon" data-feather="message-square"></i>
                <span class="link-title">Staffs</span>
            </a>
        </li>

        <li class="nav-item">
            <a href="<?php echo _route('payment:index')?>" class="nav-link">
                <i class="link-icon" data-feather="message-square"></i>
                <span class="link-title">Payments</span>
            </a>
        </li>

        <li class="nav-item">
            <a href="<?php echo _route('session:create')?>" class="nav-link">
                <i class="link-icon" data-feather="message-square"></i>
                <span class="link-title">Sessions</span>
            </a>
        </li>

        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="link-icon" data-feather="message-square"></i>
                <span class="link-title">Facilities</span>
            </a>
        </li>
    </ul>
    </div>
</nav>