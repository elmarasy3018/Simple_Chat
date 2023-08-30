<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('/CSS/chat-styles.css')}}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
    <?php date_default_timezone_set("Europe/Moscow"); ?>
</head>

<body>
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Chat') }}
            </h2>
        </x-slot>
        <div class="messenger">
            <section class="msger">
                <header class="msger-header">
                    <div class="msger-header-title">
                        <i class="fas fa-comment-alt"></i> Live Chat With {{$receiver->name}}
                    </div>
                    <div class="msger-header-options">
                        <span><i class="fas fa-cog"></i></span>
                    </div>
                </header>
                <main class="msger-chat">
                    <div id="chat_area">
                        <div class="msg left-msg">
                            <div class="msg-img" style="background-image: url(https://media.istockphoto.com/id/1272346758/vector/bot-customer-service-icon.jpg?s=170667a&w=0&k=20&c=KuhrTpI2stMkKIMcESg6eZzdFR0ol1ZQ6A5kPag0ppE=)"></div>
                            <div class="msg-bubble">
                                <div class="msg-info">
                                    <div class="msg-info-name">Bot</div>
                                    <div class="msg-info-time" id="time">
                                    </div>
                                </div>
                                <div class="msg-text">
                                    Hi, Go ahead and send a message. 😄
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
                <form class="msger-inputarea">
                    <input type="text" id="message" class="msger-input" placeholder="Enter your message...">
                    <button type="button" id="send">Here</button>
                </form>
            </section>
        </div>
    </x-app-layout>
    <script>
        $("#send").click(function() {
            $.post("/chat/{{$receiver->id}}", {
                    message: $("#message").val(),
                },
                function(data, status) {
                    console.log("Data: " + data + "\nStatus: " + status);
                    var senderTime = new Date().toLocaleTimeString('en-US', {
                        hour: "numeric",
                        minute: "numeric"
                    });
                    let senderMessage = '<div class="msg right-msg">' +
                        '<div class="msg-img" style="background-image: url(https://image.flaticon.com/icons/svg/145/145867.svg)"></div>' +
                        '<div class="msg-bubble"><div class="msg-info"><div class="msg-info-name">Me</div>' +
                        '<div class="msg-info-time">' + senderTime + '</div></div>' +
                        '<div class="msg-text">' +
                        $("#message").val() +
                        '</div></div></div>';
                    $("#chat_area").append(senderMessage);
                    $("#message").val(null);
                });
        });
        Pusher.logToConsole = true;
        var pusher = new Pusher('9578c61973567b827748', {
            cluster: 'eu'
        });
        var channel = pusher.subscribe('chat{{auth::user()->id}}');
        channel.bind('chatMessage', function(data) {
            // alert(JSON.stringify(data));
            var receiverTime = new Date().toLocaleTimeString('en-US', {
                hour: "numeric",
                minute: "numeric"
            });
            let receiverMessage = '<div class="msg left-msg"><div class="msg-img" style="background-image: url(https://image.flaticon.com/icons/svg/327/327779.svg)"></div>' +
                '<div class="msg-bubble"><div class="msg-info"><div class="msg-info-name">' + data.sender.name + '</div><div class="msg-info-time">' + receiverTime + '</div></div><div class="msg-text">' +
                data.message + '</div></div></div>';
            $("#chat_area").append(receiverMessage);
        });
    </script>
    <script>
        document.getElementById("time").innerHTML = new Date().toLocaleTimeString('en-US', {
            hour: "numeric",
            minute: "numeric"
        });
    </script>
</body>

</html>