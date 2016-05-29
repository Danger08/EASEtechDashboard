<ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
              <li>
              <a href="#">
                <i class="fa fa-dashboard"></i> <span>Dashboard</span> <i class="fa fa-angle-right pull-right"></i>
              </a>
              </li>
            <li class="treeview">
              <a ui-sref="task.taskview">
                <i class="fa fa-tasks"></i>
                <span> My Tasks</span>
                <span class="fa fa-angle-right pull-right"></span>
              </a>
              <ul class="treeview-menu">
               <li><a href="#/mytasks/Created" ui-sref="mytasks({taskstatus: 'Created'})"><i class="fa fa-tasks"></i>Created</a></li>
                <li><a href="#/mytasks/inProgress" ui-sref="mytasks({taskstatus: 'inProgress'})"><i class="fa fa-tasks"></i>In Progress</a></li>
                <li><a href="#/mytasks/Completed" ui-sref="mytasks({taskstatus: 'Completed'})"><i class="fa fa-tasks"></i>Completed</a></li>
                <li><a href="#/mytasks/onHold" ui-sref="mytasks({taskstatus: 'onHold'})"><i class="fa fa-tasks"></i>On Hold</a></li>
                <li><a href="#/mytasks/Cancelled" ui-sref="mytasks({taskstatus: 'Cancelled'})"><i class="fa fa-tasks"></i> Cancelled</a></li>

              </ul>
            </li>
            <li class="treeview">
              <a href="">
                <i class="fa fa-bars"></i> <span>Timeclock</span>
                <i class="fa fa-angle-right pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="pages/tables/simple.html"><i class="fa fa-circle-o"></i>DTR</a></li>
                <li><a href="pages/tables/data.html"><i class="fa fa-circle-o"></i> Schedule</a></li>
              </ul>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-bars"></i> <span>Utilities</span>
                <i class="fa fa-angle-right pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="pages/tables/simple.html"><i class="fa fa-circle-o"></i> Activity Log</a></li>
                <li><a href="pages/tables/data.html"><i class="fa fa-circle-o"></i> Email Message Log</a></li>
                <li><a href="pages/tables/data.html"><i class="fa fa-circle-o"></i> Database Status</a></li>
              </ul>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-user"></i> <span>My Account</span>
                <i class="fa fa-angle-right pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="pages/tables/simple.html"><i class="fa fa-circle-o"></i> Edit Profile</a></li>
                <li><a href="pages/tables/data.html"><i class="fa fa-circle-o"></i> Change Password</a></li>
                <li><a href="pages/tables/data.html"><i class="fa fa-circle-o"></i> Logout</a></li>
              </ul>
            </li>
            <li><a href="documentation/index.php"><i class="fa fa-cogs"></i> <span>Settings</span><i class="fa fa-angle-right pull-right"></i></a></li>

        </ul>


