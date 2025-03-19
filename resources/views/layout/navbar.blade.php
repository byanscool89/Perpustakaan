<nav class="navbar navbar-header navbar-header-transparent navbar-expand-lg border-bottom">
    <div class="container-fluid">
        <nav class="navbar navbar-header-left navbar-expand-lg navbar-form nav-search p-0 d-none d-lg-flex">
            <form action="">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </nav>

        <li class="nav-item topbar-user dropdown hidden-caret d-flex align-items-center">
            {{-- <div class="avatar-sm me-2">
                <img src={{  }}" alt="{{ auth()->user()->name }}" class="avatar-img rounded-circle" />
            </div> --}}
            <span class="profile-username d-flex align-items-center">
                <span>
                    <span class="op-7" id="greeting">Halo,</span>
                    <span class="fw-bold">{{ auth()->user()->name }}</span>
                    <span class="ms-2">😊</span>
                </span>
                <div class="ms-3">
                    <p class="text-muted mb-0" id="liveClock">Loading...</p>
                </div>
            </span>

            <form action="{{ route('logout') }}" method="POST" class="d-inline ms-3">
                @csrf
                @method('DELETE')
                <button class="btn btn-info btn-sm" type="submit" style="margin-right: 25px;">Logout</button>
            </form>
        </li>
    </div>
</nav>

<script>
    function updateClockAndGreeting() {
        const clockElement = document.getElementById("liveClock");
        const greetingElement = document.getElementById("greeting");
        const now = new Date();

        const hours = now.getHours().toString().padStart(2, '0');
        const minutes = now.getMinutes().toString().padStart(2, '0');
        const seconds = now.getSeconds().toString().padStart(2, '0');

        clockElement.textContent = `${hours}:${minutes}:${seconds}`;


        let greeting;
        if (hours >= 5 && hours < 12) {
            greeting = "Selamat Pagi,";
        } else if (hours >= 12 && hours < 15) {
            greeting = "Selamat Siang,";
        } else if (hours >= 15 && hours < 18) {
            greeting = "Selamat Sore,";
        } else {
            greeting = "Selamat Malam,";
        }

        greetingElement.textContent = greeting;
    }

    // Jalankan fungsi updateClockAndGreeting setiap detik
    setInterval(updateClockAndGreeting, 1000);

    // Jalankan sekali saat halaman pertama kali dimuat
    updateClockAndGreeting();
</script>
