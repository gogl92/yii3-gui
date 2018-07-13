<?php
namespace app\commands;

use app\Commands\Rss;
use Gui\Application;
use Gui\Components\Div;
use Gui\Components\Label;
use Gui\Components\Shape;
use Gui\Components\Window;
use yii\console\Controller;

use app\models\WorldCupTeam;
use app\models\search\WorldCupTeamSearch;

class WorldCupTeamController extends Controller
{
    public $message;

    public function options($actionID)
    {
        return ['message'];
    }

    public function optionAliases()
    {
        return ['m' => 'message'];
    }

    public function actionIndex()
    {
      $teams = WorldCupTeam::find()->all();
$application = new Application([
    'backgroundColor' => '#181818',
    'height' => 740,
    'left' => 248,
    'title' => 'php.internals reader',
    'top' => 50,
    'width' => 860,
]);
$application->on('start', function () use ($application) {
    new Label([
        'backgroundColor' => '#181818',
        'fontColor' => '#FFFFFF',
        'fontFamily' => 'Gill Sans',
        'fontSize' => 30,
        'left' => 25,
        'text' => 'World Cup Teams',
        'top' => 25,
    ]);
    $loading = new Label([
        'fontColor' => '#a0a0a0',
        'fontFamily' => 'Gill Sans',
        'fontSize' => 20,
        'left' => 25,
        'text' => 'Loading messages...',
        'top' => 80,
    ]);
    $application->getLoop()->addTimer(1, function () use ($loading) {
        $messages = Rss::getLastest();
        $postWindow = null;
        $loading->setVisible(false);
        new Label([
            'fontColor' => '#a0a0a0',
            'fontFamily' => 'Lucida Sans Unicode',
            'fontSize' => 13,
            'left' => 25,
            'text' => 'ID',
            'top' => 80,
            'width' => 100,
        ]);
        new Label([
            'fontColor' => '#a0a0a0',
            'fontFamily' => 'Lucida Sans Unicode',
            'fontSize' => 13,
            'left' => 100,
            'text' => 'Team Name',
            'top' => 80,
            'width' => 300,
        ]);
        new Label([
            'fontColor' => '#a0a0a0',
            'fontFamily' => 'Lucida Sans Unicode',
            'fontSize' => 13,
            'left' => 600,
            'text' => 'Ranking',
            'top' => 80,
            'width' => 300,
        ]);
        new Shape([
            'backgroundColor' => '#a0a0a0',
            'borderColor' => '#a0a0a0',
            'height' => 1,
            'left' => 25,
            'top' => 100,
            'width' => 810
        ]);
        for ($i = 0, $numberOfMessages = count($teams); $i < $numberOfMessages; $i++) {
            $link = $messages['links'][$i];
            $title = $messages['titles'][$i];
            $backgroundShape = new Shape([
                'backgroundColor' => '#181818',
                'borderColor' => '#181818',
                'height' => 30,
                'left' => 25,
                'top' => 115 + ($i * 30),
                'width' => 810,
            ]);
            $title = new Label([
                'autoSize' => false,
                'fontColor' => '#fcfcfc',
                'fontFamily' => 'Lucida Sans Unicode',
                'fontSize' => 13,
                'height' => 20,
                'left' => 25,
                'text' => $title,
                'top' => 120 + ($i * 30),
                'width' => 550,
            ]);
            new Label([
                'autoSize' => false,
                'fontColor' => '#fcfcfc',
                'fontFamily' => 'Lucida Sans Unicode',
                'fontSize' => 13,
                'height' => 20,
                'left' => 600,
                'text' => $messages['authors'][$i],
                'top' => 120 + ($i * 30),
                'width' => 260,
            ]);
            $clickFunction = function () use ($link) {
                $content = Rss::getSingle($link);
                $postWindow = new Window([
                    'height' => 740,
                    'width' => 860,
                ]);
                $div = new Div([
                    'height' => 740,
                    'width' => 860,
                ], $postWindow);
                new Label([
                    'autoSize' => true,
                    'text' => $content,
                ], $div);
            };
            $mouseEnterFunction = function () use ($backgroundShape) {
                $backgroundShape->setBackgroundColor('#282828');
            };
            $mouseLeaveFunction = function () use ($backgroundShape) {
                $backgroundShape->setBackgroundColor('#181818');
            };
            $backgroundShape->on('mouseEnter', $mouseEnterFunction);
            $title->on('mouseEnter', $mouseEnterFunction);
            $backgroundShape->on('mouseLeave', $mouseLeaveFunction);
            $title->on('mouseLeave', $mouseLeaveFunction);
            $backgroundShape->on('mouseDown', $clickFunction);
            $title->on('mouseDown', $clickFunction);
        }
    });
});
$application->run();
    }

    public function actionCreate()
    {
      $application = new Application();



      $application->run();
    }

    public function actionUpdate($id)
    {

    }
    public function actionDelete($id){

    }
}
