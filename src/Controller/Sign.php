<?php

namespace App\Controller;

use App\DBH;
use App\Model\User;
use App\Response;
use App\Role\Role;
use PDO;

abstract class Sign extends Controller
{

    /**
     * @return Response
     */
    abstract protected function sign(): Response;

    /**
     * @return \App\Response
     */
    public function indexAction(): Response
    {
        return $this->sign();
    }

    /**
     * @param User $user
     * @return boolean
     */
    protected function post (User $user): bool
    {
        try {
            DBH::get(DBH::PDO)->beginTransaction();
            $this->insertProfile();
            $this->insertUser($user);
            return DBH::get(DBH::PDO)->commit();
        } catch (\Throwable $e) {
            if (DBH::get(DBH::PDO)->inTransaction()) {
                DBH::get(DBH::PDO)->rollBack();
            }
            return false;
        }
    }
    /**
     * @param User $user
     * @return int
     * @throws \PDOException
     */
    protected function selectProfileId (User $user): int
    {
        $sth = DBH::get(DBH::PDO)->prepare(
            "SELECT `user_profile` FROM `user` WHERE `user_email`=:email"
        );
        $sth->bindValue(":email", $user->email);
        $sth->execute();
        return (int) $sth->fetch(PDO::FETCH_OBJ)->user_profile;
    }
    
    /**
     * @param User $user
     * @return string
     * @throws \PDOException
     */
    protected function selectPassword (User $user): string
    {
        $sth = DBH::get(DBH::PDO)->prepare(
            "SELECT `user_pswd` FROM `user` WHERE `user_email`=:email"
        );
        $sth->bindValue(":email", $user->email);
        $sth->execute();
        $obj = $sth->fetch(PDO::FETCH_OBJ);
        return $obj ? $obj->user_pswd : "";
    }

    /**
     * @param User $user
     * @param int $role
     * @return bool
     * @throws \PDOException
     */
    protected function updateRoles (User $user, int $role): bool
    {
        $user->role = Role::USER;
        return $this->updateRole($user, $role);
    }

    /**
     * @param User $user
     * @param int $role
     * @return bool
     * @throws \PDOException
     */
    private function updateRole (User $user, int $role): bool
    {
        $sth = DBH::get(DBH::PDO)->prepare(
            "UPDATE `user` SET `user_role`=" . $role . " WHERE `user_profile`=:profileId"
        );
        $sth->bindValue(":profileId", $user->id);
        return $sth->execute();
    }

    /**
     * @return boolean
     * @throws \PDOException
     */
    private function insertProfile(): bool
    {
        return DBH::get(DBH::PDO)->prepare(
            "INSERT INTO "
            . "`profile` (`profile_firstname`, `profile_name`, `profile_avatar`) "
            . "VALUES (NULL, NULL, NULL);"
        )->execute();
    }

    /**
     * @param User $user
     * @return boolean
     * @throws \PDOException
     */
    private function insertUser(User $user): bool
    {
        $sth = DBH::get(DBH::PDO)->prepare(
            "INSERT INTO `user` (`user_pswd`, `user_email`, `user_profile`) "
          . "VALUES (:pswd, :email, :profile);"
        );
        $sth->bindValue(':pswd', password_hash($user->pswd, PASSWORD_DEFAULT));
        $sth->bindValue(':email', $user->email);
        $sth->bindValue(':profile', DBH::get(DBH::PDO)->lastInsertId());
        return $sth->execute();
    }

}
