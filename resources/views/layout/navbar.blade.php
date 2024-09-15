<nav
            class="navbar navbar-header navbar-header-transparent navbar-expand-lg border-bottom"
          >
            <div class="container-fluid">
              <nav
                class="navbar navbar-header-left navbar-expand-lg navbar-form nav-search p-0 d-none d-lg-flex"
              >
                <div class="input-group">
                  <div class="input-group-prepend">
                    <button type="submit" class="btn btn-search pe-1">
                      <i class="fa fa-search search-icon"></i>
                    </button>
                  </div>
                  <input
                    type="text"
                    placeholder="Search ..."
                    class="form-control"
                  />
                </div>

              </nav>
              <li class="nav-item topbar-user dropdown hidden-caret d-flex align-items-center">
                {{-- <div class="avatar-sm me-2">
                    <img src={{  }}" alt="{{ auth()->user()->name }}" class="avatar-img rounded-circle" />
                </div> --}}
                <span class="profile-username">
                    <span class="op-7">Hi,</span>
                    <span class="fw-bold">{{ auth()->user()->name }}</span>
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
