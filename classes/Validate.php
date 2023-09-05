<?php
	class Validate {
		private $_passed = false,
				$_errors = array(),
				$_db = null;

		public function __construct() {
			$this->_db = Database::getInstance();
		}

		public function check($source, $items = array()) {
			foreach ($items as $item => $rules) {
				foreach ($rules as $rule => $rule_value) {

					$value 	= trim($source[$item]);
                    if (array_key_exists('fieldName', $rules)) {
                        $fieldName	= escape($rules['fieldName']);
                    } else{
                        $fieldName 	= escape($item);
                    }



					if ($rule === 'required' && empty($value)) {
						$this->addError("<div class='alert alert-danger'>&#34;{$fieldName}&#34; обязательное поле</div>");
					} else if (!empty($value)) {
						switch ($rule) {
							case 'min':
								if (strlen($value) < $rule_value) {
									$this->addError("<div class='alert alert-danger'>&#34;{$fieldName}&#34; поле должно состоять минимум из {$rule_value} символов</div>");
								}
								break;
							case 'max':
								if (strlen($value) > $rule_value) {
									$this->addError("<div class='alert alert-danger'>&#34;{$fieldName}&#34; поле должно состоять максимум из {$rule_value} символов</div>");
								}
								break;
							case 'matches':
								if ($value != $source[$rule_value]) {
									$this->addError("<div class='alert alert-danger'>&#34;{$rule_value}&#34; должно соответствовать &#34;{$fieldName}&#34;</div>");
								}
								break;
							case 'unique':
								$check = $this->_db->get($rule_value,array($item, '=' , $value));
								if ($check->count()) {
									$this->addError("<div class='alert alert-danger'>&#34;{$fieldName}&#34; уже существует</div>");
								}
								break;
						}
					}
				}
			}

			if (empty($this->_errors)) {
				$this->_passed = true;
			}

			return $this;
		}

		private function addError($error) {
			$this->_errors[] = $error;
		}

		public function errors() {
			return $this->_errors;
		}

		public function passed() {
			return $this->_passed;
		}
	}
?>