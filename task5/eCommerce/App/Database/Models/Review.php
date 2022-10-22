<?php

namespace App\Database\Models;

use App\Database\Models\Model;
use App\Database\Contracts\ConnectTo;

class Review extends Model implements ConnectTo
{
    private const table = "review";
    private int $product_id;
    private int $user_id;
    private string $comment="";
    private int $rate;
    private string $created_at;
    private string $updated_at;


    /**
     * Get the value of product_id
     */ 
    public function getProduct_id()
    {
        return $this->product_id;
    }

    /**
     * Set the value of product_id
     *
     * @return  self
     */ 
    public function setProduct_id($product_id)
    {
        $this->product_id = $product_id;

        return $this;
    }

    /**
     * Get the value of user_id
     */ 
    public function getUser_id()
    {
        return $this->user_id;
    }

    /**
     * Set the value of user_id
     *
     * @return  self
     */ 
    public function setUser_id($user_id)
    {
        $this->user_id = $user_id;

        return $this;
    }

    /**
     * Get the value of comment
     */ 
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * Set the value of comment
     *
     * @return  self
     */ 
    public function setComment($comment)
    {
        $this->comment = $comment;

        return $this;
    }

    /**
     * Get the value of rate
     */ 
    public function getRate()
    {
        return $this->rate;
    }

    /**
     * Set the value of rate
     *
     * @return  self
     */ 
    public function setRate($rate)
    {
        $this->rate = $rate;

        return $this;
    }

    /**
     * Get the value of created_at
     */ 
    public function getCreated_at()
    {
        return $this->created_at;
    }

    /**
     * Set the value of created_at
     *
     * @return  self
     */ 
    public function setCreated_at($created_at)
    {
        $this->created_at = $created_at;

        return $this;
    }

    /**
     * Get the value of updated_at
     */ 
    public function getUpdated_at()
    {
        return $this->updated_at;
    }

    /**
     * Set the value of updated_at
     *
     * @return  self
     */ 
    public function setUpdated_at($updated_at)
    {
        $this->updated_at = $updated_at;

        return $this;
    }
    public function insert()
    {
        $stmt = "INSERT INTO " . self::table . "(product_id,user_id,comment,rate) VALUES (  ? , ?, ? , ?)";
        $query = $this->con->prepare($stmt);
        $query->bind_param('iisi', $this->product_id, $this->user_id, $this->comment, $this->rate);
        return $query->execute();
    }

    public function getReviews($product_id)
    {
        $query = "SELECT
                        `review`.*,
                        `users`.`name`
                    FROM
                        `review`
                    JOIN `users`
                    ON `users`.`id` = `review`.`user_id`
                    WHERE
                        `review`.`product_id` = ?";
        $stmt = $this->con->prepare($query);
        $product_id=intval($product_id);
        $stmt->bind_param('i', $product_id);
        $stmt->execute();
        return $stmt;
    }
}
?>