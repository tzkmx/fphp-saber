<?php

/**
 * Copyright 2014-2015 Blue Snowman
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
	use \Saber\Data\HashSet;
	use \Saber\Data\Int32;

	/**
	 * @group TypeTest
	 */
	final class TypeTest extends Core\TypeTest {

		#region Tests -> Inheritance

		/**
		 * This method tests the data type.
		 */
		public function testType() {
			//$this->markTestIncomplete();

			$p0 = new HashSet\Type(array());

			$this->assertInstanceOf('\\Saber\\Data\\HashSet\\Type', $p0);
			$this->assertInstanceOf('\\Saber\\Data\\Set\\Type', $p0);
			$this->assertInstanceOf('\\Saber\\Data\\Collection\\Type', $p0);
			$this->assertInstanceOf('\\Saber\\Data\\Type', $p0);
			$this->assertInstanceOf('\\Saber\\Core\\Equality\\Type', $p0);
			$this->assertInstanceOf('\\Saber\\Core\\Comparable\\Type', $p0);
			$this->assertInstanceOf('\\Saber\\Core\\Boxable\\Type', $p0);
			$this->assertInstanceOf('\\Saber\\Core\\Type', $p0);
		}

		#endregion

		#region Tests -> Initialization

		/**
		 * This method provides the data for testing the boxing of a value.
		 *
		 * @return array
		 */
		public function dataBox() {
			$data = array(
				array(array(array(Int32\Type::zero()), array(Int32\Type::one())), array(array(Int32\Type::zero()), array(Int32\Type::one()))),
			);
			return $data;
		}

		/**
		 * This method tests the boxing of a value.
		 *
		 * @dataProvider dataBox
		 */
		public function testBox(array $provided, array $expected) {
			//$this->markTestIncomplete();

			$p0 = HashSet\Type::box($provided);

			$this->assertInstanceOf('\\Saber\\Data\\HashSet\\Type', $p0);

			$p1 = $p0->unbox();
			$e1 = count($expected);

			$this->assertInternalType('array', $p1);
			$this->assertCount($e1, $p1);
		}

		/**
		 * This method provides the data for testing the making of a value.
		 *
		 * @return array
		 */
		public function dataMake() {
			$data = array(
				array(array(Int32\Type::zero(), Int32\Type::one()), array(Int32\Type::zero(), Int32\Type::one())),
			);
			return $data;
		}

		/**
		 * This method tests the making of a value.
		 *
		 * @dataProvider dataMake
		 */
		public function testMake(array $provided, array $expected) {
			//$this->markTestIncomplete();

			$p0 = HashSet\Type::make($provided);

			$this->assertInstanceOf('\\Saber\\Data\\HashSet\\Type', $p0);

			$p1 = $p0->unbox();
			$e1 = count($expected);

			$this->assertInternalType('array', $p1);
			$this->assertCount($e1, $p1);
		}

		/**
		 * This method tests the creation of an empty list.
		 */
		public function testEmpty() {
			//$this->markTestIncomplete();

			$p0 = HashSet\Type::empty_();

			$this->assertInstanceOf('\\Saber\\Data\\HashSet\\Type', $p0);

			$p1 = $p0->unbox();
			$e1 = 0;

			$this->assertInternalType('array', $p1);
			$this->assertCount($e1, $p1);
		}

		#endregion

		#region Tests -> Interface

		/**
		 * This method tests that all items are cleared from a list.
		 */
		public function testClear() {
			//$this->markTestIncomplete();

			$p0 = HashSet\Type::make(array(Int32\Type::zero(), Int32\Type::one(), Int32\Type::box(2)));

			$p1 = $p0->unbox();
			$this->assertCount(3, $p1);

			$p0 = $p0->clear();
			$p2 = $p0->unbox();
			$this->assertCount(0, $p2);
		}

		/**
		 * This method provides the data for testing that an item exists in the collection.
		 *
		 * @return array
		 */
		public function dataHasItem() {
			$data = array(
				array(array(Int32\Type::zero()), array(true)),
				array(array(Int32\Type::one()), array(true)),
				array(array(Int32\Type::box(2)), array(true)),
				array(array(Int32\Type::negative()), array(false)),
			);
			return $data;
		}

		/**
		 * This method tests that an item exists in the collection.
		 *
		 * @dataProvider dataHasItem
		 */
		public function testHasItem(array $provided, array $expected) {
			//$this->markTestIncomplete();

			$items = array(Int32\Type::zero(), Int32\Type::one(), Int32\Type::box(2));
			$p0 = HashSet\Type::make($items)->hasItem($provided[0]);
			$e0 = $expected[0];

			$this->assertInstanceOf('\\Saber\\Data\\Bool\\Type', $p0);
			$this->assertSame($e0, $p0->unbox());
		}

		/**
		 * This method provides the data for testing that a value is empty.
		 *
		 * @return array
		 */
		public function dataIsEmpty() {
			$data = array(
				array(array(), array(true)),
				array(array(Int32\Type::zero()), array(false)),
				array(array(Int32\Type::zero(), Int32\Type::one(), Int32\Type::box(2)), array(false)),
				array(array(Int32\Type::zero(), Int32\Type::zero(), Int32\Type::zero()), array(false)),
			);
			return $data;
		}

		/**
		 * This method tests that a value is empty.
		 *
		 * @dataProvider dataIsEmpty
		 */
		public function testIsEmpty(array $provided, array $expected) {
			//$this->markTestIncomplete();

			$p0 = HashSet\Type::make($provided)->isEmpty();
			$e0 = $expected[0];

			$this->assertInstanceOf('\\Saber\\Data\\Bool\\Type', $p0);
			$this->assertSame($e0, $p0->unbox());
		}

		/**
		 * This method tests that an item is accessible.
		 */
		public function testItems() {
			//$this->markTestIncomplete();

			$p0 = HashSet\Type::make(array(Int32\Type::zero(), Int32\Type::one(), Int32\Type::box(2)))->items();

			$this->assertInstanceOf('\\Saber\\Data\\ArrayList\\Type', $p0);

			$p1 = $p0->unbox();

			$this->assertInternalType('array', $p1);
			$this->assertCount(3, $p1);
		}

		/**
		 * This method provides the data for testing that an item is put in the collection.
		 *
		 * @return array
		 */
		public function dataPutItem() {
			$data = array(
				array(array(Int32\Type::zero()), array(1)),
				array(array(Int32\Type::zero(), Int32\Type::one()), array(2)),
				array(array(Int32\Type::zero(), Int32\Type::one(), Int32\Type::box(2)), array(3)),
				array(array(Int32\Type::zero(), Int32\Type::one(), Int32\Type::zero()), array(2)),
			);
			return $data;
		}

		/**
		 * This method tests that an item is put in the collection.
		 *
		 * @dataProvider dataPutItem
		 */
		public function testPutItem(array $provided, array $expected) {
			//$this->markTestIncomplete();

			$p0 = new HashSet\Type();

			foreach ($provided as $item) {
				$p0->putItem($item);
			}

			$p1 = $p0->size()->unbox();
			$e1 = $expected[0];

			$this->assertSame($e1, $p1);
		}

		/**
		 * This method provides the data for testing that an item is removed in the collection.
		 *
		 * @return array
		 */
		public function dataRemoveItem() {
			$data = array(
				array(array(Int32\Type::zero()), array(2)),
				array(array(Int32\Type::zero(), Int32\Type::one()), array(1)),
				array(array(Int32\Type::zero(), Int32\Type::one(), Int32\Type::box(2)), array(0)),
				array(array(Int32\Type::zero(), Int32\Type::one(), Int32\Type::zero()), array(1)),
			);
			return $data;
		}

		/**
		 * This method tests that an item is removed in the collection.
		 *
		 * @dataProvider dataRemoveItem
		 */
		public function testRemoveItem(array $provided, array $expected) {
			//$this->markTestIncomplete();

			$p0 = HashSet\Type::make(array(Int32\Type::zero(), Int32\Type::one(), Int32\Type::box(2)));

			foreach ($provided as $item) {
				$p0->removeItem($item);
			}

			$p1 = $p0->size()->unbox();
			$e1 = $expected[0];

			$this->assertSame($e1, $p1);
		}

		/**
		 * This method provides the data for testing that a value is of a particular size.
		 *
		 * @return array
		 */
		public function dataSize() {
			$data = array(
				array(array(), array(0)),
				array(array(Int32\Type::zero()), array(1)),
				array(array(Int32\Type::zero(), Int32\Type::one(), Int32\Type::box(2)), array(3)),
				array(array(Int32\Type::zero(), Int32\Type::zero(), Int32\Type::zero()), array(1)),
				array(array(Int32\Type::zero(), Int32\Type::zero(), Int32\Type::one(), Int32\Type::one()), array(2)),
			);
			return $data;
		}

		/**
		 * This method tests that a value is of a particular size.
		 *
		 * @dataProvider dataSize
		 */
		public function testSize(array $provided, array $expected) {
			//$this->markTestIncomplete();

			$p0 = HashSet\Type::make($provided)->size();

			$this->assertInstanceOf('\\Saber\\Data\\Int32\\Type', $p0);

			$p1 = $p0->unbox();
			$e1 = $expected[0];

			$this->assertSame($e1, $p1);
		}

		#endregion

	}

}