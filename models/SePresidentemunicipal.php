<?php

namespace app\models;

use Yii;
use yii\helpers\Html;

/**
 * This is the model class for table "se_presidentemunicipal".
 *
 * @property int $pre_id Id
 * @property string $pre_nombre Nombre
 * @property string $pre_paterno Apellido Paterno
 * @property string $pre_materno Apellido Materno
 * @property string $pre_anioinicio Año Inicio
 * @property string $pre_aniotermino Año Termino
 * @property int $pre_fkpartidopolitico Partido Politico
 * @property int $pre_fkmunicipio Municipio
 *
 * @property CatMunicipio $preFkmunicipio
 * @property SePartidopolitico $preFkpartidopolitico
 */
class SePresidentemunicipal extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'se_presidentemunicipal';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['pre_nombre', 'pre_paterno', 'pre_materno', 'pre_anioinicio', 'pre_aniotermino', 'pre_fkpartidopolitico', 'pre_fkmunicipio'], 'required'],
            [['pre_anioinicio', 'pre_aniotermino'], 'safe'],
            [['pre_fkpartidopolitico', 'pre_fkmunicipio'], 'integer'],
            [['pre_nombre', 'pre_paterno', 'pre_materno'], 'string', 'max' => 30],
            [['pre_fkmunicipio'], 'exist', 'skipOnError' => true, 'targetClass' => CatMunicipio::className(), 'targetAttribute' => ['pre_fkmunicipio' => 'mun_id']],
            [['pre_fkpartidopolitico'], 'exist', 'skipOnError' => true, 'targetClass' => SePartidopolitico::className(), 'targetAttribute' => ['pre_fkpartidopolitico' => 'par_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'pre_id'                => 'Id',
            'pre_nombre'            => 'Nombre',
            'pre_paterno'           => 'Apellido Paterno',
            'pre_materno'           => 'Apellido Materno',
            'pre_anioinicio'        => 'Año Inicio',
            'pre_aniotermino'       => 'Año Termino',
            'pre_fkpartidopolitico' => 'Partido Politico',
            'partidopolitico'       => 'Partido Politico',
            'pre_fkmunicipio'       => 'Municipio',
            'municipioEstado'       => 'Municipio y Estado',
            'foto'                  => 'Foto',
        ];
    }

    /**
     * Gets query for [[PreFkmunicipio]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPreFkmunicipio()
    {
        return $this->hasOne(CatMunicipio::className(), ['mun_id' => 'pre_fkmunicipio']);
    }

    /**
     * Gets query for [[PreFkpartidopolitico]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPreFkpartidopolitico()
    {
        return $this->hasOne(SePartidopolitico::className(), ['par_id' => 'pre_fkpartidopolitico']);
    }

    public function getPartidopolitico(){
        return $this->preFkpartidopolitico->par_nombre;
    }

    public function getMunicipioEstado(){
        return $this->preFkmunicipio->municipioEstado; 
    }

    public function getFoto()
    {
        return Html::img("/img/presidentesmunicipales/{$this->pre_id}.png", ['height'=>'100px']);
    }
}
