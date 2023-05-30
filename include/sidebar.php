 <?php
$menu_id=$_SESSION['menu_id'];

?>
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
          <a href="mainmenu">
            <i class="fa fa-dashboard"></i> <span>MainMenu</span>
           
          </a>
         
        </li>
       
       <?php
	  
				if($menu_id != 0)
				{
					
		
		//error_reporting(0);
               $sm = mysqli_query($conn, "select distinct c.m_id,c.menu_title,c.status,c.sequence_id,c.menu_link,a.user_id,a.menu_id from main_menu c,allot_main_menu a 
where c.status='Y' and c.m_id=a.menu_id and a.user_id = '$userid' and a.menu_id='$menu_id' order by sequence_id ASC");
// $sm = mysqli_query($conn,"select * from main_menu order by sequence_id asc");
		
		 while(($rows_sm = mysqli_fetch_array($sm)) != false) 
		{
			$menu = $rows_sm['menu_title'];
			$link = $rows_sm['menu_link'];
			$id = $rows_sm['m_id'];
			
			if($link == "")
			{
			
		?>
			<li  class="treeview">
					<a class="waves-effect parent-item js__control" href="#"><i class="fa fa-edit"></i><span><?php echo $menu;?></span><span class="notice notice-blue"></span></a>
						<ul class="treeview-menu">
<?php
			}
			else
			{
?>				
				<li class="active">
					<a class="waves-effect" href="<?php echo $link; ?>"><i class="fa fa-circle-o"></i><span><?php echo $menu; ?></span></a>
				<ul class="treeview-menu">
<?php
			}
			
			  $query  = mysqli_query($conn, "SELECT DISTINCT S.REPORT_ID,S.REPORT_NAME,S.REPORT_TITLE,S.STATUS,S.SEQUENCE_ID,A.USER_ID,A.REPORT_ID from USER_REPORTS S ,ALLOT_REPORT_USER A 
WHERE A.USER_ID='$userid' and s.parent_id='$id' and S.STATUS='Y' and s.report_id=a.report_id order by S.SEQUENCE_ID ASC");
             // $query = mysqli_query($conn,"select * from user_reports where parent_id = '$id' order by sequence_id asc " );
               
                while(($row = mysqli_fetch_array($query)) != false)
                {
                    $title = $row['REPORT_TITLE'];
					$name = $row['REPORT_NAME'];
				?>
				

						<li class="active"><a href="<?php echo $name ;?>"><i class="fa fa-circle-o"></i><?php echo $title ;?></a></li>
						
				
					<?php
				}
					?>
					</ul>
					<!-- /.sub-menu js__content -->
				</li>
				<?php
		}
		}
		else
		{
			
		
				?>
				
					
				
				
				
				<!--<li>
					<a class="waves-effect" href="../tcr_like_demo/form"><i class="menu-icon ti-credit-card"></i><span>Student Card Balance</span></a>
				</li>-->
				
				<li>
					<a class="waves-effect parent-item js__control" href="#"><i class="menu-icon ti-shopping-cart"></i><span>Point Of Sale</span><span class="notice notice-blue"></span></a>
					<ul class="sub-menu js__content">
						<li><a href="../demo_syspos/order">Order Screen</a></li>
						<li><a href="../demo_syspos/manage/get_student">Order Summary</a></li>
					</ul>
					<!-- /.sub-menu js__content -->
				</li>
				
				<?php
				}
				?>
				</ul>
	  </li>
       
       
     
	 
       
      
	  </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
