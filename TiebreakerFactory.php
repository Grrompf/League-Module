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
class TiebreakerFactory {
    
    protected $_Tiebreaker;
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
           
           case "hahn":     $this->_Tiebreaker = HahnPoints::getInstance();
                            break;
               
           case "cuss"  :   $this->_Tiebreaker = CUSS::getInstance();
                            break;
                        
           default      :   throw new RuntimeException(
                sprintf('A unknown tiebreaker was provided.')
           );            
          
        }
        
        $this->_Tiebreaker->setMatches($this->_all_matches);
        return $this->_Tiebreaker->getTieBreaker($this->getPlayerId());
    }        
}

?>
