<?php


// Testeo de excepciones en PHP
$exp = array(
	 'simple' => false
	,'avanzado' => true
);

// ---------- Testeo simple ----------
if ($exp['simple']) {
	
	try {
		$error = 'Always throw this error';
		throw new Exception($error);

		// Code following an exception is not executed.
		echo 'Never executed';

	} catch (Exception $e) {
		echo 'Caught exception: ',  $e->getMessage(), "\n";
	}

	// Continue execution
	echo 'Hello World';
	
}
// ---------- /Testeo simple ----------



// ---------- Testeo avanzado ----------
if ($exp['avanzado']) {
	
	function exception_handler(Exception $e) {
		
		var_dump($e);
		echo 'Caught exception: ',  $e->getMessage(), "\n";
	}
	
	set_exception_handler('exception_handler');
	
	
	
	
	$error = 'Always throw this error';
	throw new Exception($error);

	// Code following an exception is not executed.
	echo 'Never executed';

	
	
	

	// Continue execution
	echo 'Hello World';
	
}
// ---------- /Testeo avanzado ----------



?>