<?php
unset($_SESSION['user_id']);

header('Location: ' . (preg_match('/^\/user/', $previousLocation) ? '/home' : $previousLocation));
