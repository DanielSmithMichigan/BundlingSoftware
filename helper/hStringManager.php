<?php
	require_once('lib/htmlpurifier/HTMLPurifier.standalone.php');
	$config = HTMLPurifier_Config::createDefault();
	$allowed_html = array();
	$allowed_html[] = 'p';
	$allowed_html[] = 'span';
	$allowed_html[] = 'ul';
	$allowed_html[] = 'ol';
	$allowed_html[] = 'li';
	$config->set('HTML.AllowedElements', join(',', $allowed_html));
	$allowed_attributes = array();
	$allowed_attributes[] = 'style';
	$config->set('HTML.AllowedAttributes', join(',', $allowed_attributes));
	$allowed_css = array();
	$allowed_css[] = 'font-size';
	$allowed_css[] = 'font-weight';
	$allowed_css[] = 'font-style';
	$allowed_css[] = 'text-decoration';
	$allowed_css[] = 'color';
	$allowed_css[] = 'background-color';
	$allowed_css[] = 'font-size';
	$allowed_css[] = 'text-align';
	$config->set('CSS.AllowedProperties', join(',', $allowed_css));
	$config->set('Core.EscapeNonASCIICharacters', true);
	$config->set('URI.Disable', true);
	$GLOBALS['purifier'] = new HTMLPurifier($config);
	class hStringManager {
		public static function removeBadHtml($string) {
			return $GLOBALS['purifier']->purify($string);
		}
		public static function nullIfWhitespace($string) {
			$pattern = '/\s/';
			$replacement = '';
			$stringWithoutWhitespace = preg_replace($pattern, $replacement, $string);
			if (empty($stringWithoutWhitespace)) {
				$string = '';
			}
			return $string;
		}
		public static function removeEmptyParagraphTags($string) {
			$pattern = "#<p>(\s|&nbsp;|</?\s?br\s?/?>)*</?p>#";
			$replacement = '';
			return preg_replace($pattern, $replacement, $string);
		}
		public static function convertParagraphToRow($string) {
			$pattern = '#<p>(.*?)</p>#';
			$replacement = '
					<tr>
						<td>
						</td>
						<td colspan="3">
							$1
						</td>
						<td>
						</td>
					</tr>';
			return preg_replace($pattern, $replacement, $string);
		}
		public static function prepareBundleDescription($string) {
			$string = self::removeBadHtml($string);
			$string = self::removeEmptyParagraphTags($string);
			$string = self::nullIfWhitespace($string);
			return $string;
		}
	
	}
?>