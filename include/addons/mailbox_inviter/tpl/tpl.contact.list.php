<center>
<div id="result">
<table summary="Meeting Results" id="hor-minimalist-a" style="width:95%">
    <thead>
        <tr>
            <th scope="col">Name</th>
            <th scope="col">Mail</th>
            <th scope="col"><input type="checkbox" onclick="check_all(this)" >&nbsp;Select</th>     
        </tr>
    </thead>
    <tbody>
<?php
$n = count($contacts);
if( $n > 1 ){
     
for ($i=0; $i<$n; $i++) {
     $clr = ( $i % 2 == 0 ? "#EFEFEF" : "#FFFFFF" );
     $contact =  $contacts[$i];
       
     $name = $contact->name;
     $email = $contact->email;                  
     $emaill=htmlspecialchars($email);
?>
    <tr bgcolor="<?=$clr?>">
      <td><?=$name?></td>  
      <td><?=$emaill?></td>   
      <td align="center"><input type="checkbox" id="mails" name="mails[]" value="<?=$emaill?>"></td>           
    </tr>
<?php    
}
}
else {
?>
    <tr>
        <td colspan="3" align="center"><b>No contacts.</b><br><br></td>      
    </tr>    
<?php        
}
?>    
    </tbody>
<?
if( $n > 1 ){   
?>    
    <tfoot>
        <tr>
            <td colspan="3" style="padding-top:3px">
            <h2 style="margin:4px">Your Message</h2>
            <textarea id='send_msg' style="width:530px" onclick="this.value=''">Write your invitations message ...</textarea>
            </td>
        </tr>
        <tr>
            <td colspan="3" align="center"><input style="width:150px" class="btn" type="button" value="Send Invites" onclick="send_invites()"><br><br></td>
        </tr>
    </tfoot>    
<?php
}
?>    
</table>
</div>

</center>