<?php
/**
 * Created by PhpStorm.
 * User: cedri
 * Date: 19-08-19
 * Time: 20:37
 */

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Model\PDOMessageModel;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class MessageController extends AbstractController
{

    private $messageModel;

    public function __construct(PDOMessageModel $messageModel)
    {
        $this->messageModel = $messageModel;
    }

    /**
     * @Route("/messages", methods={"GET"}, name="getAllMessages")
     */
    public function getAllMessages()
    {
        $statusCode = 200;
        $messages = [];
        try {
            $messages = $this->messageModel->findAllMessages();
            if ($messages == null) {
                $statusCode = 404;
            }
        } catch (\InvalidArgumentException $exception) {
            $statusCode = 400;
        } catch (\PDOException $exception) {
            $statusCode = 500;
        }
        return new JsonResponse($messages, $statusCode);
    }

    /**
     * @Route("/messages/{id}", methods={"GET"}, name="getMessageById")
     * @param $id
     * @return JsonResponse
     */
    public function getMessageById($id)
    {
        $statusCode = 200;
        $message = null;

        try {
            $message = $this->messageModel->findMessageById($id);
            if ($message == null) {
                $statusCode = 404;
            }
        } catch (\InvalidArgumentException $exception) {
            $statusCode = 400;
        } catch (\PDOException $exception) {
            $statusCode = 500;
        }
        return new JsonResponse($message, $statusCode);
    }

    /**
     * @Route("/messages/title/{title}", methods={"GET"}, name="getMessagesByTitle")
     * @param $title
     * @return JsonResponse
     */
    public function getMessagesByTitle($title)
    {
        $statusCode = 200;
        $messages = [];

        try {
            $messages = $this->messageModel->findMessagesByTitle($title);
            if (count($messages) < 0) {
                $statusCode = 404;
            }
        } catch (\InvalidArgumentException $exception) {
            $statusCode = 400;
        } catch (\PDOException $exception) {
            $statusCode = 500;
        }
        return new JsonResponse($messages, $statusCode);
    }

    /**
     * @Route("/messages/content/{match}", methods={"GET"}, name="getMessagesByMatch")
     * @param $match
     * @return JsonResponse
     */
    public function getMessagesByMatch($match)
    {
        $statusCode = 200;
        $messages = [];

        try {
            $messages = $this->messageModel->findMessagesByMatch($match);
            if (count($messages) < 0) {
                $statusCode = 404;
            }
        } catch (\InvalidArgumentException $exception) {
            $statusCode = 400;
        } catch (\PDOException $exception) {
            $statusCode = 500;
        }
        return new JsonResponse($messages, $statusCode);
    }

    /**
     * @Route("/messages/category/{category}", methods={"GET"}, name="getMessagesByCategory")
     * @param $category
     * @return JsonResponse
     */
    public function getMessagesByCategory($category)
    {
        $statusCode = 200;
        $messages = [];

        try {
            $messages = $this->messageModel->findMessagesByCategory($category);
            if (count($messages) < 0) {
                $statusCode = 404;
            }
        } catch (\InvalidArgumentException $exception) {
            $statusCode = 400;
        } catch (\PDOException $exception) {
            $statusCode = 500;
        }
        return new JsonResponse($messages, $statusCode);
    }

    /**
     * @Route("/messages/{id}/upVote", methods={"PUT"}, name="upVoteMessageWithId")
     * @param $id
     * @return JsonResponse
     */
    public function upVoteMessageWithId($id)
    {
        $statusCode = 202;

        try {
            $this->messageModel->upVoteMessage($id);

        } catch (\InvalidArgumentException $exception) {
            $statusCode = 400;
        } catch (\PDOException $exception) {
            $statusCode = 500;
        }
        return new JsonResponse("Message with id:". $id . " up voted !", $statusCode);
    }

    /**
     * @Route("/messages/{id}/downVote", methods={"PUT"}, name="downVoteMessageWithId")
     * @param $id
     * @return JsonResponse
     */
    public function downVoteMessageWithId($id)
    {
        $statusCode = 202;

        try {
            $this->messageModel->downVoteMessage($id);

        } catch (\InvalidArgumentException $exception) {
            $statusCode = 400;
        } catch (\PDOException $exception) {
            $statusCode = 500;
        }
        return new JsonResponse("Message with id:". $id . " down voted !", $statusCode);
    }
}
