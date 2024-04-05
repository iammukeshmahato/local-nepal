let receiver_id = "{{ $receiver_id }}";
let sender_id = "{{ Auth::user()->id }}";
let sender_role = "{{ Auth::user()->role }}";

if (sender_role == 'tourist') {
    channel_name = 'chat-' + sender_id + '-' + receiver_id;
} else {
    channel_name = 'chat-' + receiver_id + '-' + sender_id;
}

var pusher = new Pusher('c4511fa24aeddfc52ef2', {
    cluster: 'ap2'
});

var channel = pusher.subscribe(channel_name);
channel.bind('message', function (data) {
    newElem = document.createElement('li');
    newElem.classList.add('chat-message');
    newElem.innerHTML = `<div class="d-flex overflow-hidden">
                                    <div class="user-avatar flex-shrink-0 me-3">
                                        <div class="avatar avatar-sm">
                                            @if (isset($receiver))
                                                <img src="{{ asset('storage/profiles/' . $receiver->user->avatar) }}"
                                                    alt="Avatar" class="rounded-circle">
                                            @else
                                                <img src="{{ asset('storage/profiles/' . $clients[0]->user->avatar) }}"
                                                    alt="Avatar" class="rounded-circle">
                                            @endif
                                        </div>
                                    </div>
                                    <div class="chat-message-wrapper flex-grow-1">
                                        <div class="chat-message-text">
                                            <p class="mb-0">${data.message}</p>
                                        </div>
                                    </div>
                                </div>`;


    // Add the message to the chat history list
    var chatList = document.querySelector('.chat-history');
    chatList.appendChild(newElem);
    a = document.querySelector('.chat-history-body');
    a.scrollTo(0, a.scrollHeight);
});