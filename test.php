<?php
 declare(strict_types=1);

 use App\Actions\CancelAction;
 use App\Actions\CompleteAction;
 use App\Actions\ExecuteAction;
 use App\Actions\FailAction;
 use App\Actions\ResponseAction;

 require_once 'vendor/autoload.php';

 $user = new \App\User(1);
 $userExecutor = new \App\User(2);
 $userExecutor->changeRoleToExecutor();
 $task = new App\Task($user);
//Пишем тесты
 //роль = заказчик
    // Статус = new
    assert(
        $task->availableActions($user) === [ExecuteAction::getPublicName(),CancelAction::getPublicName()],
        "\"not valid actions for new status and customer role\""
    );

    // Статус = Execute
    $task->setExecutorId(2);
    try {
        $task->setStatus($task::EXECUTE_TASK);
    } catch(\App\Exceptions\UserException $e) {
        echo ($e->getStructMessage()."<b>catch in:</b> ".__FILE__." on line <b>".__LINE__."</b><br>");
    }
    assert(
        $task->availableActions($user) === [CompleteAction::getPublicName()],
        "\"not valid actions for Execute status and customer role\""
    );

    // Статус = Canceled
    $task->setStatus($task::CANCEL_TASK);
    assert(
        $task->availableActions($user) === [],
        "\"not valid actions for Canceled status and customer role\""
    );

    // Статус = Failed
    $task->setStatus($task::FAIL_TASK);
    assert($task->availableActions($user) === [],"\"not valid actions for Failed status and customer role\"");

    // Статус = Completed
    $task->setStatus($task::END_TASK);
    assert($task->availableActions($user) === [],"\"not valid actions for Completed status and customer role\"");

 //роль = исполнитель
    // Статус = New
    $task->resetExecutorId();
    try {
        $task->setStatus($task::NEW_TASK);
    } catch(\App\Exceptions\UserException $e) {
        echo ($e->getStructMessage()."<b>catch in:</b> ".__FILE__." on line <b>".__LINE__."</b><br>");
    }
    assert(
        $task->availableActions($userExecutor) === [ResponseAction::getPublicName()],
        "\"not valid actions for new status and executor role\""
    );

    // Статус = Execute
    $task->setExecutorId(2);
    try {
        $task->setStatus($task::EXECUTE_TASK);
    } catch(\App\Exceptions\UserException $e) {
        echo ($e->getStructMessage()."<b>catch in:</b> ".__FILE__." on line <b>".__LINE__."</b><br>");
    }
    assert(
        $task->availableActions($userExecutor) === [FailAction::getPublicName()],
        "\"not valid actions for Execute status and customer role\""
    );

    // Статус = Canceled
    $task->setStatus($task::CANCEL_TASK);
    assert(
        $task->availableActions($userExecutor) === [],
        "\"not valid actions for Canceled status and customer role\""
    );

    // Статус = Failed
    $task->setStatus($task::FAIL_TASK);
    assert(
        $task->availableActions($userExecutor) === [],
        "\"not valid actions for Failed status and customer role\""
    );

    // Статус = Completed
    $task->setStatus($task::END_TASK);
    assert(
        $task->availableActions($userExecutor) === [],
        "\"not valid actions for Completed status and customer role\""
    );

try {
    $outFilePath = __DIR__."/sql/query/general.sql";
    $outFile = new \SplFileObject($outFilePath,'w+');

    $category = new \App\CSVConverter(__DIR__."/data/categories.csv",'category');
    $category->createInsertFile($category->getInsertString(),__DIR__."/sql/query/".$category->getTableNamePublic().".sql");
    $outFile->fwrite($category->getInsertString());
    unset($category);

    $city = new \App\CSVConverter(__DIR__."/data/cities.csv",'city');
    $city->createInsertFile($city->getInsertString(),__DIR__."/sql/query/".$city->getTableNamePublic().".sql");
    $outFile->fwrite($city->getInsertString());
    unset($city);

    $dumpUser = new \App\CSVConverter(__DIR__."/data/users.csv",'user');
    $dumpUser->createInsertFile($dumpUser->getInsertString(),__DIR__."/sql/query/".$dumpUser->getTableNamePublic().".sql");
    $outFile->fwrite($dumpUser->getInsertString());
    unset($dumpUser);

    $dumpTask = new \App\CSVConverter(__DIR__."/data/tasks.csv",'task');
    $dumpTask->createInsertFile($dumpTask->getInsertString(),__DIR__."/sql/query/".$dumpTask->getTableNamePublic().".sql");
    $outFile->fwrite($dumpTask->getInsertString());
    unset($dumpTask);

    $opinion = new \App\CSVConverter(__DIR__."/data/opinions.csv",'rewiew');
    $opinion->createInsertFile($opinion->getInsertString(),__DIR__."/sql/query/".$opinion->getTableNamePublic().".sql");
    $outFile->fwrite($opinion->getInsertString());
    unset($opinion);



} catch (\App\Exceptions\UserException $e) {
    echo ($e->getStructMessage()."<b>catch in:</b> ".__FILE__." on line <b>".__LINE__."</b><br>");
} catch (\mysqli_sql_exception $e) {
    echo $e->getMessage();
}
