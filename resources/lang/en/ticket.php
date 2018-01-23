<?php

return [
    'notifications' => [
        'reply' => [
            'subject' => 'Someone replied to your ticket!',
            'message' => 'Hello, :user replied to your ticket. Come check it out!',
            'action' => 'View Ticket',
        ],

        'comment' => [
            'subject' => 'Someone commented on your reply!',
            'message' => 'Hello, :user posted a comment on your reply. Come check it out!',
            'action' => 'View Ticket',
        ],

        'assigned' => [
            'subject' => 'You\'ve been assigned to a ticket!',
            'message' => 'Hello, :user has assigned a new ticket to you. Come check it out!',
            'action' => 'View Ticket',
        ],
    ]
];
