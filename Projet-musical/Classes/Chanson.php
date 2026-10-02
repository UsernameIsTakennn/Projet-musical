<?php
require_once('Style.php');
require_once('CRUD.php');

// Section chanson
class Chanson extends Style {

    protected $id;
    protected $titre;
    protected $duration;
    protected $dateSortie;
    protected $albumId;

    public function __construct($id = null, $titre = null, $duration = null, $dateSortie = null, $albumId = null){
        parent::__construct($id);
        
        $this->titre = $titre;
        $this->dateSortie = $dateSortie;
        $this->duration = $duration;
        $this->albumId = $albumId;
    }

    public function getProp($prop){
        return $this->$prop;
    }

    public function setProp($prop, $value){
        $this->$prop = $value;
    }

    public function enregistrer(CRUD $crud){
        $data = [
            'titre' => $this->titre,
            'duration' => $this->duration,
            'date_sortie' => $this->dateSortie,
            'album_id' => $this->albumId
        ];

        $insert = $crud->insert('chanson', $data);

        if ($insert) {
            $this->id = $insert;
        }

        return $insert;
    }

    public function modifier(CRUD $crud){
        $data = [
            'id' => $this->id,
            'titre' => $this->titre,
            'duration' => $this->duration,
            'date_sortie' => $this->dateSortie,
            'album_id' => $this->albumId
        ];
        return $crud->update('chanson', $data);
    }

    public function supprimer(CRUD $crud)
    {
        $stmt = $crud->prepare(
            "DELETE FROM chanson_genre WHERE chanson_id = :id"
        );
        $stmt->bindValue(':id', $this->id);
        $stmt->execute();

        return $crud->delete('chanson', $this->id);
    }

    public static function tous(CRUD $crud){
        return $crud->select('chanson');
    }

    public static function trouver(CRUD $crud, $id){
        return $crud->selectId('chanson', $id);
    }

    // Compte le nombre de genres associés à cette chanson
    public function nombreGenres(CRUD $crud){
        $stmt = $crud->prepare("SELECT COUNT(*) FROM chanson_genre WHERE chanson_id = :id");
        $stmt->bindValue(':id', $this->id);
        $stmt->execute();

        return (int) $stmt->fetchColumn();
    }

    // Retourne les genres associés à cette chanson
    public function genres(CRUD $crud){
        $sql = "SELECT genre.* FROM genre
                INNER JOIN chanson_genre ON genre.id = chanson_genre.genre_id
                WHERE chanson_genre.chanson_id = :id";

        $stmt = $crud->prepare($sql);
        $stmt->bindValue(':id', $this->id);
        $stmt->execute();

        return $stmt->fetchAll();
    }
}