<nav class="navbar navbar-default; h-14 bg-gradient-to-r from-purple-500 to-pink-500"
    style="height: 7rem; padding-top: .5rem; font-size: 2rem;">
    <div
        style="display: grid; grid-template-columns: .1fr 1fr auto; padding: 0 2rem; justify-items: center; align-items:center;">

        <div class="navbar-header" style="display: grid; justify-self: start;">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a href="{{ url('/') }}">
                <img src="/navbar/salon.png" alt="salon" style="width: 7.5rem">
            </a>
        </div>

        <div>
            <ul class="nav navbar-nav">

                <li style="padding: 0 1rem;">
                    <a href="{{ url('/transactions') }}">
                        <i class="fa fa-cart-arrow-down" style="padding: 0 .5rem 0 0;" aria-hidden="true"></i>
                        Transaction
                    </a>
                </li>

                <li style="padding: 0 1rem;">
                    <a href="{{ url('/product') }}">
                        <i class="fa fa-product-hunt" style="padding: 0 .5rem 0 0;" aria-hidden="true"></i> Stock
                    </a>
                </li>

                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                        aria-expanded="false"><span style="font-size: 3rem;">&#128480;</span> Charts <span
                            class="caret"></span></a>
                    <ul class="dropdown-menu" style="font-size: 1.75rem;">
                        <div>
                            <ul class="nav navbar-nav">
                                <li style="padding: 0 1rem;">
                                    <a href="{{ url('/dashboard/userRole') }}">
                                        All User Chart
                                    </a>
                                </li>
                        </div>
                    </ul>
                </li>


                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                        aria-expanded="false"> <i class="fa fa-archive" style="padding: 0 .5rem 0 0;"
                            aria-hidden="true"></i> Tables <span class="caret"></span></a>
                    <ul class="dropdown-menu" style="font-size: 1.75rem;">

                        <div>
                            <ul class="nav navbar-nav">


                                <li style="padding: 0 1rem;">
                                    <a href="{{ url('/admin') }}">
                                        Admins
                                    </a>
                                </li>

                                <li style="padding: 0 1rem;">
                                    <a href="{{ url('/customer') }}">
                                        Customers
                                    </a>
                                </li>

                                <li style="padding: 0 1rem;">
                                    <a href="{{ url('/employee') }}">
                                        Employees
                                    </a>
                                </li>

                                <li style="padding: 0 1rem;">
                                    <a href="{{ url('/supplier') }}">
                                        Suppliers
                                    </a>
                                </li>
                            </ul>
                </li>
            </ul>

            <li><a href="{{ url('/user/search') }}">
                    Search
                </a></li>

            <li tabindex="0">
                @if (Auth::check())
            <li>
                <a href="#"><i class="fa fa-user"></i></i>
                    {{ Auth::user()->role }}
                    <span class="caret"></span></a>
            @else
            <li>
                <a href="#"></a>
                Guest</a>
                @endif
                <ul class="p-2 bg-base-100" >
                    @if (Auth::check())
                        <li>
                            <a href="{{ url('/admin/profile/edit/{id}') }}">
                                Update Profile
                            </a>
                        </li>
                        <li>
                           <P>Welcome, {{ Auth::user()->name }} </P> 
                        </li>
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
