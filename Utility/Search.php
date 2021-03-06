<?php
/**
 * Convenience class for search.
 *
 * @author Jun Nishikawa <topaz2@m0n0m0n0.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 */

/**
 * Convenience class for search.
 */
class Search {

/**
 * Delimiter
 *
 * @var string
 */
	public static $delimiter = ' ';

/**
 * Max title length
 *
 * @var int
 */
	const MAX_TITLE_LENGTH = 64;

/**
 * AND search type
 *
 * @var int
 */
	const SEARCH_TYPE_AND = 1;

/**
 * OR search type
 *
 * @var int
 */
	const SEARCH_TYPE_OR = 2;

/**
 * Phrase search type
 *
 * @var int
 */
	const SEARCH_TYPE_PHRASE = 3;

/**
 * Prepare title to index
 *
 * @param string $data data
 * @return string Title
 */
	public static function prepareTitle($data) {
		return mb_strimwidth(strip_tags($data), 0, self::MAX_TITLE_LENGTH);
	}

/**
 * Prepare contents to index
 *
 * @param array $data data
 * @return string Contents
 */
	public static function prepareContents($data) {
		return implode(self::$delimiter, $data);
	}

/**
 * Prepare keyword to search
 *
 * @param string $keyword keyword
 * @param int $searchType search type
 * @return string keyword
 */
	public static function prepareKeyword($keyword, $searchType = self::SEARCH_TYPE_AND) {
		switch ($searchType) {
			case self::SEARCH_TYPE_AND:
				$keyword = sprintf('*D+ %s', $keyword);
				break;
			case self::SEARCH_TYPE_OR:
				$keyword = sprintf('*DOR %s', $keyword);
				break;
			case self::SEARCH_TYPE_PHRASE:
				$keyword = sprintf('"%s"', $keyword);
				break;
			default:
				break;
		}

		return $keyword;
	}
}
