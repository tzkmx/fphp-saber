<?php

/**
 * Copyright 2014 Blue Snowman
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

namespace Saber\Data\HashSet {

	use \Saber\Core;
	use \Saber\Data;
	use \Saber\Data\ArrayList;
	use \Saber\Data\Bool;
	use \Saber\Data\HashSet;
	use \Saber\Data\Int32;
	use \Saber\Data\LinkedList;
	use \Saber\Data\Set;
	use \Saber\Data\Unit;
	use \Saber\Throwable;

	final class Module extends Data\Module implements Set\Module {

		#region Methods -> Basic Operations

		/**
		 * This method adds the item to the collection (if it doesn't already exist).
		 *
		 * @access public
		 * @static
		 * @param HashSet\Type $xs                                  the hash set
		 * @param Core\Type $x                                      the item to be stored
		 * @return Core\Type                                        the collection
		 */
		public static function addItem(HashSet\Type $xs, Core\Type $x) {
			$zs = HashSet\Type::box($xs->unbox());
			$zs->addItem($x);
			return $zs;
		}

		/**
		 * This method removes all entries from the collection.
		 *
		 * @access public
		 * @static
		 * @param HashSet\Type $xs                                  the hash set
		 * @return HashSet\Type                                     the collection
		 */
		public static function clear(HashSet\Type $xs) {
			return HashSet\Type::empty_();
		}

		/**
		 * This method returns a hash set which represents the (asymmetric) difference between
		 * the two specified hash sets.
		 *
		 * @access public
		 * @static
		 * @param HashSet\Type $xs                                  the first hash set
		 * @param HashSet\Type $ys                                  the second hash set
		 * @return HashSet\Type                                     a hash set which represents the (asymmetric)
		 *                                                          difference of the two specified hash sets
		 */
		public static function difference(HashSet\Type $xs, HashSet\Type $ys) {
			$zs = HashSet\Type::box($xs->unbox());
			$yi = HashSet\Module::iterator($ys);
			foreach ($yi as $y) {
				$zs->removeItem($y);
			}
			return $zs;
		}

		/**
		 * This method returns the item associated with the specified key.
		 *
		 * @access public
		 * @static
		 * @param HashSet\Type $xs                                  the hash set
		 * @param Core\Type $x                                      the item to be found
		 * @return Bool\Type                                        whether the item exists
		 */
		public static function hasItem(HashSet\Type $xs, Core\Type $x) {
			return $xs->hasItem($x);
		}

		/**
		 * This method returns a hash set which represents the intersection between the two
		 * specified sets.
		 *
		 * @access public
		 * @static
		 * @param HashSet\Type $xs                                  the first hash set
		 * @param HashSet\Type $ys                                  the second hash set
		 * @return HashSet\Type                                     a hash set which represents the intersection
		 *                                                          of the two specified hash sets
		 */
		public static function intersection(HashSet\Type $xs, HashSet\Type $ys) {
			$zs = HashSet\Type::empty_();
			$yi = HashSet\Module::iterator($ys);
			foreach ($yi as $y) {
				if ($xs->__hasItem($y)) {
					$zs->addItem($zs);
				}
			}
			return $zs;
		}

		/**
		 * This method (aka "null") returns whether this list is empty.
		 *
		 * @access public
		 * @static
		 * @param HashSet\Type $xs                                  the hash set
		 * @return Bool\Type                                        whether the list is empty
		 */
		public static function isEmpty(HashSet\Type $xs) {
			return $xs->isEmpty();
		}

		/**
		 * This method returns whether the second hash set is a subset of the first hash set.
		 *
		 * @access public
		 * @static
		 * @param HashSet\Type $xs                                  the first hash set
		 * @param HashSet\Type $ys                                  the second hash set
		 * @return Bool\Type                                        whether the second hash set is a
		 *                                                          subset of the first hash set
		 */
		public static function isSubset(HashSet\Type $xs, HashSet\Type $ys) {
			$yi = HashSet\Module::iterator($ys);
			foreach ($yi as $y) {
				if (!$xs->__hasItem($y)) {
					return Bool\Type::false();
				}
			}
			return Bool\Type::true();
		}

		/**
		 * This method returns whether the second hash set is a superset of the first hash set.
		 *
		 * @access public
		 * @static
		 * @param HashSet\Type $xs                                  the first set
		 * @param HashSet\Type $ys                                  the second set
		 * @return Bool\Type                                        whether the second hash set is a
		 *                                                          superset of the first hash set
		 */
		public static function isSuperset(HashSet\Type $xs, HashSet\Type $ys) {
			$xi = HashSet\Module::iterator($xs);
			foreach ($xi as $x) {
				if (!$ys->__hasItem($x)) {
					return Bool\Type::false();
				}
			}
			return Bool\Type::true();
		}

		/**
		 * This method returns all of the items in the collection.
		 *
		 * @access public
		 * @static
		 * @param HashSet\Type $xs                                  the hash set
		 * @return ArrayList\Type                                   all items in the collection
		 */
		public static function items(HashSet\Type $xs) {
			return $xs->items();
		}

		/**
		 * This method returns an iterator for this collection.
		 *
		 * @access public
		 * @static
		 * @param HashSet\Type $xs                                  the hash set
		 * @return HashSet\Iterator                                 an iterator for this collection
		 */
		public static function iterator(HashSet\Type $xs) {
			return new HashSet\Iterator($xs);
		}

		/**
		 * This method returns the power set of the specified hash set.
		 *
		 * @access public
		 * @static
		 * @param HashSet\Type $xs                                  the hash set to be used
		 * @return HashSet\Type                                     the power set
		 */
		public static function powerset(HashSet\Type $xs) {
			$css = HashSet\Type::empty_();
			$css->addItem(HashSet\Type::empty_());
			$xi = HashSet\Module::iterator($xs);
			foreach ($xi as $x) {
				$as = HashSet\Type::empty_();
				$csi = HashSet\Module::iterator($css);
				foreach ($csi as $cs) {
					$as->addItem($cs);
					$bs = HashSet\Type::box($cs);
					$bs->addItem($x);
					$as->addItem($bs);
				}
				$css = $as;
			}
			return $css;
		}

		/**
		 * This method returns the collection with the item removed.
		 *
		 * @access public
		 * @static
		 * @param HashSet\Type $xs                                  the hash set
		 * @param Core\Type $item                                   the item to be removed
		 * @return Core\Type                                        the item removed
		 */
		public static function removeItem(HashSet\Type $xs, Core\Type $item) {
			$zs = HashSet\Type::box($xs->unbox());
			$zs->removeItem($item);
			return $zs;
		}

		/**
		 * This method returns the size of this collection.
		 *
		 * @access public
		 * @static
		 * @param HashSet\Type $xs                                  the hash set
		 * @return Int32\Type                                       the size of this collection
		 */
		public static function size(HashSet\Type $xs) {
			return $xs->size();
		}

		/**
		 * This method returns a hash set which represents the union of the two specified hash sets.
		 *
		 * @access public
		 * @static
		 * @param HashSet\Type $xs                                  the first hash set
		 * @param HashSet\Type $ys                                  the second hash set
		 * @return HashSet\Type                                     a hash set which represents the union
		 *                                                          of the two specified hash sets
		 */
		public static function union(HashSet\Type $xs, HashSet\Type $ys) {
			$zs = HashSet\Type::box($xs->unbox());
			$yi = HashSet\Module::iterator($ys);
			foreach ($yi as $y) {
				$zs->addItem($y);
			}
			return $zs;
		}

		#endregion

		#region Methods -> Conversion Operations

		/**
		 * This method returns the latter value should the former value evaluates
		 * to null.
		 *
		 * @access public
		 * @static
		 * @param HashSet\Type $xs                                  the value to be evaluated
		 * @param HashSet\Type $ys                                  the default value
		 * @return HashSet\Type                                     the result
		 */
		public static function nvl(HashSet\Type $xs = null, HashSet\Type $ys = null) {
			return ($xs !== null) ? $xs : (($ys !== null) ? $ys : HashSet\Type::empty_());
		}

		/**
		 * This method returns the collection as an array.
		 *
		 * @access public
		 * @static
		 * @param HashSet\Type $xs                                  the operand
		 * @return HashSet\Type                                     the collection as an array list
		 */
		public static function toArrayList(HashSet\Type $xs) {
			$buffer = array();
			$xi = HashSet\Module::iterator($xs);
			foreach ($xi as $x) {
				$buffer[] = $x;
			}
			return ArrayList\Type::box($buffer);
		}

		/**
		 * This method returns the collection as a linked list.
		 *
		 * @access public
		 * @static
		 * @param HashSet\Type $xs                                  the operand
		 * @return LinkedList\Type                                  the collection as a linked list
		 */
		public static function toLinkedList(HashSet\Type $xs) {
			$zs = LinkedList\Type::nil();
			$xi = HashSet\Module::iterator($xs);
			foreach ($xi as $x) {
				$zs = LinkedList\Module::prepend($zs, $x);
			}
			return $zs;
		}

		#endregion
	}

}