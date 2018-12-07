<?php

namespace App\Models\RankingModels;

use Illuminate\Database\Eloquent\Model;
use DB;

class ScientificPublication extends Model
{
    protected $primaryKey = 'idPublication';
    protected $table = 'scient_publication';
    protected $fillable = array('title', 'edition', 'pages', 'date', 'file', 'fk_pub_type');

    private $idPublication;

    public function __construct($idPublication, $attributes = [])
    {
        $this->idPublication = $idPublication;
        parent::__construct($attributes);
    }

    public function identifyPublication(){
        $event = DB::table($this->table)
            ->join('type_of_publication', 'scient_publication.fk_pub_type',  '=', 'type_of_publication.idTypePub')
            ->where('scient_publication.idPublication', '=',  $this->idPublication )
            ->first();
        return $event;
    }

    public function getAuthors(){
        $members = DB::table('authors_of_publication')
            ->select("users.*",   "authors_of_publication.*",
                "student.surname AS student_surname", "professor.surname AS professor_surname",
                "student.name AS student_name", "professor.name AS professor_name")
            ->join('users', 'users.idUsers', '=', 'authors_of_publication.fk_user')
            ->leftjoin('professor', 'professor.type_user', '=', 'users.idUsers')
            ->leftjoin('student', 'student.type_user', '=', 'users.idUsers')
            ->where('authors_of_publication.fk_pub', '=',  $this->idPublication )
            ->get();
        return $members;
    }

    public function editPublicationInfo($title, $date, $fkType, $edition, $pages){
        $update = DB::table('scient_publication')
            ->where('idPublication', $this->idPublication)
            ->update( ['title' => $title, 'date' => $date, 'fk_pub_type' => $fkType, 'edition' => $edition, 'pages' => $pages]);
        return $update;
    }

    public static function deleteAuthorOfPublication($idDelete){
        $deleted =  DB::table('authors_of_publication')->where('idPubAuthor','=',$idDelete)->delete();
        return $deleted;
    }

    public static function editPercentById($id, $newPercent, $status){
        $update = DB::table('authors_of_publication')
            ->where('idPubAuthor', $id)
            ->update( ['percent_of_writing' => $newPercent, 'status' => $status]);
        return $update;
    }

    public static function getPercentOfAuthor($idPub, $idAuthor){
        $percent = DB::table('authors_of_publication')
            ->where([['authors_of_publication.fk_pub', '=',  $idPub], ['authors_of_publication.fk_user', '=',  $idAuthor]] )
            ->first();
        return $percent->percent_of_writing;
    }


}
