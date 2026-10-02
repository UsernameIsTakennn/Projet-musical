<?php
require_once('CRUD.php');

// Section artiste
class Artiste {

    protected $id;
    protected $nom;
    protected $pays;
    protected $dateNaissance;
    protected $biographie;

    public function __construct($id = null, $nom = null, $pays = null, $dateNaissance = null, $biographie = null) {
        $this->id = $id;
        $this->nom = $nom;
        $this->pays = $pays;
        $this->dateNaissance = $dateNaissance;
        $this->biographie = $biographie;
    }

    public function getProp($prop){
        return $this->$prop;
    }

    public function setProp($prop, $value){
        $this->$prop = $value;
    }

    public function enregistrer(CRUD $crud){
        $data = [
            'nom' => $this->nom,
            'pays' => $this->pays,
            'date_naissance' => $this->dateNaissance,
            'biographie' => $this->biographie
        ];
        $insert = $crud->insert('artiste', $data);
        if ($insert) {
            $this->id = $insert;
        }
        return $insert;
    }

    public function modifier(CRUD $crud) {
        $data = [
            'id' => $this->id,
            'nom' => $this->nom,
            'pays' => $this->pays,
            'date_naissance' => $this->dateNaissance,
            'biographie' => $this->biographie
        ];
        return $crud->update('artiste', $data);
    }

    public function supprimer(CRUD $crud)
    {
        $stmt = $crud->prepare(
            "SELECT id FROM album WHERE artiste_id = :id"
        );
        $stmt->bindValue(':id', $this->id);
        $stmt->execute();

        $albums = $stmt->fetchAll();

        foreach ($albums as $album) {
            $stmt = $crud->prepare(
                "SELECT id FROM chanson WHERE album_id = :id"
            );
            $stmt->bindValue(':id', $album['id']);
            $stmt->execute();

            $chansons = $stmt->fetchAll();

            foreach ($chansons as $chanson) {
                $stmt = $crud->prepare(
                    "DELETE FROM chanson_genre WHERE chanson_id = :id"
                );
                $stmt->bindValue(':id', $chanson['id']);
                $stmt->execute();

                $crud->delete('chanson', $chanson['id']);
            }

            $crud->delete('album', $album['id']);
        }

        return $crud->delete('artiste', $this->id);
    }

    public static function tous(CRUD $crud){
        return $crud->select('artiste');
    }

    public static function trouver(CRUD $crud, $id){
        return $crud->selectId('artiste', $id);
    }

    public function albums(CRUD $crud){
        $sql = "SELECT * FROM album
            WHERE artiste_id = :id";

        $stmt = $crud->prepare($sql);
        $stmt->bindValue(':id', $this->id);
        $stmt->execute();

        return $stmt->fetchAll();
    }
}