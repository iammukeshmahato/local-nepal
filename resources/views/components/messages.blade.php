@push('links')
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/app-chat.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}">
    <style>
        .chat-contact-list-item.active {
            background-color: #8a8cf3;
        }
    </style>
@endpush
@section('main-content')
    @if (!$clients->isEmpty())
        <div class="app-chat overflow-hidden card">
            <div class="row g-0">
                <!-- Chat & Contacts -->
                <div class="col app-chat-contacts app-sidebar flex-grow-0 overflow-hidden border-end" id="app-chat-contacts">
                    <div class="sidebar-body ps ps--active-y">

                        <!-- Chats -->
                        <ul class="list-unstyled chat-contact-list pt-1" id="chat-list">
                            <li class="chat-contact-list-item chat-contact-list-item-title">
                                <h5 class="text-primary mb-0">Guides</h5>
                            </li>
                            @foreach ($clients as $item)
                                <li
                                    class="chat-contact-list-item
                                @if ($item->user->id == $receiver_id) active @endif
                                ">
                                    <a class="d-flex align-items-center"
                                        href="{{ url('/' . Auth::user()->role . '/messages/' . $item->user->id) }}">
                                        <div class="flex-shrink-0 avatar">
                                            <img src="{{ asset('storage/profiles/' . $item->user->avatar) }}" alt="Avatar"
                                                class="rounded-circle">
                                        </div>
                                        <div class="chat-contact-info flex-grow-1 ms-3">
                                            <h6 class="chat-contact-name text-truncate m-0">{{ $item->user->name }}</h6>
                                            <p class="chat-contact-status text-truncate mb-0 text-muted">Refer friends. Get
                                                rewards.</p>
                                        </div>
                                        <small class="text-muted mb-auto">5 Minutes</small>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <!-- /Chat contacts -->

                <!-- Chat History -->
                <div class="col app-chat-history">
                    <div class="chat-history-wrapper">
                        <div class="chat-history-header border-bottom">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="d-flex overflow-hidden align-items-center">
                                    <i class="bx bx-menu bx-sm cursor-pointer d-lg-none d-block me-2"
                                        data-bs-toggle="sidebar" data-overlay="" data-target="#app-chat-contacts"></i>
                                    <div class="flex-shrink-0 avatar">
                                        <img src="  @if (isset($receiver)) {{ asset('storage/profiles/' . $receiver->user->avatar) }}
                                    @else
                                        {{ asset('storage/profiles/' . $clients[0]->user->avatar) }} @endif"
                                            alt="Avatar" class="rounded-circle" data-bs-toggle="sidebar" data-overlay=""
                                            data-target="#app-chat-sidebar-right">
                                    </div>
                                    <div class="chat-contact-info flex-grow-1 ms-3">
                                        <h6 class="m-0">
                                            @if (isset($receiver))
                                                {{ $receiver->user->name }}
                                            @else
                                                {{ $clients[0]->user->name }}
                                            @endif
                                        </h6>
                                        <small class="user-status text-muted">Location</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="chat-history-body ps ps--active-y">
                            <ul class="list-unstyled chat-history mb-0">

                                @foreach ($messages as $item)
                                    @if ($item->sender_id == auth()->user()->id)
                                        <li class="chat-message chat-message-right">
                                            <div class="d-flex overflow-hidden">
                                                <div class="chat-message-wrapper flex-grow-1">
                                                    <div class="chat-message-text">
                                                        <p class="mb-0">{{ $item->message }}</p>
                                                    </div>
                                                </div>
                                                <div class="user-avatar flex-shrink-0 ms-3">
                                                    <div class="avatar avatar-sm">
                                                        <img src="{{ asset('storage/profiles/' . auth()->user()->avatar) }}"
                                                            alt="Avatar" class="rounded-circle">
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    @else
                                        <li class="chat-message">
                                            <div class="d-flex overflow-hidden">
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
                                                        <p class="mb-0">{{ $item->message }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    @endif
                                @endforeach

                            </ul>

                        </div>
                        <!-- Chat message form -->
                        <div class="chat-history-footer">
                            <form class="form-send-messagee d-flex justify-content-between align-items-center"
                                action="{{ url('/tourist/message') }}" method="post">
                                @csrf
                                <input type="hidden" name="sender_id" value="{{ Auth::user()->id }}">
                                <input type="hidden" name="receiver_id" value="{{ $receiver_id }}">
                                <input class="form-control message-input border-0 me-3 shadow-none"
                                    placeholder="Type your message here..." name="message">
                                <div class="message-actions d-flex align-items-center">
                                    <i class="speech-to-text bx bx-microphone bx-sm cursor-pointer"></i>
                                    <label for="attach-doc" class="form-label mb-0">
                                        <i class="bx bx-paperclip bx-sm cursor-pointer mx-3"></i>
                                    </label>
                                    <button class="btn btn-primary d-flex send-msg-btn">
                                        <i class="bx bx-paper-plane me-md-1 me-0"></i>
                                        <span class="align-middle d-md-inline-block d-none">Send</span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- /Chat History -->

                <div class="app-overlay"></div>
            </div>
        </div>
    @endif
@endsection

@push('script')
    <script src="{{ asset('assets/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('assets/js/chat.js') }}"></script>
@endpush
