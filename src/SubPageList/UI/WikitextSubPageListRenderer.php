<?php

namespace SubPageList\UI;

use SubPageList\Page;
use SubPageList\UI\PageRenderer\LinkingPageRenderer;

/**
 * @since 1.0
 *
 * @licence GNU GPL v2+
 * @author Jeroen De Dauw < jeroendedauw@gmail.com >
 */
class WikitextSubPageListRenderer implements SubPageListRenderer {

	protected $options;
	protected $text;

	/**
	 * @see SubPageListRenderer::render
	 *
	 * @param Page $page
	 * @param array $options
	 *
	 * @return string
	 */
	public function render( Page $page, array $options ) {
		$this->options = $options;
		$this->text = '';

		$this->addHeader();
		$this->addPageHierarchy( $page );
		$this->addFooter();

		return $this->text;
	}

	protected function addHeader() {
		$this->text .= $this->options['intro'];
	}

	protected function addFooter() {
		$this->text .= $this->options['outro'];
	}

	protected function addPageHierarchy( Page $page ) {
		$this->text .= $this->newTreeListRenderer()->renderHierarchy( $page, $this->options );
	}

	// TODO: this construction logic does not really fit into this class, split off
	protected function newTreeListRenderer() {
		return new TreeListRenderer( $this->newPageRenderer() );
	}

	protected function newPageRenderer() {
		return new LinkingPageRenderer();
	}

}
