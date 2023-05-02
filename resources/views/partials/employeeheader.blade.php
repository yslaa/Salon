<div class="navbar bg-secondary" style="z-index: 9999">
    <div class="flex-1">
        <a href="{{ url('/') }}">
            <img src="/navbar/salon.png" alt="salon" style="width: 7.5rem">
        </a>
    </div>
    <div class="flex-none" style="margin-right:5rem;">
        <ul class="menu menu-horizontal px-1">
            
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
                            <a href="{{ url('/employeeProfile') }}">
                                Welcome, {{ Auth::user()->name }}
                            </a>
                        </li>
                        <li>
                            <a href="{{ url('/employee/profile/edit/{id}') }}">
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
