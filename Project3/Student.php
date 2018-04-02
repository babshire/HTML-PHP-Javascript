<?php
	declare(strict_types=1);
	
	
	class Student {
		private $name;
		private $grade;
	
		public function __construct(string $name, string $grade) {
			$this->name = $name;		// Notice this->name (no $ for name)
			$this->grade = $grade;  // We need $this-> to refer to data members
		}
	
		public function __toString() {
			return "<b>Name:</b> ".$this->name.", <b>grade:</b> ".$this->grade;		
		}

		public function getName() {
			return $this->name;
		}
		public function __setName(string $name) {
			$this->name = $name;
		}

	
		public function getGrade() {
			return $this->grade;
		}
		public function setGrade(string $grade) {
			$this->grade = $grade;
		}

	}
?>