<?php global $user, $page, $time; 

if($page == "N/A") { $page = "Unknown Location"; $nolink = "1"; } else { unset($nolink); }
?>


			<tr id="tr">
				<td id="td"><?php echo $user; ?></td>
				<td id="td"><?php if(isset($nolink)) { echo $page; } else { echo "<a href=\"$page\" title=\"\">".$page."</a>"; } ?></td>
				<td id="td"><?php echo $time; ?></td>

			</tr>
