<?php

namespace App\Loggers;

use ActionLogRepo;
use App\Contracts\Entities\ActionLog;
use App\Contracts\Entities\Users;
use App\Support\Enums\ActionLogEnum;
use Auth;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Log;

class ActionLogger
{
    private $actionLog;

    public function __construct()
    {
        $this->actionLog = ActionLogRepo::make();
    }

    public function writeLog(ActionLog $actionLog, Users $user = null)
    {
        if (is_null($user)) {
            $user = Auth::user();
        }

        $actionLog->setUserId($user->getId());
        $actionLog->setUserName($user->getName());
        $actionLog->setIp(request()->ip());

        ActionLogRepo::create($actionLog->toArray());
    }

    public function updateUser(Users $oldUser, Users $user, string $oldRole, string $role)
    {
        $updateContent = '';
        $username = $user->getName();
        if ($oldRole !== $role) {
            $updateContent .= ($username . ' update role "' . $oldRole . '" to "' .  $role . '", ');
        }

        if (empty($updateContent)) {
            return;
        }

        $this->actionLog->setAction(ActionLogEnum::ACTION_ACCOUNT);
        $this->actionLog->setEvent($updateContent);

        $this->writeLog($this->actionLog);
    }

    public function deleteUser(Users $user)
    {
        $this->actionLog->setAction(ActionLogEnum::ACTION_ACCOUNT);
        $this->actionLog->setEvent('Delete account ' . $user->getName());

        $this->writeLog($this->actionLog);
    }
}
