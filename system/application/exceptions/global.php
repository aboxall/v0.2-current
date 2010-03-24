<?php

function globalExceptionHandler($e)
{
    echo '<p style="color: red; padding: 10px; border: 1px solid red;">' . $e->getMessage() . '</p>';
}

set_exception_handler("globalExceptionHandler");

// EOF
