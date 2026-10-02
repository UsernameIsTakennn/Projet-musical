<?php
require_once('CRUD.php');

// Section album
class Album{

    protected $id;
    protected $titre;
    protected $dateSortie;
    protected $description;
    protected $artisteId;

    public function __construct($id = null, $titre = null, $dateSortie = null, $description = null, $artisteId = null)
    {
        $this->id = $id;
        $this->titre = $titre;
        $this->dateSortie = $dateSortie;
        $this->description = $description;
        $this->artisteId = $artisteId;
    }

    public function getProp($prop) {
        return $this->$prop;
    }

    public function setProp($prop, $value) {
        $this->$prop = $value;
    }

    public function enregistrer(CRUD $crud){
        $data = [
            'titre' => $this->titre,
            'date_sortie' => $this->dateSortie,
            'description' => $this->description,
            'artiste_id' => $this->artisteId
        ];

        $insert = $crud->insert('album', $data);

        if($insert){
            $this->id = $insert;
        }

        return $insert;
    }

    public function modifier(CRUD $crud){
        $data = [
            'id' => $this->id,
            'titre' => $this->titre,
            'date_sortie' => $this->dateSortie,
            'description' => $this->description,
            'artiste_id' => $this->artisteId
        ];
        return $crud->update('album', $data);
    }

    public function supprimer(CRUD $crud)
    {
        $stmt = $crud->prepare(
            "SELECT id FROM chanson WHERE album_id = :id"
        );
        $stmt->bindValue(':id', $this->id);
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

        return $crud->delete('album', $this->id);
    }

    public static function tous(CRUD $crud){
        return $crud->select('album');
    }

    public static function trouver(CRUD $crud, $id){
        return $crud->selectId('album', $id);
    }

    public function chansons(CRUD $crud){
        $sql = "SELECT * FROM chanson
            WHERE album_id = :id";

        $stmt = $crud->prepare($sql);
        $stmt->bindValue(':id', $this->id);
        $stmt->execute();

        return $stmt->fetchAll();
    }
}