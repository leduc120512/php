<?php
// Cart.php
class Cart
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function addToCart($user_id, $product_id, $quantity)
    {
        // Check if the item already exists in the cart
        $stmt = $this->conn->prepare("SELECT * FROM cart WHERE user_id = ? AND product_id = ?");
        $stmt->execute([$user_id, $product_id]);
        $existing = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($existing) {
            // Update quantity if item exists
            $new_quantity = $existing['quantity'] + $quantity;
            $stmt = $this->conn->prepare("UPDATE cart SET quantity = ?, created_at = NOW() WHERE user_id = ? AND product_id = ?");
            return $stmt->execute([$new_quantity, $user_id, $product_id]);
        } else {
            // Add new item to cart
            $stmt = $this->conn->prepare("INSERT INTO cart (user_id, product_id, quantity, created_at) VALUES (?, ?, ?, NOW())");
            return $stmt->execute([$user_id, $product_id, $quantity]);
        }
    }

    public function getCartByUserId($user_id)
    {
        $stmt = $this->conn->prepare("SELECT c.*, p.name AS product_name, p.price, p.img AS product_image 
            FROM cart c 
            JOIN products p ON c.product_id = p.ID 
            WHERE c.user_id = ?");
        $stmt->execute([$user_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function clearCart($user_id)
    {
        $stmt = $this->conn->prepare("DELETE FROM cart WHERE user_id = ?");
        return $stmt->execute([$user_id]);
    }
}
