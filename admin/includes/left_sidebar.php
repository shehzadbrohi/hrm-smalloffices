<div class="left-side-bar">
		<div class="brand-logo">
			<a href="admin_dashboard.php">
				<img src="../vendors/images/deskapp-logo.svg" alt="" class="dark-logo">
				<img src="../vendors/images/deskapp-logo-white.svg" alt="" class="light-logo">
			</a>
			<div class="close-sidebar" data-toggle="left-sidebar-close">
				<i class="ion-close-round"></i>
			</div>
		</div>
		<div class="menu-block customscroll">
			<div class="sidebar-menu">
				<ul id="accordion-menu">
					<li class="dropdown">
						<a href="admin_dashboard.php" class="dropdown-toggle no-arrow">
							<span class="micon dw dw-house-1"></span><span class="mtext">Dashboard</span>
						</a>
						
					</li>
					<li class="dropdown">
						<a href="signature.php" class="dropdown-toggle no-arrow">
							<span class="micon dw dw-house-1"></span><span class="mtext">Signature</span>
						</a>
						
					</li>
				
		
		<li class="dropdown">
						<a href="javascript:;" class="dropdown-toggle">
							<span class="micon dw dw-apartment"></span><span class="mtext"> Overtime Request </span>
						</a>
						<ul class="submenu">

						<?php
		if($session_id == 34){
			?>

<li><a href="add_overtime.php">Add  Overtime Request</a></li>

<li><a href="view_overtime_me.php">View  My Overtime</a></li>

			<?php
			}
			?>
							<li><a href="view_overtime.php">View  Overtime Request</a></li>
							<li><a href="view_overtime_remote.php">View Admin Overtime Request</a></li>
							<li><a href="view_overtime_all.php">View All Overtime Request</a></li>
						</ul>
					</li>


<?php
		if($session_id == 2){
			?>
			<li class="dropdown">
						<a href="employee_report.php" class="dropdown-toggle no-arrow">
							<span class="micon dw dw-page"></span><span class="mtext">View Admin Daily Report</span>
						</a>


						
					</li>
					<li class="dropdown">
						<a href="leave_history_remote.php" class="dropdown-toggle no-arrow">
							<span class="micon dw dw-page"></span><span class="mtext">View Admin Leaves</span>
						</a>


						
					</li>

<?php
}
?>
					<li class="dropdown">
						<a href="view_report.php" class="dropdown-toggle no-arrow">
							<span class="micon dw dw-page"></span><span class="mtext">View Daily Report</span>
						</a>


						
					</li>
					<li class="dropdown">
						<a href="javascript:;" class="dropdown-toggle">
							<span class="micon dw dw-watch"></span><span class="mtext"> Official Work </span>
						</a>
						<ul class="submenu">
							<?php
						if($session_id == 34){
						?>

<li><a href="official_work.php">Add Official Work</a></li>
						
						<?php

						}?>

						<li><a href="view_officialwork.php">View Official Work</a></li>
						</ul>
					</li>
					<li class="dropdown">
						<a href="javascript:;" class="dropdown-toggle">
							<span class="micon dw dw-help"></span><span class="mtext"> Requests </span>
						</a>
						<ul class="submenu">
							<li><a href="admin_approval_page.php">Pending Requests</a></li>
							<li><a href="allrequests.php">All Requests</a></li>
						</ul>
					</li>
					<li class="dropdown">
						<a href="javascript:;" class="dropdown-toggle">
							<span class="micon dw dw-page"></span><span class="mtext"> Announcements </span>
						</a>
						<ul class="submenu">
							<li><a href="add_broadcast.php">Add Announcements</a></li>
							<li><a href="announcements.php">View Announcements</a></li>
						</ul>
					</li>
			
					<li>
						<a href="department.php" class="dropdown-toggle no-arrow">
							<span class="micon dw dw-calendar1"></span><span class="mtext">Department</span>
						</a>
					</li>
					<li>
						<a href="leave_type.php" class="dropdown-toggle no-arrow">
							<span class="micon dw dw-calendar1"></span><span class="mtext">Leave Type</span>
						</a>
					</li>
					<li class="dropdown">
						<a href="javascript:;" class="dropdown-toggle">
							<span class="micon dw dw-library"></span><span class="mtext">Staff</span>
						</a>
						<ul class="submenu">
							<li><a href="add_staff.php">New Staff</a></li>
							<li><a href="staff.php">Manage Staff</a></li>
						</ul>
					</li>
					<li class="dropdown">
						<a href="javascript:;" class="dropdown-toggle">
							<span class="micon dw dw-apartment"></span><span class="mtext"> Leave </span>
						</a>
						<ul class="submenu">
						<li><a href="apply_leave.php">Apply Leave</a></li>
							<li><a href="leaves.php">All Leave</a></li>
							<li><a href="pending_leave.php">Pending Leave</a></li>
							<li><a href="approved_leave.php">Approved Leave</a></li>
							<li><a href="rejected_leave.php">Rejected Leave</a></li>
						</ul>
					</li>
					<li class="dropdown">
						<a href="javascript:;" class="dropdown-toggle">
							<span class="micon dw dw-chat"></span><span class="mtext"> Chat </span>
						</a>
						<ul class="submenu">
							<li><a href="chat.php?sender=21&receiver=10">Chat to Other Staff</a></li>
							<li><a href="chat.php?sender=14&receiver=12">Chat for IT Support</a></li>
						</ul>
					</li>
					<li class="dropdown">
						<a href="javascript:;" class="dropdown-toggle">
							<span class="micon dw dw-chat"></span><span class="mtext"> Business Trips </span>
						</a>
						<ul class="submenu">
							<li><a href="add_businesstrip.php">Add Business Trip</a></li>
							<li><a href="business_trip_history.php">View Business Trip</a></li>
						</ul>
					</li>
					<li class="dropdown">
						<a href="javascript:;" class="dropdown-toggle">
							<span class="micon dw dw-chat"></span><span class="mtext"> Events </span>
						</a>
						<ul class="submenu">
							<li><a href="add_event.php">Add Events</a></li>
							<li><a href="event_history.php">Event History</a></li>
						</ul>
					</li>
					<li>
						<div class="dropdown-divider"></div>
					</li>
					<li>
						<div class="sidebar-small-cap">Extra</div>
					</li>
					<li>
						<a href="https://karsh.ae" class="dropdown-toggle no-arrow">
							<span class="micon dw dw-edit-2"></span><span class="mtext">Visit Us</span>
						</a>
					</li>
				
				</ul>
			</div>
		</div>
	</div>