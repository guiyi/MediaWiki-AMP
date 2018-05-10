<?php
/**
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along
 * with this program; if not, write to the Free Software Foundation, Inc.,
 * 51 Franklin Street, Fifth Floor, Boston, MA 02110-1301, USA.
 * http://www.gnu.org/copyleft/gpl.html
 *
 * @file
 */

/**
 * Generic wrapper for template functions, with interface
 * compatible with what we use of PHPTAL 0.7.
 * @ingroup Skins
 */
abstract class QuickTemplate {

	/** @var Config $config */
	protected $config;

	/**
	 * @param Config $config
	 */
	function __construct( Config $config = null ) {
		$this->data = [];
		$this->translator = new MediaWikiI18N();
		if ( $config === null ) {
			wfDebug( __METHOD__ . ' was called with no Config instance passed to it' );
			$config = ConfigFactory::getDefaultInstance()->makeConfig( 'main' );
		}
		$this->config = $config;
	}

	/**
	 * Sets the value $value to $name
	 * @param string $name
	 * @param mixed $value
	 */
	public function set( $name, $value ) {
		$this->data[$name] = $value;
	}

	/**
	* extends the value of data with name $name with the value $value
	* @since 1.25
	* @param string $name
	* @param mixed $value
	*/
	public function extend( $name, $value ) {
		if ( $this->haveData( $name ) ) {
			$this->data[$name] = $this->data[$name] . $value;
		} else {
			$this->data[$name] = $value;
		}
	}

	/**
	 * Gets the template data requested
	 * @since 1.22
	 * @param string $name Key for the data
	 * @param mixed $default Optional default (or null)
	 * @return mixed The value of the data requested or the deafult
	 */
	public function get( $name, $default = null ) {
		if ( isset( $this->data[$name] ) ) {
			return $this->data[$name];
		} else {
			return $default;
		}
	}

	/**
	 * @param string $name
	 * @param mixed $value
	 */
	public function setRef( $name, &$value ) {
		$this->data[$name] =& $value;
	}

	/**
	 * @param MediaWikiI18N $t
	 */
	public function setTranslator( &$t ) {
		$this->translator = &$t;
	}

	/**
	 * Main function, used by classes that subclass QuickTemplate
	 * to show the actual HTML output
	 */
	abstract public function execute();

	/**
	 * @private
	 * @param string $str
	 */
	function text( $str ) {
		echo htmlspecialchars( $this->data[$str] );
	}


	/******************Adair Start****************/
	/**
	 * @private
	 * @param string $str
	 */
	function html( $str ) {
		//---Adair 2017.11.03 start------//
		
		if(constant("wgMobileFlag")){
			//删除script
			$preg = "/<script[\s\S]*?<\/script>/i";
			$newstr = preg_replace($preg,"",$this->data[$str]);
			//$str = '<script async src="https://cdn.ampproject.org/v0.js"></script>';
			//替换 	<html lang="zh-CN" dir="ltr" class="client-nojs"> 
			//为	<html amp>
			$preg = '/html.*"/i';
			$newstr = preg_replace($preg,"html amp",$newstr);

			//删除meta
			$preg = "/<meta name.*?\/>/i";
			
			$newstr = preg_replace($preg,"",$newstr);

			//删除link
			$preg = '/link rel="EditURI".*"/i';
			$newstr = preg_replace($preg,'lisnk rel="canonical" ',$newstr);

			$preg = "/<link.*?\/>/i";
			$newstr = preg_replace($preg,"",$newstr);

			$SOME_URL = $_SERVER['PHP_SELF'];
			$preg = '/lisnk.*?\/>/i';
			$newstr = preg_replace($preg,'link rel="canonical" href='.$SOME_URL.'>'."\r\n"
				.'<meta name="viewport" content="width=device-width,minimum-scale=1">'."\r\n"
				.' <style amp-custom>
			/* any custom style goes here */
			
			body {
				background-color: white;
			}
			
			a {
				text-decoration: none;
			}
			
			amp-img {
				background-color: gray;
				border: 1px solid black;
			}
			
			table {
				border-collapse: collapse;
				border-spacing: 0;
				/*width: 100%;*/
			}
			
			.mw-editsection,
			.mw-editsection-like {
				font-size: small;
				font-weight: normal;
				margin-left: 1em;
				vertical-align: baseline;
				line-height: 1em;
				display: inline-block;
			}
			
			pre,
			.mw-code {
				color: black;
				background-color: #f9f9f9;
				border: 1px solid #ddd;
				white-space: pre-wrap;
				overflow:hidden;
			}
			
			#mw-wrapper {
				padding: 0 15px;
			}
			
			#mw-wrapper .mw-body {
				max-width: 1200px;
				margin: 0 auto;
			}
			
			#mw-wrapper .mw-body-content {
				width: 100%;
			}
			
			#mw-wrapper #mw-content-text .tright {
				border: 1px solid #ccc;
				padding: 3px;
				background-color: #f9f9f9;
				text-align: center;
			}
			#mw-wrapper #mw-content-text img{
				width:100%;
				height:100%;
			}
			
			#mw-wrapper #mw-content-text .tright .thumbinner {
				margin: 0 auto;
			}
			
			#mw-wrapper textarea {
				width: 100%;
			}
			#mw-wrapper .main_tab{
				width: 100%;
    			overflow: auto;
			}
			#mw-wrapper #mw-content-text #toc {
				border: 1px solid #aaa;
				background-color: #f9f9f9;
				margin-top: 15px;
				padding: 0 15px
			}
			
			#mw-wrapper #mw-content-text dd {
				margin-left: 0;
			}
			
			#mw-wrapper #mw-content-text table .thumbinner {
				width: 122px;
				border: 1px solid #ccc;
				background-color: #f9f9f9;
			}
			
			#mw-footer {
				max-width: 1200px;
				margin: 0 auto;
			}
			
			#mw-footer ul li {
				list-style: none;
			}
			
			#mw-footer ul#footer-places li {
				float: left;
				margin-right: 15px;
			}
			
			#mw-footer ul#footer-places li a {
				color: #0645ad;
			}

			.printfooter{
				color: #0645ad;
			}

			/* --- Links --- */
			a,
			a.link {
			  text-decoration: none;
			  border-bottom: 1px dotted;
			}

			a:hover,
			a:active,
			a:focus,
			.link:hover,
			.link:active,
			.link:focus {
			  text-decoration: none;
			  border-bottom-style: solid;
			}

			.link {
			  font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
			}

			h1 a,
			h2 a {
			  border-bottom: none;
			}
			
		</style>'
		.'	<style amp-boilerplate>
		body{-webkit-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-moz-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-ms-animation:-amp-start 8s steps(1,end) 0s 1 normal both;animation:-amp-start 8s steps(1,end) 0s 1 normal both}@-webkit-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-moz-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-ms-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-o-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}
	</style>
	<noscript><style amp-boilerplate>body{-webkit-animation:none;-moz-animation:none;-ms-animation:none;animation:none}</style></noscript>
      
	<script async src="https://cdn.ampproject.org/v0.js"></script>'
		,$newstr);

			//去除编辑
			$preg = "/(?:\[)(.*)(?:\])/i";
			$newstr = preg_replace($preg,"",$newstr);

			//去除style
			$preg = '/<*style.*?".*"/i';
			$newstr = preg_replace($preg,"",$newstr);

			//去除nofollow
			/*$preg = '/<*rel="nofollow"/i';
			$newstr = preg_replace($preg,"",$newstr);*/

			//去除nofollow
			/*$preg = '/<*rel="nofollow"|class="external text.*?"/i';
			$newstr = preg_replace($preg,"",$newstr);*/

			//去除nofollow
			$preg = '/<font color.*?>/i';
			$newstr = preg_replace($preg,"",$newstr);

			$preg = '/rel="nofollow"|class="external text"/i';
			$newstr = preg_replace($preg,"",$newstr);
			

			/*$pattern = '/href=".*"/i';
			$preg= '/<a rel.*?>/i';
			preg_match($pattern, $newstr, $matches);
			$newstr = preg_replace($preg,"<a ".$matches[0].">",$newstr);*/

			//echo substr_replace($str,$newstr,5,0);
			echo $newstr;
		}else{
			echo $this->data[$str];
		}
		
	}

	/******************Adair End****************/

	/**
	 * @private
	 * @param string $str
	 */
	function msg( $str ) {
		echo htmlspecialchars( $this->translator->translate( $str ) );
	}

	/**
	 * @private
	 * @param string $str
	 */
	function msgHtml( $str ) {
		echo $this->translator->translate( $str );
	}

	/**
	 * An ugly, ugly hack.
	 * @private
	 * @param string $str
	 */
	function msgWiki( $str ) {
		global $wgOut;

		$text = $this->translator->translate( $str );
		echo $wgOut->parse( $text );
	}

	/**
	 * @private
	 * @param string $str
	 * @return bool
	 */
	function haveData( $str ) {
		return isset( $this->data[$str] );
	}

	/**
	 * @private
	 *
	 * @param string $str
	 * @return bool
	 */
	function haveMsg( $str ) {
		$msg = $this->translator->translate( $str );
		return ( $msg != '-' ) && ( $msg != '' ); # ????
	}

	/**
	 * Get the Skin object related to this object
	 *
	 * @return Skin
	 */
	public function getSkin() {
		return $this->data['skin'];
	}

	/**
	 * Fetch the output of a QuickTemplate and return it
	 *
	 * @since 1.23
	 * @return string
	 */
	public function getHTML() {
		ob_start();
		$this->execute();
		$html = ob_get_contents();
		ob_end_clean();
		return $html;
	}
}

?>