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

Library::import('PaginationPlugin.models.Paginator');

/**
 * Paginator Delegate
 *
 * This class provides the attachable method which is attached to
 * the ModelSet. It instantatites a Paginator object, assigns it to
 * the ModelSet, and uses it to filter the ModelSet query based on
 * the current requested page and per-page limit.
 *
 * @author Josh Lockhart <info@joshlockhart.com>
 * @since Verson 1.0
 */
class PaginatorDelegate {

	public $perPage = 25;

	public function paginate( ModelSet $modelSet ) {
		$page = ( isset($_REQUEST['page']) ) ? intval($_REQUEST['page']) : 1;
		$limit = $this->perPage;
		$total = $modelSet->count();
		$modelSet->paginator = new Paginator($total, $page, $limit);
		return $modelSet->limit( $modelSet->paginator->perPage() )->offset( $modelSet->paginator->offset() );
	}
	
}

?>