<nav
            class="navbar navbar-header navbar-header-transparent navbar-expand-lg border-bottom"
          >
            <div class="container-fluid">
              <nav
                class="navbar navbar-header-left navbar-expand-lg navbar-form nav-search p-0 d-none d-lg-flex"
              >
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
                    <span class="op-7">Hi,</span>
                    <span class="fw-bold">{{ auth()->user()->name }}</span>
                </span>
                <div class="ms-3">
                    <p class="text-muted mb-0" id="liveClock">Loading...</p> 
                    <script>
                        function updateClock() {
                            const clockElement = document.getElementById("liveClock");
                            const now = new Date();
                    
                            // Format waktu: HH:MM:SS
                            const hours = now.getHours().toString().padStart(2, '0');
                            const minutes = now.getMinutes().toString().padStart(2, '0');
                            const seconds = now.getSeconds().toString().padStart(2, '0');
                    
                            clockElement.textContent = `${hours}:${minutes}:${seconds}`;
                        }
                    
                        // Jalankan fungsi updateClock setiap detik
                        setInterval(updateClock, 1000);
                    
                        // Jalankan sekali saat halaman pertama kali dimuat
                        updateClock();
                    </script><!-- Jam akan tampil di sini -->
                </div>
            </span>

                <form action="{{ route('logout') }}" method="POST" class="d-inline ms-3">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-info btn-sm" type="submit"  style="margin-right: 25px;">Logout</button>
                </form>
            </li>

              </ul>
            </div>
          </nav>
