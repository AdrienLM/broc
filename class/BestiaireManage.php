<?php
class BestiaireManage
{
  private $_db; // Instance de PDO

  public function __construct($db)
  {
    $this->setDb($db);
  }

  public function add(Bestiaire $bete)
  {
    //var_dump($bete);
    $q = $this->_db->prepare('INSERT INTO 18mmi2pj02.databestiaire (nom,image,description,position,imageUnlock) VALUES(:nom, :image, :description, :position, :imageUnlock)');

    $q->bindValue(':nom', $bete->nom());
    $q->bindValue(':image', $bete->image());
    $q->bindValue(':description', $bete->description());
    $q->bindValue(':position', $bete->position(), PDO::PARAM_INT);
    $q->bindValue(':imageUnlock', $bete->imageUnlock());
    $q->execute();

    $bete->hydrate([  // mise à jour de l'id
      'idBestiaire'=>$this->_db->lastInsertId(),

      ]);
  }

  public function delete(Bestiaire $bete) // on efface la bete avec cette id
  {
    $this->_db->exec('DELETE FROM 18mmi2pj02.databestiaire WHERE idBestiaire = '.$bete->idBestiaire());
  }

  public function deleteAll() 
  {
    $this->_db->exec('TRUNCATE TABLE 18mmi2pj02.databestiaire');
  }

  public function get($id)  // en fct d'un id on recupère tous les paramètres 
  {
    $id = (int) $id;

    $q = $this->_db->query('SELECT idBestiaire, nom, image, description,position, imageUnlock FROM 18mmi2pj02.databestiaire WHERE idBestiaire = '.$id);
    $donnees = $q->fetch(PDO::FETCH_ASSOC);

    return new Bestiaire($donnees);
  }

  public function getList() // on récupère la liste complète des Bestiaire (faire dump pour la trace à l'arrivée)
  {
    $bete = [];

    $q = $this->_db->query('SELECT idBestiaire, nom, image, description,position, imageUnlock FROM 18mmi2pj02.databestiaire ORDER BY position');

    while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
    {
      $bete[] = new Bestiaire($donnees);
    }

    return $bete;
  }

  public function update(Bestiaire $bete)
  {
    $q = $this->_db->prepare('UPDATE 18mmi2pj02.databestiaire SET nom = :nom, image = :image, description = :description, position = :position , imageUnlock = :imageUnlock WHERE idBestiaire = :idBestiaire');

    $q->bindValue(':nom', $bete->nom());
    $q->bindValue(':image', $bete->image());
    $q->bindValue(':imageUnlock', $bete->imageUnlock());
    $q->bindValue(':description', $bete->description());
    $q->bindValue(':position', $bete->position(), PDO::PARAM_INT);
    $q->bindValue(':idBestiaire', $bete->idBestiaire(), PDO::PARAM_INT);
    $q->execute();
  }

  public function setDb(PDO $db)
  {
    $this->_db = $db;
  }
}