<?php
/**
 * Convenience class for reading, writing and appending to files.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       Cake.Utility
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

/**
 * Convenience class for reading, writing and appending to files.
 *
 * @package       Cake.Utility
 */
class Search {

/**
 * Delimiter
 *
 * @var string
 */
	public static $DELIMITER = ' ';

/**
 * Max title length
 *
 * @var int
 */
	public static $MAX_TITLE_LENGTH = 64;

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
	public function prepareTitle($data) {
		return mb_strimwidth(strip_tags($data), 0, self::$MAX_TITLE_LENGTH);
	}

/**
 * Prepare contents to index
 *
 * @param array $data data
 * @return string Contents
 */
	public function prepareContents($data) {
		return implode(self::$DELIMITER, $data);
	}

/**
 * Prepare keyword to search
 *
 * @param string $keyword keyword
 * @param int $searchType search type
 * @return string keyword
 */
	public function prepareKeyword($keyword, $searchType = self::SEARCH_TYPE_AND) {
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
