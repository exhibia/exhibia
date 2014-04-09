<?php
$game_server = 'http://pennyauctionsoftdemo.com';
include("$BASE_DIR/include/addons/games/api/trivia.config.inc.php");
$_REQUEST['domain'] = str_replace("www.", "", $_REQUEST['domain']);

?>
<link href="<?php echo $game_server; ?>/include/addons/games/trivia/js/trivia.css" rel="stylesheet" type="text/css" />
<div id="quiz"></div>
 <div id="answered">
  <h4>Quizzes: <em id="nqansw">0</em> of <span id="ntotalq"></span></h4>
  <span id="nca">0</span> - Correct answers<br/>
  <span id="nia">0</span> - Incorrect answers
 </div>
 <div id="qdata">
  <label for="level1"><input type="radio" name="level" id="level1" checked="checked" />Level 1</label>
  <label for="level2"><input type="radio" name="level" id="level2" />Level 2</label>
  <h4>Mode</h4>
  <label for="qindex"><input type="radio" name="qmode" id="qindex" checked="checked" />Consecutive</label>
  <div id="startqn">From <input type="text" size="1" name="nquiz" id="nquiz" value="1" /> to <span id="totalq"></span></div>
  <label for="qrandom"><input type="radio" name="qmode" id="qrandom" />Random</label>
  <label for="qctimer"><input type="checkbox" id="qctimer" />Countdown Timer</label><hr/>
  <button id="squiz">Start</button>
  <button id="treset" disabled="disabled">Reset</button>
 </div>
</div>
<script type="text/javascript" src="<?php echo $game_server; ?>/include/addons/games/trivia/js/trivia.php"></script>