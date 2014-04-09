<?php global $total_guests, $total_users; ?>

<div class="cool_message">
	We have a total of <?php echo $total_guests ?> Guests and <?php echo $total_users; ?> Users online.
</div>
<table id="onlinetable" width="100%">

	<!-- Table header -->

		<thead>
			<tr id="tr">
				<th scope="col" id="th">User</th>
				<th scope="col" id="th">Location</th>
				<th scipe="col" id="th">Time</th>
			</tr>
		</thead>

		<tbody>

