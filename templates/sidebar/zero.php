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
                <span>Tasks</span>
                <span class="fa fa-angle-right pull-right"></span>
              </a>
              <ul class="treeview-menu">
               <li><a href="#/tasks/Created" ui-sref="tasks({taskstatus: 'Created'})"><i class="fa fa-tasks"></i>Created</a></li>
                <li><a href="#/tasks/inProgress" ui-sref="tasks({taskstatus: 'inProgress'})"><i class="fa fa-tasks"></i>In Progress</a></li>
                <li><a href="#/tasks/Completed" ui-sref="tasks({taskstatus: 'Completed'})"><i class="fa fa-tasks"></i>Completed</a></li>
                <li><a href="#/tasks/onHold" ui-sref="tasks({taskstatus: 'onHold'})"><i class="fa fa-tasks"></i>On Hold</a></li>
                <li><a href="#/tasks/Cancelled" ui-sref="tasks({taskstatus: 'Cancelled'})"><i class="fa fa-tasks"></i> Cancelled</a></li>

              </ul>
            </li>

            <li class="treeview">
              <a>
                <i class="fa fa fa-users"></i>
                <span>Employees</span>
                <span class="fa fa-angle-right pull-right"></span>
              </a>
              <ul class="treeview-menu">
                <li><a href="#/employee/add" ui-sref="employee-add"><i class="fa fa-circle-o"></i> Add/Edit Employee</a></li>
                <li><a href="#/employee/list" ui-sref="employee-list"><i class="fa fa-circle-o"></i> List Employee</a></li>

              </ul>
            </li>
            <!-- <li><a ui-sref="chatbox"><i class="fa fa-wechat"></i> <span>Chatbox on App</span><i class="fa fa-angle-right pull-right"></i></a></li> -->

            <li class="treeview">
              <a href="">
                <i class="fa fa-database"></i>
                <span>Transactions</span>
                <span class="fa fa-angle-right pull-right"></span>
              </a>
              <ul class="treeview-menu">
                <li><a ui-sref="invoicecreate"><i class="fa fa-circle-o"></i>Create Invoice</a></li>
                <li><a ui-sref="invoicelist"><i class="fa fa-circle-o"></i> Invoice List </a></li>
              </ul>
            </li>
            <li class="treeview is-disabled" >
              <a href="" class="is-disabled">
                <i class="fa fa-building-o"></i>
                <span>Bank &amp; Cash</span>
                <i class="fa fa-angle-right pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="pages/UI/general.html"><i class="fa fa-circle-o"></i> New Account</a></li>
                <li><a href="pages/UI/icons.html"><i class="fa fa-circle-o"></i> List Account</a></li>
                <li><a href="pages/UI/buttons.html"><i class="fa fa-circle-o"></i> Account Balances</a></li>
              </ul>
            </li>
            <li class="treeview is-disabled">
              <a href="" class="is-disabled">
                <i class="fa fa-cube"></i> <span>Services</span>
                <i class="fa fa-angle-right pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="pages/forms/editors.html"><i class="fa fa-circle-o"></i> Services</a></li>
                <li><a href="pages/forms/editors.html"><i class="fa fa-circle-o"></i> New Services</a></li>
              </ul>
            </li>
            <li class="treeview is-disabled">
              <a href="" class="is-disabled">
                <i class="fa fa-bar-chart-o"></i> <span>Reports</span>
                <i class="fa fa-angle-right pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="pages/tables/simple.html"><i class="fa fa-circle-o"></i> Account Statement</a></li>
                <li><a href="pages/tables/data.html"><i class="fa fa-circle-o"></i> income Reports</a></li>
                <li><a href="pages/tables/data.html"><i class="fa fa-circle-o"></i> Expense Reports</a></li>
                <li><a href="pages/tables/data.html"><i class="fa fa-circle-o"></i> Income Vs Expense</a></li>
                <li><a href="pages/tables/data.html"><i class="fa fa-circle-o"></i> Reports by Date</a></li>
                <li><a href="pages/tables/data.html"><i class="fa fa-circle-o"></i> All income</a></li>
                <li><a href="pages/tables/data.html"><i class="fa fa-circle-o"></i> All expense</a></li>
                <li><a href="pages/tables/data.html"><i class="fa fa-circle-o"></i> All Transactions</a></li>
              </ul>
            </li>
            <li class="treeview is-disabled">
              <a href="" class="is-disabled">
                <i class="fa fa-bars"></i> <span>Utilities</span>
                <i class="fa fa-angle-right pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="pages/tables/simple.html"><i class="fa fa-circle-o"></i> Activity Log</a></li>
                <li><a href="pages/tables/data.html"><i class="fa fa-circle-o"></i> Email Message Log</a></li>
                <li><a href="pages/tables/data.html"><i class="fa fa-circle-o"></i> Database Status</a></li>
              </ul>
            </li>
            <li class="treeview is-disabled">
              <a href="" class="is-disabled">
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
        <style media="screen">
        .is-disabled {
  pointer-events: none; /* Disables the button completely. Better than just cursor: default; */
  cursor: not-allowed;
  opacity: 0.5;
}

        </style>
