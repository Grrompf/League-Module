<?php
namespace League\Business;

use League\Business\Results as RESULT;

/**
 * Calculating Hahn-Points 
 *
 * @author Dr.Holger Maerz <holger@nakade.de>
 */
class HahnPoints extends AbstractGameStats implements TiebreakerInterface
{
    
    protected $_max_points=40;
    protected $_offset_points=20;

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
            self::$instance = new HahnPoints();
        }
        
        return self::$instance;
    }      
    
    public function getTieBreaker($playerId) 
    {
        
        $count=0;
        foreach($this->_all_matches as $match) {
            
            
            if($match->getResultId() ===null            ||
               $match->getResultId()==RESULT::SUSPENDED || 
               $match->getResultId()==RESULT::DRAW) {
               continue;
            }    
     
            if($match->getResultId()==RESULT::BYPOINTS   &&
               $match->getWinnerId()==$playerId ) {
                
               $count += $match->getPoints()+$this->_offset_points; 
               continue;
            }
            
            if($match->getResultId()==RESULT::BYPOINTS      &&
               $match->getPoints() < $this->_offset_points  &&     
               ($match->getBlackId()==$playerId || 
                $match->getWhiteId()==$playerId )) {
                
                
               $count += $match->getPoints(); 
               continue;
            }
            
            if($match->getWinnerId()==$playerId ) {
                
               $count +=$this->_max_points;
               
            }
               
            
        } 
      
        return $count;
    }
   
    
}

?>
