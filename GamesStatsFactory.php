<?php
namespace League\Business;

use RuntimeException;
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PizzaFactory
 *
 * @author Dr.Holger Maerz <holger@nakade.de>
 */
class GamesStatsFactory {
    
    protected $_GameStats;
    protected $_all_matches;
    protected $_playerId;
    
    public function __construct($allMatches) {
        $this->_all_matches=$allMatches;
    }
    
    public function setPlayerId($playerId)
    {
        $this->_playerId=$playerId;
        return $this;
    }        
    
    public function getPlayerId()
    {
        return $this->_playerId;
    }        
    
    public function getPoints($typ)
    {
       
        switch (strtolower($typ)) {
           
           case "played":   $this->_GameStats = PlayedGames::getInstance();
                            break;
               
           case "lost"  :   $this->_GameStats = LostGames::getInstance();
                            break;
                    
           case "won":      $this->_GameStats = WonGames::getInstance();
                            break;
                        
           case "draw":     $this->_GameStats = DrawGames::getInstance();
                            break;
                        
           case "suspended":$this->_GameStats = SuspendedGames::getInstance();
                            break;
                        
           default      :   throw new RuntimeException(
                sprintf('An unknown tiebreaker was provided.')
           );              
        }
        
        
        $this->_GameStats->setMatches($this->_all_matches);
        return $this->_GameStats->getNumberOfGames($this->getPlayerId());
    }        
}

?>
