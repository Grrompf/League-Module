<?php
namespace League\Business;


/**
 * Description of Results
 *
 * @author Dr.Holger Maerz <holger@nakade.de>
 */
class MatchStats 
{
    protected $_Factory;
    protected $_TiebreakerFactory;
    protected $_points_for_win=3;
    protected $_points_for_draw=1;
    protected $_first_tiebreak ='Hahn';
    protected $_second_tiebreak='CUSS';
    protected $_third_tiebreak ='CUSS';
    
    public function __construct($allMatches)
    {
        $this->_Factory           = new GamesStatsFactory($allMatches);
        $this->_TiebreakerFactory = new TiebreakerFactory($allMatches);
      
    }        
    
    public function setFirstTiebreak($name)
    {
        $this->_first_tiebreak = $name;
        return $this;
    } 
  
    public function getFirstTiebreak()
    {
        return $this->_first_tiebreak;
    }
  
    public function setSecondTiebreak($name)
    {
        $this->_second_tiebreak = $name;
        return $this;
    } 
  
    public function getSecondTiebreak()
    {
        return $this->_second_tiebreak;
    }
  
    public function getGamesStats($playerId) 
    {
        $this->_Factory->setPlayerId($playerId);
        $this->_TiebreakerFactory->setPlayerId($playerId);
                
        $results = array(
           'gamesPlayed'    => $this->_Factory->getPoints('played'),
           'gamesSuspended' => $this->_Factory->getPoints('suspended'),
           'gamesWin'       => $this->_Factory->getPoints('won'),
           'gamesDraw'      => $this->_Factory->getPoints('draw'),
           'gamesLost'      => $this->_Factory->getPoints('lost'),
           'gamesPoints'    => $this->getPoints(),
           'firstTiebreak'  => $this->_TiebreakerFactory
                                    ->getPoints($this->_first_tiebreak),
           'secondTiebreak' => $this->_TiebreakerFactory
                                    ->getPoints($this->_second_tiebreak),
           'thirdTiebreak' => $this->_TiebreakerFactory
                                    ->getPoints($this->_third_tiebreak),
          
        );
        
        return $results;
    }
    
    protected function getPoints() 
    {
        return  $this->_Factory->getPoints('won') * $this->_points_for_win +
                $this->_Factory->getPoints('draw') * $this->_points_for_draw;
    }
    
    public function sorting(&$playersInLeague, $sort=Sorting::BY_POINTS) 
    {
       $s = new Sorting();
       $s->sorting($playersInLeague, $sort);
       
    }
    

}

?>
