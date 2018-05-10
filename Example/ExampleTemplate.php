<?php
/**
 * BaseTemplate class for the Example skin
 *
 * @ingroup Skins
 */
class ExampleTemplate extends BaseTemplate {
	/**
	 * Outputs the entire contents of the page
	 */
	public function execute() {

		$this->html( 'headelement' );
		//$this->remove_script($this->html( 'headelement' ));
		//die();

		?>
		<div id="mw-wrapper">
			<div class="mw-body" role="main">
				<?php
				if ( $this->data['sitenotice'] ) {
					echo Html::rawElement(
						'div',
						array( 'id' => 'siteNotice' ),
						$this->get( 'sitenotice' )
					);
				}
				if ( $this->data['newtalk'] ) {
					echo Html::rawElement(
						'div',
						array( 'class' => 'usermessage' ),
						$this->get( 'newtalk' )
					);
				}
				echo $this->getIndicators();
				echo Html::rawElement(
					'h1',
					array(
						'class' => 'firstHeading',
						'lang' => $this->get( 'pageLanguage' )
					),
					$this->get( 'title' )
				);

				echo Html::rawElement(
					'div',
					array( 'id' => 'siteSub' ),
					$this->getMsg( 'tagline' )->parse()
				);
				?>

				<div class="mw-body-content">
					<?php
					echo Html::openElement(
						'div',
						array( 'id' => 'contentSub' )
					);
					if ( $this->data['subtitle'] ) {
						echo Html::rawelement (
							'p',
							[],
							$this->get( 'subtitle' )
						);
					}
					echo Html::rawelement (
						'p',
						[],
						$this->get( 'undelete' )
					);
					echo Html::closeElement( 'div' );

					$this->html( 'bodycontent' );
					//$this->clear();
					echo Html::rawElement(
						'div',
						array( 'class' => 'printfooter' ),
						$this->get( 'printfooter' )
					);
					$this->html( 'catlinks' );
					$this->html( 'dataAfterContent' );
					?>
				</div>
			</div>

			<div id="mw-navigation">
				<?php
				/*echo Html::rawElement(
					'h2',
					[],
					$this->getMsg( 'navigation-heading' )->parse()
				);

				echo $this->getLogo();
				echo $this->getSearch();

				// User profile links
				echo Html::rawElement(
					'div',
					array( 'id' => 'user-tools' ),
					$this->getUserLinks()
				);

				// Page editing and tools
				echo $this->remove_Edit(Html::rawElement(
					'div',
					array( 'id' => 'page-tools' ),
					$this->getPageLinks()
				));*/

				// Site navigation/sidebar
				echo Html::rawElement(
					'div',
					array( 'id' => 'site-navigation' ),
					$this->getSiteNavigation()
				);
				?>
			</div>

			<div id="mw-footer">
				<?php
				echo Html::openElement(
					'ul',
					array(
						'id' => 'footer-icons',
						'role' => 'contentinfo'
					)
				);
				foreach ( $this->getFooterIcons( 'icononly' ) as $blockName => $footerIcons ) {
					echo Html::openElement(
						'li',
						array(
							'id' => 'footer-' . Sanitizer::escapeId( $blockName ) . 'ico'
						)
					);
					foreach ( $footerIcons as $icon ) {
						echo $this->modify_img($this->getSkin()->makeFooterIcon( $icon ));
					}
					echo Html::closeElement( 'li' );
				}
				echo Html::closeElement( 'ul' );

				foreach ( $this->getFooterLinks() as $category => $links ) {
					echo Html::openElement(
						'ul',
						array(
							'id' => 'footer-' . Sanitizer::escapeId( $category ),
							'role' => 'contentinfo'
						)
					);
					foreach ( $links as $key ) {
						echo Html::rawElement(
							'li',
							array(
								'id' => 'footer-' . Sanitizer::escapeId( $category . '-' . $key )
							),
							$this->get( $key )
						);
					}
					echo Html::closeElement( 'ul' );
				}
				$this->clear();
				?>
			</div>
		</div>

		<?php $this->printTrail() ?>
		</body>
		</html>

		<?php
	}

	/**
	 * Generates a single sidebar portlet of any kind
	 * @return string html
	 */
	private function getPortlet( $box ) {
		if ( !$box['content'] ) {
			return;
		}

		$html = Html::openElement(
			'div',
			array(
				'role' => 'navigation',
				'class' => 'mw-portlet',
				'id' => Sanitizer::escapeId( $box['id'] )
			) + Linker::tooltipAndAccesskeyAttribs( $box['id'] )
		);
		$html .= Html::element(
			'h3',
			[],
			isset( $box['headerMessage'] ) ? $this->getMsg( $box['headerMessage'] )->text() : $box['header'] );
		if ( is_array( $box['content'] ) ) {
			$html .= Html::openElement( 'ul' );
			foreach ( $box['content'] as $key => $item ) {
				$html .= $this->makeListItem( $key, $item );
			}
			$html .= Html::closeElement( 'ul' );
		} else {
			$html .= $box['content'];
		}
		$html .= Html::closeElement( 'div' );

		return $html;
	}

	/**
	 * Generates the logo and (optionally) site title
	 * @return string html
	 */
	private function getLogo( $id = 'p-logo', $imageOnly = false ) {
		$html = Html::openElement(
			'div',
			array(
				'id' => $id,
				'class' => 'mw-portlet',
				'role' => 'banner'
			)
		);
		$html .= Html::element(
			'a',
			array(
				'href' => $this->data['nav_urls']['mainpage']['href'],
				'class' => 'mw-wiki-logo',
			) + Linker::tooltipAndAccesskeyAttribs( 'p-logo' )
		);
		if ( !$imageOnly ) {
			$html .= Html::element(
				'a',
				array(
					'id' => 'p-banner',
					'class' => 'mw-wiki-title',
					'href'=> $this->data['nav_urls']['mainpage']['href']
				) + Linker::tooltipAndAccesskeyAttribs( 'p-logo' ),
				$this->getMsg( 'sitetitle' )->escaped()
			);
		}
		$html .= Html::closeElement( 'div' );

		return $html;
	}

	/**
	 * Generates the search form
	 * @return string html
	 */
	private function getSearch() {
		$html = Html::openElement(
			'form',
			array(
				'action' => htmlspecialchars( $this->get( 'wgScript' ) ),
				'role' => 'search',
				'class' => 'mw-portlet',
				'id' => 'p-search'
			)
		);
		$html .= Html::hidden( 'title', htmlspecialchars( $this->get( 'searchtitle' ) ) );
		$html .= Html::rawelement(
			'h3',
			[],
			Html::label( $this->getMsg( 'search' )->escaped(), 'searchInput' )
		);
		$html .= $this->makeSearchInput( array( 'id' => 'searchInput' ) );
		$html .= $this->makeSearchButton( 'go', array( 'id' => 'searchGoButton', 'class' => 'searchButton' ) );
		$html .= Html::closeElement( 'form' );

		return $html;
	}

	/**
	 * Generates the sidebar
	 * Set the elements to true to allow them to be part of the sidebar
	 * @return string html
	 */
	private function getSiteNavigation() {
		$html = '';

		$sidebar = $this->getSidebar();

		$sidebar['SEARCH'] = false;
		$sidebar['TOOLBOX'] = true;
		$sidebar['LANGUAGES'] = true;

		foreach ( $sidebar as $boxName => $box ) {
			if ( $boxName === false ) {
				continue;
			}
			$html .= $this->getPortlet( $box, true );
		}

		return $html;
	}

	/**
	 * Generates page-related tools/links
	 * @return string html
	 */
	private function getPageLinks() {
		$html = $this->getPortlet( array(
			'id' => 'p-namespaces',
			'headerMessage' => 'namespaces',
			'content' => $this->data['content_navigation']['namespaces'],
		) );
		$html .= $this->getPortlet( array(
			'id' => 'p-variants',
			'headerMessage' => 'variants',
			'content' => $this->data['content_navigation']['variants'],
		) );
		$html .= $this->getPortlet( array(
			'id' => 'p-views',
			'headerMessage' => 'views',
			'content' => $this->data['content_navigation']['views'],
		) );
		$html .= $this->getPortlet( array(
			'id' => 'p-actions',
			'headerMessage' => 'actions',
			'content' => $this->data['content_navigation']['actions'],
		) );

		return $html;
	}

	/**
	 * Generates user tools menu
	 * @return string html
	 */
	private function getUserLinks() {
		return $this->getPortlet( array(
			'id' => 'p-personal',
			'headerMessage' => 'personaltools',
			'content' => $this->getPersonalTools(),
		) );
	}

	/**
	 * Outputs a css clear using the core visualClear class
	 */
	private function clear() {
		echo '<div class="visualClear"></div>';
	}


	//删除style
	private function remove_style($string){
		$preg = '/<*style.*?;"/i';
		$newstr = preg_replace($preg,"",$string);  
		return $newstr;  
	}

	//删除JavaScript
	private function remove_script($string){
		$preg = "/<script[\s\S]*?<\/script>/i";
		$newstr = preg_replace($preg,"",$string);  
		return $newstr;  
	}

	//删除Edit
	private function remove_Edit($string){
		$preg = '/<li id="ca-edit.*?<\/li>/i';
		//"/<meta name.*?\/>/i";
		$newstr = preg_replace($preg,"",$string);  
		return $newstr;  
	}


	//修改图片
	private function modify_img($string){
		$preg = "/img/i";
		$newstr = preg_replace($preg,"amp-img",$string);  
		return $newstr;  
	}

}
