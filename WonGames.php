<?php
namespace League\Business;

use League\Business\Results as RESULT;


/**
 * Calculating Hahn-Points 
 *
 * @author Dr.Holger Maerz <holger@nakade.de>
 */
class WonGames extends AbstractGameStats implements GameStatsInterface
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
            self::$instance = new WonGames();
        }
        
        return self::$instance;
    }      

    public function getNumberOfGames($playerId) 
    {
        
        $count=0;
        foreach($this->_all_matches as $match) {
            
            if( $match->getResultId()===null        ||
                $match->getResultId()==RESULT::DRAW || 
                $match->getResultId()==RESULT::SUSPENDED ) {
                
                continue;
            }    
   
            if($match->getWinnerId()==$playerId) {
                $count++;
            }    
            
        } 
      
        return $count;
    }
   
    
}

?>
