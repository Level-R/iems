  <div id="mySidebar" class="sidebar shadow-sm">
    <a href="/iems/admin/index.php"><i class="fa fa-fw fa-home"></i><span class="link-text">Dashboard</span></a>
    <a href="/iems/<?php echo $_SESSION['user_role']; ?>/profile.php"><i class="fa-solid fa-circle-user"></i><span class="link-text"><?php echo htmlspecialchars($_SESSION['username']); ?> Profile</span></a>
    <a href="/iems/admin/teacher.php"><i class="fa-solid fa-users"></i><span class="link-text">Teachers</span></a>
    <a href="/iems/admin/student.php"><i class="fa-solid fa-user-graduate"></i><span class="link-text">Student</span></a>
    <a href="/iems/admin/register-office.php"><i class="fa-solid fa-pencil"></i><span class="link-text">Register-Office</span></a>
    <a href="/iems/admin/class.php"><i class="fa-solid fa-cubes"></i><span class="link-text">class/Department</span></a>
    <a href="/iems/admin/section.php"><i class="fa-solid fa-table-columns"></i><span class="link-text">Section</span></a>
    <a href="/iems/admin/schedule.php"><i class="fa-solid fa-calendar-days"></i><span class="link-text">Schedule</span></a>
    <a href="/iems/admin/course.php"><i class="fa-solid fa-book"></i><span class="link-text">Course</span></a>
    <a href="/iems/admin/settings.php"><i class="fa-solid fa-gear"></i><span class="link-text">Settings</span></a>
  </div>