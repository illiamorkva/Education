<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

register_shutdown_function('shutdown');
set_error_handler('myHandler', E_ALL);

function shutdown() {

    $error = error_get_last();

    if (is_array($error) && (in_array($error['type'], [E_ERROR, E_PARSE, E_CORE_ERROR, E_COMPILE_ERROR])))
    {
        while (ob_get_level()) {
            ob_end_clean();
        }
        echo "Сервер находится на техническом обслуживании, зайдите позже";
    }
}

set_exception_handler(function($exception) {
    echo $exception->getMessage(), "<br/>\n";
    echo $exception->getFile(), ':', $exception->getLine(), "<br/>\n";
    echo $exception->getTraceAsString(), "<br/>\n";
});


try {
    calculate(123, 11);
}
catch (NumericException $exNumeric) {
    echo "Exception " . $exNumeric->getMessage();
}
catch (Exception $ex) {
    echo "Exception " . $ex->getMessage();
}
finally {
    echo "<br/>";
    echo "Good luck!";
}



function calculate($a, $b)
{
    if (!is_numeric($a)) {
        throw new Exception("Variable $a is a not number");
    }
    if (!is_numeric($b)) {
        throw new NumericException("Variable $b is a not number");
    }
    echo "Variable $a and $b is a number!";
}

class NumericException extends Exception
{

}

function myHandler($level, $message, $file, $line, $context) {
    switch ($level) {
        case E_WARNING:
            $type = 'Warning';
            break;
        case E_NOTICE:
            $type = 'Notice';
            break;
        default;
            return false;
    }
    echo "<h2>$type: $message</h2>";
    echo "<p><strong>File</strong>: $file:$line</p>";
    echo "<p><strong>Context</strong>: $". join(', $', array_keys($context))."</p>";
    return true;
}

