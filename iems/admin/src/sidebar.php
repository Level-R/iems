  <div id="mySidebar" class="sidebar shadow-sm">
    <a href="/iems/admin/index.php"><i class="fa fa-fw fa-home"></i><span class="link-text">Dashboard</span></a>
    <a href="/iems/<?php echo $_SESSION['user_role']; ?>/profile.php"><i class="fa-solid fa-circle-user"></i><span class="link-text"><?php echo htmlspecialchars($_SESSION['username']); ?> Profile</span></a>
    <div class="sidebar-dropdown">
      <samp  class="dropdown-toggle roboto-body">
        <i class="fa-solid fa-users-gear"></i>
        <span class="link-text">Manage Users</span>
      </samp>
      <div class="dropdown-content">
        <a href="/iems/admin/manage-user.php?user=teacher"><i class="fa-solid fa-users"></i><span class="link-text">Teachers</span></a>
        <a href="/iems/admin/manage-user.php?user=student"><i class="fa-solid fa-user-graduate"></i><span class="link-text">Student</span></a>
        <a href="/iems/admin/manage-user.php?user=moderator"><i class="fa-solid fa-people-roof"></i><span class="link-text">Moderator </span></a>
        <a href="/iems/admin/manage-user.php?user=accounts"><i class="fa-solid fa-file-invoice-dollar"></i><span class="link-text">Accounts</span></a>
      </div>
    </div>
    
    <a href="/iems/admin/register-office.php"><i class="fa-solid fa-pencil"></i><span class="link-text">Register-Office</span></a>

    <div class="sidebar-dropdown">
      <samp  class="dropdown-toggle roboto-body"><i class="fa-solid fa-cubes"></i><span class="link-text">Manage Classes</span></samp>
      <div class="dropdown-content">
        <a href="/iems/admin/manage-classes.php"><i class="fa-solid fa-users"></i><span class="link-text">Class</span></a>
        <a href="/iems/admin/manage-classes.php"><i class="fa-solid fa-users"></i><span class="link-text">Course</span></a>
        <a href="/iems/admin/manage-classes.php"><i class="fa-solid fa-users"></i><span class="link-text">Section</span></a>
        <a href="/iems/admin/manage-classes.php"><i class="fa-solid fa-users"></i><span class="link-text">Subject</span></a>
        <a href="/iems/admin/manage-classes.php"><i class="fa-solid fa-users"></i><span class="link-text">Lessons</span></a>
      </div>
    </div>
    
    <a href="/iems/admin/section.php"><i class="fa-solid fa-table-columns"></i><span class="link-text">Section</span></a>
    <a href="/iems/admin/schedule.php"><i class="fa-solid fa-calendar-days"></i><span class="link-text">Schedule</span></a>
    <a href="/iems/admin/course.php"><i class="fa-solid fa-book"></i><span class="link-text">Course</span></a>
    <a href="/iems/admin/settings.php"><i class="fa-solid fa-gear"></i><span class="link-text">Settings</span></a>
  </div>