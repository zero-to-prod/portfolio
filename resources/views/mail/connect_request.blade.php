<?php
/* @var \App\Models\Message $message_model */
?>

email: {{$message_model->contact->email}}
subject: {{$message_model->subject}}
body: {{$message_model->body}}


