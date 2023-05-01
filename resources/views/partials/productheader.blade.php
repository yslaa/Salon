<nav class="navbar navbar-default; h-14 bg-gradient-to-r from-purple-500 to-pink-500" style="height: 7rem; padding-top: .5rem; font-size: 2rem;">
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
        @if(Auth::check() && Auth::user()->role === 'supplier')
        <div>
            <ul class="nav navbar-nav">

                <li style="padding: 0 1rem;">
                    <a href="{{ route('product.index') }}">
                        <i class="fa fa-product-hunt" style="padding: 0 .5rem 0 0;" aria-hidden="true"></i> Products
                    </a>
                </li>

                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                        aria-expanded="false"> <i class="fa fa-id-card" style="padding: 0 .5rem 0 0;"
                            aria-hidden="true"></i> Data <span class="caret"></span></a>
                    <ul class="dropdown-menu" style="font-size: 1.75rem;">

                        <div>
                            <ul class="nav navbar-nav">
                                <li>
                                    <a href="{{ url('/supplierProfile') }}">
                                        Profile
                                    </a>
                                </li>

                                <li>
                                    <a href="{{ url('/supplier/profile/edit/{id}') }}">
                                        Update Profile
                                    </a>
                                </li>
                            </ul>
                </li>
            </ul>
        </div>
        @elseif (Auth::check() && Auth::user()->role === 'admin')
            <div>
                <ul class="nav navbar-nav">

                    <li style="padding: 0 1rem;">
                        <a href="{{ url('/transac') }}">
                            <i class="fa fa-cart-arrow-down" style="padding: 0 .5rem 0 0;" aria-hidden="true"></i>
                            Transaction
                        </a>
                    </li>

                    <li style="padding: 0 1rem;">
                        <a href="{{ url('/product') }}">
                            <i class="fa fa-product-hunt" style="padding: 0 .5rem 0 0;" aria-hidden="true"></i> Stock
                        </a>
                    </li>

                    <li style="padding: 0 1rem;">
                        <a href="{{ route ('service.index') }}">
                            <i class="fa fa-handshake-o" style="padding: 0 .5rem 0 0;" aria-hidden="true"></i>
                            Services
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

                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                        aria-expanded="false"> <i class="fa fa-id-card" style="padding: 0 .5rem 0 0;"
                            aria-hidden="true"></i> Data <span class="caret"></span></a>
                    <ul class="dropdown-menu" style="font-size: 1.75rem;">

                        <div>
                            <ul class="nav navbar-nav">
                                <li>
                                    <a href="{{ url('/adminProfile') }}">
                                        Profile
                                    </a>
                                </li>

                                <li>
                                    <a href="{{ url('/admin/profile/edit/{id}') }}">
                                        Update Profile
                                    </a>
                                </li>
                            </ul>
                </li>

                </ul>

                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                        aria-expanded="false"> <i class="fa fa-search" style="padding: 0 .5rem 0 0;" aria-hidden="true"></i>
                        Search <span class="caret"></span></a>
                    <ul class="dropdown-menu" style="font-size: 1.75rem;">

                        <div>
                            <ul class="nav navbar-nav">
                                <li style="padding: 0 1rem;">
                                    <a href="{{ url('/user/search') }}">
                                        Search Users
                                    </a>
                                </li>
                            </ul>
                </li>
            </div>
        </div>
        @endif

      </div>

      <div id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav navbar-right">
              @if (Auth::check())
                  <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                          aria-haspopup="true" aria-expanded="false"><i class="fa fa-user" aria-hidden="true"></i>
                          {{ Auth::user()->role }}
                          <span class="caret"></span></a>
                  @else
                  <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                          aria-haspopup="true" aria-expanded="false"><i class="fa fa-user" aria-hidden="true"></i>
                          Guest <span class="caret"></span></a>
              @endif
              <ul class="dropdown-menu" style="font-size: 1.75rem;">
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
</nav>
