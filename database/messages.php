<?php
    function getConversations($db, $username) {
        $query = $db->prepare("
        SELECT DISTINCT receiver AS other_user, item_id FROM messages WHERE sender = :username
        UNION
        SELECT DISTINCT sender AS other_user, item_id FROM messages WHERE receiver = :username
        ");
        $query->execute(['username' => $username]);
    
        // Fetch all conversations
        $conversations = $query->fetchAll(PDO::FETCH_ASSOC);
    
        return $conversations;
    }

    function getMessages($db, $username1, $username2, $itemId) {
        $query = $db->prepare("
            SELECT * FROM messages 
            WHERE ((sender = :username1 AND receiver = :username2) OR (sender = :username2 AND receiver = :username1)) 
            AND item_id = :itemId
            ORDER BY timestamp ASC
        ");
        $query->execute(['username1' => $username1, 'username2' => $username2, 'itemId' => $itemId]);
    
        // Fetch all messages
        $messages = $query->fetchAll(PDO::FETCH_ASSOC);
    
        return $messages;
    }

    function remove_proposals($db, $sender, $receiver, $itemId) {
        $query = $db->prepare("UPDATE messages SET price = NULL, message_text = 'Cancelled offer' WHERE sender = :sender AND receiver = :receiver AND item_id = :item_id AND price IS NOT NULL");
        $query->execute([':sender' => $sender, ':receiver' => $receiver, ':item_id' => $itemId]);
    }
    
    function sendMessage($db, $sender, $receiver, $itemId, $messageText, $price) {
        $query = $db->prepare("INSERT INTO messages (sender, receiver, item_id, message_text, price, timestamp) VALUES (:sender, :receiver, :item_id, :message_text, :price, :timestamp)");
        $query->execute([
            ':sender' => $sender,
            ':receiver' => $receiver,
            ':item_id' => $itemId,
            ':message_text' => $messageText,
            ':price' => $price,
            ':timestamp' => time()
        ]);
    }
    function update_message($db, $messageId) {
        $stmt = $db->prepare("UPDATE messages SET price=NULL, message_text='Offer accepted.' WHERE id = :message_id");
        $stmt->execute([':message_id' => $messageId]);
    }
    
    function create_offer_message($db, $username, $otherUser, $itemId, $price) {
        $stmt = $db->prepare("INSERT INTO messages (sender, receiver, item_id, price, offer_accepted, timestamp) VALUES (:sender, :receiver, :item_id, :price, 1, :timestamp)");
        $stmt->execute([
            ':sender' => $username,
            ':receiver' => $otherUser,
            ':item_id' => $itemId,
            ':price' => $price,
            ':timestamp' => time()
        ]);
    }

    function getNewMessages($db, $user, $item, $lastMessageId) {
        $query = $db->prepare("SELECT * FROM messages WHERE (receiver = :user OR sender = :user) AND item_id = :item AND id > :lastMessageId ORDER BY id ASC");
        $query->execute([':user' => $user, ':item' => $item, ':lastMessageId' => $lastMessageId]);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
    
    function getLatestMessageId($db, $username, $otherUser, $itemId) {
        $stmt = $db->prepare('SELECT MAX(id) AS max_id FROM messages WHERE (sender = ? AND receiver = ? OR sender = ? AND receiver = ?) AND item_id = ?');
        $stmt->execute([$username, $otherUser, $otherUser, $username, $itemId]);
        $result = $stmt->fetch();
        return $result['max_id'] ?? 10;
    }