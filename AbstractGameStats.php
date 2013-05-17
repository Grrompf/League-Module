<?php
namespace League\Business;

/**
 * Description of AbstractTranslatorClass
 *
 * @author Dr.Holger Maerz <holger@nakade.de>
 */
abstract class AbstractGameStats 
{
    
    protected $_all_matches;
    
    
    public function setMatches($allMatches) {
        
        $this->_all_matches = $allMatches;
        return $this;
    }
    
    public function getMatches() {
        
        return $this->_all_matches;
    }
    
}

?>
