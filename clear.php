<?php
session_start();
session_unset();
session_destroy();
echo "Удаление прошло успешно";
echo "<a href='https://se.ifmo.ru/~s309584/'>Вернуться на главную</a>";
exit;
?>