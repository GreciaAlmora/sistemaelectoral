<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cat_nacional".
 *
 * @property int $nac_id Id
 * @property int $nac_fkestado Estado
 * @property int $nac_fkmunicipio Municipio
 *
 * @property CatEstado $nacFkestado
 * @property CatMunicipio $nacFkmunicipio
 */
class CatNacional extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cat_nacional';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nac_fkestado', 'nac_fkmunicipio'], 'required'],
            [['nac_fkestado', 'nac_fkmunicipio'], 'integer'],
            [['nac_fkestado', 'nac_fkmunicipio'], 'unique', 'targetAttribute' => ['nac_fkestado', 'nac_fkmunicipio']],
            [['nac_fkestado'], 'exist', 'skipOnError' => true, 'targetClass' => CatEstado::className(), 'targetAttribute' => ['nac_fkestado' => 'est_id']],
            [['nac_fkmunicipio'], 'exist', 'skipOnError' => true, 'targetClass' => CatMunicipio::className(), 'targetAttribute' => ['nac_fkmunicipio' => 'mun_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'nac_id'          => 'Id',
            'nac_fkestado'    => 'Estado',
            'nac_fkmunicipio' => 'Municipio',
            'estado'          => 'Estado',
            'municipio'       => 'Municipio',
        ];
    }

    /**
     * Gets query for [[NacFkestado]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNacFkestado()
    {
        return $this->hasOne(CatEstado::className(), ['est_id' => 'nac_fkestado']);
    }

    /**
     * Gets query for [[NacFkestado0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNacFkmunicipio()
    {
        return $this->hasOne(CatMunicipio::className(), ['mun_id' => 'nac_fkmunicipio']);
    }

    public function getEstado()
    {
        return $this->nacFkestado->est_nombre;
    }

    public function getMunicipio()
    {
        return $this->nacFkmunicipio->mun_nombre;
    }
}
