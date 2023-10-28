 <!-- Divider -->
 <hr class="sidebar-divider my-0">

<!-- Nav Item - Dashboard -->
<li class="nav-item active">
    <a class="nav-link" href="<?php echo _route('user:profile')?>">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span></a>
</li>

<!-- Divider -->
<hr class="sidebar-divider">

<!-- Heading -->
<div class="sidebar-heading" style="display: none;">
    Walk In & Instructed
</div>

<?php if(isInstructor()) :?>
<li class="nav-item">
    <a class="nav-link" href="<?php echo _route('session:students')?>">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Students</span></a>
</li>

<li class="nav-item">
    <a class="nav-link" href="<?php echo _route('instructor-commission:index')?>">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Commissions</span></a>
</li>
<?php endif?>

<?php if(isAdmin()) :?>
<!-- Nav Item - Utilities Collapse Menu -->
<li class="nav-item" style="display: none;">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseInstructorPrograms"
        aria-expanded="true" aria-controls="collapseInstructorPrograms">
        <i class="fas fa-fw fa-wrench"></i>
        <span>Instructed Programs</span>
    </a>
    <div id="collapseInstructorPrograms" class="collapse" aria-labelledby="headingUtilities"
        data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="<?php echo _route('program:index')?>">Programs</a>
            <a class="collapse-item" href="<?php echo _route('program:students')?>">Students</a>
        </div>
    </div>
</li>
<?php endif?>

<?php if(isAdmin()) :?>
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#programSessionCollapse"
        aria-expanded="true" aria-controls="programSessionCollapse">
        <i class="fas fa-fw fa-cog"></i>
        <span>Program & Sessions</span>
    </a>
    <div id="programSessionCollapse" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="<?php echo _route('session:create')?>">Program</a>
            <a class="collapse-item" href="<?php echo _route('session:index')?>">Seessions</a>
        </div>
    </div>
</li>
<?php endif?>


<li class="nav-item">
    <a class="nav-link" href="<?php echo _route('program:index')?>">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Scheduled Programs</span></a>
</li>

<?php if(isAdmin()) :?>
<!-- Nav Item - Pages Collapse Menu -->
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#userCollapse"
        aria-expanded="true" aria-controls="userCollapse">
        <i class="fas fa-fw fa-cog"></i>
        <span>Users</span>
    </a>
    <div id="userCollapse" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="<?php echo _route('user:members', null)?>">Members</a>
            <a class="collapse-item" href="<?php echo _route('user:instructors', null)?>">Instructors</a>
        </div>
    </div>
</li>
<?php endif?>

<?php if(true) :?>
    <li class="nav-item">
        <a class="nav-link" href="<?php echo _route('asset-management:tutorial')?>">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Tutorial</span></a>
    </li>
<?php endif?>

<?php if(isAdmin()) :?>
<!-- Nav Item - Utilities Collapse Menu -->
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
        aria-expanded="true" aria-controls="collapseUtilities">
        <i class="fas fa-fw fa-wrench"></i>
        <span>Utilities</span>
    </a>
    <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
        data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="<?php echo _route('package:index')?>">Program Packages</a>
            <a class="collapse-item" href="<?php echo _route('payment:index')?>">Payments</a>
            <a class="collapse-item" href="<?php echo _route('instructor-commission:index')?>">Instructor Commissions</a>
            <a class="collapse-item" href="<?php echo _route('asset-management:create')?>">Assets</a>
            <a class="collapse-item" href="<?php echo _route('session:update-daily-session')?>">Daily Session Update</a>
        </div>
    </div>
</li>
<?php endif?>