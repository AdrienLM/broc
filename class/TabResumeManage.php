<?php
class TabResumeManage
{
  private $_db; // Instance de PDO
  private $resume=[];


  public function __construct($db)
  {
    $this->setDb($db);
    
  }

  public function add($idCompte)
  {

    // vérifier si idCompte déjà créé
    $q = $this->_db->prepare('SELECT * FROM .tabresume WHERE idCompte = '.$idCompte);
    $q->execute();
    $donnees = $q->fetch(PDO::FETCH_ASSOC);
    
    if($donnees==false)  // l'idCompte n'existe pas 
    {
    $q = $this->_db->prepare('INSERT INTO .tabresume (idCompte,resume1,resume2,resume3,resume4,resume5) VALUES(:idCompte,:resume1, :resume2, :resume3, :resume4, :resume5)');
    for($i=1;$i<=5;$i++) { $q->bindValue(':resume'.$i, 0); }
    $q->bindValue(':idCompte', $idCompte);
    $q->execute();
    return true;
  }
  else return false;  // l'idCompte existe déjà
  }

  public function delete($idCompte) // on efface idCompte de la base si il existe sinon RAS
  {
    $this->_db->exec('DELETE FROM .tabresume WHERE idCompte = '. $idCompte);
  }

   public function deleteAll() // on efface idCompte de la base si il existe sinon RAS
  {
    $this->_db->exec('TRUNCATE TABLE .tabresume');
  }

  public function get($idCompte)  // en fct d'un id on recupère tous les paramètres avec la clé de la base
  {
    $idCompte = (int) $idCompte;
    
    $q = $this->_db->query('SELECT idCompte, resume1, resume2, resume3, resume4 ,resume5 FROM .tabresume WHERE idCompte = '.$idCompte);
    $donnees = $q->fetch(PDO::FETCH_ASSOC);

    return $donnees;

  }

  public function getEtatResume($idCompte,$resumeNumber)  // en fct d'un id on recupère tous les paramètres 
  {
    $idCompte = (int) $idCompte;
    $data=[];
    global $debugQWClass;
    
    $q = $this->_db->query('SELECT idCompte, resume1, resume2, resume3, resume4 ,resume5 FROM .tabresume WHERE idCompte = '.$idCompte);
    $donnees = $q->fetch(PDO::FETCH_ASSOC);
    if(!empty($donnees)) 
    {
          $j=(int)0;
          foreach ($donnees as $key) 
          {
          $this->resume[$j]=$key;
          if($debugQWClass) { echo 'class : '.__CLASS__."\t".'/ fct : '.__FUNCTION__."\t".'/ ligne : '.__LINE__."\t".'/ var ... $resume['.$j.'] = '.$this->resume[$j].'<br>';}
          $j++;
          }
     if($this->resume[$resumeNumber]==1) return 1;
     else return 0;
   }
  else return -1; // retourne -1 si idcompte n'existe pas
  }


public function getEtatResumes($idCompte)  // en fct d'un id on recupère tous les paramètres selon une clé numérique
  {
    $idCompte = (int) $idCompte;
    $data=[];
    global $debugQWClass;

    $q = $this->_db->query('SELECT idCompte, resume1, resume2, resume3, resume4 ,resume5 FROM .tabresume WHERE idCompte = '.$idCompte);
    $donnees = $q->fetch(PDO::FETCH_ASSOC);
    
    if(!empty($donnees)) 
    {
          $j=(int)0;
          foreach ($donnees as $key) 
          {
          if($debugQWClass) print_r($key.'<br>');
          $this->resume[$j]=$key;
          if($debugQWClass) echo $this->resume[$j].'<br>';
          $j++;
          }
     return $this->resume;
    }
  else return -1; // retourne -1 si idcompte n'existe pas
  }



  public function getList() // on récupère la liste complète des tabresume (faire dump pour la trace à l'arrivée)
  {
    $listedonnees = [];

    $q = $this->_db->query('SELECT idCompte,resume1, resume2, resume3, resume4, resume5 FROM .tabresume ORDER BY idCompte');

    while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
    {
      $listedonnees[] = $donnees;
    }

    return $listedonnees;
  }

  
  public function updates($idCompte,array $resume) // Mise à jour de tous les resume
  {
    //$this->resume=$resume;
    $q = $this->_db->prepare('UPDATE .tabresume SET resume1 = :resume1, resume2 = :resume2, resume3 = :resume3, resume4 = :resume4, resume5 = :resume5 WHERE idCompte = :idCompte');
     for($i=1;$i<=5;$i++) { $q->bindValue(':resume'.$i, (int) $resume[$i] );}

    
    $q->bindValue(':idCompte', $idCompte);

    $q->execute();
  }

  public function setDb(PDO $db)
  {
    $this->_db = $db;
  }
}