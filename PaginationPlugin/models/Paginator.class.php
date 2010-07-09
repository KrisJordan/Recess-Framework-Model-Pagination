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

/**
 * Paginator
 *
 * This class provides the actual pagination computation and helper methods.
 * A paginator is assigned as a property on the current ModelSet object.
 * So you can easily extract this paginator from the ModelSet, pass it to
 * your View, and use it to create pagination links.
 *
 * This object was inspired by John Nunemaker's Plucky paginator, also on
 * GitHub at http://github.com/jnunemaker/plucky/ (Copyright John Nunemaker).
 *
 * @author Josh Lockhart <info@joshlockhart.com>
 * @since Verson 1.0
 */
class Paginator {
	
	private $totalEntries;
	private $currentPage;
	private $perPage;
	
	public function __construct($total, $page, $perPage = null) {
		$this->totalEntries = intval($total);
		$this->currentPage = max(array(intval($page), 1));
		$this->perPage = ( is_null($perPage) ) ? 25 : intval($perPage);
	}
	
	public function totalEntries() {
		return $this->totalEntries;
	}
	
	public function currentPage() {
		return $this->currentPage;
	}
	
	public function perPage() {
		return $this->perPage;
	}
	
	public function totalPages() {
		return ceil($this->totalEntries / $this->perPage);
	}
	
	public function outOfBounds() {
		return $this->currentPage > $this->totalPages();
	}
	
	public function previousPage() {
		return ( $this->currentPage > 1 ) ? $this->currentPage - 1 : null;
	}
	
	public function nextPage() {
		return ( $this->currentPage < $this->totalPages() ) ? $this->currentPage + 1 : null;
	}
	
	public function offset() {
		return ( $this->currentPage - 1 ) * $this->perPage;
	}
	
}

?>