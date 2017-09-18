<?php 
    class Cat {
        //you can't run variables with expressions within a class eg. private $colour = trim($expression);
        private $colour;
        protected $name;
        // __contruct is called when new Cat() is declared. It can take parameters.
        public function __construct($catname) {
            //from inside class, refer to other members with 
            //$this->membername
            $this -> colour = "calico";
            $this -> name = $catname;
        }
        public function getColour() {
            return $this -> colour;
        }
        public function getName() {
            return $this -> name;
        }
    }
?>