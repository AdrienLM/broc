<?php
class TabHerbierManage
{
  private $_db; // Instance de PDO
  private $stick=[];


  public function __construct($db)
  {
    $this->setDb($db);
    
  }

  public function add($idCompte)
  {

    
    $q = $this->_db->prepare('SELECT * FROM kleiz.tabherbier WHERE idCompte = '.$idCompte);
    $q->execute();
    $donnees = $q->fetch(PDO::FETCH_ASSOC);
    
    if($donnees==false)  // l'idCompte n'existe pas 
    {
    $q = $this->_db->prepare('INSERT INTO kleiz.tabherbier (idCompte,stick1,stick2,stick3,stick4,stick5) VALUES(:idCompte,:stick1, :stick2, :stick3, :stick4, :stick5)');
    for($i=1;$i<=5;$i++) { $q->bindValue(':stick'.$i, 0); }
    $q->bindValue(':idCompte', $idCompte);
    $q->execute();
    return true;
  }
  else return false;  // l'idCompte existe déjà
  }

  public function delete($idCompte) // on efface idCompte de la base si il existe sinon RAS
  {
    $this->_db->exec('DELETE FROM kleiz.tabherbier WHERE idCompte = '. $idCompte);
  }

   public function deleteAll() // on efface idCompte de la base si il existe sinon RAS
  {
    $this->_db->exec('TRUNCATE TABLE kleiz.tabherbier');
  }

  public function get($idCompte)  // en fct d'un id on recupère tous les paramètres avec la clé de la base
  {
    $idCompte = (int) $idCompte;
    
    $q = $this->_db->query('SELECT idCompte, stick1, stick2, stick3, stick4 ,stick5 FROM kleiz.tabherbier WHERE idCompte = '.$idCompte);
    $donnees = $q->fetch(PDO::FETCH_ASSOC);

    return $donnees;

  }

  public function getEtatStick($idCompte,$stickNumber)  // en fct d'un id on recupère tous les paramètres 
  {
    $idCompte = (int) $idCompte;
    $data=[];
    global $debugQWClass;
    
    $q = $this->_db->query('SELECT idCompte, stick1, stick2, stick3, stick4 ,stick5 FROM kleiz.tabherbier WHERE idCompte = '.$idCompte);
    $donnees = $q->fetch(PDO::FETCH_ASSOC);
    if(!empty($donnees)) 
    {
          $j=(int)0;
          foreach ($donnees as $key) 
          {
          $this->stick[$j]=$key;
          if($debugQWClass) { echo 'class : '.__CLASS__."\t".'/ fct : '.__FUNCTION__."\t".'/ ligne : '.__LINE__."\t".'/ var ... $stick['.$j.'] = '.$this->stick[$j].'<br>';}
          $j++;
          }
     if($this->stick[$stickNumber]==1) return 1;
     else return 0;
   }
  else return -1; // retourne -1 si idcompte n'existe pas
  }


public function getEtatSticks($idCompte)  // en fct d'un id on recupère tous les paramètres selon une clé numérique
  {
    $idCompte = (int) $idCompte;
    $data=[];
    global $debugQWClass;

    $q = $this->_db->query('SELECT idCompte, stick1, stick2, stick3, stick4 ,stick5 FROM kleiz.tabherbier WHERE idCompte = '.$idCompte);
    $donnees = $q->fetch(PDO::FETCH_ASSOC);
    
    if(!empty($donnees)) 
    {
          $j=(int)0;
          foreach ($donnees as $key) 
          {
          if($debugQWClass) print_r($key.'<br>');
          $this->stick[$j]=$key;
          if($debugQWClass) echo $this->stick[$j].'<br>';
          $j++;
          }
     return $this->stick;
    }
  else return -1; // retourne -1 si idcompte n'existe pas
  }



  public function getList() // on récupère la liste complète des Herbier (faire dump pour la trace à l'arrivée)
  {
    $listedonnees = [];

    $q = $this->_db->query('SELECT idCompte,stick1, stick2, stick3, stick4, stick5 FROM kleiz.tabherbier ORDER BY idCompte');

    while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
    {
      $listedonnees[] = $donnees;
    }

    return $listedonnees;
  }

  //public function update($idCompte,$stickNumber)
  //{
   // $q = $this->_db->prepare('UPDATE kleiz.tabherbier SET stick'.$stickNumber.' = :stick'.$stickNumber.WHERE idCompte = '.$idCompte');
  // $q->bindValue(':stick'.$stickNumber, (int) 1);}

    //$q->bindValue(':stick1', (int) ($stickNumber==1));
    //$q->bindValue(':stick2', (int) ($stickNumber==2));
    //$q->bindValue(':stick3', (int) ($stickNumber==3));
    //$q->bindValue(':stick4', (int) ($stickNumber==4));
    //$q->bindValue(':stick5', (int) ($stickNumber==5));
    //$q->bindValue(':idCompte', $idCompte);

  //  $q->execute();
  //}

  public function updates($idCompte,array $stick) // Mise à jour de tous les sticks
  {
    //$this->stick=$stick;
    $q = $this->_db->prepare('UPDATE kleiz.tabherbier SET stick1 = :stick1, stick2 = :stick2, stick3 = :stick3, stick4 = :stick4, stick5 = :stick5 WHERE idCompte = :idCompte');
     for($i=1;$i<=5;$i++) { $q->bindValue(':stick'.$i, (int) $stick[$i] );}

    //$q->bindValue(':stick1', (int) ($stick[1]));
    //$q->bindValue(':stick2', (int) ($stick[2]));
    //$q->bindValue(':stick3', (int) ($stick[3]));
    //$q->bindValue(':stick4', (int) ($stick[4]));
    //$q->bindValue(':stick5', (int) ($stick[5]));
    $q->bindValue(':idCompte', $idCompte);

    $q->execute();
  }

  public function setDb(PDO $db)
  {
    $this->_db = $db;
  }
}