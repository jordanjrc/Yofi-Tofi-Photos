<?php
unset($_SESSION['login']);
unset($_SESSION['user_id']);

header('Location: /'. $previousLocation);
