<?php

Library::import('recess.framework.Plugin');
Library::import('PaginationPlugin.annotations.PaginateAnnotation');

class PaginationPlugin extends Plugin {
	
	function init( Application $app ) {
		//Do nothing. Only need to import the annotations and wrappers.
	}
	
}

?>