<?php


class LikeM
{

    public function add($id, $ip)
    {
        $query = "SELECT l.ip FROM `likes` AS l WHERE l.ip='$ip' AND l.id_photo='$id'";
        $findIp = PdoM::Instance()->Select($query);

        if (!$findIp) {
            return PdoM::Instance()->Insert('likes', ['id_photo' => $id, 'ip' => $ip]);
        }

        $query = "DELETE FROM `likes` WHERE id_photo = '$id' AND ip = '$ip'";
        return PdoM::Instance()->Select($query);
    }
}