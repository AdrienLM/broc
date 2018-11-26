<?php
class HerbierManage
{
  private $_db; // Instance de PDO

  public function __construct($db)
  {
    $this->setDb($db);
  }

  public function add(Herbier $bete)
  {
    //var_dump($bete);
    $q = $this->_db->prepare('INSERT INTO kleiz.dataherbier (nom,image,description,position,imageUnlock) VALUES(:nom, :image, :description, :position, :imageUnlock)');

    $q->bindValue(':nom', $bete->nom());
    $q->bindValue(':image', $bete->image());
    $q->bindValue(':description', $bete->description());
    $q->bindValue(':position', $bete->position(), PDO::PARAM_INT);
    $q->bindValue(':imageUnlock', $bete->imageUnlock());
    $q->execute();

    $bete->hydrate([  // mise à jour de l'id
      'idHerbier'=>$this->_db->lastInsertId(),

      ]);
  }

  public function delete(Herbier $bete) // on efface la bete avec cette id
  {
    $this->_db->exec('DELETE FROM kleiz.dataherbier WHERE idHerbier = '.$bete->idHerbier());
  }

  public function deleteAll() 
  {
    $this->_db->exec('TRUNCATE TABLE kleiz.dataherbier');
  }


  public function get($id)  // en fct d'un id on recupère tous les paramètres 
  {
    $id = (int) $id;

    $q = $this->_db->query('SELECT idHerbier, nom, image, description,position, imageUnlock FROM kleiz.dataherbier WHERE idHerbier = '.$id);
    $donnees = $q->fetch(PDO::FETCH_ASSOC);

    return new Herbier($donnees);
  }

  public function getList() // on récupère la liste complète des Herbier (faire dump pour la trace à l'arrivée)
  {
    $bete = [];

    $q = $this->_db->query('SELECT idHerbier, nom, image, description,position, imageUnlock FROM kleiz.dataherbier ORDER BY position');

    while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
    {
      $bete[] = new Herbier($donnees);
    }

    return $bete;
  }

  public function update(Herbier $bete)
  {
    $q = $this->_db->prepare('UPDATE kleiz.dataherbier SET nom = :nom, image = :image, description = :description, position = :position , imageUnlock = :imageUnlock WHERE idHerbier = :idHerbier');

    $q->bindValue(':nom', $bete->nom());
    $q->bindValue(':image', $bete->image());
    $q->bindValue(':imageUnlock', $bete->imageUnlock());
    $q->bindValue(':description', $bete->description());
    $q->bindValue(':position', $bete->position(), PDO::PARAM_INT);
    $q->bindValue(':idHerbier', $bete->idHerbier(), PDO::PARAM_INT);
    $q->execute();
  }

  public function setDb(PDO $db)
  {
    $this->_db = $db;
  }
}