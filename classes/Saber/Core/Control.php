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

namespace Saber\Core {

	use \Saber\Core;

	class Control implements Core\Monad {

		public static function choice(Core\Any $object/*, Core\Int32 $index*/) {
			$index = (func_num_args() > 0) ? func_get_arg(0) : Core\Int32::zero();
			return new Core\Control\Choice\Cons($object, $index);
		}

	}

}