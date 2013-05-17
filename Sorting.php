<?php
namespace League\Business;


/**
 * Description of Results
 *
 * @author Dr.Holger Maerz <holger@nakade.de>
 */
class Sorting
{
    const BY_POINTS='points';
    const BY_NAME='name';
    const BY_SUSPENDED_GAMES='supendedGames';
    const BY_PLAYED_GAMES='playedGames';
    const BY_WON_GAMES='winGames';
    const BY_LOST_GAMES='lostGames';
    const BY_DRAW_GAMES='drawGames';
    const BY_FIRST_TIEBREAK='firstTiebreak';
    const BY_SECOND_TIEBREAK='secondTiebreak';
    const BY_THIRD_TIEBREAK='thirdTiebreak';
    
    public function sorting(&$playersInLeague, $sort=Sorting::BY_POINTS) 
    {
       $method = 'sortBy' . ucfirst($sort);  
       if(!method_exists($this, $method))
           $method='sortBy' . ucfirst('points');      
       
       usort($playersInLeague, array($this, $method));
       
    }
    
    protected function sortByName($a, $b) {
        
           $method =  "get" . ucfirst('player');
           if(strcmp($a->$method()->getShortName(),$b->$method()->getShortName())==0)
               return $this->sortByPoints($a, $b);
        
           return (strcmp($a->$method()->getShortName(),$b->$method()->getShortName()));
            
    }
    
    protected function sortBySuspendedGames($a, $b) {
        
           $method =  "get" . ucfirst('gamesSuspended');
           if($a->$method()==$b->$method())
               return $this->sortByPoints($a, $b);
        
           return ($a->$method()>$b->$method())?-1:1;
            
    }
    
    
    protected function sortByPlayedGames($a, $b) {
        
           $method =  "get" . ucfirst('gamesPlayed');
           if($a->$method()==$b->$method())
               return $this->sortByPoints($a, $b);
        
           return ($a->$method()>$b->$method())?-1:1;
            
    }
    
    protected function sortByWin($a, $b) {
        
           $method =  "get" . ucfirst('gamesWin');
           if($a->$method()==$b->$method())
               return $this->sortByPoints($a, $b);
        
           return ($a->$method()>$b->$method())?-1:1;
            
    }
    
    protected function sortByLost($a, $b) {
        
           $method =  "get" . ucfirst('gamesLost');
           if($a->$method()==$b->$method())
               return $this->sortByPoints($a, $b);
        
           return ($a->$method()>$b->$method())?-1:1;
            
    }
    
    protected function sortByDraw($a, $b) {
        
           $method =  "get" . ucfirst('gamesDraw');
           if($a->$method()==$b->$method())
               return $this->sortByPoints($a, $b);
        
           return ($a->$method()>$b->$method())?-1:1;
            
    }
    
    protected function sortByPoints($a, $b) {
        
           $method =  "get" . ucfirst('gamesPoints'); 
           if($a->$method()==$b->$method())
               return $this->sortByFirstTiebreak($a, $b);
        
           return ($a->$method()>$b->$method())?-1:1;
            
    }
  
    protected function sortByFirstTiebreak($a, $b) {
        
           $method =  "get" . ucfirst('firstTiebreak'); 
           if($a->$method()==$b->$method())
               return $this->sortBySecondTiebreak($a, $b);
        
           return ($a->$method()>$b->$method())?-1:1;
            
    }

    protected function sortBySecondTiebreak($a, $b) {
        
           $method =  "get" . ucfirst('secondTiebreak'); 
           if($a->$method()==$b->$method())
               return sortByThirdTiebreak($a, $b);
        
           return ($a->$method()>$b->$method())?-1:1;
            
    }
    
    protected function sortByThirdTiebreak($a, $b) {
        
           $method =  "get" . ucfirst('thirdTiebreak'); 
           if($a->$method()==$b->$method())
               return 0;
        
           return ($a->$method()>$b->$method())?-1:1;
            
    }
    

}

?>
