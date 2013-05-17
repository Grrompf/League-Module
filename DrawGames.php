<?php
namespace League\Business;

use League\Business\Results as RESULT;

/**
 * Calculating Hahn-Points 
 *
 * @author Dr.Holger Maerz <holger@nakade.de>
 */
class DrawGames extends AbstractGameStats implements GameStatsInterface
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
            self::$instance = new DrawGames();
        }
        
        return self::$instance;
    }      

    public function getNumberOfGames($playerId) 
    {
        
        $count=0;
        foreach($this->_all_matches as $match) {
            
            if($match->getResultId()===null    ||
               $match->getResultId()!=RESULT::DRAW) {
                continue;
            }    
     
            if( $match->getBlackId()==$playerId || 
                $match->getWhiteId()==$playerId ) {
                
                $count++;
            }    
            
        } 
      
       return $count;
        
    }
   
    
}

?>
