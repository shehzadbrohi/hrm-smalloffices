	<div class="left-side-bar">
		<div class="brand-logo">
			<a href="index.php">
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
						<a href="index.php" class="dropdown-toggle no-arrow">
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
							<span class="micon dw dw-page"></span><span class="mtext"> Daily Report </span>
						</a>
						<ul class="submenu">
							<li><a href="add_report.php">Submit Daily Report</a></li>
							<li><a href="view_report.php">View Daily Report</a></li>
							<li><a href="employee_report.php">View Employee Daily Report</a></li>
						</ul>
					</li>

<?php					if($session_id == 9 || $session_id == 13 || $session_id == 10){
?>


<?php
}
?>
<li class="dropdown">
						<a href="javascript:;" class="dropdown-toggle">
							<span class="micon dw dw-apartment"></span><span class="mtext"> Overtime Request </span>
						</a>

	<ul class="submenu">
							<li><a href="add_overtime.php">Add  Overtime Request</a></li>
						</ul>
						<ul class="submenu">
							<li><a href="view_overtime_me.php">View My Overtime</a></li>
						</ul>



	<ul class="submenu">
							<li><a href="view_overtime.php">View Employee Overtime</a></li>
						</ul>
	
					
					</li>
					<li class="dropdown">
						<a href="javascript:;" class="dropdown-toggle">
							<span class="micon dw dw-watch"></span><span class="mtext"> Official Work </span>
						</a>
						<ul class="submenu">
							<li><a href="official_work.php">Add Official Work</a></li>
							<li><a href="view_officialwork.php">View Official Work</a></li>
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
						<a href="business_trip_history.php" class="dropdown-toggle no-arrow">
							<span class="micon dw dw-house-1"></span><span class="mtext">Business Trips</span>
						</a>
						
					</li>
					<li class="dropdown">
						<a href="event_history.php" class="dropdown-toggle no-arrow">
							<span class="micon dw dw-house-1"></span><span class="mtext">Event History</span>
						</a>
						
					</li>
					<li class="dropdown">
						<a href="announcements.php" class="dropdown-toggle no-arrow">
							<span class="micon dw dw-house-1"></span><span class="mtext">Announcements</span>
						</a>
						
					</li>
					<?php
					if($session_id == 9 || $session_id == 13 || $session_id == 10){
			?>
	
	<li class="dropdown">
						<a href="meeting.php" class="dropdown-toggle no-arrow">
							<span class="micon dw dw-house-1"></span><span class="mtext">Schedule Meeting</span>
						</a>
						
					</li>
			<?php
			}
			?>
				
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