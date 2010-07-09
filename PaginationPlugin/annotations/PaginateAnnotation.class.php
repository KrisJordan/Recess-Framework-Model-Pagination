<?php
/**
 * Recess Framework Model Pagination Plugin
 *
 * Easily paginate your Models
 *
 * @author		Josh Lockhart <info@joshlockhart.com>
 * @link		http://code.joshlockhart.com/recess/pagination/
 * @copyright	2010 Josh Lockhart
 * 
 * MIT LICENSE
 *
 * Permission is hereby granted, free of charge, to any person obtaining
 * a copy of this software and associated documentation files (the
 * "Software"), to deal in the Software without restriction, including
 * without limitation the rights to use, copy, modify, merge, publish,
 * distribute, sublicense, and/or sell copies of the Software, and to
 * permit persons to whom the Software is furnished to do so, subject to
 * the following conditions:
 * 
 * The above copyright notice and this permission notice shall be
 * included in all copies or substantial portions of the Software.
 * 
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
 * EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF
 * MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND
 * NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE
 * LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION
 * OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION
 * WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 */

Library::import('recesss.lang.Annotation');
Library::import('PaginationPlugin.models.PaginatorDelegate');

/**
 * Pagination Annotation
 *
 * This annotation attaches the paginate() method to a Model object.
 *
 * USAGE:
 *
 * !Paginate Limit: 5
 *
 * Limit:
 * - Optional
 * - Determines the number of results to show per page
 *
 * @author Josh Lockhart <info@joshlockhart.com>
 * @since Verson 1.0
 */
class PaginateAnnotation extends Annotation {
		
	public function usage() {
		return '!Paginate Limit:25';		
	}
	
	public function isFor() {
		return Annotation::FOR_CLASS;
	}
	
	protected function validate($class) {
		$this->acceptsNoKeylessValues();
		$this->acceptedKeys(array('limit'));
		$this->validOnSubclassesOf($class,'Model');
	}
	
	protected function expand($class, $reflection, $descriptor) {
		$delegate = new PaginatorDelegate();
		$delegate->perPage = isset($this->limit) ? intval($this->limit) : 25; 
		$descriptor->attachMethod($class, 'paginate', $delegate, 'paginate');
		return $descriptor;
	}
	
}

?>