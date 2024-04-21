 <!-- Main Sidebar Container -->
 <aside class="main-sidebar sidebar-dark-primary elevation-4">
     <!-- Brand Logo -->
     <a href="{{ route('dashboard') }}" class="brand-link">
         <img src="{{ asset('assets/dist/img/AdminLTELogo.png') }}" class="brand-image img-circle elevation-3"
             style="opacity: .8">
         <span class="brand-text font-weight-light">Dashboard</span>
     </a>

     <!-- Sidebar -->
     <div class="sidebar">
         <!-- Sidebar user panel (optional) -->
         <div class="user-panel mt-3 pb-3 mb-3 d-flex flex-column">
             <div class="image">
                 <img src="{{ asset('storage/' . auth()->user()->profile_photo_path) ?? asset('avater.png') }}"
                     class="img-circle elevation-2" alt="User Image">
             </div>
             <div class="info">
                 <a href="{{ route('user.index') }}" class="d-block">{{ auth()->user()->name }}</a>
             </div>
             <br />
             <div class="info text-light">
                 {{-- Total Balance of approved loans --}}
                 Total Balance:
                 <?php
                 $totalBalance = \App\Models\Loan::where('loan_status', 'approved')->sum('principal_amount');
                 echo $totalBalance;
                 ?>
                 <br>

                 {{-- Number of active wallets with amount > 0 --}}
                 @php
                     $activeWallets = \App\Models\Wallet::where('amount', '>', 0)->get();
                 @endphp

                 Active Wallets:
                 @foreach ($activeWallets as $wallet)
                     <p>Name: {{ $wallet->name }}, Balance: {{ $wallet->amount }}</p>
                 @endforeach
             </div>
         </div>

         <!-- SidebarSearch Form -->
         <div class="form-inline">
             <div class="input-group" data-widget="sidebar-search">
                 <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                     aria-label="Search">
                 <div class="input-group-append">
                     <button class="btn btn-sidebar">
                         <i class="fas fa-search fa-fw"></i>
                     </button>
                 </div>
             </div>
         </div>

         <!-- Sidebar Menu -->
         <nav class="mt-2">
             <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                 data-accordion="false">
                 <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                 <li class="nav-item menu-open">
                     <a href="#" class="nav-link {{ request()->routeIs('borrower.*') ? 'active' : '' }}">
                         <i class="nav-icon fas fa-building"></i>
                         <p>
                             Borrowers
                             <i class="right fas fa-angle-left"></i>
                         </p>
                     </a>
                     <ul class="nav nav-treeview">
                         <li class="nav-item">
                             <a href="{{ route('borrower.index') }}"
                                 class="nav-link {{ request()->routeIs('borrower.index') ? 'active' : '' }}">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p>All Borowers</p>
                             </a>
                         </li>
                     </ul>
                 </li>


                 <li class="nav-item">
                     <a href="#"
                         class="nav-link {{ request()->routeIs('loan.*') || request()->routeIs('loan.*') ? 'active' : '' }}">
                         <i class="nav-icon fas fa-store"></i>
                         <p>
                             Loans
                             <i class="right fas fa-angle-left"></i>
                         </p>
                     </a>
                     <ul class="nav nav-treeview">


                         <li class="nav-item">
                             <a href="{{ route('loan.index') }}"
                                 class="nav-link {{ request()->routeIs('loan.*') ? 'active' : '' }}">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p>Add Loan</p>
                             </a>
                         </li>

                         <li class="nav-item">
                             <a href="{{ route('loan.requested') }}"
                                 class="nav-link {{ request()->routeIs('loan.*') ? 'active' : '' }}">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p>Pending Loans</p>
                             </a>
                         </li>

                         <li class="nav-item">
                             <a href="{{ route('loan.processing') }}"
                                 class="nav-link {{ request()->routeIs('loan.*') ? 'active' : '' }}">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p>Loans Processing</p>
                             </a>
                         </li>

                         <li class="nav-item">
                             <a href="{{ route('loan.approved') }}"
                                 class="nav-link {{ request()->routeIs('loan.*') ? 'active' : '' }}">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p>Active Loans</p>
                             </a>
                         </li>

                         <li class="nav-item">
                             <a href="{{ route('loan.denied') }}"
                                 class="nav-link {{ request()->routeIs('loan.*') ? 'active' : '' }}">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p>Denied Loans</p>
                             </a>
                         </li>

                         <li class="nav-item">
                             <a href="{{ route('loan.default') }}"
                                 class="nav-link {{ request()->routeIs('loan.*') ? 'active' : '' }}">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p>Defaulted Loans</p>
                             </a>
                         </li>

                         <li class="nav-item">
                             <a href="{{ route('loan.penalty') }}"
                                 class="nav-link {{ request()->routeIs('loan.*') ? 'active' : '' }}">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p>Loan Penalty</p>
                             </a>
                         </li>

                         <li class="nav-item">
                             <a href="{{ route('loan.agreemenet_form') }}"
                                 class="nav-link {{ request()->routeIs('loan.*') ? 'active' : '' }}">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p>Loan Agreement Forms</p>
                             </a>
                         </li>

                         <li class="nav-item">
                             <a href="{{ route('loan.settlement_form') }}"
                                 class="nav-link {{ request()->routeIs('loan.*') ? 'active' : '' }}">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p>Loan Settlement Forms</p>
                             </a>
                         </li>
                     </ul>
                 </li>




                 <li class="nav-item">
                     <a href="#" class="nav-link">
                         <i class="nav-icon fas fa-dollar-sign"></i>
                         <p>
                             Wallet Accounts
                             <i class="fas fa-angle-left right"></i>
                         </p>
                     </a>
                     <ul class="nav nav-treeview">

                         <li class="nav-item">
                             <a href="{{ route('wallet.index') }}" class="nav-link">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p>Add Account</p>
                             </a>
                         </li>


                         <li class="nav-item">
                             <a href="{{ route('wallet.create') }}" class="nav-link">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p>Create Account</p>
                             </a>
                         </li>
                     </ul>
                 </li>

                 <li class="nav-item">
                     <a href="#" class="nav-link">
                         <i class="nav-icon fas fa-dollar-sign"></i>
                         <p>
                             Transfer
                             <i class="fas fa-angle-left right"></i>
                         </p>
                     </a>
                     <ul class="nav nav-treeview">

                         <li class="nav-item">
                             <a href="{{ route('transfer.index') }}" class="nav-link">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p> All Transfer</p>
                             </a>
                         </li>


                         <li class="nav-item">
                             <a href="{{ route('transfer.create') }}" class="nav-link">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p>Make Transfer</p>
                             </a>
                         </li>
                     </ul>
                 </li>


                 <li class="nav-item">
                     <a href="" class="nav-link {{ request()->routeIs('account.*') ? 'active' : '' }}">
                         <i class="nav-icon fas fa-book"></i>
                         <p>
                             Accounts
                             <i class="fas fa-angle-left right"></i>
                         </p>
                     </a>
                     <ul class="nav nav-treeview">

                         <li class="nav-item">
                             <a href="{{ route('account.index') }}"
                                 class="nav-link {{ request()->routeIs('account.index') ? 'active' : '' }}">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p>All Accounts</p>
                             </a>
                         </li>

                         <li class="nav-item">
                             <a href="{{ route('account.create') }}"
                                 class="nav-link {{ request()->routeIs('account.create') ? 'active' : '' }}">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p>Create Account</p>
                             </a>
                         </li>

                     </ul>
                 </li>

                 <li class="nav-item">
                     <a href="#" class="nav-link {{ request()->routeIs('users.*') ? 'active' : '' }}">
                         <i class="nav-icon fas fa-cog"></i>
                         <p>
                             Users & System
                             <i class="fas fa-angle-left right"></i>
                         </p>
                     </a>
                     <ul class="nav nav-treeview">

                         <li class="nav-item">
                             <a href="{{ route('user.index') }}"
                                 class="nav-link {{ request()->routeIs('user.index') ? 'active' : '' }}">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p>User Profile</p>
                             </a>
                         </li>


                         <li class="nav-item">
                             <a href="{{ url('user/profile/') }}"
                                 class="nav-link {{ request()->routeIs('profile.show') ? 'active' : '' }}">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p>User Management</p>
                             </a>
                         </li>

                         <li class="nav-item">
                             <a href="{{ route('attachment.index') }}"
                                 class="nav-link {{ request()->routeIs('user.attachment') ? 'active' : '' }}">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p>User Attachment</p>
                             </a>
                         </li>
                     </ul>
                 </li>





             </ul>
         </nav>
         <!-- /.sidebar-menu -->
     </div>
     <!-- /.sidebar -->
 </aside>
