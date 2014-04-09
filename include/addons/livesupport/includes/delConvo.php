<?php
if(!empty($_GET['id'])) {
echo '<div id="padded_box"><form method="post" action="admin.php">';
        echo '<p>Are you sure you want to end this conversation?</p>';
        echo '
        <input type="hidden" name="id" id="id" value="'.$_GET['id'].'" />
        <button type="submit" name="cancel" value="cancel">Cancel</button>
        <button class="del" type="submit" name="delete_convo" value="delete">Yes</button>
        </form></div>
';
}
?>
