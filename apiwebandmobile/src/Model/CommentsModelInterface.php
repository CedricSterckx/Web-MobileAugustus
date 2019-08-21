<?php
/**
 * Created by PhpStorm.
 * User: cedri
 * Date: 19-08-19
 * Time: 20:38
 */

namespace App\Model;

interface CommentsModelInterface
{

    public function findCommentsByMessageId($id);

    public function postCommentUnderMessage($content, $username, $messageId);

    public function editCommentByToken($content, $token);

    public function deleteCommentByToken($token);

}