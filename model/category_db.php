<?php
  function get_categories() { 
    global $db;
    $query = 'SELECT * FROM categories ORDER BY categoryID';
    $statement = $db->prepare($query); $statement->execute();
    $categories = $statement->fetchAll(); $statement->closeCursor(); 
    return $categories;
  }
  
  function get_category_name($category_id) { 
    global $db;
    $query = 'SELECT * FROM categories WHERE categoryID = :category_id'; 
    $statement = $db->prepare($query);
    $statement->bindValue(':category_id', $category_id); 
    $statement->execute();
    $category = $statement->fetch(); 
    $statement->closeCursor();
    // bug fixed: "Trying to access array offset on value of type bool in"
    $category_name = $category['categoryName'] ?? '.'; 
    return $category_name ;
  }

  function delete_category($category_id) { 
    global $db;
    $query = 'DELETE FROM categories
    WHERE categoryID = :category_id'; 
    $statement = $db->prepare($query);
    $statement->bindValue(':category_id', $category_id); 
    $statement->execute(); 
    $statement->closeCursor();
  }
  
  function add_category($category_name) { 
    global $db;
    $query = 'INSERT INTO categories (categoryName) 
              VALUES
              (:category_name)'; 
    $statement = $db->prepare($query);
    $statement->bindValue(':category_name', $category_name);
    $statement->execute(); 
    $statement->closeCursor();
  }   