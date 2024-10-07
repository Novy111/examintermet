<?php



class book {

    public $name;
    public $price;
    
    function __construct($name,$price) {
    $this->name = $name ;
    $this->price = $price;
    
    }
    
    
    public function intro(){
    
    echo "this book is {$this->name} and the price is {$this->price}.";
        
    }
    
    }
    
      class novel extends book {
        public $Authors_name;
    
        function __construct($name,$price,$Authors_name) {
          $this->name = $name ;
          $this->price = $price;
          $this->Authors_name = $Authors_name;
          
          }
       
    public function intro_novel(){
    
        echo "this novel is {$this->name} and the price is {$this->price} and the novel Authors {$this->Authors_name}.";
            
        }
          }
        
  