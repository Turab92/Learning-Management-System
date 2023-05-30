  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>Alexander Pierce</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li class="active">
          <a href="mainmenu.php">
            <i class="fa fa-dashboard"></i> <span>MainMenu</span>
           
          </a>
         
        </li>
       
       
       
       
        <li class="treeview">
          <a href="adminpanel.php">
            <i class="fa fa-edit"></i> <span>Admin Panel</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="active"><a href="create_user.php"><i class="fa fa-circle-o"></i>Create User</a></li>
            <li><a href="create_main_menu.php"><i class="fa fa-circle-o"></i>Create Modules</a></li>
            <li><a href="create_reports.php"><i class="fa fa-circle-o"></i>Create Sub Modules</a></li>
			<li class="active"><a href="edit_delete_rights.php"><i class="fa fa-circle-o"></i>Edit Delete Rights</a></li>
            <li><a href="post_unpost_rights.php"><i class="fa fa-circle-o"></i>Post Unpost Rights</a></li>
            <li><a href="menu_alloting.php"><i class="fa fa-circle-o"></i>Menu Alloting</a></li>
			 <li><a href="submenu_allot.php"><i class="fa fa-circle-o"></i>Sub Menu Alloting</a></li>
          </ul>
        </li>
      
        <li class="treeview">
          <a href="adminpanel.php">
            <i class="fa fa-edit"></i> <span>General Setup</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="active"><a href="session_setup.php"><i class="fa fa-circle-o"></i>Session Setup</a></li>
            <li><a href="main_branch_setup.php"><i class="fa fa-circle-o"></i>Add Branch</a></li>
            <li><a href="class.php"><i class="fa fa-circle-o"></i>Add Class</a></li>
			<li class="active"><a href="section.php"><i class="fa fa-circle-o"></i>Add Section</a></li>
            <li><a href="subject_type_setup.php"><i class="fa fa-circle-o"></i>Add Subject Type</a></li>
            <li><a href="subjects.php"><i class="fa fa-circle-o"></i>Add Subject</a></li>
			 <li><a href="gender.php"><i class="fa fa-circle-o"></i>Add Gender</a></li>
			 <li><a href="religion.php"><i class="fa fa-circle-o"></i>Add Religion</a></li>
            <li><a href="document_setup.php"><i class="fa fa-circle-o"></i>Add Document</a></li>
			 <li><a href="class_branch_setup.php"><i class="fa fa-circle-o"></i>Assign Class To Branch</a></li>
			 <li><a href="class_section_capacity.php"><i class="fa fa-circle-o"></i>Class Section Capacity Setup</a></li>
            <li><a href="class_subject.php"><i class="fa fa-circle-o"></i>Assign Subject To Class</a></li>
			 <li><a href="period_setup.php"><i class="fa fa-circle-o"></i>Set Class Duration</a></li>
          </ul>
        </li>
      
	  <li class="treeview">
          <a href="adminpanel.php">
            <i class="fa fa-edit"></i> <span>Student Module</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="active"><a href="admission_form_setup.php"><i class="fa fa-circle-o"></i>Admission Form</a></li>
            <li><a href="create_student_profile.php"><i class="fa fa-circle-o"></i>Create Student Profile</a></li>
            <li><a href="waiting_list_students.php"><i class="fa fa-circle-o"></i>Student Waiting List</a></li>
			<li class="active"><a href="document.php"><i class="fa fa-circle-o"></i>Documents</a></li>
            <li><a href="bearer.php"><i class="fa fa-circle-o"></i>Bearer</a></li>
            <li><a href="house.php"><i class="fa fa-circle-o"></i>Student Contact Details</a></li>
			 <li><a href="prev_docs.php"><i class="fa fa-circle-o"></i>Previous Details</a></li>
			 <li><a href="student_current_class.php"><i class="fa fa-circle-o"></i>Student Promotion</a></li>
            <li><a href="student_attendance.php"><i class="fa fa-circle-o"></i>Student Attendance</a></li>
			 <li><a href="student_view.php"><i class="fa fa-circle-o"></i>View Student Profile</a></li>
			 <li><a href="student_current_class_1.php"><i class="fa fa-circle-o"></i>View Class Students</a></li>
            <li><a href="view.php"><i class="fa fa-circle-o"></i>View Attendance</a></li>
			
          </ul>
        </li>
		 <li class="treeview">
          <a href="adminpanel.php">
            <i class="fa fa-edit"></i> <span>Employee Module</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="active"><a href="employee.php"><i class="fa fa-circle-o"></i>Create Employee Profile</a></li>
            <li><a href="employee_branch_setup.php"><i class="fa fa-circle-o"></i>Assign Branch To Employee</a></li>
            <li><a href="employee_type_setup.php"><i class="fa fa-circle-o"></i>Add Employee Type</a></li>
			<li class="active"><a href="allowance.php"><i class="fa fa-circle-o"></i>Add Allowances</a></li>
            <li><a href="employee_qualification.php"><i class="fa fa-circle-o"></i>Add Employee Qualification</a></li>
            <li><a href="department.php"><i class="fa fa-circle-o"></i>Add Departments</a></li>
			 <li><a href="designation.php"><i class="fa fa-circle-o"></i>Add Designations</a></li>
			 <li><a href="grade_setup.php"><i class="fa fa-circle-o"></i>Add Employee Grades</a></li>
            <li><a href="student_attendance.php"><i class="fa fa-circle-o"></i>Add Holidays</a></li>
			 <li><a href="monthly_payroll.php"><i class="fa fa-circle-o"></i>Monthly Payroll</a></li>
			 <li><a href="employee_attendance.php"><i class="fa fa-circle-o"></i>Employee Attendance</a></li>
            <li><a href="leave.php"><i class="fa fa-circle-o"></i>Add Leave Types</a></li>
			<li><a href="assign_leaves.php"><i class="fa fa-circle-o"></i>Assign Leaves</a></li>
            <li><a href="employees_allowance.php"><i class="fa fa-circle-o"></i>Employee Allowances</a></li>
			 <li><a href="allowance_detail.php"><i class="fa fa-circle-o"></i>Employee Allowance Detail</a></li>
			 <li><a href="student_current_class_1.php"><i class="fa fa-circle-o"></i>Employee Advance</a></li>
            <li><a href="view.php"><i class="fa fa-circle-o"></i>View Employee Advance</a></li>
			 <li><a href="student_current_class_1.php"><i class="fa fa-circle-o"></i>View Attendance</a></li>
            <li><a href="view_employee_profile.php"><i class="fa fa-circle-o"></i>View Employee Profile</a></li>
			
          </ul>
        </li>
      
	   <li class="treeview">
          <a href="adminpanel.php">
            <i class="fa fa-edit"></i> <span>Fee Setup</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="active"><a href="nature.php"><i class="fa fa-circle-o"></i>Nature Payment</a></li>
            <li><a href="payment_frequency.php"><i class="fa fa-circle-o"></i>Payment Frequency</a></li>
            <li><a href="payment_mode.php"><i class="fa fa-circle-o"></i>Payment Mode</a></li>
			<li class="active"><a href="charges.php"><i class="fa fa-circle-o"></i>Charges Type</a></li>
            <li><a href="fee_slab.php"><i class="fa fa-circle-o"></i>Fee Slab</a></li>
            <li><a href="fee_collection.php"><i class="fa fa-circle-o"></i>Generate Student Schedule</a></li>
			 <li><a href="view_slab.php"><i class="fa fa-circle-o"></i>View Fee Slab</a></li>
			 <li><a href="view_fee_schedule.php"><i class="fa fa-circle-o"></i>View Student Schedule</a></li>
            <li><a href="fees_recieve_student.php"><i class="fa fa-circle-o"></i>Fee Receiving History</a></li>
			
          </ul>
        </li>
       
       
       
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
