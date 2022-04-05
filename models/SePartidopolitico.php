<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "se_partidopolitico".
 *
 * @property int $par_id Id
 * @property string $par_nombre Nombre
 *
 * @property SeCandidato[] $seCandidatos
 * @property SeGobernador[] $seGobernadors
 * @property SePresidentemunicipal[] $sePresidentemunicipals
 * @property SeResultado[] $seResultados
 */
class SePartidopolitico extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'se_partidopolitico';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['par_nombre'], 'required'],
            [['par_nombre'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'par_id' => 'Id',
            'par_nombre' => 'Nombre',
        ];
    }

    /**
     * Gets query for [[SeCandidatos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSeCandidatos()
    {
        return $this->hasMany(SeCandidato::className(), ['can_fkpartidopolitico' => 'par_id']);
    }

    /**
     * Gets query for [[SeGobernadors]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSeGobernadors()
    {
        return $this->hasMany(SeGobernador::className(), ['gob_fkpartidopolitico' => 'par_id']);
    }

    /**
     * Gets query for [[SePresidentemunicipals]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSePresidentemunicipals()
    {
        return $this->hasMany(SePresidentemunicipal::className(), ['pre_fkpartidopolitico' => 'par_id']);
    }

    /**
     * Gets query for [[SeResultados]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSeResultados()
    {
        return $this->hasMany(SeResultado::className(), ['res_fkpartidopolitico' => 'par_id']);
    }
}
