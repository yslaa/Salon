<div class="navbar bg-secondary" style="z-index: 9999">
    <div class="flex-1">
        <a href="{{ url('/') }}">
            <img src="/navbar/salon.png" alt="salon" style="width: 7.5rem">
        </a>
    </div>
    <div class="flex-none" style="margin-right:5rem;">
        <ul class="menu menu-horizontal px-1">
            <li><a href="{{ url('/transactions') }}">Transaction</a></li>
            <li><a href="{{ url('/product') }}">Stock</a></li>
            <li>
                <a>
                    Charts
                    <svg class="fill-current" xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                        viewBox="0 0 24 24">
                        <path d="M7.41,8.58L12,13.17L16.59,8.58L18,10L12,16L6,10L7.41,8.58Z" />
                    </svg>
                </a>
                <ul class="p-2 bg-base-100">
                    <li> <a href="{{ url('/dashboard/userRole') }}">
                            All User Chart
                        </a></li>
                </ul>
            </li>
            <li tabindex="0">
                <a>
                    Tables
                    <svg class="fill-current" xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                        viewBox="0 0 24 24">
                        <path d="M7.41,8.58L12,13.17L16.59,8.58L18,10L12,16L6,10L7.41,8.58Z" />
                    </svg>
                </a>
                <ul class="p-2 bg-base-100">
                    <li> <a href="{{ url('/admin') }}">
                            Admins
                        </a></li>
                    <li> <a href="{{ url('/customer') }}">
                            Customers
                        </a></li>
                    <li> <a href="{{ url('/employee') }}">
                            Employees
                        </a></li>
                    <li> <a href="{{ url('/supplier') }}">
                            Suppliers
                        </a></li>
                </ul>
            </li>

            <li><a href="{{ url('/user/search') }}">
                    Search
                </a></li>

            <li tabindex="0">
                @if (Auth::check())
            <li>
                <a href="#"><i class="fa fa-user"></i>
                    {{ Auth::user()->role }}
                    <span class="caret"></span></a>
            @else
            <li>
                <a href="#">
                    Guest</a>
                @endif
                <ul class="p-2 bg-base-100">
                    @if (Auth::check())
                        <li>
                            <a href="{{ url('/adminProfile') }}">
                                @if (strlen(Auth::user()->name) > 10)
                                    Welcome,<br>{{ Auth::user()->name }}
                                @else
                                    Welcome, {{ Auth::user()->name }}
                                @endif
                            </a>

                        </li>
                        <li>
                            <a href="{{ url('/admin/profile/edit/{id}') }}">
                                Update Profile
                            </a>

                        <li><a href="{{ route('user.logout') }}">Logout</a></li>
                    @else
                        <li><a href="{{ route('customer.registers') }}">Customer Signup</a></li>
                        <li><a href="{{ route('supplier.registers') }}">Supplier Signup</a></li>
                        <li><a href="{{ route('employee.registers') }}">Employee Signup</a></li>
                        <li><a href="{{ route('admin.registers') }}">Admin Signup</a></li>
                        <li><a href="{{ route('user.signIn') }}">Signin</a></li>
                    @endif
                </ul>
            </li>
        </ul>
    </div>

</div>
