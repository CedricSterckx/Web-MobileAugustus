<?php
/**
 * Created by PhpStorm.
 * User: cedri
 * Date: 19-08-19
 * Time: 20:38
 */
namespace App\Model;

class PDOMessageModel implements MessageModelInterface
{

    private $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    public function findAllMessages()
    {
        try {
            $pdo = $this->connection->getPdo();

            $statement = $pdo->prepare('SELECT * FROM messages');
            $statement->execute();

            $statement->bindColumn(1, $id, \PDO::PARAM_INT);
            $statement->bindColumn(2, $title, \PDO::PARAM_STR);
            $statement->bindColumn(3, $content, \PDO::PARAM_STR);
            $statement->bindColumn(4, $category, \PDO::PARAM_STR);
            $statement->bindColumn(5, $upVotes, \PDO::PARAM_INT);
            $statement->bindColumn(6, $downVotes, \PDO::PARAM_INT);

            $messages = [];

            while ($statement->fetch(\PDO::FETCH_BOUND)) {
                $messages[] = ['id' => $id, 'title' => $title, 'content' => $content,
                    'category' => $category, 'upVotes' => $upVotes, 'downVotes' => $downVotes];
            }

            return $messages;

        } catch (\PDOException $e) {
            print 'Excpetion while trying to find all messages: ' . $e->getMessage();
        }
    }

    public function findMessageById($id)
    {
        try {
            $this->validateId($id);
            $pdo = $this->connection->getPdo();

            $statement = $pdo->prepare('SELECT * FROM messages WHERE id=:id');
            $statement->bindParam(':id', $id, \PDO::PARAM_INT);
            $statement->execute();

            $statement->bindColumn(1, $id, \PDO::PARAM_INT);
            $statement->bindColumn(2, $title, \PDO::PARAM_STR);
            $statement->bindColumn(3, $content, \PDO::PARAM_STR);
            $statement->bindColumn(4, $category, \PDO::PARAM_STR);
            $statement->bindColumn(5, $upVotes, \PDO::PARAM_INT);
            $statement->bindColumn(6, $downVotes, \PDO::PARAM_INT);

            $message = null;

            if ($statement->fetch(\PDO::FETCH_BOUND)) {
                $message = ['id' => $id, 'title' => $title, 'content' => $content,
                    'category' => $category, 'upVotes' => $upVotes, 'downVotes' => $downVotes];
            }

            return $message;
        } catch (\PDOException $e) {
            print 'Exception while trying to find the message by id: ' . $e->getMessage();
        }
    }

    public function findMessagesByTitle($title)
    {
        try {
            $title = '%' . $title . '%';
            $pdo = $this->connection->getPdo();

            $statement = $pdo->prepare('SELECT * FROM messages WHERE title  LIKE ?');
            $statement->bindParam(1, $title, \PDO::PARAM_STR);
            $statement->execute();

            $statement->bindColumn(1, $id, \PDO::PARAM_INT);
            $statement->bindColumn(2, $title, \PDO::PARAM_STR);
            $statement->bindColumn(3, $content, \PDO::PARAM_STR);
            $statement->bindColumn(4, $category, \PDO::PARAM_STR);
            $statement->bindColumn(5, $upVotes, \PDO::PARAM_INT);
            $statement->bindColumn(6, $downVotes, \PDO::PARAM_INT);

            $messages = [];

            while ($statement->fetch(\PDO::FETCH_BOUND)) {
                $messages[] = ['id' => $id, 'title' => $title, 'content' => $content,
                    'category' => $category, 'upVotes' => $upVotes, 'downVotes' => $downVotes];
            }

            return $messages;
        } catch (\PDOException $e) {
            print 'Exception while trying to find the message by title: ' . $e->getMessage();
        }
    }

    public function findMessagesByMatch($searchWord)
    {
        try {
            $searchWord = '%' . $searchWord . '%';
            $pdo = $this->connection->getPdo();

            $statement = $pdo->prepare('SELECT * FROM messages WHERE content  LIKE ?');
            $statement->bindParam(1, $searchWord, \PDO::PARAM_STR);
            $statement->execute();

            $statement->bindColumn(1, $id, \PDO::PARAM_INT);
            $statement->bindColumn(2, $title, \PDO::PARAM_STR);
            $statement->bindColumn(3, $content, \PDO::PARAM_STR);
            $statement->bindColumn(4, $category, \PDO::PARAM_STR);
            $statement->bindColumn(5, $upVotes, \PDO::PARAM_INT);
            $statement->bindColumn(6, $downVotes, \PDO::PARAM_INT);

            $messages = [];

            while ($statement->fetch(\PDO::FETCH_BOUND)) {
                $messages[] = ['id' => $id, 'title' => $title, 'content' => $content,
                    'category' => $category, 'upVotes' => $upVotes, 'downVotes' => $downVotes];
            }

            return $messages;
        } catch (\PDOException $e) {
            print 'Excpetion while trying to find the message by match: ' . $e->getMessage();
        }
    }

    public function findMessagesByCategory($category)
    {
        try {
            $pdo = $this->connection->getPdo();

            $statement = $pdo->prepare('SELECT * FROM messages WHERE category  LIKE ?');
            $statement->bindParam(1, $category, \PDO::PARAM_STR);
            $statement->execute();

            $statement->bindColumn(1, $id, \PDO::PARAM_INT);
            $statement->bindColumn(2, $title, \PDO::PARAM_STR);
            $statement->bindColumn(3, $content, \PDO::PARAM_STR);
            $statement->bindColumn(4, $category, \PDO::PARAM_STR);
            $statement->bindColumn(5, $upVotes, \PDO::PARAM_INT);
            $statement->bindColumn(6, $downVotes, \PDO::PARAM_INT);


            $messages = [];

            while ($statement->fetch(\PDO::FETCH_BOUND)) {
                $messages[] = ['id' => $id, 'title' => $title, 'content' => $content,
                    'category' => $category, 'upVotes' => $upVotes, 'downVotes' => $downVotes];
            }

            return $messages;
        } catch (\PDOException $e) {
            print 'Excpetion while trying to find the message by category: ' . $e->getMessage();
        }
    }

    public function upVoteMessage($id)
    {
        try {
            $pdo = $this->connection->getPdo();

            $statement = $pdo->prepare('UPDATE messages SET upvotes=upvotes + 1 WHERE id=:id');
            $statement->bindParam(':id', $id, \PDO::PARAM_INT);
            $statement->execute();
        } catch (\PDOException $e) {
            print 'Excpetion while trying to upvote the message: ' . $e->getMessage();
        }
    }

    public function downVoteMessage($id)
    {
        try {
            $pdo = $this->connection->getPdo();

            $statement = $pdo->prepare('UPDATE messages SET downvotes=downvotes + 1 WHERE id=:id');
            $statement->bindParam(':id', $id, \PDO::PARAM_INT);
            $statement->execute();
        } catch (\PDOException $e) {
            print 'Excpetion while trying to downvote the message: ' . $e->getMessage();
        }
    }

    private
    function validateId($id)
    {
        if (!(is_string($id) && preg_match("/^[0-9]+$/", $id) && (int)$id > 0)) {
            throw new \InvalidArgumentException("id has to contain an int > 0 ");
        }
    }


}



