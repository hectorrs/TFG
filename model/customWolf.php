<?php $see = aactionManager($this, 'see');
$smell = actionManager($this, 'smell');
$hear = actionManager($this, 'hear');
$move = array('up', 'down', 'left', 'right');
actionManager($this, 'move', $move[rand(0, 3)]);
actionManager($this, 'sleep');
actionManager($this, 'breed');
?>