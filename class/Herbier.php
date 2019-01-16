<?php

class Herbier 
{

private $_idHerbier;
private $_nom;	// Taureau bleu ... korrigan
private $_image; // photo dans la base de donnée transparent ou débloqué dans la BDD
private $_description; // Si débloqué renseigne sur le nom ... description dans la base de donnée
private $_position;	// position sur l'écran ... attention au problème du responsive
private $_imageUnlock;

public function __construct(array $donnees)
{
	$this->hydrate($donnees);
}

public function hydrate(array $donnees)
{
	foreach ($donnees as $key => $value) 
	{
		$methode = 'set'.ucfirst($key);
		if(method_exists($this, $methode))
		{
			$this->$methode($value);
		}
	}
}

// GETTERS //
public function idHerbier()	{ 	return $this->_idHerbier; }
public function image()	{	return $this->_image;	}
public function imageUnlock()	{	return $this->_imageUnlock;	}
public function nom()	{	return $this->_nom;	}
public function description()	{	return $this->_description;	}
public function position()	{	return $this->_position;	}


// SETTERS //
public function setIdHerbier($idHerbier)
{
	$idHerbier =(int) $idHerbier;
	if($idHerbier > 0) 
	{
		$this->_idHerbier=$idHerbier;
	}
}
public function setImage($image)
{
	if(is_string($image))
	{
		$this->_image=$image;
	}
}

public function setImageUnlock($imageUnlock)
{
	if(is_string($imageUnlock))
	{
		$this->_imageUnlock=$imageUnlock;
	}
}

public function setNom($nom)
{
	if(is_string($nom))
	{
		$this->_nom=$nom;
	}
}

public function setDescription($description)
{
	if(is_string($description))
	{
		$this->_description=$description;
	}
}

public function setPosition($position)
{
	$position =(int) $position;
	if($position > 0) 
	{
		$this->_position=$position;
	}
}

}

?>
