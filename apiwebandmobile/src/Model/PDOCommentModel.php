<?php
/**
 * Created by PhpStorm.
 * User: cedri
 * Date: 19-08-19
 * Time: 20:38
 */

namespace App\Model;

class PDOCommentModel implements CommentsModelInterface
{
    private $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    public function findCommentsByMessageId($id)
    {
        try {
            $pdo = $this->connection->getPdo();
            $this->validateId($id);
            $statement = $pdo->prepare('SELECT * FROM comments WHERE messageId=:id');
            $statement->bindParam(':id', $id, \PDO::PARAM_INT);
            $statement->execute();

            $statement->bindColumn(1, $id, \PDO::PARAM_INT);
            $statement->bindColumn(2, $content, \PDO::PARAM_STR);
            $statement->bindColumn(3, $user, \PDO::PARAM_STR);
            $statement->bindColumn(4, $messageId, \PDO::PARAM_INT);
            $statement->bindColumn(5, $token, \PDO::PARAM_STR);

            $comments = [];

            while ($statement->fetch(\PDO::FETCH_BOUND)) {
                $comments[] = ['id' => $id, 'content' => $content, 'user' => $user, 'messageId' => $messageId,
                    'token' => $token];
            }

            return $comments;
        } catch (\PDOException $e) {
            print 'Exception while trying to get all comments from an message: ' . $e->getMessage();
        }
        return "";
    }

    public function postCommentUnderMessage($content, $username, $messageId)
    {
        try {
            $this->validateContent($content);
            $this->validateId($messageId);
            $token = md5(uniqid(rand(), true));
            $pdo = $this->connection->getPdo();

            $statement = $pdo->prepare('INSERT INTO comments (content, username, messageId, token) 
                                    VALUES (:content, :username, :messageId,:token)');
            $statement->bindParam(':content', $content, \PDO::PARAM_STR);
            $statement->bindParam(':username', $username, \PDO::PARAM_STR);
            $statement->bindParam(':messageId', $messageId, \PDO::PARAM_INT);
            $statement->bindParam(':token', $token, \PDO::PARAM_STR);
            $statement->execute();
            return $token;
        } catch (\PDOException $e) {
            print 'Exception while trying to add a comment: ' . $e->getMessage();
        }
        return "";
    }

    public function editCommentByToken($content, $token)
    {
        try {
            $this->validateContent($content);
            $pdo = $this->connection->getPdo();

            $statement = $pdo->prepare('UPDATE comments SET content=:content WHERE token=:token');
            $statement->bindParam(':content', $content, \PDO::PARAM_STR);
            $statement->bindParam(':token', $token, \PDO::PARAM_STR);
            $statement->execute();

        } catch (\PDOException $e) {
            print 'Exception while trying to edit the comment: ' . $e->getMessage();
        }
    }

    public function deleteCommentByToken($token)
    {
        try {
            $pdo = $this->connection->getPdo();

            $statement = $pdo->prepare('DELETE FROM comments WHERE token=:token');
            $statement->bindParam(':token', $token, \PDO::PARAM_STR);
            $statement->execute();
        } catch (\PDOException $e) {
            print 'Exception while trying to delete the comment: ' . $e->getMessage();
        }
    }

    private function validateContent($content)
    {
        if ($content == null) {
            throw new \InvalidArgumentException("You have to have some content");
        }
    }

    private function validateId($id)
    {
        if (!(is_string($id) && preg_match("/^[0-9]+$/", $id) && (int)$id > 0)) {
            throw new \InvalidArgumentException("id has to contain an int > 0 ");
        }
    }

}