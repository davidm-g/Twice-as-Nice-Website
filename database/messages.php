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

    function sendMessage($db, $sender, $receiver, $itemId, $messageText, $price = null) {
        $query = $db->prepare("INSERT INTO messages (sender, receiver, item_id, message_text, price, timestamp) VALUES (:sender, :receiver, :item_id, :message_text, :price, strftime('%s','now'))");
        $query->execute(['sender' => $sender, 'receiver' => $receiver, 'item_id' => $itemId, 'message_text' => $messageText, 'price' => $price]);
    }

    function remove_proposals($db, $sender, $receiver, $itemId) {
        $query = $db->prepare("UPDATE messages SET price = NULL, message_text = 'Cancelled' WHERE sender = :sender AND receiver = :receiver AND item_id = :item_id AND price IS NOT NULL");
        $query->execute([':sender' => $sender, ':receiver' => $receiver, ':item_id' => $itemId]);
    }

