<div class="sidebar">
    <nav class="sidebar-nav">

        <ul class="nav">
            <div class="text-center mt-4">
                <img src="{{ asset('images/adaroenergy.png') }}" alt="Adaro Energy Logo" width="150">
            </div>
            @can('user_management_access')
                <li class="nav-item nav-dropdown">

                    <a class="nav-link  nav-dropdown-toggle" href="#">
                        <i class="fa-fw fas fa-users nav-icon">

                        </i>
                        {{ trans('cruds.userManagement.title') }}
                    </a>
                    <ul class="nav-dropdown-items">
                        @can('permission_access')
                            <li class="nav-item">
                                <a href="{{ route("admin.permissions.index") }}"
                                   class="nav-link {{ request()->is('admin/permissions') || request()->is('admin/permissions/*') ? 'active' : '' }}">
                                    <i class="fa-fw fas fa-unlock-alt nav-icon">

                                    </i>
                                    {{ trans('cruds.permission.title') }}
                                </a>
                            </li>
                        @endcan
                        @can('role_access')
                            <li class="nav-item">
                                <a href="{{ route("admin.roles.index") }}"
                                   class="nav-link {{ request()->is('admin/roles') || request()->is('admin/roles/*') ? 'active' : '' }}">
                                    <i class="fa-fw fas fa-briefcase nav-icon">

                                    </i>
                                    {{ trans('cruds.role.title') }}
                                </a>
                            </li>
                        @endcan
                        @can('user_access')
                            <li class="nav-item">
                                <a href="{{ route("admin.users.index") }}"
                                   class="nav-link {{ request()->is('admin/users') || request()->is('admin/users/*') ? 'active' : '' }}">
                                    <i class="fa-fw fas fa-user nav-icon">

                                    </i>
                                    {{ trans('cruds.user.title') }}
                                </a>
                            </li>
                        @endcan
                        @can('team_access')
                            <li class="nav-item">
                                <a href="{{ route("admin.teams.index") }}"
                                   class="nav-link {{ request()->is('admin/teams') || request()->is('admin/teams/*') ? 'active' : '' }}">
                                    <i class="fa-fw fas fa-users nav-icon">

                                    </i>
                                    {{ trans('cruds.team.title') }}
                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endcan

            @can('asset_access')
                <li class="nav-item nav-dropdown">
                    <a class="nav-link  nav-dropdown-toggle" href="#">
                        <i class="fa-fw fas fa-capsules nav-icon">

                        </i>
                        Obat-obatan
                    </a>
                    <ul class="nav-dropdown-items">
                        @can('asset_access')
                            <li class="nav-item">
                                <a href="{{ route("admin.assets.index") }}"
                                   class="nav-link {{ request()->is('admin/assets') || request()->is('admin/assets/*') ? 'active' : '' }}">
                                    <i class="fa-fw fas fa-cogs nav-icon">

                                    </i>
                                    Obat
                                </a>
                            </li>
                        @endcan
                        @can('stock_access')
                            <li class="nav-item">
                                <a href="{{ route("admin.stocks.index") }}"
                                   class="nav-link {{ request()->is('admin/stocks') || request()->is('admin/stocks/*') ? 'active' : '' }}">
                                    <i class="fa-fw fas fa-cogs nav-icon">

                                    </i>
                                    Stok Obat
                                </a>
                            </li>
                        @endcan

                        @can('transaction_access')
                            <li class="nav-item">
                                <a href="{{ route("admin.transactions.index") }}"
                                   class="nav-link {{ request()->is('admin/transactions') || request()->is('admin/transactions/*') ? 'active' : '' }}">
                                    <i class="fa-fw fas fa-cogs nav-icon">

                                    </i>
                                    Transaksi Obat
                                </a>
                            </li>
                        @endcan
                        @can('jenisobat_access')
                            <li class="nav-item">
                                <a href="{{ route("admin.jenisobats.index") }}"
                                   class="nav-link {{ request()->is('admin/jenisobat') || request()->is('admin/jenisobat/*') ? 'active' : '' }}">
                                    <i class="fa-fw fas fa-cogs nav-icon">

                                    </i>
                                    Jenis Obat
                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endcan
            @can('alat_access')
                <li class="nav-item nav-dropdown">
                    <a class="nav-link  nav-dropdown-toggle" href="#">
                        <i class="fa-fw fas fa-capsules nav-icon">

                        </i>
                        Alat-alat
                    </a>
                    <ul class="nav-dropdown-items">
                        @can('alat_access')
                            <li class="nav-item">
                                <a href="{{ route("admin.alat.index") }}"
                                   class="nav-link {{ request()->is('admin/alat') || request()->is('admin/alat/*') ? 'active' : '' }}">
                                    <i class="fa-fw fas fa-cogs nav-icon">

                                    </i>
                                    Alat
                                </a>
                            </li>
                        @endcan
                        @can('stock_alat_access')
                            <li class="nav-item">
                                <a href="{{ route("admin.stocksAlat.index") }}"
                                   class="nav-link {{ request()->is('admin/stockAlat') || request()->is('admin/stockAlat/*') ? 'active' : '' }}">
                                    <i class="fa-fw fas fa-cogs nav-icon">

                                    </i>
                                    Stok Alat
                                </a>
                            </li>
                        @endcan

                        @can('transaction_alat_access')
                            <li class="nav-item">
                                <a href="{{ route("admin.transactionsAlat.index") }}"
                                   class="nav-link {{ request()->is('admin/transactionsAlat') || request()->is('admin/transactionsAlat/*') ? 'active' : '' }}">
                                    <i class="fa-fw fas fa-money nav-icon">

                                    </i>
                                    Transaksi Alat
                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endcan
            @can('disposable_access')
                <li class="nav-item nav-dropdown">
                    <a class="nav-link  nav-dropdown-toggle" href="#">
                        <i class="fa-fw fas fa-capsules nav-icon">

                        </i>
                        Disposable
                    </a>
                    <ul class="nav-dropdown-items">
                        @can('disposable_access')
                            <li class="nav-item">
                                <a href="{{ route("admin.disposable.index") }}"
                                   class="nav-link {{ request()->is('admin/disposable') || request()->is('admin/disposable/*') ? 'active' : '' }}">
                                    <i class="fa-fw fas fa-capsules nav-icon">

                                    </i>
                                    Disposable
                                </a>
                            </li>
                        @endcan
                        @can('disposable_stock_access')
                            <li class="nav-item">
                                <a href="{{ route("admin.stocksDisposable.index") }}"
                                   class="nav-link {{ request()->is('admin/stockDisposable') || request()->is('admin/stockDisposable/*') ? 'active' : '' }}">
                                    <i class="fa-fw fas fa-cogs nav-icon">

                                    </i>
                                    Stok Disposable
                                </a>
                            </li>
                        @endcan
                        @can('transactions_disposable_access')
                            <li class="nav-item">
                                <a href="{{ route("admin.transactionsDisposable.index") }}"
                                   class="nav-link {{ request()->is('admin/transactionsDisposable') || request()->is('admin/transactionsDisposable/*') ? 'active' : '' }}">
                                    <i class="fa-fw fas fa-money nav-icon">

                                    </i>
                                    Transaksi Disposable
                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endcan

            @if(file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php')))
                @can('profile_password_edit')
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('profile/password') || request()->is('profile/password/*') ? 'active' : '' }}"
                           href="{{ route('profile.password.edit') }}">
                            <i class="fa-fw fas fa-key nav-icon">
                            </i>
                            {{ trans('global.change_password') }}
                        </a>
                    </li>
                @endcan
            @endif
            <li class="nav-item">
                <a href="#" class="nav-link"
                   onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                    <i class="nav-icon fas fa-fw fa-sign-out-alt">

                    </i>
                    {{ trans('global.logout') }}
                </a>
            </li>
        </ul>

    </nav>
    <button class="sidebar-minimizer brand-minimizer" type="button"></button>
</div>
