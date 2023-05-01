<div class="navbar bg-secondary" style="z-index: 9999">
    <div class="flex-1">
        <a href="{{ url('/') }}">
            <img src="/navbar/salon.png" alt="salon" style="width: 7.5rem">
        </a>
    </div>

    <div class="flex-none" style="margin-right:5rem;">
        <ul class="menu menu-horizontal px-1">
            @if (Auth::check())
                <li class="dropdown">
                    <a href="#" role="button"><i class="fa fa-user" aria-hidden="true"></i>
                        {{ Auth::user()->role }}
                        <span class="caret"></span></a>
                @else
                <li class="dropdown">
                    <a href="#" role="button"><i class="fa fa-user" aria-hidden="true"></i>
                        Guest <span class="caret"></span></a>
            @endif
            <ul class="p-2 bg-base-100">
                @if (Auth::check())
                    <li
                        style="padding-left: 2rem; white-space: nowrap; overflow: hidden;
                            text-overflow: ellipsis;">
                        <p> Welcome, {{ Auth::user()->name }}</p>
                    </li>
                    <li role="separator" class="divider"></li>
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
