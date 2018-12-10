<?php
/**
 * Created by PhpStorm.
 * User: astakhova.n
 * Date: 12/10/2018
 * Time: 6:12 PM
 */

namespace App\Models\RankingModels;

use Illuminate\Database\Eloquent\Model;
use DB;

/**
 * Class Rankings or identify data in ranking
 * @package App\Models\RankingModels
 */
class Rankings extends Model
{
    protected $primaryKey = 'idTemplate';
    protected $table = 'res_template';
    protected $fillable = array('idTemplate','title', 'fileTemplate');

    private $idTemplate;

    /**
     * Rankings constructor.
     * @param array $attributes
     */
    public function __construct($attributes = [])
    {
       // $this->idTemplate = $idTemplate;
        parent::__construct($attributes);
    }


}