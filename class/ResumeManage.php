<?php
class ResumeManage
{
  private $_db; // Instance de PDO

  public function __construct($db)
  {
    $this->setDb($db);
  }

  public function add(Resume $bete)
  {
    //var_dump($bete);
    $q = $this->_db->prepare('INSERT INTO kleiz.dataresume (nom,image,description,position,imageUnlock) VALUES(:nom, :image, :description, :position, :imageUnlock)');

    $q->bindValue(':nom', $bete->nom());
    $q->bindValue(':image', $bete->image());
    $q->bindValue(':description', $bete->description());
    $q->bindValue(':position', $bete->position(), PDO::PARAM_INT);
    $q->bindValue(':imageUnlock', $bete->imageUnlock());
    $q->execute();

    $bete->hydrate([  // mise à jour de l'id
      'idResume'=>$this->_db->lastInsertId(),

      ]);
  }

  public function delete(Resume $bete) // on efface la bete avec cette id
  {
    $this->_db->exec('DELETE FROM kleiz.dataresume WHERE idResume = '.$bete->idResume());
  }

  public function deleteAll() 
  {
    $this->_db->exec('TRUNCATE TABLE kleiz.dataresume');
  }

  public function get($id)  // en fct d'un id on recupère tous les paramètres 
  {
    $id = (int) $id;

    $q = $this->_db->query('SELECT idResume, nom, image, description,position, imageUnlock FROM kleiz.dataresume WHERE idResume = '.$id);
    $donnees = $q->fetch(PDO::FETCH_ASSOC);

    return new Resume($donnees);
  }

  public function getList() // on récupère la liste complète des Resume (faire dump pour la trace à l'arrivée)
  {
    $bete = [];

    $q = $this->_db->query('SELECT idResume, nom, image, description,position, imageUnlock FROM kleiz.dataresume ORDER BY position');

    while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
    {
      $bete[] = new Resume($donnees);
    }

    return $bete;
  }

  public function update(Resume $bete)
  {
    $q = $this->_db->prepare('UPDATE kleiz.dataresume SET nom = :nom, image = :image, description = :description, position = :position , imageUnlock = :imageUnlock WHERE idResume = :idResume');

    $q->bindValue(':nom', $bete->nom());
    $q->bindValue(':image', $bete->image());
    $q->bindValue(':imageUnlock', $bete->imageUnlock());
    $q->bindValue(':description', $bete->description());
    $q->bindValue(':position', $bete->position(), PDO::PARAM_INT);
    $q->bindValue(':idResume', $bete->idResume(), PDO::PARAM_INT);
    $q->execute();
  }

  public function setDb(PDO $db)
  {
    $this->_db = $db;
  }
}