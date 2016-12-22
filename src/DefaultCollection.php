<?php
/* ===========================================================================
 * Copyright 2013-2016 The Opis Project
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *    http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 * ============================================================================ */

namespace Opis\Validation;

use Opis\Validation\Validators\Between;
use Opis\Validation\Validators\Email;
use Opis\Validation\Validators\Equal;
use Opis\Validation\Validators\FileMatch;
use Opis\Validation\Validators\FileType;
use Opis\Validation\Validators\GreaterThan;
use Opis\Validation\Validators\GreaterThanOrEqual;
use Opis\Validation\Validators\Length;
use Opis\Validation\Validators\LessThan;
use Opis\Validation\Validators\LessThanOrEqual;
use Opis\Validation\Validators\Match;
use Opis\Validation\Validators\MaxLength;
use Opis\Validation\Validators\MinLength;
use Opis\Validation\Validators\Number;
use Opis\Validation\Validators\Regex;
use Opis\Validation\Validators\Required;
use Opis\Validation\Validators\RequiredFile;

class DefaultCollection extends ValidatorCollection
{
    /**
     * @param string $name
     * @return bool|ValidatorInterface
     */
    public function get(string $name)
    {
        if (false !== $validator = parent::get($name)) {
            return $validator;
        }

        $validator = $this->resolveValidator($name);
        return $this->validators[$name] = $validator;
    }

    /**
     * @param string $name
     * @return bool|ValidatorInterface
     */
    protected function resolveValidator(string $name)
    {
        switch ($name) {
            case 'required':
                return new Required();
            case 'length':
                return new Length();
            case 'minLength':
                return new MinLength();
            case 'maxLength':
                return new MaxLength();
            case 'gt':
                return new GreaterThan();
            case 'lt':
                return new LessThan();
            case 'gte':
                return new GreaterThanOrEqual();
            case 'lte':
                return new LessThanOrEqual();
            case 'equal':
                return new Equal();
            case 'between':
                return new Between();
            case 'match':
                return new Match();
            case 'number':
                return new Number();
            case 'email':
                return new Email();
            case 'regex':
                return new Regex();
            case 'requiredFile':
                return new RequiredFile();
            case 'fileType':
                return new FileType();
            case 'fileMatch':
                return new FileMatch();
        }

        return false;
    }
}