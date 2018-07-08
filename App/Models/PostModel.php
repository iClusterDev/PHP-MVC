<?php

  namespace App\Models;

  use PDO;

  class PostModel extends \Core\Model {

    public static function getAll() {
      $sql = 'SELECT id, title, content FROM posts ORDER BY created_at DESC';

      try {
        $db = static::getDB();
        $stmt = $db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);        
      }
      catch(PDOException $e) {
        throw new \Exception(get_class($this) . " Error: Not Able to get all posts");
      }

    }

  }