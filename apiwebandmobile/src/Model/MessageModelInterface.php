<?php
/**
 * Created by PhpStorm.
 * User: cedri
 * Date: 19-08-19
 * Time: 20:38
 */


namespace App\Model;

interface MessageModelInterface
{
    public function findAllMessages();

    public function findMessageById($id);

    public function findMessagesByTitle($title);

    public function findMessagesByMatch($searchWord);

    public function findMessagesByCategory($category);

    public function upVoteMessage($id);

    public function downVoteMessage($id);

}
