<?php
require_once('Style.php');
require_once('CRUD.php');

// Section genre
class Genre extends Style{

    protected $id;
    protected $nom;

    public function __construct($id = null, $nom = null){
        parent::__construct($id);
        
        $this->nom = $nom;
    }

    public function getProp($prop){
        return $this->$prop;
    }

    public function setProp($prop, $value){
        $this->$prop = $value;
    }

    public function enregistrer(CRUD $crud){
        $data = [
            'nom' => $this->nom
        ];

        $insert = $crud->insert('genre', $data);

        if ($insert) {
            $this->id = $insert;
        }

        return $insert;
    }

    public function modifier(CRUD $crud){
        $data = [
            'id' => $this->id,
            'nom' => $this->nom
        ];

        return $crud->update('genre', $data);
    }

    public function supprimer(CRUD $crud)
    {
        $stmt = $crud->prepare(
            "DELETE FROM chanson_genre WHERE genre_id = :id"
        );
        $stmt->bindValue(':id', $this->id);
        $stmt->execute();

        return $crud->delete('genre', $this->id);
    }

    public static function tous(CRUD $crud){
        return $crud->select('genre');
    }

    public static function trouver(CRUD $crud, $id){
        return $crud->selectId('genre', $id);
    }

    // Compte le nombre de chansons associées à ce genre
    public function nombreChansons(CRUD $crud){
        $stmt = $crud->prepare("SELECT COUNT(*) FROM chanson_genre WHERE genre_id = :id");
        $stmt->bindValue(':id', $this->id);
        $stmt->execute();

        return (int) $stmt->fetchColumn();
    }

    // Retourne les chansons associées à ce genre
    public function chansons(CRUD $crud){
        $sql = "SELECT chanson.* FROM chanson
                INNER JOIN chanson_genre ON chanson.id = chanson_genre.chanson_id
                WHERE chanson_genre.genre_id = :id";

        $stmt = $crud->prepare($sql);
        $stmt->bindValue(':id', $this->id);
        $stmt->execute();

        return $stmt->fetchAll();
    }

    // Associe une chanson à ce genre
    public function ajouterChanson(CRUD $crud, $chanson_id)
    {

        $sql = "INSERT INTO chanson_genre (genre_id, chanson_id)
            VALUES (:genre_id, :chanson_id)";

        $stmt = $crud->prepare($sql);

        $stmt->bindValue(':genre_id', $this->id);
        $stmt->bindValue(':chanson_id', $chanson_id);

        return $stmt->execute();
    }
}
