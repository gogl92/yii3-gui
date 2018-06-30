<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "world_cup_team".
 *
 * @property int $id
 * @property string $team_name Team
 * @property int $ranking Ranking
 */
class WorldCupTeam extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'world_cup_team';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'team_name'], 'required'],
            [['id', 'ranking'], 'integer'],
            [['team_name'], 'string', 'max' => 100],
            [['id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'team_name' => Yii::t('app', 'Team'),
            'ranking' => Yii::t('app', 'Ranking'),
        ];
    }
}
