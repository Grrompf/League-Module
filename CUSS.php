<?php
namespace League\Business;

use League\Business\Results as RESULT;


/**
 * Calculating Hahn-Points 
 *
 * @author Dr.Holger Maerz <holger@nakade.de>
 */
class CUSS extends AbstractGameStats implements TiebreakerInterface
{
    
    /**
    * @var AbstractGameStats 
    */
    private static $instance =null;
    
   /**
    * Singleton Pattern for preventing object inflation.
    * @return AbstractGameStats
    */
    public static function getInstance()
    {
        if(self::$instance == null) {
            self::$instance = new CUSS();
        }
        
        return self::$instance;
    }      
    
    public function getTieBreaker($playerId) 
    {
       
        $count=0;
        $cuss=0;
        foreach($this->_all_matches as $match) {
            
            
            if($match->getResultId() ===null            ||
               $match->getResultId()==RESULT::SUSPENDED ) {
                
               continue;
            }    
     
            if($match->getWinnerId()==$playerId    ||
               $match->getResultId()==RESULT::DRAW ) {
                
               $count++; 
               $cuss += $count;
               continue;
            }
            
            $cuss += $count;
        } 
      
        return $cuss;
        
    }
   
    
}

?>
