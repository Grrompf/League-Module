<?php
namespace League\Business;

use League\Business\Results as RESULT;

/**
 * Calculating Hahn-Points 
 *
 * @author Dr.Holger Maerz <holger@nakade.de>
 */
class SuspendedGames extends AbstractGameStats implements GameStatsInterface
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
            self::$instance = new SuspendedGames();
        }
        
        return self::$instance;
    }      

    public function getNumberOfGames($playerId) 
    {
        
        $count=0;
        foreach($this->_all_matches as $match) {
            
            $blackId = $match->getBlackId();
            $whiteId = $match->getWhiteId();
            
            if($match->getResultId() ===null ||
               $match->getResultId()!=RESULT::SUSPENDED ) {
                continue;
            }    
     
            if($blackId==$playerId || $whiteId==$playerId) {
                $count++;
            }    
            
        } 
      
        return $count;
    }
   
    
}

?>
